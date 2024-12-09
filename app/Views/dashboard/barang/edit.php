<?= $this->extend('layouts/navbar') ?>

<?= $this->section('content') ?>
<h1>Edit Barang</h1>
<form action="/barang/update/<?= $barang['id'] ?>" method="post">
    <?= csrf_field() ?>
    <div class="mb-3">
        <label for="kode_barang" class="form-label">Kode Barang</label>
        <input type="text" id="kode_barang" name="kode_barang" class="form-control" value="<?= $barang['kode_barang'] ?>" disabled>
    </div>
    <div class="mb-3">
        <label for="nama_barang" class="form-label">Nama Barang</label>
        <input type="text" id="nama_barang" name="nama_barang" class="form-control" value="<?= $barang['nama_barang'] ?>" required>
    </div>
    <div class="mb-3">
        <label for="satuan" class="form-label">Satuan</label>
        <input type="text" id="satuan" name="satuan" class="form-control" value="<?= $barang['satuan'] ?>" required>
    </div>
    <div class="mb-3">
        <label for="harga" class="form-label">Harga</label>
        <input type="number" id="harga" name="harga" class="form-control" value="<?= $barang['harga'] ?>" required>
    </div>
    <button type="submit" class="btn btn-danger">Simpan Perubahan</button>
</form>
<?= $this->endSection() ?>