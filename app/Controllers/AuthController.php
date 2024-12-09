<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Controllers\BaseController;

class AuthController extends BaseController
{
    public function login()
    {
        return view('auth/login');
    }

    public function attemptLogin()
    {
        $model = new UserModel();
        $credentials = $this->request->getPost(['email_or_username', 'password']);

        $user = $model->where('email', $credentials['email_or_username'])
            ->orWhere('username', $credentials['email_or_username'])
            ->first();

        if ($user && password_verify($credentials['password'], $user['password'])) {
            session()->set(['user' => $user]);
            return redirect()->to('/dashboard');
        }

        return redirect()->back()->with('error', 'Username/Email or password is incorrect.');
    }

    public function register()
    {
        return view('auth/register');
    }

    public function attemptRegister()
    {
        $model = new UserModel();
        $data = $this->request->getPost(['name', 'username', 'email', 'password']);
        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);

        if ($model->insert($data)) {
            return redirect()->to('/login')->with('success', 'Registration successful.');
        }

        return redirect()->back()->with('error', 'Failed to register.');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
