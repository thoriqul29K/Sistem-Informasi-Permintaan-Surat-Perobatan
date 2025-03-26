<!DOCTYPE html>
<html>

<head>
    <title>Detail & Verifikasi Permintaan Surat</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.css" />
</head>

<body>
    <div class="container mt-5">
        <h2>Detail & Verifikasi Permintaan Surat</h2>
        <!-- Tombol Kembali di pojok kiri atas -->
        <a href="<?= base_url('/list-info') ?>" class="btn btn-secondary mb-3">
            <i class="ri-arrow-left-line"></i> Kembali
        </a>

        <div class="card mt-3">
            <div class="card-header">
                Informasi Permintaan
            </div>
            <div class="card-body">
                <p><strong>Nama:</strong> <?= $info['nama_lengkap'] ?></p>
                <p><strong>Email:</strong> <?= $info['email'] ?></p>
                <p><strong>NIK:</strong> <?= $info['nik'] ?></p>
                <p><strong>Alamat:</strong> <?= $info['alamat'] ?></p>
                <p><strong>Keterangan:</strong> <?= $info['keterangan'] ?></p>
                <p><strong>Status:</strong> <?= $info['status'] ?></p>
            </div>
        </div>

        <!-- Jika status masih Menunggu, tampilkan form verifikasi -->
        <?php if ($info['status'] == 'Menunggu'): ?>
            <form action="<?= base_url('/admin/verifikasi/' . $info['id']) ?>" method="post" class="mt-4">
                <div class="form-group">
                    <label for="rumah_sakit">Pilih Rumah Sakit </label>
                    <select name="rumah_sakit" id="rumah_sakit" class="form-control" required>
                        <option value="">-- Pilih Rumah Sakit --</option>
                        <option value="RS A">RS A</option>
                        <option value="RS B">RS B</option>
                        <option value="RS C">RS C</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-success">
                    Verifikasi & Tanda Tangan
                </button>
            </form>
        <?php else: ?>
            <div class="alert alert-info mt-4">
                Permintaan surat sudah diverifikasi.
            </div>
        <?php endif; ?>
        <?php if ($info['status'] == 'Disetujui'): ?>
            <a href="<?= base_url('/admin/generate-pdf/' . $info['id']) ?>" class="btn btn-warning mt-3">
                Cetak Ulang PDF
            </a>
        <?php endif; ?>
        <!-- Tombol Hapus Informasi -->
        <form action="<?= base_url('/admin/hapus/' . $info['id']) ?>" method="post" onsubmit="return confirm('Apakah Anda yakin ingin menghapus informasi ini?');" class="mt-3">
            <button type="submit" class="btn btn-danger">Hapus Informasi</button>
        </form>

    </div>
</body>

</html>