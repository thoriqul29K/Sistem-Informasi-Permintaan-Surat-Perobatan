<?= $this->include('layouts/header_auth') ?>
<div class="login">
    <img src="<?= base_url('assets/img/login-bg.png') ?>" class="login__bg">
    <form action="<?= base_url('reset-password') ?>" method="POST" class="login__form">
        <h1 class="login__title">Reset Password</h1>

        <?php if (session()->getFlashdata('error')): ?>
            <p class="text-danger"><?= session()->getFlashdata('error') ?></p>
        <?php elseif (session()->getFlashdata('message')): ?>
            <p class="text-success"><?= session()->getFlashdata('message') ?></p>
        <?php endif; ?>

        <div class="login__box">
            <input type="email" name="email" placeholder="Email" required class="login__input">
            <i class="ri-mail-fill"></i>
        </div>
        <button type="submit" class="login__button">Kirim Link</button>
        <p class="login__register"><a href="<?= base_url('login') ?>">Kembali ke Login</a></p>
    </form>
</div>
</body>

</html>