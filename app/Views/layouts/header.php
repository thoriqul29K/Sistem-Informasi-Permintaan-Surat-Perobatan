<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Tambahkan CSS sesuai kebutuhan -->
    <link rel="stylesheet" href="<?= base_url('assets/css/styles.css') ?>">
    <title>Dashboard</title>
</head>

<body>
    <header style="background: #f0f0f0; padding: 10px;">
        <div class="container" style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <strong>Selamat datang, <?= session()->get('nama') ?></strong>
            </div>
            <div>
                <a href="<?= base_url('logout') ?>" style="text-decoration: none; color: #333;">Logout</a>
            </div>
        </div>
    </header>
    <hr>