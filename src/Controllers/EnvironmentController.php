<?php

namespace duxphp\DuxravelInstaller\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use duxphp\DuxravelInstaller\Events\EnvironmentSaved;
use duxphp\DuxravelInstaller\Helpers\EnvironmentManager;
use Validator;
use function Couchbase\defaultDecoder;

class EnvironmentController extends Controller
{
    /**
     * @var EnvironmentManager
     */
    protected $EnvironmentManager;

    /**
     * @param EnvironmentManager $environmentManager
     */
    public function __construct(EnvironmentManager $environmentManager)
    {
        $this->EnvironmentManager = $environmentManager;
    }

    /**
     * Display the Environment menu page.
     *
     * @return \Illuminate\View\View
     */
    public function environmentMenu()
    {
        return view('vendor/duxphp/duxravel-installer/src/Views/environment');
    }

    /**
     * Display the Environment page.
     *
     * @return \Illuminate\View\View
     */
    public function environmentWizard()
    {
        $envConfig = $this->EnvironmentManager->getEnvContent();
        $data = config('installer.environment.form.fields');
        return view('vendor/duxphp/duxravel-installer/src/Views/environment-wizard', [
            'env' => \Dotenv\Dotenv::parse($envConfig),
            'data' => $data
        ]);
    }

    /**
     * Display the Environment page.
     *
     * @return \Illuminate\View\View
     */
    public function environmentClassic()
    {
        $envConfig = $this->EnvironmentManager->getEnvContent();

        return view('vendor/duxphp/duxravel-installer/src/Views/environment-classic', compact('envConfig'));
    }

    /**
     * Processes the newly saved environment configuration (Classic).
     *
     * @param Request $input
     * @param Redirector $redirect
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveClassic(Request $input, Redirector $redirect)
    {
        $message = $this->EnvironmentManager->saveFileClassic($input);

        event(new EnvironmentSaved($input));

        return $redirect->route('DuxravelInstaller::environmentClassic')
                        ->with(['message' => $message]);
    }

    /**
     * Processes the newly saved environment configuration (Form Wizard).
     *
     * @param Request $request
     * @param Redirector $redirect
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveWizard(Request $request, Redirector $redirect)
    {
        $rules = config('installer.environment.form.rules');
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $redirect->route('DuxravelInstaller::environmentWizard')->withInput()->withErrors($validator->errors());
        }

        if (! $this->checkDatabaseConnection($request)) {
            return $redirect->route('DuxravelInstaller::environmentWizard')->withInput()->withErrors([
                'DB_CONNECTION' => trans('duxinstall::lang.environment.wizard.form.DB_CONNECTION_failed'),
            ]);
        }

        try {
            $redis = new \Redis();
            $redis->connect($request->input('REDIS_HOST'), 6379);
            if ($request->input('REDIS_PASSWORD')) {
                $redis->auth($request->input('REDIS_PASSWORD'));
            }
            $redis->ping();
        }catch (\Exception $e) {
            return $redirect->route('DuxravelInstaller::environmentWizard')->withInput()->withErrors([
                'REDIS_HOST' => trans('duxinstall::lang.environment.wizard.form.REDIS_CONNECTION_failed'),
            ]);
        }

        $results = $this->EnvironmentManager->saveFileWizard($request);

        event(new EnvironmentSaved($request));

        return $redirect->route('DuxravelInstaller::database')
                        ->with(['results' => $results]);
    }

    /**
     * TODO: We can remove this code if PR will be merged: https://github.com/RachidLaasri/DuxravelInstaller/pull/162
     * Validate database connection with user credentials (Form Wizard).
     *
     * @param Request $request
     * @return bool
     */
    private function checkDatabaseConnection(Request $request)
    {
        $connection = $request->input('DB_CONNECTION');

        $settings = config("database.connections.$connection");

        config([
            'database' => [
                'default' => $connection,
                'connections' => [
                    $connection => array_merge($settings, [
                        'driver' => $connection,
                        'host' => $request->input('DB_HOST'),
                        'port' => $request->input('DB_PORT'),
                        'database' => $request->input('DB_DATABASE'),
                        'username' => $request->input('DB_USERNAME'),
                        'password' => $request->input('DB_PASSWORD'),
                    ]),
                ],
            ],
        ]);

        DB::purge();

        try {
            DB::connection()->getPdo();

            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}
