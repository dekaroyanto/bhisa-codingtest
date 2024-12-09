<?= $this->extend('layouts/navbar') ?>

<?= $this->section('content') ?>
<div class="container mt-4">
    <h1>Manajemen Pengguna</h1>
    <a href="/users/create" class="btn btn-danger mb-2">Tambah Pengguna</a>
    <div class="card">
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?= $user['name'] ?></td>
                            <td><?= $user['username'] ?></td>
                            <td><?= $user['email'] ?></td>
                            <td><?= ucfirst($user['role']) ?></td>
                            <td><?= ucfirst($user['status']) ?></td>
                            <td>
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal-<?= $user['id'] ?>">Edit</button>
                                <a href="/users/delete/<?= $user['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus pengguna ini?')">Hapus</a>
                            </td>
                        </tr>

                        <!-- Modal Edit User -->
                        <div class="modal fade" id="editModal-<?= $user['id'] ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="/users/update/<?= $user['id'] ?>" method="post">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editModalLabel">Edit Pengguna</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="name-<?= $user['id'] ?>" class="form-label">Nama</label>
                                                <input type="text" name="name" id="name-<?= $user['id'] ?>" class="form-control" value="<?= $user['name'] ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="username-<?= $user['id'] ?>" class="form-label">Username</label>
                                                <input type="text" name="username" id="username-<?= $user['id'] ?>" class="form-control" value="<?= $user['username'] ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="email-<?= $user['id'] ?>" class="form-label">Email</label>
                                                <input type="email" name="email" id="email-<?= $user['id'] ?>" class="form-control" value="<?= $user['email'] ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="role-<?= $user['id'] ?>" class="form-label">Role</label>
                                                <select name="role" id="role-<?= $user['id'] ?>" class="form-select">
                                                    <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
                                                    <option value="user" <?= $user['role'] === 'user' ? 'selected' : '' ?>>User</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="status-<?= $user['id'] ?>" class="form-label">Status</label>
                                                <select name="status" id="status-<?= $user['id'] ?>" class="form-select">
                                                    <option value="active" <?= $user['status'] === 'active' ? 'selected' : '' ?>>Active</option>
                                                    <option value="deactive" <?= $user['status'] === 'deactive' ? 'selected' : '' ?>>Deactive</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-danger">Simpan Perubahan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- End Modal Edit User -->
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

<?= $this->endSection() ?>