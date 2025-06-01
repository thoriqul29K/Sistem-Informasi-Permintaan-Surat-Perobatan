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

    public function progress_bar()
    {
        return view('pages/progress_bar');
    }
}
