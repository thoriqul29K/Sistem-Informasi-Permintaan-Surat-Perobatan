<?= $this->include('layouts/header_homepage') ?>

<div class="container" style="margin-top: 80px;">
    <h3>Permintaan Terkirim</h3>
    <?php
    $formModel = new \App\Models\FormModel();
    $userForms = $formModel->where('created_by', session('user_id'))->findAll();
    ?>
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger">
            <p class="text-danger"><?= session()->getFlashdata('error') ?></p>
        </div>
    <?php elseif (session()->getFlashdata('message')): ?>
        <p class="text-success"><?= session()->getFlashdata('message') ?></p>
    <?php endif; ?>

    <?php if (empty($userForms)): ?>
        <p>Anda belum mengajukan permintaan surat perobatan.</p>
    <?php else: ?>
        <?php foreach ($userForms as $form): ?>
            <!-- Panel dengan atribut collapse pada elemen .panel -->
            <div class="panel panel-default panel-hover panel-clickable"
                data-toggle="collapse"
                data-target="#collapse<?= $form['id'] ?>"
                aria-expanded="false"
                aria-controls="collapse<?= $form['id'] ?>"
                style="margin-bottom: 20px; cursor: pointer;">
                <!-- Header tetap hanya tampilan, tapi bukan trigger -->
                <div class="panel-heading">
                    <strong>Form ID: <?= $form['id'] ?> – <?= esc($form['nama_lengkap']) ?></strong>
                    <span class="pull-right"><?= date('d-m-Y', strtotime($form['created_at'])) ?></span>
                </div>

                <!-- Bagian progress bar & tombol tetap terlihat -->
                <div class="panel-body">
                    <?php
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
                    <p><strong><?= esc($label) ?></strong></p>
                    <div class="progress">
                        <div class="progress-bar <?= in_array($form['status'], ['Ditolak', 'Tertandatangan']) ? 'progress-bar-success' : 'progress-bar-info' ?>"
                            role="progressbar"
                            aria-valuenow="<?= $percent ?>"
                            aria-valuemin="0"
                            aria-valuemax="100"
                            style="width: <?= $percent ?>%;">
                            <?= $percent ?>%
                        </div>
                    </div>

                    <?php if ($form['status'] === 'Tertandatangan'): ?>
                        <a href="<?= base_url('form/download-pdf/' . $form['id']) ?>"
                            class="btn btn-primary btn-sm"
                            style="margin-top: 10px;">
                            <span class="glyphicon glyphicon-download-alt"></span> Download Surat
                        </a>
                    <?php endif; ?>
                </div>

                <!-- Konten collapse: muncul hanya setelah panel diklik -->
                <div id="collapse<?= $form['id'] ?>" class="panel-collapse collapse">
                    <div class="panel-body">
                        <hr> <!-- Divider di atas detail -->
                        <p><strong>Nama Keluarga:</strong> <?= esc($form['nama_keluarga']) ?></p>
                        <p><strong>Jenjang Jabatan:</strong> <?= esc($form['jenjang_jabatan']) ?></p>

                        <?php
                        $rsModel = new \App\Models\RSModel();
                        $rs = $rsModel->find($form['rs_id']);
                        $namaRS = $rs ? esc($rs['Nama_RS']) . " – " . esc($rs['Jalan']) : '-';
                        ?>
                        <p><strong>Rumah Sakit Terpilih:</strong> Rumah Sakit <?= $namaRS ?></p>

                        <p><strong>Verifikasi Admin:</strong>
                            <?= $form['verified_at'] ? date('d-m-Y H:i', strtotime($form['verified_at'])) : '-' ?>
                        </p>
                        <p><strong>Disetujui Pimpinan:</strong>
                            <?= $form['approved_at'] ? date('d-m-Y H:i', strtotime($form['approved_at'])) : '-' ?>
                        </p>
                        <p><strong>Tanda Tangan:</strong>
                            <?= $form['signed_at'] ? date('d-m-Y H:i', strtotime($form['signed_at'])) : '-' ?>
                        </p>
                        <p><strong>Dibuat:</strong>
                            <?= date('d-m-Y H:i', strtotime($form['created_at'])) ?>
                        </p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<?= $this->include('layouts/footer_homepage') ?>