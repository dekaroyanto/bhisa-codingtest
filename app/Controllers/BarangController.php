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
        $model = new BarangModel();

        // Generate kode barang otomatis
        $lastBarang = $model->orderBy('id', 'DESC')->first();
        $lastKode = $lastBarang ? $lastBarang['kode_barang'] : null;

        $newKode = $this->generateKodeBarang($lastKode);

        $data['kode_barang'] = $newKode;

        return view('dashboard/barang/create', $data);
    }

    public function store()
    {
        $model = new BarangModel();

        $data = [
            'kode_barang' => $this->request->getPost('kode_barang'),
            'nama_barang' => $this->request->getPost('nama_barang'),
            'satuan'      => $this->request->getPost('satuan'),
            'harga'       => $this->request->getPost('harga'),
        ];

        $model->insert($data);

        return redirect()->to('/barang')->with('success', 'Barang berhasil ditambahkan.');
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

    private function generateKodeBarang($lastKode)
    {
        if (!$lastKode) {
            return 'PR01';
        }

        $number = (int)substr($lastKode, 2);

        $newNumber = $number + 1;

        return 'PR' . str_pad($newNumber, 2, '0', STR_PAD_LEFT);
    }
}
