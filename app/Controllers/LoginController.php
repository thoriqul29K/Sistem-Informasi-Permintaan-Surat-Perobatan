<?php

namespace App\Controllers;

helper('cookie');

use App\Models\UserModel;
use App\Models\UserTokensModel;
use CodeIgniter\Controller;
use PhpParser\Node\Stmt\Else_;
use CodeIgniter\Cookie\Cookie;

class LoginController extends BaseController
{
    protected $userTokensModel;
    public function __construct()
    {
        $this->userTokensModel = new UserTokensModel();
    }

    public function index()
    {

        if (session()->get('user_id')) {
            // Jika sudah login, redirect ke halaman sesuai role
            $role = session()->get('role');
            if ($role === 'admin' || $role === 'ruler') {
                return redirect()->to('/list-info');
            } else {
                return redirect()->to('/form-permintaan-surat');
            }
        }
        return view('pages/login');
    }

    public function login()
    {
        helper('cookie');
        $model           = new UserModel();
        $tokenModel      = $this->userTokensModel;
        $email           = $this->request->getPost('email');
        $password        = $this->request->getPost('password');
        $rememberChecked = $this->request->getPost('remember');

        // Cari user
        $user = $model->where('email', $email)->first();
        if (! $user || hash('sha256', $password) !== $user['password']) {
            return redirect()->back()->with('error', 'Email atau password salah.');
        }

        // Set session
        session()->set([
            'user_id' => $user['id'],
            'email'   => $user['email'],
            'nama'    => $user['nama'],
            'role'    => $user['role'],
        ]);

        // Jika “ingat saya” dicentang
        if ($rememberChecked) {
            $token     = bin2hex(random_bytes(32));
            $expiresAt = date('Y-m-d H:i:s', time() + 30 * DAY);

            $tokenModel->insert([
                'user_id'    => $user['id'],
                'token'      => $token,
                'expires_at' => $expiresAt,
            ]);

            set_cookie([
                'name'     => 'remember_me',
                'value'    => $token,
                'expire'   => 30 * DAY,
                'path'     => '/',
                'httponly' => true,
            ]);
        }

        // Redirect sesuai role
        return redirect()->to(
            in_array($user['role'], ['admin', 'ruler'])
                ? '/list-info'
                : '/form-permintaan-surat'
        );
    }



    public function checkRemember()
    {
        $token = $this->request->getCookie('remember_token');
        if ($token) {
            $row = $this->userTokensModel
                ->where('token', $token)
                ->where('expires_at >', date('Y-m-d H:i:s'))
                ->first();
            if ($row) {
                //restore session user_id = $row['user_id']
            }
        }
    }
}
