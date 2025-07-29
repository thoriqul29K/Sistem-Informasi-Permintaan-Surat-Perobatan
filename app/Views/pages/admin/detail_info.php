<?php

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

if (! empty($info['qr_token'])) {
    $url    = base_url("ruler/sign/{$info['id']}/{$info['qr_token']}");
    $qrCode = QrCode::create($url)
        ->setSize(150)
        ->setMargin(10);

    $writer = new PngWriter();
    $result = $writer->write($qrCode);

    // sisipkan sebagai data-uri
    $qrImage = $result->getDataUri();
}
?>
<div class="card mt-3">
    <div class="card-header">
        Informasi Permintaan
    </div>
    <div class="card-body">
        <p><strong>Nama:</strong> <?= esc($info['nama_lengkap']) ?></p>
        <p><strong>Umur:</strong> <?= esc($info['umur']) ?> tahun</p>
        <p><strong>Jenis Kelamin:</strong> <?= esc($info['jenis_kelamin']) ?></p>
        <p><strong>Jenjang Jabatan:</strong> <?= esc($info['jenjang_jabatan']) ?></p>
        <p><strong>Rumah Sakit Dituju:</strong>
            <?= esc($info['nama_rs']) ?>
            <?php if (! empty($info['jalan_rs'])): ?>
                <br><small class="text-muted"><?= esc($info['jalan_rs']) ?></small>
            <?php endif; ?>
        </p>


        <p><strong>Status:</strong> <?= esc($info['status']) ?></p>
        <?php if (!empty($info['verified_at'])): ?>
            <p><strong>Tanggal Diverifikasi:</strong> <?= date('d-m-Y H:i', strtotime($info['verified_at'])) ?></p>
        <?php endif; ?>

        <?php if (!empty($info['approved_at'])): ?>
            <p><strong>Tanggal Disetujui:</strong> <?= date('d-m-Y H:i', strtotime($info['approved_at'])) ?></p>
        <?php endif; ?>
        <?php if (!empty($info['signed_at'])): ?>
            <p><strong>Tanggal Ditanda-tangan:</strong> <?= date('d-m-Y H:i', strtotime($info['signed_at'])) ?></p>
        <?php endif; ?>
        <?php if (!empty($info['qr_token'])): ?>
            <p><strong>Qr code: <img src="<?= $qrImage ?>" alt="QR Code Tanda Tangan"></strong></p>
        <?php endif; ?>
    </div>
</div>

<div class="mt-4">
    <?php $role = session()->get('role'); ?>

    <!-- 1) Tombol Verifikasi (hanya admin & status = Menunggu) -->
    <?php if ($role === 'admin' && $info['status'] === 'Menunggu'): ?>
        <form action="<?= base_url('admin/verify/' . $info['id']) ?>" method="post" class="d-inline">
            <button type="submit" class="btn btn-success">Verifikasi</button>
        </form>
    <?php endif; ?>

    <!-- 2) Tombol Setujui/Tolak (hanya ruler & status = Terverifikasi) -->
    <?php if ($role === 'ruler' && $info['status'] === 'Terverifikasi'): ?>
        <form action="<?= base_url('ruler/decide/' . $info['id']) ?>" method="post" class="d-inline">
            <button name="action" value="approve" class="btn btn-success">Setujui</button>
        </form>
        <form action="<?= base_url('ruler/decide/' . $info['id']) ?>" method="post" class="d-inline">
            <button name="action" value="reject" class="btn btn-danger">Tolak</button>
        </form>
    <?php endif; ?>

    <!-- 3) Cetak Ulang PDF (admin & ruler, tapi hanya ketika status Disetujui) -->
    <?php if (in_array($role, ['admin', 'ruler']) && in_array($info['status'], ['Disetujui', 'Tertandatangan'])): ?>
        <a href="<?= base_url('admin/generate-pdf/' . $info['id']) ?>" class="btn btn-warning">
            Cetak Ulang PDF
        </a>
    <?php endif; ?>

    <!-- 4) Hapus Informasi (hanya admin & hanya untuk status Menunggu atau Ditolak) -->
    <?php if ($role === 'admin' && in_array($info['status'], ['Menunggu', 'Ditolak'])): ?>
        <form
            action="<?= base_url('admin/hapus/' . $info['id']) ?>"
            method="post"
            onsubmit="return confirm('Apakah Anda yakin ingin menghapus informasi ini?');"
            class="d-inline">
            <button type="submit" class="btn btn-danger">Hapus Informasi</button>
        </form>
    <?php endif; ?>
</div>