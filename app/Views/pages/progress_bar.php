<?= $this->include('layouts/header_homepage') ?>

<div class="container" style="margin-top: 80px;">
    <h3>Permintaan Terkirim</h3>
    <?php
    // Ambil form-data milik user saat ini
    $formModel = new \App\Models\FormModel();
    $userForms = $formModel->where('created_by', session('user_id'))->findAll();
    ?>

    <?php if (empty($userForms)): ?>
        <p>Anda belum mengajukan permintaan surat perobatan.</p>
    <?php else: ?>
        <?php foreach ($userForms as $form): ?>
            <div class="panel panel-default" style="margin-bottom: 20px;">
                <div class="panel-heading">
                    <strong>Form ID: <?= $form['id'] ?> - <?= esc($form['nama_lengkap']) ?></strong>
                    <span class="pull-right"><?= date('d-m-Y', strtotime($form['created_at'])) ?></span>
                </div>
                <div class="panel-body">
                    <?php
                    // Tentukan persentase progress berdasarkan status
                    switch ($form['status']) {
                        case 'Menunggu':
                            $percent = 25;
                            $label = "Menunggu Verifikasi Admin";
                            break;
                        case 'Terverifikasi':
                            $percent = 50;
                            $label = "Menunggu Keputusan Pimpinan";
                            break;
                        case 'Disetujui':
                            $percent = 75;
                            $label = "Menunggu Tanda Tangan";
                            break;
                        case 'Ditolak':
                            $percent = 100;
                            $label = "Ditolak";
                            break;
                        case 'Tertandatangan':
                            $percent = 100;
                            $label = "Selesai (Tertandatangan)";
                            break;
                        default:
                            $percent = 0;
                            $label = "Status Tidak Diketahui";
                    }
                    ?>
                    <p><?= esc($label) ?></p>
                    <div class="progress">
                        <div class="progress-bar 
                            <?= in_array($form['status'], ['Ditolak', 'Tertandatangan']) ? 'progress-bar-success' : 'progress-bar-info' ?>"
                            role="progressbar" aria-valuenow="<?= $percent ?>" aria-valuemin="0" aria-valuemax="100"
                            style="width: <?= $percent ?>%;">
                            <?= $percent ?>%
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif ?>
</div>

<?= $this->include('layouts/footer_homepage') ?>