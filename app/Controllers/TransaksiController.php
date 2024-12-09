<?php

namespace App\Controllers;

use App\Models\BarangModel;
use App\Models\TransaksiModel;
use App\Controllers\BaseController;
use App\Models\TransaksiDetailModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class TransaksiController extends BaseController
{
    public function index()
    {
        $model = new TransaksiModel();
        $data['transaksi'] = $model->findAll();
        return view('dashboard/transaksi/index', $data);
    }

    public function create()
    {
        $barangModel = new BarangModel();
        $data['barang'] = $barangModel->findAll();
        return view('dashboard/transaksi/create', $data);
    }

    public function store()
    {
        $transaksiModel = new TransaksiModel();
        $transaksiDetailModel = new TransaksiDetailModel();


        $transaksiData = $this->request->getPost(['no_faktur', 'tanggal', 'nama_perusahaan', 'alamat_perusahaan', 'nama_up']);
        $transaksiId = $transaksiModel->insert($transaksiData);


        $barangIds = $this->request->getPost('barang_id');
        $jumlahs = $this->request->getPost('jumlah');
        foreach ($barangIds as $index => $barangId) {
            $barang = (new BarangModel())->find($barangId);
            $totalHarga = $barang['harga'] * $jumlahs[$index];
            $transaksiDetailModel->insert([
                'transaksi_id' => $transaksiId,
                'barang_id'    => $barangId,
                'jumlah'       => $jumlahs[$index],
                'total_harga'  => $totalHarga,
            ]);
        }

        return redirect()->to('/transaksi');
    }

    public function printPage()
    {
        $transaksiModel = new TransaksiModel();
        $data['transaksi'] = $transaksiModel->findAll();
        return view('dashboard/transaksi/print_page', $data);
    }

    public function printTransaksi($id)
    {
        $transaksiModel = new TransaksiModel();
        $detailModel = new TransaksiDetailModel();
        $barangModel = new BarangModel();

        $transaksi = $transaksiModel->find($id);
        $detail = $detailModel->where('transaksi_id', $id)->findAll();


        foreach ($detail as &$d) {
            $barang = $barangModel->find($d['barang_id']);
            $d['kode_barang'] = $barang['kode_barang'];
            $d['nama_barang'] = $barang['nama_barang'];
            $d['satuan'] = $barang['satuan'];
            $d['harga'] = $barang['harga'];
        }

        $data = [
            'transaksi' => $transaksi,
            'detail' => $detail,
        ];

        return view('dashboard/transaksi/print', $data);
    }

    public function edit($id)
    {
        $transaksiModel = new TransaksiModel();
        $detailModel = new TransaksiDetailModel();
        $barangModel = new BarangModel();


        $data['transaksi'] = $transaksiModel->find($id);
        if (!$data['transaksi']) {
            throw new PageNotFoundException("Transaksi dengan ID $id tidak ditemukan.");
        }

        $data['detail'] = $detailModel->where('transaksi_id', $id)->findAll();

        $data['barang'] = $barangModel->findAll();

        return view('dashboard/transaksi/edit', $data);
    }

    public function update($id)
    {
        $transaksiModel = new TransaksiModel();
        $detailModel = new TransaksiDetailModel();

        $transaksiData = $this->request->getPost(['no_faktur', 'tanggal', 'nama_perusahaan', 'alamat_perusahaan', 'nama_up']);
        $transaksiModel->update($id, $transaksiData);

        $detailModel->where('transaksi_id', $id)->delete();

        $barangIds = $this->request->getPost('barang_id');
        $jumlahs = $this->request->getPost('jumlah');
        foreach ($barangIds as $index => $barangId) {
            $barang = (new BarangModel())->find($barangId);
            $totalHarga = $barang['harga'] * $jumlahs[$index];
            $detailModel->insert([
                'transaksi_id' => $id,
                'barang_id'    => $barangId,
                'jumlah'       => $jumlahs[$index],
                'total_harga'  => $totalHarga,
            ]);
        }

        return redirect()->to('/transaksi')->with('success', 'Transaksi berhasil diperbarui.');
    }

    public function delete($id)
    {
        $transaksiModel = new TransaksiModel();
        $transaksiModel->delete($id);
        return redirect()->to('/transaksi')->with('success', 'Transaksi berhasil dihapus.');
    }
}
