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
            if ($user['status'] === 'deactive') {
                return redirect()->to('/login')->with('error', 'Akun Anda tidak aktif, silahkan hubungi admin.');
            }

            session()->set('user', [
                'id'     => $user['id'],
                'name'   => $user['name'],
                'email'  => $user['email'],
                'username' => $user['username'],
                'role'   => $user['role'],
                'status' => $user['status'],
            ]);

            return redirect()->to('/dashboard');
        }

        return redirect()->back()->with('error', 'Username/Email atau password salah.');
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
        $data['role'] = 'user';
        $data['status'] = 'deactive';

        if ($model->where('email', $data['email'])->first()) {
            return redirect()->back()->with('error', 'Email sudah terdaftar.');
        }

        if ($model->where('username', $data['username'])->first()) {
            return redirect()->back()->with('error', 'Username sudah terdaftar.');
        }

        if ($model->insert($data)) {
            return redirect()->to('/login')->with('success', 'Registrasi berhasil! Tunggu konfirmasi dari admin.');
        }

        return redirect()->back()->with('error', 'Gagal melakukan registrasi.');
    }

    public function editProfile()
    {
        $user = session()->get('user');
        return view('auth/edit_profile', ['user' => $user]);
    }

    public function updateProfile()
    {
        $userModel = new UserModel();
        $userId = session()->get('user')['id'];
        $data = $this->request->getPost(['name', 'username', 'email']);

        if ($userModel->update($userId, $data)) {
            session()->set('user', array_merge(session()->get('user'), $data));
            return redirect()->to('/profile')->with('success', 'Profil berhasil diperbarui.');
        }

        return redirect()->back()->with('error', 'Gagal memperbarui profil.');
    }

    public function changePassword()
    {
        return view('auth/change_password');
    }

    public function updatePassword()
    {
        $userModel = new UserModel();
        $userId = session()->get('user')['id'];
        $data = $this->request->getPost();

        $user = $userModel->find($userId);

        if (!password_verify($data['current_password'], $user['password'])) {
            return redirect()->back()->with('error', 'Password lama tidak sesuai.');
        }

        if ($data['new_password'] !== $data['confirm_password']) {
            return redirect()->back()->with('error', 'Konfirmasi password baru tidak sesuai.');
        }

        $userModel->update($userId, [
            'password' => password_hash($data['new_password'], PASSWORD_BCRYPT),
        ]);

        return redirect()->to('/change-password')->with('success', 'Password berhasil diubah.');
    }

    public function createUser()
    {
        if (session()->get('user')['role'] !== 'admin') {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses untuk menambah pengguna.');
        }

        return view('auth/create_user');
    }

    public function storeUser()
    {
        $userModel = new UserModel();

        if (session()->get('user')['role'] !== 'admin') {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses untuk menambah pengguna.');
        }

        $data = $this->request->getPost(['name', 'username', 'email', 'password', 'role', 'status']);
        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);

        if ($userModel->insert($data)) {
            return redirect()->to('/users')->with('success', 'Pengguna berhasil ditambahkan.');
        }

        return redirect()->back()->with('error', 'Gagal menambahkan pengguna.');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
