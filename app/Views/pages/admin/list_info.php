<?= $this->include('layouts/header') ?>

<title>List Informasi Permintaan Surat</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="h5 mb-0">List Informasi Permintaan Surat</h2>
        <a href="<?= base_url('/') ?>"
            class="btn btn-secondary btn-sm"
            style="color: white; background-color: black;">
            ← Kembali
        </a>
    </div>

    <?php if (session()->getFlashdata('message')): ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('message') ?>
        </div>
    <?php endif; ?>

    <!-- Wrapper untuk responsive table -->
    <div class="table-responsive">
        <table class="table table-bordered table-hover mb-0">
            <thead class="thead-light">
                <tr>
                    <th class="align-middle">ID</th>
                    <th class="align-middle">Nama Lengkap</th>
                    <!-- Kolom Nama Keluarga tetap tampil semua breakpoint -->
                    <th class="align-middle">Nama Keluarga</th>
                    <!-- Sembunyikan kolom NP di <576px -->
                    <th class="align-middle d-none d-sm-table-cell">NP</th>
                    <!-- Sembunyikan kolom Umur di <768px -->
                    <th class="align-middle d-none d-md-table-cell">Umur</th>
                    <!-- Sembunyikan Jenjang Jabatan di <768px -->
                    <th class="align-middle d-none d-md-table-cell">Jenjang Jabatan</th>
                    <th class="align-middle">Rumah Sakit</th>
                    <th class="align-middle">Status</th>
                    <th class="align-middle">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($list_info as $info): ?>
                    <tr>
                        <td class="align-middle"><?= $info['id'] ?></td>
                        <td class="align-middle"><?= esc($info['nama_lengkap']) ?></td>
                        <td class="align-middle"><?= esc($info['nama_keluarga']) ?></td>
                        <td class="align-middle d-none d-sm-table-cell"><?= esc($info['np']) ?></td>
                        <td class="align-middle d-none d-md-table-cell"><?= esc($info['umur']) ?> tahun</td>
                        <td class="align-middle d-none d-md-table-cell"><?= esc($info['jenjang_jabatan']) ?></td>
                        <td class="align-middle">
                            <?= esc($info['nama_rs']) ?>
                            <?php if (! empty($info['jalan_rs'])): ?>
                                <br><small class="text-muted"><?= esc($info['jalan_rs']) ?></small>
                            <?php endif; ?>
                        </td>
                        <td class="align-middle"><?= esc($info['status']) ?></td>
                        <td class="align-middle">
                            <button
                                class="btn btn-sm btn-primary btn-detail px-2"
                                data-id="<?= $info['id'] ?>"
                                title="Lihat Detail">
                                <span class="d-none d-sm-inline">Detail</span>
                                <span class="d-inline d-sm-none"><i class="fas fa-info-circle"></i></span>
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Modal Bootstrap -->
    <div class="modal fade" id="detailModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail &amp; Verifikasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                        &times;
                    </button>
                </div>
                <div class="modal-body" id="detailContent">
                    <div class="text-center py-4">
                        <div class="spinner-border text-primary" role="status">
                            <span class="sr-only">Memuat...</span>
                        </div>
                        <div>Memuat...</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->include('layouts/footer') ?>

<!-- JS Detail Modal tetap sama -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.btn-detail').forEach(btn => {
            btn.addEventListener('click', () => {
                const id = btn.getAttribute('data-id');
                $('#detailModal').modal('show');
                document.getElementById('detailContent').innerHTML =
                    `<div class="text-center py-4">
                    <div class="spinner-border text-primary" role="status">
                        <span class="sr-only">Memuat...</span>
                    </div>
                    <div>Memuat...</div>
                </div>`;
                fetch(`<?= base_url('admin/detail/') ?>${id}`, {
                        credentials: 'same-origin'
                    })
                    .then(res => res.ok ? res.text() : Promise.reject())
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