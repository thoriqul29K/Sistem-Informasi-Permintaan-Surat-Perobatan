<?php

namespace App\Controllers;

class FormController extends BaseController
{
    public function SIPSP(): string
    {
        return view('pages/form_permintaansurat');
    }
}
