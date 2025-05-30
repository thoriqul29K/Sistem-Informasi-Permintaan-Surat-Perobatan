<?= $this->include('layouts/header_dashboard') ?>

<?php if (session()->getFlashdata('error')): ?>
  <div class="alert alert-danger">
    <p class="text-danger"><?= session()->getFlashdata('error') ?></p>
  </div>
<?php elseif (session()->getFlashdata('message')): ?>
  <p class="text-success"><?= session()->getFlashdata('message') ?></p>
<?php endif; ?>
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
</div>
<?= $this->include('layouts/footer_dashboard') ?>