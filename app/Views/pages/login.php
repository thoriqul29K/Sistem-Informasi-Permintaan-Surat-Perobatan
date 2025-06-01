<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <!-- REMIXICONS -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.css" crossorigin="">
   <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" />
   <!-- CSS -->
   <link rel="stylesheet" href="<?= base_url('assets/css/styles.css') ?>">
   <title>Login | PTBA</title>
</head>

<body>
   <div class="login">
      <img src="<?= base_url('assets/img/login-bg.png') ?>" alt="image" class="login__bg">
      <form action="<?= base_url('login') ?>" method="POST" class="login__form">
         <div>
            <a href="<?= base_url('/') ?>" style="color: #5f0d57; background-color:white;" class="back-btn btn btn-secondary btn-sm">← Kembali</a>
         </div>
         <h1 class="login__title">Masuk</h1>
         <div class="login__inputs">
            <div class="login__box">
               <input type="email" name="email" placeholder="Email" required class="login__input">
               <i class="ri-mail-fill"></i>
            </div>
            <div class="login__box">
               <input type="password" name="password" placeholder="Password" required class="login__input">
               <i class="ri-lock-2-fill"></i>
            </div>
         </div>
         <div class="login__check">
            <div class="login__check-box">
               <input type="checkbox" name="remember" class="login__check-input" id="user-check">
               <label for="user-check" class="login__check-label">Ingat saya</label>
            </div>
            <a href="<?= base_url('/reset-password') ?>" class="login__forgot">Reset Password?</a>
         </div>
         <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger">
               <?= session()->getFlashdata('error') ?>
            </div>
         <?php endif; ?>
         <?php if (session()->getFlashdata('message')): ?>
            <div class="alert alert-message">
               <?= session()->getFlashdata('message') ?>
            </div>
         <?php endif; ?>
         <button type="submit" class="login__button">Masuk</button>
      </form>
   </div>
</body>

</html>