<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;
use PhpParser\Node\Stmt\Else_;

class LoginController extends BaseController
{
    public function index()
    {
        return view('pages/index');
    }

    public function login()
    {
        $model = new UserModel();
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        // Cari user berdasarkan email
        $user = $model->where('email', $email)->first();

        if ($user) {
            // Gunakan SHA-256 untuk memverifikasi password
            if (hash('sha256', $password) === $user['password']) {
                // Set session data
                session()->set([
                    'id'    => $user['id'],
                    'email' => $user['email'],
                    'nama'  => $user['nama'],
                    'role'  => $user['role']
                ]);

                // Redirect berdasarkan role
                if ($user['role'] === 'admin') {
                    return redirect()->to('/list_info');
                } else {
                    return redirect()->to('/form-permintaan-surat');
                }
            } else {
                return redirect()->back()->with('error', 'Password salah!');
            }
        } else {
            return redirect()->back()->with('error', 'Email tidak ditemukan!');
        }
    }
}
