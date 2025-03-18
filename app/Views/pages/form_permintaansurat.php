<div class="formbold-main-wrapper">
  <!-- Author: FormBold Team -->
  <!-- Learn More: https://formbold.com -->
  <div class="formbold-form-wrapper">
    <img class="formbold-img" width="200" height="200" src="<?= base_url('assets/img/logo PTBA.png') ?>" />

    <form id="formPermintaan" action="<?= base_url('form/simpan') ?>" method="POST">
      <div class="formbold-form-title">
        <h2>Sistem Informasi Permintaan Surat Perobatan</h2>
        <p>Silahkan masukkan identitas anda</p>
      </div>

      <div class="formbold-mb-3">
        <label for="nama_lengkap" class="formbold-form-label">Nama Lengkap</label>
        <input type="text" name="nama_lengkap" id="nama_lengkap" class="formbold-form-input" required />
      </div>

      <div class="formbold-input-flex">
        <div>
          <label for="email" class="formbold-form-label">Email</label>
          <input type="email" name="email" id="email" class="formbold-form-input" required />
        </div>
        <div>
          <label for="phone" class="formbold-form-label">Nomor HP</label>
          <input type="text" name="phone" id="phone" class="formbold-form-input" required />
        </div>
      </div>

      <div class="formbold-mb-3">
        <label for="nik" class="formbold-form-label">NIK</label>
        <input type="text" name="nik" id="nik" class="formbold-form-input" required />
      </div>

      <div class="formbold-mb-3">
        <label for="alamat" class="formbold-form-label">Alamat</label>
        <input type="text" name="alamat" id="alamat" class="formbold-form-input" required />
      </div>

      <div class="formbold-mb-3">
        <label for="keterangan" class="formbold-form-label">Keterangan</label>
        <input type="text" name="keterangan" id="keterangan" class="formbold-form-input" required />
      </div>

      <!-- Pesan yang ditampilkan tanpa reload halaman -->
      <div id="message" style="display: none; margin-top: 20px;" class="alert alert-success">
        <p style="color:red">Informasi yang diisi telah berhasil terkirim</p>
      </div>

      <button type="submit" class="formbold-btn">Kirim</button>
      <br><br>
      <a href="<?= base_url('/') ?>" class="button">Balik ke halaman login</a>
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

  .formbold-mb-3 {
    margin-bottom: 15px;
  }

  .formbold-relative {
    position: relative;

  }

  .formbold-opacity-0 {
    opacity: 0;
  }

  .formbold-stroke-current {
    stroke: currentColor;
  }

  #supportCheckbox:checked~div span {
    opacity: 1;
  }

  .formbold-main-wrapper {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 48px;
  }

  .formbold-form-wrapper {
    margin: 0 auto;
    max-width: 570px;
    width: 100%;
    background: white;
    text-align: center;
    padding: 40px;
  }

  .formbold-img {
    margin-bottom: 45px;
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

  .formbold-input-flex {
    display: flex;
    gap: 20px;
    margin-bottom: 15px;
  }

  .formbold-input-flex>div {
    width: 50%;
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
    resize: none;
  }

  .formbold-form-input:focus {
    border-color: #6a64f1;
    box-shadow: 0px 3px 8px rgba(0, 0, 0, 0.05);
  }

  .formbold-form-label {
    color: #536387;
    font-size: 14px;
    line-height: 24px;
    display: block;
    margin-bottom: 10px;
  }

  .formbold-checkbox-label {
    display: flex;
    cursor: pointer;
    user-select: none;
    font-size: 16px;
    line-height: 24px;
    color: #536387;
  }

  .formbold-checkbox-label a {
    margin-left: 5px;
    color: #6a64f1;
  }

  .formbold-input-checkbox {
    position: absolute;
    width: 1px;
    height: 1px;
    padding: 0;
    margin: -1px;
    overflow: hidden;
    clip: rect(0, 0, 0, 0);
    white-space: nowrap;
    border-width: 0;
  }

  .formbold-checkbox-inner {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 20px;
    height: 20px;
    margin-right: 16px;
    margin-top: 2px;
    border: 0.7px solid #dde3ec;
    border-radius: 3px;
  }

  .formbold-btn {
    font-size: 16px;
    border-radius: 5px;
    padding: 14px 25px;
    border: none;
    font-weight: 500;
    align-self: center;
    background-color: #6a64f1;
    color: white;
    cursor: pointer;
    display: inline-block;
    margin-top: 25px;
  }

  .formbold-btn:hover {
    box-shadow: 0px 3px 8px rgba(0, 0, 0, 0.05);
  }

  .formbold-checkbox-wrapper {
    text-align: center;
  }
</style>
<!-- JavaScript untuk meng-handle AJAX form submission -->
<script>
  document.getElementById('formPermintaan').addEventListener('submit', function(e) {
    e.preventDefault(); // Mencegah reload halaman

    var form = e.target;
    var formData = new FormData(form);

    fetch(form.action, {
        method: form.method,
        body: formData,
      })
      .then(response => response.text())
      .then(data => {
        // Tampilkan pesan sukses
        document.getElementById('message').style.display = 'block';
        // Opsional: Reset form jika diperlukan
        form.reset();
      })
      .catch(error => {
        console.error('Error:', error);
      });
  });
</script>