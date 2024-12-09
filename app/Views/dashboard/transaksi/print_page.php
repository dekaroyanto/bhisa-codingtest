<?= $this->extend('layouts/navbar') ?>

<?= $this->section('content') ?>
<h1>Pilih Transaksi untuk Cetak</h1>
<table class="table table-striped">
    <thead>
        <tr>
            <th>No Faktur</th>
            <th>Tanggal</th>
            <th>Pembeli</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($transaksi as $t): ?>
            <tr>
                <td><?= $t['no_faktur'] ?></td>
                <td><?= $t['tanggal'] ?></td>
                <td><?= $t['nama_perusahaan'] ?></td>
                <td>
                    <a href="/print/transaksi/<?= $t['id'] ?>" class="btn btn-primary">Print</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?= $this->endSection() ?>