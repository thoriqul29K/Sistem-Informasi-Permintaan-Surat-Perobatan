<div class="formbold-main-wrapper">
  <!-- Author: FormBold Team -->
  <!-- Learn More: https://formbold.com -->
  <div class="formbold-form-wrapper">
    <img class="formbold-img" width="200" height="200" fill="none" src="<?= base_url('assets/img/logo PTBA.png') ?>" />
    <form action="https://formbold.com/s/FORM_ID" method="POST">
      <div class="formbold-form-title">
        <h2 class="">Sistem Informasi Permintaan Surat Perobatan</h2>
        <p>
          Silahkan masukkan identitas anda
        </p>
      </div>

      <div class="formbold-input-flex">
        <div>
          <label for="firstname" class="formbold-form-label">
            Nama Depan
          </label>
          <input
            type="text"
            name="firstname"
            id="firstname"
            class="formbold-form-input" />
        </div>
        <div>
          <label for="lastname" class="formbold-form-label"> Nama Belakang </label>
          <input
            type="text"
            name="lastname"
            id="lastname"
            class="formbold-form-input" />
        </div>
      </div>

      <div class="formbold-input-flex">
        <div>
          <label for="email" class="formbold-form-label"> Email </label>
          <input
            type="email"
            name="email"
            id="email"
            class="formbold-form-input" />
        </div>
        <div>
          <label for="phone" class="formbold-form-label"> Nomor HP </label>
          <input
            type="text"
            name="phone"
            id="phone"
            class="formbold-form-input" />
        </div>
      </div>

      <div class="formbold-mb-3">
        <label for="address" class="formbold-form-label">
          Alamat
        </label>
        <input
          type="text"
          name="address"
          id="address"
          class="formbold-form-input" />
      </div>

      <div class="formbold-mb-3">
        <label for="NIK" class="formbold-form-label">
          NIK
        </label>
        <input
          type="text"
          name="NIK"
          id="NIK"
          class="formbold-form-input" />
      </div>

      <div class="formbold-mb-3">
        <div>
          <label for="state" class="formbold-form-label"> Kota/Provinsi </label>
          <input
            type="text"
            name="state"
            id="state"
            class="formbold-form-input" />
        </div>
      </div>

      <div class="formbold-mb-3">
        <div>
          <label for="state" class="formbold-form-label"> Keterangan </label>
          <input
            type="text"
            name="keterangan"
            id="keterangan"
            class="formbold-form-input" />
        </div>
      </div>

      <div class="formbold-checkbox-wrapper">
        <div class="formbold-relative">
          <input
            type="checkbox"
            id="supportCheckbox"
            class="formbold-input-checkbox" />
          <button class="formbold-btn">Kirim</button> <br> <br> <br>
          <a href="<?= base_url('/') ?>" class="button">balik ke halaman login</a>
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