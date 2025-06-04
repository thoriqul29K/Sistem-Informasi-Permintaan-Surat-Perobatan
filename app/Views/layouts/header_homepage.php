<!DOCTYPE html>
<html lang="en">

<head>
    <title>Homepage | Sistem Informasi Permintaan Surat Perobatan</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/homepagestyles.css') ?>">

    <!-- JQuery & Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="<?= base_url('assets/script/homepage.js') ?>"></script>
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
                    <img src="<?= base_url('assets/img/PTBA-logo-white.svg') ?>" alt="PTBA" style="height:20px;">
                </a>
            </div>

            <div class="collapse navbar-collapse" id="nav-menu">
                <ul class="nav navbar-nav">
                    <li class="<?= uri_string() === '' ? 'active' : '' ?>">
                        <a href="<?= base_url('/') ?>">Beranda</a>
                    </li>
                    <li class="<?= uri_string() === 'tentang' ? 'active' : '' ?>">
                        <a href="<?= base_url('/tentang') ?>">Tentang</a>
                    </li>
                    <li class="<?= uri_string() === 'sop' ? 'active' : '' ?>">
                        <a href="<?= base_url('/sop') ?>">Alur Permintaan/Pengajuan</a>
                    </li>
                    <?php if (session()->has('user_id')): ?>
                        <li class="<?= uri_string() === 'progress_bar' ? 'active' : '' ?>">
                            <a href="<?= base_url('/progress_bar') ?>">Permintaan Terkirim</a>
                        </li>
                    <?php endif; ?>
                </ul>

                <!-- Menu kanan: Login atau nama user jika sudah login -->

                <ul class="nav navbar-nav navbar-right">
                    <?php if (session()->has('user_id')): ?>
                        <!-- Ikon notifikasi -->
                        <?php
                        $notifModel = new \App\Models\NotificationModel();
                        $unreadCount = $notifModel->countUnread(session('user_id'));
                        ?>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                🔔
                                <?php if ($unreadCount > 0): ?>
                                    <span class="badge" style="background-color:red;"><?= $unreadCount ?></span>
                                <?php endif ?>
                            </a>
                            <ul class="dropdown-menu" style="width: 300px;">
                                <?php
                                // Ambil 5 notifikasi terbaru yang belum dibaca
                                $unread = $notifModel->getUnreadByUser(session('user_id'));
                                ?>
                                <?php if (empty($unread)): ?>
                                    <li><a href="javascript:void(0)">Tidak ada notifikasi baru</a></li>
                                <?php else: ?>
                                    <?php foreach ($unread as $notif): ?>
                                        <?php
                                        $data = json_decode($notif['data'], true);
                                        switch ($notif['type']) {
                                            case 'form_submitted':
                                                $text = "Form ID {$data['form_id']} baru dikirim oleh {$data['nama_lengkap']}";
                                                break;
                                            case 'form_verified':
                                                $text = "Form ID {$data['form_id']} yang dikirim oleh {$data['nama_lengkap']} telah diverifikasi";
                                                break;
                                            case 'form_approved':
                                                $text = "Form ID {$data['form_id']} yang dikirim oleh {$data['nama_lengkap']} telah disetujui";
                                                break;
                                            case 'form_rejected':
                                                $text = "Form ID {$data['form_id']} yang dikirim oleh {$data['nama_lengkap']} telah ditolak";
                                                break;
                                            case 'form_signed':
                                                $text = "Form ID {$data['form_id']} yang dikirim oleh {$data['nama_lengkap']} telah tertandatangan";
                                                break;
                                            default:
                                                $text = "Notifikasi baru";
                                        }
                                        $time = date('d-m-Y H:i', strtotime($notif['created_at']));
                                        ?>
                                        <li>
                                            <a href="<?= base_url('/notifications/markread/' . $notif['id']) ?>" style="white-space: normal;">
                                                <small class="text-muted"><?= $time ?></small><br>
                                                <?= esc($text) ?>
                                            </a>
                                        </li>
                                    <?php endforeach ?>
                                <?php endif ?>
                                <li class="divider"></li>
                                <li><a href="<?= base_url('/notifications') ?>">Lihat semua notifikasi</a></li>
                            </ul>
                        </li>

                        <!-- Dropdown nama user -->
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <span class="glyphicon glyphicon-user"> </span>
                                <?= esc(session('nama')) ?> <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <?php $role = session()->get('role'); ?>

                                <?php if ($role === 'admin'): ?>
                                    <li><a href="<?= base_url('list-info') ?>">Verifikasi Data</a></li>
                                <?php elseif ($role === 'ruler'): ?>
                                    <li><a href="<?= base_url('list-info') ?>">Setujui / Tanda Tangan Data</a></li>
                                <?php endif ?>
                                <li><a href="<?= base_url('form-permintaan-surat') ?>">Isi Form Permintaan</a></li>
                                <li><a href="<?= base_url('logout') ?>">Logout</a></li>
                            </ul>
                        </li>
                    <?php else: ?>
                        <!-- Jika belum login -->
                        <li class="<?= uri_string() === 'login' ? 'active' : '' ?>">
                            <a href="<?= base_url('/login') ?>">Login</a>
                        </li>
                    <?php endif ?>
                </ul>

            </div>
        </div>
    </nav>


    <div class="container">