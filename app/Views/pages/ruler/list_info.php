<?= $this->include('layouts/header') ?>
<!DOCTYPE html>
<html>

<head>
    <title>List Informasi Permintaan Surat</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h2>List Informasi Permintaan Surat</h2>
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
                    <th>Nama Keluarga</th>
                    <th>NP</th>
                    <th>Umur</th>
                    <th>Jenjang Jabatan</th>
                    <th>Rumah Sakit</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($list_info as $info): ?>
                    <tr>
                        <td><?= $info['id'] ?></td>
                        <td><?= $info['nama_lengkap'] ?></td>
                        <td><?= $info['nama_keluarga'] ?></td>
                        <td><?= $info['np'] ?></td>
                        <td><?= $info['umur'] ?> tahun</td>
                        <td><?= $info['jenjang_jabatan'] ?></td>
                        <td>
                            <?= esc($info['nama_rs']) ?>
                            <?php if (! empty($info['jalan_rs'])): ?>
                                <br><small class="text-muted"><?= esc($info['jalan_rs']) ?></small>
                            <?php endif; ?>
                        </td>
                        <td><?= $info['status'] ?></td>
                        <td>
                            <form action="<?= base_url('ruler/decide/' . $info['id']) ?>" method="POST" class="d-inline">
                                <button name="action" value="approve" class="btn btn-sm btn-success">Setujui</button>
                            </form>
                            <form action="<?= base_url('ruler/decide/' . $info['id']) ?>" method="POST" class="d-inline">
                                <button name="action" value="reject" class="btn btn-sm btn-danger">Tolak</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>

</html>