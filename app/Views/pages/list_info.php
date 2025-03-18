<!DOCTYPE html>
<html>

<head>
    <title>List Informasi Permintaan Surat</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h2>List Informasi Permintaan Surat</h2>
        <!-- Menampilkan pesan flash jika ada -->
        <?php if (session()->getFlashdata('message')): ?>
            <div class="alert alert-success">
                <?= session()->getFlashdata('message') ?>
            </div>
        <?php endif; ?>

        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Lengkap</th>
                    <th>Email</th>
                    <th>NIK</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($list_info as $info): ?>
                    <tr>
                        <td><?= $info['id'] ?></td>
                        <td><?= $info['nama_depan'] . ' ' . $info['nama_belakang'] ?></td>
                        <td><?= $info['email'] ?></td>
                        <td><?= $info['nik'] ?></td>
                        <td><?= $info['status'] ?></td>
                        <td>
                            <a href="<?= base_url('/admin/detail/' . $info['id']) ?>" class="btn btn-primary btn-sm">
                                Detail & Verifikasi
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>

</html>