<?= $this->include('layouts/header_homepage') ?>

<div class="container" style="margin-top: 80px;">
    <h3>Semua Notifikasi</h3>
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
                        <div class="col-xs-10">
                            <?= esc($text) ?><br>
                            <small class="text-muted"><?= esc($time) ?></small>
                        </div>
                        <div class="col-xs-2 text-right">
                            <?php if ($notif['is_read'] == 0): ?>
                                <a href="<?= base_url('/notifications/markread/' . $notif['id']) ?>" class="btn btn-xs btn-primary">
                                    Tandai Dibaca
                                </a>
                            <?php else: ?>
                                <span class="text-success"><i>Terbaca</i></span>
                            <?php endif ?>
                        </div>
                    </div>
                </li>
            <?php endforeach ?>
        </ul>
    <?php endif ?>
</div>

<?= $this->include('layouts/footer_homepage') ?>