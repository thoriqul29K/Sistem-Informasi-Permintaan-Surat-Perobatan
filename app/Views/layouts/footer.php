<!-- footer.php -->
<!-- Modal sudah ada di list_info.php -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js">
</script>

<script>
    // Inisialisasi Bootstrap Tooltip secara umum
    $(function() {
        $('[data-toggle="tooltip"]').tooltip();
    });

    // Validasi instan saat mengetik dan saat submit
    (function() {
        'use strict';
        // Ambil form
        var form = document.getElementById('formPermintaan');

        // Cegah event submit bila ada input invalid
        form.addEventListener('submit', function(event) {
            var npInput = document.getElementById('np');
            var npValue = npInput.value.trim();

            // Cek: apakah hanya digit dan panjang <= 10?
            var regex = /^[0-9]{1,10}$/;
            if (!regex.test(npValue)) {
                // Tandai invalid, tampilkan tooltip dan umpan balik
                npInput.classList.add('is-invalid');
                npInput.focus();
                event.preventDefault();
                event.stopPropagation();
            } else {
                // Jika valid, bersihkan indikator invalid
                npInput.classList.remove('is-invalid');
            }
        }, false);

        // Cek setiap keyup pada input np agar tooltip muncul bila invalid
        document.getElementById('np').addEventListener('input', function(e) {
            var val = e.target.value;
            var regex = /^[0-9]{0,10}$/;

            if (!regex.test(val)) {
                // Jika bukan digit atau lebih dari 10, beri class invalid
                e.target.classList.add('is-invalid');
            } else {
                // Jika sesuai pola sementara (0–10 digit), hapus invalid
                e.target.classList.remove('is-invalid');
            }
        });
    })();
</script>

</body>

</html>