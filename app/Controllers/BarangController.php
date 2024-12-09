<?php

namespace App\Controllers;

use App\Models\BarangModel;
use App\Controllers\BaseController;
use CodeIgniter\Exceptions\PageNotFoundException;

class BarangController extends BaseController
{
    public function index()
    {
        $model = new BarangModel();
        $data['barang'] = $model->findAll();
        return view('dashboard/barang/index', $data);
    }

    public function create()
    {
        return view('dashboard/barang/create');
    }

    public function store()
    {
        $model = new BarangModel();
        $model->insert($this->request->getPost());
        return redirect()->to('/barang');
    }

    public function edit($id)
    {
        $barangModel = new BarangModel();
        $data['barang'] = $barangModel->find($id);

        if (!$data['barang']) {
            throw new PageNotFoundException("Barang dengan ID $id tidak ditemukan.");
        }

        return view('dashboard/barang/edit', $data);
    }

    public function update($id)
    {
        $barangModel = new BarangModel();
        $data = $this->request->getPost();

        $barangModel->update($id, $data);

        return redirect()->to('/barang')->with('success', 'Data barang berhasil diperbarui.');
    }

    public function delete($id)
    {
        $barangModel = new BarangModel();
        $barangModel->delete($id);
        return redirect()->to('/barang')->with('success', 'Data barang berhasil dihapus.');
    }
}
