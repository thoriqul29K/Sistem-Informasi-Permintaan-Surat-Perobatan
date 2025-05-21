<!DOCTYPE html>
<html lang="en">

<head>
    <title><?= isset($title) ? esc($title) : 'PTBA' ?></title>
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

    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container-fluid">

            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#nav-menu">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?= base_url('/') ?>">
                    <img src="<?= base_url('assets/img/Logo PTBA 750x140px.png') ?>"
                        alt="PTBA" style="height:30px;">
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
                    <li class="<?= uri_string() === 'login' ? 'active' : '' ?>">
                        <a href="<?= base_url('/login') ?>">Login</a>
                    </li>
                </ul>
            </div>

        </div>
    </nav>

    <div class="container">