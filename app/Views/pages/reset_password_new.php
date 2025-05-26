<?= $this->include('layouts/header_auth') ?>
<div class="login">
    <img src="<?= base_url('assets/img/login-bg.png') ?>" class="login__bg">
    <form action="<?= base_url('reset-password/' . $token) ?>" method="POST" class="login__form">
        <h1 class="login__title">Password Baru</h1>

        <?php if (isset($validation)): ?>
            <div class="text-danger"><?= $validation->listErrors() ?></div>
        <?php endif; ?>

        <div class="login__box">
            <input type="password" name="password" placeholder="Password baru" required class="login__input">
            <i class="ri-lock-2-fill"></i>
        </div>
        <div class="login__box">
            <input type="password" name="password_confirm" placeholder="Konfirmasi password" required class="login__input">
            <i class="ri-lock-2-fill"></i>
        </div>
        <button type="submit" class="login__button">Reset Password</button>
        <p class="login__register"><a href="<?= base_url('login') ?>">Kembali ke Login</a></p>
    </form>
</div>
</body>

</html>