<?= $this->include('layouts/header_homepage') ?>
<!-- ✅ ISI KONTEN HALAMAN -->
<div class="container">
  <h2>Alur Permintaan / Pengajuan</h2>
  <img src="<?= base_url('assets/img/Flowchart.png') ?>" alt="flowchart">
  <ol>
    <li>Pegawai login ke sistem menggunakan akun yang sudah terdaftar.</li>
    <li>Mengisi form permohonan surat perobatan secara digital.</li>
    <li>Admin TU menerima dan memeriksa kelengkapan serta validitas data.</li>
    <li>Jika valid, admin TU meneruskan ke pimpinan untuk proses verifikasi akhir.</li>
    <li>Pimpinan menyetujui permohonan dan sistem mencetak dokumen PDF dengan tanda tangan digital.</li>
    <li>Pegawai dapat mengunduh surat perobatan yang telah disetujui.</li>
  </ol>
</div>

<?= $this->include('layouts/footer_homepage') ?>