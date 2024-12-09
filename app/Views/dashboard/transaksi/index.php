<?= $this->extend('layouts/navbar') ?>

<?= $this->section('content') ?>
<h1>Daftar Transaksi</h1>
<a href="/transaksi/create" class="btn btn-danger mb-3">Tambah Transaksi</a>

<div class="card">
    <div class="card-body">

        <table class="table table-striped table-hover">
            <thead class="table-danger">
                <tr>
                    <th>No Faktur</th>
                    <th>Tanggal</th>
                    <th>Nama Perusahaan</th>
                    <th>Total Item</th>
                    <th>Total Harga</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($transaksi)): ?>
                    <tr>
                        <td colspan="6" class="text-center">Data transaksi belum tersedia.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($transaksi as $t): ?>
                        <tr>
                            <td><?= $t['no_faktur'] ?></td>
                            <td><?= date('d F Y', strtotime($t['tanggal'])) ?></td>
                            <td><?= $t['nama_perusahaan'] ?></td>
                            <td>
                                <?php
                                $detailModel = new \App\Models\TransaksiDetailModel();
                                $details = $detailModel->where('transaksi_id', $t['id'])->findAll();
                                echo array_sum(array_column($details, 'jumlah'));
                                ?>
                            </td>
                            <td>
                                Rp <?= number_format(array_sum(array_column($details, 'total_harga')), 0, ',', '.') ?>
                            </td>
                            <td class="d-flex gap-2">
                                <a href="/transaksi/edit/<?= $t['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="/print/transaksi/<?= $t['id'] ?>" class="btn btn-success btn-sm">Print</a>
                                <a href="/transaksi/delete/<?= $t['id'] ?>" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus transaksi ini?')">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>