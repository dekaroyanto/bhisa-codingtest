<?= $this->extend('layouts/navbar') ?>

<?= $this->section('content') ?>
<div class="container mt-4">
    <h1>Ubah Profil</h1>
    <div class="card">
        <div class="card-body">
            <form action="/profile" method="post">
                <?= csrf_field() ?>
                <div class="mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" name="name" id="name" class="form-control" value="<?= $user['name'] ?>" required>
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" name="username" id="username" class="form-control" value="<?= $user['username'] ?>" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control" value="<?= $user['email'] ?>" required>
                </div>
                <button type="submit" class="btn btn-danger">Simpan</button>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>