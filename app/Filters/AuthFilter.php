<?php

namespace App\Filters;

use App\Models\UserModel;
use App\Models\UserTokensModel;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        helper('cookie');

        // Jika belum ada session tapi ada cookie
        if (! session()->has('user_id') && get_cookie('remember_me')) {
            $tokenModel = new UserTokensModel();
            $tokenRow   = $tokenModel
                ->where('token', get_cookie('remember_me'))
                ->where('expires_at >', date('Y-m-d H:i:s'))
                ->first();

            if ($tokenRow) {
                $user = (new UserModel())->find($tokenRow['user_id']);
                session()->set([
                    'user_id' => $user['id'],
                    'email'   => $user['email'],
                    'nama'    => $user['nama'],
                    'role'    => $user['role'],
                ]);
            } else {
                delete_cookie('remember_me');
            }
        }

        if (! session()->has('user_id')) {
            session()->setFlashdata('error', 'Silakan login terlebih dahulu.');
            return redirect()->to('/');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Tidak perlu tindakan setelah
    }
}
