<?= $this->include('layouts/header_homepage') ?>

<div class="container" style="margin-top: 80px;">
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger">
            <p class="text-danger"><?= session()->getFlashdata('error') ?></p>
        </div>
    <?php elseif (session()->getFlashdata('message')): ?>
        <div class="alert alert-success">
            <p class="text-success"><?= session()->getFlashdata('message') ?></p>
        </div>
    <?php endif; ?>
    <h3>Semua Notifikasi</h3>

    <!-- Tombol aksi: Baca Semua & Hapus Semua -->
    <?php if (! empty($notifications)): ?>
        <div class="btn-group" style="margin-bottom: 15px;">
            <!-- Form Baca Semua Notifikasi -->
            <form action="<?= base_url('notifications/markallread') ?>" method="POST" style="display:inline;">
                <?= csrf_field() ?>
                <button type="submit" class="btn btn-sm btn-success">
                    <span class="glyphicon glyphicon-ok-circle"></span> Baca Semua Notifikasi
                </button>
            </form>
            <!-- Form Hapus Semua Notifikasi -->
            <form action="<?= base_url('notifications/deleteall') ?>" method="POST" style="display:inline; margin-left:5px;">
                <?= csrf_field() ?>
                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus semua notifikasi?')">
                    <span class="glyphicon glyphicon-trash"></span> Hapus Semua Notifikasi
                </button>
            </form>
        </div>
    <?php endif; ?>

    <?php if (empty($notifications)): ?>
        <p>Tidak ada notifikasi.</p>
    <?php else: ?>
        <ul class="list-group">
            <?php foreach ($notifications as $notif): ?>
                <?php $data = json_decode($notif['data'], true); ?>
                <?php
                switch ($notif['type']) {
                    case 'form_submitted':
                        $text = "Form ID {$data['form_id']} baru dikirim oleh {$data['nama_lengkap']}";
                        break;
                    case 'form_verified':
                        $text = "Form ID {$data['form_id']} milik {$data['nama_lengkap']} telah diverifikasi";
                        break;
                    case 'form_approved':
                        $text = "Form ID {$data['form_id']} milik {$data['nama_lengkap']} telah disetujui";
                        break;
                    case 'form_rejected':
                        $text = "Form ID {$data['form_id']} milik {$data['nama_lengkap']} telah ditolak";
                        break;
                    case 'form_signed':
                        $text = "Form ID {$data['form_id']} milik {$data['nama_lengkap']} telah tertandatangan";
                        break;
                    default:
                        $text = "Notifikasi baru";
                }
                $time = date('d-m-Y H:i', strtotime($notif['created_at']));
                ?>
                <li class="list-group-item <?= $notif['is_read'] == 0 ? 'list-group-item-info' : '' ?>">
                    <div class="row">
                        <div class="col-xs-8">
                            <?= esc($text) ?><br>
                            <small class="text-muted"><?= esc($time) ?></small>
                        </div>
                        <div class="col-xs-4 text-right">
                            <?php if ($notif['is_read'] == 0): ?>
                                <a href="<?= base_url('notifications/markread/' . $notif['id']) ?>" class="btn btn-xs btn-primary">
                                    <span class="glyphicon glyphicon-ok"></span> Tandai Dibaca
                                </a>
                            <?php else: ?>
                                <span class="text-success"><i>Terbaca</i></span>
                            <?php endif ?>

                            <!-- Tombol Hapus Notifikasi -->
                            <form action="<?= base_url('notifications/delete/' . $notif['id']) ?>" method="POST" style="display:inline; margin-left:5px;">
                                <?= csrf_field() ?>
                                <button type="submit" class="btn btn-xs btn-danger" onclick="return confirm('Hapus notifikasi ini?')">
                                    <span class="glyphicon glyphicon-remove"></span> Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </li>
            <?php endforeach ?>
        </ul>
    <?php endif ?>
</div>

<?= $this->include('layouts/footer_homepage') ?>