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
        <?php if (!empty($info['approved_at'])): ?>
            <p><strong>Tanggal Disetujui:</strong> <?= date('d-m-Y H:i', strtotime($info['approved_at'])) ?></p>
        <?php endif; ?>
    </div>
</div>

<!-- Jika status masih Menunggu, tampilkan form verifikasi -->
<?php if ($info['status'] == 'Menunggu'): ?>
    <form action="<?= base_url('/admin/verify/' . $info['id']) ?>" method="post" class="mt-4">
        <!-- Misal admin hanya melakukan verifikasi tanpa input tambahan -->
        <button type="submit" class="btn btn-success">
            Verifikasi & Tanda Tangan
        </button>
    </form>
<?php else: ?>
    <div class="alert alert-info mt-4">
        Permintaan surat sudah diverifikasi.
    </div>
<?php endif; ?>

<!-- Jika status sudah Disetujui, tampilkan tombol untuk cetak ulang PDF -->
<?php if ($info['status'] == 'Disetujui'): ?>
    <a href="<?= base_url('/admin/generate-pdf/' . $info['id']) ?>" class="btn btn-warning mt-3">
        Cetak Ulang PDF
    </a>
<?php endif; ?>

<!-- Tombol Hapus Informasi -->
<form action="<?= base_url('/admin/hapus/' . $info['id']) ?>" method="post" onsubmit="return confirm('Apakah Anda yakin ingin menghapus informasi ini?');" class="mt-3">
    <button type="submit" class="btn btn-danger">Hapus Informasi</button>
</form>