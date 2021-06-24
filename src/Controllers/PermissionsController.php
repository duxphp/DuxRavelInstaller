<?php

namespace duxphp\DuxravelInstaller\Controllers;

use Illuminate\Routing\Controller;
use duxphp\DuxravelInstaller\Helpers\PermissionsChecker;

class PermissionsController extends Controller
{
    /**
     * @var PermissionsChecker
     */
    protected $permissions;

    /**
     * @param PermissionsChecker $checker
     */
    public function __construct(PermissionsChecker $checker)
    {
        $this->permissions = $checker;
    }

    /**
     * Display the permissions check page.
     *
     * @return \Illuminate\View\View
     */
    public function permissions()
    {
        $permissions = $this->permissions->check(
            config('installer.permissions')
        );

        return view('vendor/duxphp/duxravel-installer/src/Views/permissions', compact('permissions'));
    }
}
