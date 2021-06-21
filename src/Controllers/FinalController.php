<?php

namespace duxphp\DuxravelInstaller\Controllers;

use Illuminate\Routing\Controller;
use duxphp\DuxravelInstaller\Events\DuxravelInstallerFinished;
use duxphp\DuxravelInstaller\Helpers\EnvironmentManager;
use duxphp\DuxravelInstaller\Helpers\FinalInstallManager;
use duxphp\DuxravelInstaller\Helpers\InstalledFileManager;

class FinalController extends Controller
{
    /**
     * Update installed file and display finished view.
     *
     * @param \duxphp\DuxravelInstaller\Helpers\InstalledFileManager $fileManager
     * @param \duxphp\DuxravelInstaller\Helpers\FinalInstallManager $finalInstall
     * @param \duxphp\DuxravelInstaller\Helpers\EnvironmentManager $environment
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function finish(InstalledFileManager $fileManager, FinalInstallManager $finalInstall, EnvironmentManager $environment)
    {
        $finalMessages = $finalInstall->runFinal();
        $finalStatusMessage = $fileManager->update();
        $finalEnvFile = $environment->getEnvContent();

        event(new DuxravelInstallerFinished);

        return view('vendor.installer.finished', compact('finalMessages', 'finalStatusMessage', 'finalEnvFile'));
    }
}
