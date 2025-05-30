<!DOCTYPE html>
<html lang="en">

<head>
    <title><?= isset($title) ? esc($title) : 'Dashboard | Sistem Informasi Permintaan Surat Perobatan' ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/dashboardstyles.css') ?>">

    <!-- JQuery & Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="<?= base_url('assets/script/dashboard.js') ?>"></script>
</head>

<body>

    <!-- Views/layouts/header_dashboard.php -->
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#nav-menu">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?= base_url('/') ?>">
                    <img src="<?= base_url('assets/img/PTBA-logo-white.svg') ?>" alt="PTBA" style="height:30px;">
                </a>
            </div>

            <div class="collapse navbar-collapse" id="nav-menu">
                <ul class="nav navbar-nav">
                    <li class="<?= uri_string() === '/' ? 'active' : '' ?>">
                        <a href="<?= base_url('/') ?>">Beranda</a>
                    </li>
                    <li class="<?= uri_string() === 'tentang' ? 'active' : '' ?>">
                        <a href="<?= base_url('/tentang') ?>">Tentang</a>
                    </li>
                    <li class="<?= uri_string() === 'sop' ? 'active' : '' ?>">
                        <a href="<?= base_url('/sop') ?>">SOP</a>
                    </li>
                </ul>

                <!-- Menu kanan: Login atau nama user jika sudah login -->
                <ul class="nav navbar-nav navbar-right">
                    <?php if (session()->has('user_id')): ?>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <?= esc(session('nama')) ?> <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="<?= base_url('logout') ?>">Logout</a></li>
                                <li><a href="<?= base_url('/form-permintaan-surat') ?>">Isi Form Permintaan Surat</a></li>
                                <!-- Hanya tampilkan jika role = admin atau ruler -->
                                <?php if (in_array(session('role'), ['admin', 'ruler'])): ?>
                                    <li class="divider"></li>
                                    <li><a href="<?= base_url('list-info') ?>">List Informasi Permintaan</a></li>
                                <?php endif; ?>
                            </ul>
                        </li>
                    <?php else: ?>
                        <li class="<?= uri_string() === 'login' ? 'active' : '' ?>">
                            <a href="<?= base_url('/login') ?>">Login</a>
                        </li>
                    <?php endif ?>
                </ul>
            </div>
        </div>
    </nav>


    <div class="container">