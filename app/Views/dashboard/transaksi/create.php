<?= $this->extend('layouts/navbar') ?>

<?= $this->section('content') ?>
<h1>Tambah Transaksi</h1>
<div class="card">
    <div class="card-body">
        <form action="/transaksi/store" method="post">
            <?= csrf_field() ?>
            <div class="mb-3">
                <label for="no_faktur" class="form-label">No Faktur</label>
                <input type="text" id="no_faktur" name="no_faktur" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="tanggal" class="form-label">Tanggal</label>
                <input type="date" id="tanggal" name="tanggal" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="nama_purchasing" class="form-label">Nama Purchasing</label>
                <input type="text" name="nama_purchasing" id="nama_purchasing" class="form-control bg-light" value="<?= $nama_purchasing ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="nama_perusahaan" class="form-label">Nama Perusahaan</label>
                <input type="text" id="nama_perusahaan" name="nama_perusahaan" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="nama_up" class="form-label">Nama UP</label>
                <input type="text" id="nama_up" name="nama_up" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="alamat_perusahaan" class="form-label">Alamat Perusahaan</label>
                <textarea id="alamat_perusahaan" name="alamat_perusahaan" class="form-control"></textarea>
            </div>

            <h3>Detail Barang</h3>
            <button type="button" class="btn btn-secondary" id="add-item">Tambah Barang</button>
            <div id="barang-container">
                <div class="row g-3 align-items-end mb-3">
                    <div class="col-md-6">
                        <label for="barang" class="form-label">Barang</label>
                        <select name="barang_id[]" class="form-select" required>
                            <?php foreach ($barang as $b): ?>
                                <option value="<?= $b['id'] ?>"><?= $b['nama_barang'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="jumlah" class="form-label">Jumlah</label>
                        <input type="number" name="jumlah[]" class="form-control" required>
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-danger remove-item">Hapus</button>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-danger mt-3">Simpan Transaksi</button>
        </form>
    </div>
</div>

<script>
    document.getElementById('add-item').addEventListener('click', function() {
        const container = document.getElementById('barang-container');
        const item = container.firstElementChild.cloneNode(true);
        container.appendChild(item);
        item.querySelector('.remove-item').addEventListener('click', function() {
            if (container.children.length > 1) {
                this.closest('.row').remove();
            } else {
                alert('Setidaknya harus ada satu field barang.');
            }
        });
    });

    document.querySelectorAll('.remove-item').forEach(function(button) {
        button.addEventListener('click', function() {
            const container = document.getElementById('barang-container');
            if (container.children.length > 1) {
                this.closest('.row').remove();
            } else {
                alert('Setidaknya harus ada satu field barang.');
            }
        });
    });
</script>
<?= $this->endSection() ?>