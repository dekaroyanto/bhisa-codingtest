<?= $this->extend('layouts/navbar') ?>

<?= $this->section('content') ?>
<h1>Daftar Barang</h1>
<a href="/barang/create" class="btn btn-danger mb-3">Tambah Barang</a>

<div class="card">
    <div class="card-body">

        <table class="table table-striped table-hover">
            <thead class="table-danger">
                <tr>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Satuan</th>
                    <th>Harga</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($barang)): ?>
                    <tr>
                        <td colspan="5" class="text-center">Data barang belum tersedia.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($barang as $b): ?>
                        <tr>
                            <td><?= $b['kode_barang'] ?></td>
                            <td><?= $b['nama_barang'] ?></td>
                            <td><?= $b['satuan'] ?></td>
                            <td>Rp <?= number_format($b['harga'], 0, ',', '.') ?></td>
                            <td>
                                <a href="/barang/edit/<?= $b['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="/barang/delete/<?= $b['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus barang ini?')">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</div>
<?= $this->endSection() ?>