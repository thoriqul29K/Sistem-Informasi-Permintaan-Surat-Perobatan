<?php

namespace App\Controllers;

class AuthController extends BaseController
{
    public function login()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $user = $this->userModel->where('email', $email)->first();

        if ($user && password_verify($password, $user['password'])) {
            session()->set([
                'id' => $user['id'],
                'role' => $user['role'],
                'logged_in' => true
            ]);

            return ($user['role'] == 'admin') ? redirect()->to('/admin/list') : redirect()->to('/user/form');
        }
        return redirect()->back()->with('error', 'Login gagal!');
    }
}
