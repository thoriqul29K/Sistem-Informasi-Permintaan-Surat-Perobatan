<?= $this->include('layouts/header') ?>
<div class="formbold-main-wrapper">
  <a href="<?= base_url('/') ?>" class="back-btn btn btn-secondary btn-sm">
    ← Kembali
  </a>
  <div class="formbold-form-wrapper">
    <div class="logo-container">
      <img class="formbold-img" width="auto" height="300" src="<?= base_url('assets/img/Logo PTBA 750x140px.png') ?>" />
    </div>

    <?php if (session()->getFlashdata('success')): ?>
      <div class="alert alert-success">
        <?= session()->getFlashdata('success') ?>
      </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('errors')): ?>
      <div class="alert alert-danger">
        <ul>
          <?php foreach (session()->getFlashdata('errors') as $error): ?>
            <li><?= esc($error) ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
    <?php endif; ?>

    <?php if (isset($validation)): ?>
      <div class="alert alert-danger">
        <?= $validation->listErrors() ?>
      </div>
    <?php endif; ?>


    <form id="formPermintaan" action="<?= base_url('form/simpan') ?>" method="POST">
      <div class="formbold-form-title">
        <h2>Sistem Informasi Permintaan Surat Perobatan</h2>
        <p>Silahkan masukkan identitas anda</p>
      </div>

      <div class="formbold-mb-3">
        <label for="nama_lengkap" class="formbold-form-label">Nama Lengkap</label>
        <input type="text" name="nama_lengkap" id="nama_lengkap" class="formbold-form-input" required />
      </div>

      <div class="formbold-mb-3">
        <label for="nama_keluarga" class="formbold-form-label">Nama Keluarga</label>
        <input type="text" name="nama_keluarga" id="nama_keluarga" class="formbold-form-input" required />
      </div>

      <div class="formbold-mb-3">
        <label for="np" class="formbold-form-label">Nomor Pegawai</label>
        <input
          type="text"
          name="np"
          id="np"
          class="formbold-form-input"
          required
          pattern="[0-9]{10}"
          maxlength="10"
          minlength="10"
          data-toggle="tooltip"
          data-placement="right"
          title="NP harus berupa angka (0–9) dan harus 10 digit." />
        <div class="invalid-feedback">
          Silakan masukkan NP berupa angka 0-9 dan harus 10 digit.
        </div>
      </div>

      <div class="formbold-mb-3">
        <label for="umur" class="formbold-form-label">Umur</label>
        <input
          type="text"
          name="umur"
          id="umur"
          class="formbold-form-input"
          required
          inputmode="numeric"
          maxlength="2"
          pattern="^(?:1[89]|[2-5]\d|60)$"
          title="Umur yang dimasukkan berupa angka 18 - 60 dan harus 2 digit." />
      </div>

      <div class="formbold-mb-3">
        <label for="jenis_kelamin" class="formbold-form-label">Jenis Kelamin</label>
        <select name="jenis_kelamin" id="jenis_kelamin" class="formbold-form-input" required>
          <option value="">-- Pilih Jenis Kelamin --</option>
          <option value="Laki-laki">Laki-laki</option>
          <option value="Perempuan">Perempuan</option>
        </select>
      </div>

      <div class="formbold-mb-3">
        <label for="jenjang_jabatan" class="formbold-form-label">Jenjang Jabatan</label>
        <input type="text" name="jenjang_jabatan" id="jenjang_jabatan" class="formbold-form-input" required />
      </div>

      <div class="formbold-mb-3">
        <label for="rumah_sakit_dituju" class="formbold-form-label">Rumah Sakit yang Dituju</label>
        <select name="rumah_sakit_dituju" id="rumah_sakit_dituju" class="formbold-form-input" required>
          <option value="">-- Pilih Rumah Sakit --</option>
          <?php foreach ($rs_list as $rs): ?>
            <option value="<?= esc($rs['ID']) ?>">
              <?= esc($rs['Nama_RS']) ?> — <?= esc($rs['Jalan']) ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>

      <div id="message" style="display: none; margin-top: 20px;" class="alert alert-success">
        <p style="color:red">Informasi yang diisi telah berhasil terkirim</p>
      </div>

      <button type="submit" class="formbold-btn">Kirim</button>
    </form>
  </div>
</div>

<style>
  @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

  .alert {
    padding: 15px;
    margin-bottom: 20px;
    border-radius: 5px;
    text-align: center;
  }

  .alert-success {
    background-color: #d4edda;
    color: #155724;
  }

  .alert-danger {
    background-color: #f8d7da;
    color: #721c24;
  }


  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
  }

  body {
    font-family: 'Inter', sans-serif;
  }

  .formbold-main-wrapper {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 48px;
    background-image: url("<?= base_url('assets/img/login-bg.png') ?>");
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
  }

  /* Styling untuk tombol kembali agar selalu di kiri atas */
  .back-btn {
    position: absolute;
    top: 20px;
    left: 20px;
    z-index: 10;
  }

  .formbold-form-wrapper {
    background: rgba(255, 255, 255, 0.6);
    margin: 0 auto;
    max-width: 570px;
    width: 100%;
    text-align: center;
    padding: 40px;
  }

  .formbold-img {
    margin-bottom: 45px;
    display: block;
    margin: 0 auto;
  }

  .formbold-form-title {
    margin-bottom: 30px;
  }

  .formbold-form-title h2 {
    font-weight: 600;
    font-size: 28px;
    line-height: 34px;
    color: #07074d;
  }

  .formbold-form-title p {
    font-size: 16px;
    line-height: 24px;
    color: #536387;
    margin-top: 12px;
  }

  .formbold-mb-3 {
    margin-bottom: 15px;
  }

  .formbold-form-label {
    color: #536387;
    font-size: 14px;
    line-height: 24px;
    display: block;
    margin-bottom: 10px;
  }

  .formbold-form-input {
    text-align: center;
    width: 100%;
    padding: 13px 22px;
    border-radius: 5px;
    border: 1px solid #dde3ec;
    background: #ffffff;
    font-weight: 500;
    font-size: 16px;
    color: #536387;
    outline: none;
  }

  .formbold-form-input:focus {
    border-color: #6a64f1;
    box-shadow: 0px 3px 8px rgba(0, 0, 0, 0.05);
  }

  .formbold-btn {
    font-size: 16px;
    border-radius: 5px;
    padding: 14px 25px;
    border: none;
    font-weight: 500;
    background-color: #6a64f1;
    color: white;
    cursor: pointer;
    margin-top: 25px;
  }

  .formbold-btn:hover {
    box-shadow: 0px 3px 8px rgba(0, 0, 0, 0.05);
  }

  .logo-container {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 20px;
    margin-bottom: 20px;
  }

  .logo-container .formbold-img {
    display: inline-block;
    margin: 0;
  }

  /* Hapus spin button pada Chrome, Safari, Edge, Opera */
  #np::-webkit-outer-spin-button,
  #np::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
  }

  /* Hapus spin button pada Firefox */
  #np {
    -moz-appearance: textfield;
  }

  /* ===== Responsif untuk layar kecil (mobile) ===== */
  @media (max-width: 768px) {

    /* Buat wrapper memenuhi lebar, kurangi padding */
    .formbold-main-wrapper {
      padding: 24px;
      /* Kurangi padding keseluruhan */
    }

    .formbold-form-wrapper {
      padding: 20px;
      /* Kurangi padding internal */
      max-width: 100%;
      /* Penuhi lebar layar */
      margin: 0 10px;
      /* Sisakan sedikit margin samping */
    }

    /* Logo-container berubah jadi kolom */
    .logo-container {
      flex-direction: column;
      /* Susun logo vertikal */
      gap: 10px;
      /* Jarak antar logo diperkecil */
      margin-bottom: 15px;
      /* Kurangi margin bawah */
    }

    /* Ukuran gambar logo diperkecil */
    .logo-container .formbold-img {
      width: 200px !important;
      height: auto !important;
    }

    /* Judul dibuat lebih ringkas dan teks rata-tengah */
    .formbold-form-title h2 {
      font-size: 22px;
      /* Perkecil ukuran font judul */
      line-height: 28px;
    }

    .formbold-form-title p {
      font-size: 14px;
    }

    /* Padding pada input dikurangi */
    .formbold-form-input {
      padding: 10px 16px;
      font-size: 14px;
      /* Font input dikurangi sedikit */
    }

    /* Tombol dibuat lebih besar agar mudah ditekan */
    .formbold-btn {
      padding: 12px 20px;
      font-size: 14px;
    }

    /* Alert disesuaikan lebarnya */
    .alert {
      font-size: 14px;
      padding: 12px;
    }
  }

  .logo-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 1rem;
  }

  .logo-container img {
    max-width: 25%;
    height: auto;
  }

  @media (max-width: 576px) {
    .logo-container img {
      max-width: 45%;
    }
  }
</style>
<script>
  // Menonaktifkan fungsi scroll (wheel) pada input np
  document.getElementById('np').addEventListener('wheel', function(e) {
    e.preventDefault();
  });
</script>