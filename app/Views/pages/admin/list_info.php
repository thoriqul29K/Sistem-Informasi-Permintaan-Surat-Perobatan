<?= $this->include('layouts/header') ?>

<title>List Informasi Permintaan Surat</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

<div class="container mt-5">
    <div>
        <a href="<?= base_url('/') ?>" style="color: white; background-color:black;" class="back-btn btn btn-secondary btn-sm">← Kembali</a>
    </div>

    <h2><br>List Informasi Permintaan Surat</h2>
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
                        <button
                            class="btn btn-sm btn-primary btn-detail"
                            data-id="<?= $info['id'] ?>">
                            Detail
                        </button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <!-- Setelah tabel -->
    <!-- Modal Bootstrap -->
    <div class="modal fade" id="detailModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail & Verifikasi</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        &times;
                    </button>
                </div>
                <div class="modal-body" id="detailContent">
                    <!-- Konten akan dimuat di sini -->
                    <div class="text-center">
                        <span class="spinner-border"></span> Memuat...
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<?= $this->include('layouts/footer') ?>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.btn-detail').forEach(btn => {
            btn.addEventListener('click', () => {
                const id = btn.getAttribute('data-id');
                $('#detailModal').modal('show');
                document.getElementById('detailContent').innerHTML =
                    '<div class="text-center"><span class="spinner-border"></span> Memuat...</div>';
                fetch(`<?= base_url('admin/detail/') ?>${id}`, {
                        credentials: 'same-origin'
                    })
                    .then(res => {
                        if (!res.ok) throw new Error('Network response was not ok');
                        return res.text();
                    })
                    .then(html => {
                        document.getElementById('detailContent').innerHTML = html;
                    })
                    .catch(() => {
                        document.getElementById('detailContent').innerHTML =
                            '<div class="alert alert-danger">Gagal memuat detail.</div>';
                    });
            });
        });
    });
</script>