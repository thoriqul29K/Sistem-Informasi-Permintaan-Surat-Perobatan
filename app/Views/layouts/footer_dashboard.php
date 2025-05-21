</div> <!-- tutup .container -->

<footer>
    <p>© 2025 PT Bukit Asam. Sistem Digital Surat Perobatan</p>
</footer>

<!-- Jika ada script khusus halaman, bisa ditempatkan sebelum penutup body -->
<?php if (isset($scripts) && is_array($scripts)): ?>
    <?php foreach ($scripts as $script): ?>
        <script src="<?= $script ?>"></script>
    <?php endforeach ?>
<?php endif ?>

</body>

</html>