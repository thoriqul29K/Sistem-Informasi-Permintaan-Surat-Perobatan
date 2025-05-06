<?= $this->include('layouts/header') ?>
<div class="formbold-main-wrapper">
  <div class="formbold-form-wrapper">
    <div class="logo-container">
      <img class="formbold-img" width="100" height="100" src="<?= base_url('assets/img/logo BUMN.png') ?>" />
      <img class="formbold-img" width="100" height="100" src="<?= base_url('assets/img/Akhlak.png') ?>" />
      <img class="formbold-img" width="100" height="100" src="<?= base_url('assets/img/logo PTBA 2.png') ?>" />
    </div>
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
          type="number"
          name="np"
          id="np"
          class="formbold-form-input"
          required
          onkeydown="if(['ArrowUp','ArrowDown','ArrowLeft','ArrowRight'].includes(event.key)) event.preventDefault();" />

      </div>

      <div class="formbold-mb-3">
        <label for="umur" class="formbold-form-label">Umur</label>
        <input type="number" name="umur" id="umur" class="formbold-form-input" required />
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

  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
  }

  body {
    font-family: 'Inter', sans-serif;
  }

  .formbold-main-wrapper {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 48px;
    background-image: url("<?= base_url('assets/img/login-bg.png') ?>");
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
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
</style>
<script>
  document.getElementById('formPermintaan').addEventListener('submit', function(e) {
    e.preventDefault();
    var form = e.target;
    var formData = new FormData(form);
    fetch(form.action, {
        method: form.method,
        body: formData,
      })
      .then(response => response.text())
      .then(data => {
        document.getElementById('message').style.display = 'block';
        form.reset();
      })
      .catch(error => {
        console.error('Error:', error);
      });
  });
  // Menonaktifkan fungsi scroll (wheel) pada input np
  document.getElementById('np').addEventListener('wheel', function(e) {
    e.preventDefault();
  });
</script>