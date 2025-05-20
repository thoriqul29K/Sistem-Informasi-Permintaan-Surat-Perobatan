<!DOCTYPE html>
<html lang="en">

<head>
  <title>PTBA - Beranda</title>
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

    

    /* Tambahkan ini */
.img-carousel {
  width: 100%;
  height: 600px; /* Ubah tinggi sesuai kebutuhan, misalnya 600px */
  object-fit: cover; /* Menjaga proporsi gambar dan crop bagian luar */
}

/* Responsif untuk layar kecil */
@media (max-width: 768px) {
  .img-carousel {
    height: 300px; /* Ukuran tinggi untuk mobile */
  }

  .carousel-caption h3 {
    font-size: 18px;
  }

  .carousel-caption p {
    font-size: 14px;
  }
}

    .carousel-container {
    max-width: 100%;
    height: 400px; /* Atur tinggi tetap */
    overflow: hidden;
    position: relative;
  }

  .mySlides {
    height: 100%;
    display: none;
  }

  .mySlides img {
    height: 100%;
    width: 100%;
    object-fit: cover; /* menjaga gambar tetap proporsional & mengisi area */
  }

  .mySlides .text-slide {
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    background-color: #052c65;
    color: white;
    padding: 20px;
    box-sizing: border-box;
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
          <li><a href="/tentang">Tentang</a></li>
          <li><a href="/sop">SOP</a></li>
          <li><a href="/login">Login</a></>
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
        <!-- Slide 1 -->
        <div class="item active">
          <img src="<?= base_url('assets/img/carousel2_2.jpg') ?>" alt="Foto 1" class="img-carousel">
          <div class="carousel-caption">
            <h3>Selamat Datang di Sistem Surat Perobatan</h3>
            <p>Mempermudah pegawai PTBA dalam pengajuan dan persetujuan surat perobatan.</p>
          </div>
        </div>

        <!-- Slide 2 -->
        <div class="item">
          <img src="<?= base_url('assets/img/carousel 2_LE.jpg') ?>" alt="Foto 2" class="img-carousel">
          <div class="carousel-caption">
            <h3>Alur Pengajuan Digital</h3>
            <p>Surat diperiksa Admin TU dan disetujui pimpinan melalui sistem.</p>
          </div>
        </div>

        <!-- Slide 3 -->
        <div class="item">
          <img src="<?= base_url('assets/img/carousel slide 3(1).jpg') ?>" alt="Foto 3" class="img-carousel">
          <div class="carousel-caption">
            <h3>Efisien & Terintegrasi</h3>
            <p>Pengajuan lebih cepat, aman, dan terdokumentasi rapi.</p>
          </div>
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

  <!-- ✅ HTML SLIDES -->
 <!-- Slide dengan latar belakang biru tua -->
 <div class="w3-content" style="max-width: 400px; margin: auto;">

  <!-- Slide 1: Teks -->
  <div class="mySlides w3-container" style="background-color: #052c65; color: white; padding: 20px; border-radius: 10px;">
    <h1><b>Did You Know?</b></h1>
    <h1><i>We plan to sell trips to the moon in the 2020s</i></h1>
  </div>

  <!-- Slide 2: Gambar -->
  <div class="mySlides">
    <img src="<?= base_url('assets/img/IMG_4837.jpg') ?>" alt="Slide 2" style="width:100%; height:auto; border-radius: 10px;">
  </div>

  <!-- Slide 3: Teks -->
  <div class="mySlides w3-container" style="background-color: #052c65; color: white; padding: 20px; border-radius: 10px;">
    <p><span class="w3-tag w3-yellow">New!</span></p>
    <p>6 Crystal Glasses</p>
    <p>Only $99 !!!</p>
  </div>

  <!-- Slide 4: Gambar -->
  <div class="mySlides">
    <img src="<?= base_url('assets/img/IMG_4839.jpg') ?>" alt="Slide 4" style="width:100%; height:auto; border-radius: 10px;">
  </div>

</div>

  <!-- ✅ FOOTER -->
  <footer>
    <p>© 2025 PT Bukit Asam. Sistem Digital Surat Perobatan</p>
  </footer>
  <script>
var slideIndex = 0;
carousel();

function carousel() {
  var i;
  var x = document.getElementsByClassName("mySlides");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none"; 
  }
  slideIndex++;
  if (slideIndex > x.length) {slideIndex = 1} 
  x[slideIndex-1].style.display = "block"; 
  setTimeout(carousel, 2000); 
}
</script>

  </body>

</html>