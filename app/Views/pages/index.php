<!DOCTYPE html>
<html lang="en">

<head>
  <title>Beranda</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap 3 CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

  <!-- JQuery & Bootstrap JS -->
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

    /* ✅ Ukuran Gambar Carousel */
    .carousel-inner>.item>img {
      height: 400px;
      /* Atur tinggi tetap */
      object-fit: cover;
      /* Pangkas gambar agar pas */
      width: 100%;
      /* Pastikan lebar penuh */
    }

    @media (max-width: 768px) {
      .carousel-inner>.item>img {
        height: 250px;
        /* Lebih pendek di mobile */
      }
    }
  </style>

  <!-- ✅ NAVBAR RESPONSIF -->
  <nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">

      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#nav-menu">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <img src="<?= base_url('assets/img/Logo PTBA 750x140px.png') ?>" alt="Foto 1" style="width: 100px;">
      </div>

      <div class="collapse navbar-collapse" id="nav-menu">
        <ul class="nav navbar-nav">
          <li class="active"><a href="/">Beranda</a></li>
          <li><a href="<?= base_url('/tentang') ?>">Tentang</a></li>
          <li><a href="<?= base_url('/sop') ?>">SOP</a></li>
          <li><a href="<?= base_url('/login') ?>">Login</a></>
        </ul>
      </div>

    </div>
  </nav>

  <!-- ✅ CAROUSEL UTAMA -->
  <div class="container">
    <div id="myCarousel" class="carousel slide" data-ride="carousel">

      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
      </ol>

      <!-- Slides -->
      <div class="carousel-inner">
        <div class="item active">
          <img src="<?= base_url('assets/img/foto1.jpeg') ?>" alt="Foto 1" style="width:100%;">
        </div>
        <div class="item">
          <img src="<?= base_url('assets/img/foto2.jpeg') ?>" alt="Foto 2" style="width:100%;">
        </div>
        <div class="item">
          <img src="<?= base_url('assets/img/foto3.jpg') ?>" alt="Foto 3" style="width:100%;">
        </div>
      </div>

      <!-- Controls -->
      <a class="left carousel-control" href="#myCarousel" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#myCarousel" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>

    <!-- ✅ INFO PENGANTAR -->
    <div class="row" style="margin-top: 40px;">
      <div class="col-xs-12">
        <h2>Selamat Datang di Sistem Surat Perobatan Pegawai PTBA</h2>
        <p>
          Sistem ini dibuat untuk mendigitalisasi proses pengajuan surat perobatan bagi pegawai di PT Bukit Asam.
          Anda dapat melihat informasi SOP, mengajukan surat perobatan, dan melacak status pengajuan Anda secara online.
        </p>
      </div>
    </div>
  </div>

  <!-- ✅ FOOTER -->
  <footer>
    <p>© 2025 PT Bukit Asam. Sistem Digital Surat Perobatan</p>
  </footer>

  </body>

</html>