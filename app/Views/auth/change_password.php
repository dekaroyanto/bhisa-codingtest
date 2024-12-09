<?= $this->extend('layouts/navbar') ?>

<?= $this->section('content') ?>
<div class="container mt-4">
    <h1>Ubah Password</h1>
    <div class="card">
        <div class="card-body">
            <form action="/change-password" method="post">
                <div class="mb-3">
                    <label for="current_password" class="form-label">Password Lama</label>
                    <input type="password" name="current_password" id="current_password" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="new_password" class="form-label">Password Baru</label>
                    <input type="password" name="new_password" id="new_password" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="confirm_password" class="form-label">Konfirmasi Password Baru</label>
                    <input type="password" name="confirm_password" id="confirm_password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-danger">Simpan</button>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>