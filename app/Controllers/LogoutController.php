<?php

namespace App\Controllers;

class LogoutController extends BaseController
{
    public function index()
    {
        // Hapus session
        session()->destroy();
        // Hapus cookie remember_me
        setcookie('remember_me', '', time() - 3600, '/', '', false, true);
        return redirect()->to('/');
    }
}
