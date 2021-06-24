<?php

namespace duxphp\DuxravelInstaller\Controllers;

use Illuminate\Routing\Controller;

class WelcomeController extends Controller
{
    /**
     * Display the installer welcome page.
     *
     * @return \Illuminate\Http\Response
     */
    public function welcome()
    {
        return view('vendor/duxphp/duxravel-installer/src/Views/welcome');
    }
}
