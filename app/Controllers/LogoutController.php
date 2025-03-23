<?php

namespace App\Controllers;

class LogoutController extends BaseController
{
    public function index()
    {
        session()->destroy();
        return redirect()->to(base_url('/'));
    }
}
