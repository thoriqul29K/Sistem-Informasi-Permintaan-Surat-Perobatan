<?php

namespace App\Controllers;

helper('cookie');

use App\Models\UserModel;
use App\Models\UserTokensModel;
use App\Models\PasswordResetModel;
use CodeIgniter\Controller;
use PhpParser\Node\Stmt\Else_;
use CodeIgniter\Cookie\Cookie;

class AuthController extends BaseController
{
    protected $userTokensModel;
    protected $userModel;
    protected $resetModel;
    protected $email;
    public function __construct()
    {
        $this->userTokensModel = new UserTokensModel();
        $this->userModel  = new UserModel();
        $this->resetModel = new PasswordResetModel();
        $this->email      = \Config\Services::email();
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

    public function logout()
    {
        // Hapus session
        session()->destroy();
        // Hapus cookie remember_me
        setcookie('remember_me', '', time() - 3600, '/', '', false, true);
        return redirect()->to('/');
    }

    // 1) Tampilkan form minta reset
    public function showResetForm()
    {
        return view('pages/reset_password_request');
    }

    // 2) Kirim email dengan link
    public function sendResetLink()
    {
        $email = $this->request->getPost('email');
        if (! $user = $this->userModel->where('email', $email)->first()) {
            return redirect()->back()->with('error', 'Email tidak terdaftar');
        }

        $token = bin2hex(random_bytes(32));
        $this->resetModel->insert([
            'email'      => $email,
            'token'      => $token,
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        // Kirim via SMTP
        $link = base_url("reset-password/$token");
        $this->email->setTo($email);
        $this->email->setSubject('Reset Password');
        $this->email->setMessage("
             Klik tautan berikut untuk mereset password Anda:<br>
             <a href=\"$link\">$link</a><br><br>
             Jika tidak meminta, abaikan email ini.
         ");
        if (! $this->email->send()) {
            // Cetak log error SMTP ke layar (atau tulis ke log CI)
            log_message('error', $this->email->printDebugger(['headers']));
            echo $this->email->printDebugger(['headers', 'subject', 'body', 'error']);
            exit;
        }

        return redirect()->back()->with('message', 'Link reset password sudah dikirim ke email Anda.');
    }

    // 3) Tampilkan form password baru
    public function showNewPasswordForm($token)
    {
        // Validasi token (maks 1 jam misalnya)
        $row = $this->resetModel->where('token', $token)
            ->first();
        if (! $row || strtotime($row['created_at']) < time() - 3600) {
            return redirect()->to('/login')->with('error', 'Tautan tidak valid atau kadaluarsa.');
        }
        return view('pages/reset_password_new', ['token' => $token]);
    }

    // 4) Proses ganti password
    public function resetPassword($token)
    {
        $post = $this->request->getPost();
        helper('form');
        $rules = [
            'password'         => 'required|min_length[6]',
            'password_confirm' => 'matches[password]'
        ];
        if (! $this->validate($rules)) {
            return view('pages/reset_password_new', [
                'token'      => $token,
                'validation' => $this->validator
            ]);
        }

        // 1) Cek token di password_resets
        $row = $this->resetModel->where('token', $token)->first();
        if (! $row) {
            return redirect()->to('/login')->with('error', 'Token tidak valid.');
        }

        // 2) Ambil user berdasarkan email yang ada di password_resets
        $user = $this->userModel->where('email', $row['email'])->first();
        if (! $user) {
            return redirect()->to('/login')->with('error', 'User tidak ditemukan.');
        }

        // 3) Update password menggunakan user ID sebagai PK
        $this->userModel->update(
            $user['id'],                      // <-- gunakan ID di sini
            ['password' => hash('sha256', $post['password'])]
        );

        // 4) Hapus token setelah reset berhasil
        $this->resetModel->where('token', $token)->delete();

        return redirect()->to('/login')
            ->with('message', 'Password berhasil direset. Silakan login.');
    }
}
