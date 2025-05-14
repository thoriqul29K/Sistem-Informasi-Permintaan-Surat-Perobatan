<!DOCTYPE html>
<html lang="en">

<head>
  <title>SOP Surat Perobatan</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS & JS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

  <style>
    body {
      padding-top: 70px;
    }

    footer {
      margin-top: 50px;
      padding: 20px 0;
      background-color: #f5f5f5;
      text-align: center;
    }
  </style>
</head>

<body>

  <!-- ✅ NAVBAR -->
  <nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#nav-menu">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="/">PTBA</a>
      </div>

      <div class="collapse navbar-collapse" id="nav-menu">
        <ul class="nav navbar-nav">
          <li><a href="<?= base_url('/') ?>">Beranda</a></li>
          <li><a href="<?= base_url('/tentang') ?>">Tentang</a></li>
          <li class="active"><a href="<?= base_url('/sop') ?>">SOP</a></li>
          <li><a href="<?= base_url('/login') ?>">Login</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- ✅ ISI KONTEN HALAMAN -->
  <div class="container">
    <h2>Standar Operasional Prosedur (SOP)</h2>
    <ol>
      <li>Pegawai login ke sistem menggunakan akun yang sudah terdaftar.</li>
      <li>Mengisi form permohonan surat perobatan secara digital.</li>
      <li>Admin TU menerima dan memeriksa kelengkapan serta validitas data.</li>
      <li>Jika valid, admin TU meneruskan ke pimpinan untuk proses verifikasi akhir.</li>
      <li>Pimpinan menyetujui permohonan dan sistem mencetak dokumen PDF dengan tanda tangan digital.</li>
      <li>Pegawai dapat mengunduh surat perobatan yang telah disetujui.</li>
    </ol>
  </div>

  <!-- ✅ FOOTER -->
  <footer>
    <p>© 2025 PT Bukit Asam. Sistem Digital Surat Perobatan</p>
  </footer>

</body>

</html>