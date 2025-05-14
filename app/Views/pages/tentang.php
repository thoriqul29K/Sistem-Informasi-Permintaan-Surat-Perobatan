<!DOCTYPE html>
<html lang="en">

<head>
  <title>Tentang PTBA</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS dan JS -->
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
        <a class="navbar-brand" href="<?= base_url('/') ?>">PTBA</a>
      </div>

      <div class="collapse navbar-collapse" id="nav-menu">
        <ul class="nav navbar-nav">
          <li><a href="<?= base_url('/') ?>">Beranda</a></li>
          <li class="active"><a href="<?= base_url('/tentang') ?>">Tentang</a></li>
          <li><a href="<?= base_url('/sop') ?>">SOP</a></li>
          <li><a href="<?= base_url('/login') ?>">Login</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- ✅ ISI KONTEN HALAMAN -->
  <div class="container">
    <h2>Tentang PT Bukit Asam</h2>
    <p>
      PT Bukit Asam adalah perusahaan yang bergerak di bidang pertambangan batubara milik negara Indonesia. Perusahaan ini berkomitmen untuk meningkatkan kesejahteraan pegawai, termasuk dalam hal layanan kesehatan.
    </p>
    <p>
      Sistem digital surat perobatan ini bertujuan untuk meningkatkan efisiensi proses pengajuan bantuan dana perobatan pegawai, mengurangi proses manual, serta memberikan akses informasi yang mudah bagi pegawai dan pimpinan.
    </p>
  </div>

  <!-- ✅ FOOTER -->
  <footer>
    <p>© 2025 PT Bukit Asam. Sistem Digital Surat Perobatan</p>
  </footer>

</body>

</html>