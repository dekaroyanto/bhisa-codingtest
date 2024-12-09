<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class UsersController extends BaseController
{
    public function index()
    {
        if (session()->get('user')['role'] !== 'admin') {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }
        $userModel = new UserModel();
        $data['users'] = $userModel->findAll();
        return view('auth/users', $data);
    }

    public function update($id)
    {
        if (session()->get('user')['role'] !== 'admin') {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }
        $userModel = new UserModel();
        $data = $this->request->getPost();

        // echo '<pre>'; print_r($data); die();

        $updateData = [
            'name'   => $data['name'],
            'username' => $data['username'],
            'email'  => $data['email'],
            'role'   => $data['role'],
            'status' => $data['status'],
        ];


        if ($userModel->update($id, $updateData)) {
            return redirect()->to('/users')->with('success', 'Data pengguna berhasil diperbarui.');
        }

        return redirect()->to('/users')->with('error', 'Gagal memperbarui data pengguna.');
    }

    public function delete($id)
    {
        if (session()->get('user')['role'] !== 'admin') {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }
        $userModel = new UserModel();
        $userModel->delete($id);

        return redirect()->to('/users')->with('success', 'Pengguna berhasil dihapus.');
    }
}
