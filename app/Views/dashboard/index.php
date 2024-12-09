<?= $this->extend('layouts/navbar') ?>

<?= $this->section('content') ?>

<h1>Welcome to Dashboard, <?= session()->get('user')['name'] ?></h1>

<?= $this->endSection() ?>