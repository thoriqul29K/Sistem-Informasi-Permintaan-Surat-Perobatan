<?php

namespace App\Controllers;

class Pages extends BaseController
{

    public function index(): string
    {
        return view('pages/index');
    }


    public function sop()
    {
        return view('pages/sop');
    }

    public function tentang()
    {
        return view('pages/tentang');
    }

    public function login()
    {
        return view('pages/login');
    }
}
