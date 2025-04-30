<?php
function convertMonthToRoman($month)
{
    $romanNumerals = [
        1  => 'I',
        2  => 'II',
        3  => 'III',
        4  => 'IV',
        5  => 'V',
        6  => 'VI',
        7  => 'VII',
        8  => 'VIII',
        9  => 'IX',
        10 => 'X',
        11 => 'XI',
        12 => 'XII'
    ];
    return $romanNumerals[$month] ?? $month;
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Surat Perobatan</title>
    <style>
        /* Untuk mencetak dokumen di 1 lembar A4, kita atur margin dokumen, ukuran font, dan jarak spasi dengan teliti */
        @page {
            size: A4;
            margin: 1.5cm;
            /* margin cetak */
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            /* menggunakan @page untuk margin */
            font-size: 10pt;
            /* ukuran font lebih kecil */
            line-height: 1.3;
            /* jarak baris */
            color: #000;
        }

        .header {
            text-align: center;
            margin-bottom: 10mm;
        }

        .header h1 {
            margin: 0;
            font-size: 12pt;
        }

        .content {
            margin-bottom: 10mm;
            text-align: justify;
        }

        .content p {
            margin: 3px 0;
            /* jarak antar paragraf */
        }

        .field {
            display: flex;
            margin: 2px 0;
        }

        .field .label {
            width: 35mm;
            /* mengatur lebar label untuk memastikan titik dua sejajar */
            display: inline-block;
        }

        .list {
            margin-left: 10mm;
        }

        .list p {
            margin: 2px 0;
        }

        .footer {
            margin-top: 10mm;
            text-align: center;
            font-size: 9pt;
        }

        .signature {
            margin-top: 15mm;
            text-align: right;
            font-size: 10pt;
        }

        hr {
            border: 0;
            border-top: 1px solid #000;
            margin: 4mm 0;
        }

        ol.list {
            counter-reset: item;
            padding-left: 0;
            margin: 0;
        }

        ol.list li {
            counter-increment: item;
            list-style: none;
            position: relative;
            margin-bottom: 2px;
            padding-left: 18px;
            text-align: justify;
            text-indent: 0;
        }

        ol.list li::before {
            content: counter(item) ".";
            position: absolute;
            left: 0;
            width: 14px;
        }
    </style>
</head>

<body>
    <div class="header" style="text-align: right;">
        <img src="<?= esc($logoDataUri) ?>" alt="Logo Bukit Asam" style="width:200px;">
        <p>Palembang, <?= date('d-m-Y') ?></p>
    </div>

    <div class="content">
        <div class="field">
            <span class="label"><strong>Nomor</strong></span>: B/<?= $info['id'] ?>/25601/LK.05.01/<?= convertMonthToRoman(date('n')) ?>/2025
        </div>
        <div class="field">
            <span class="label"><strong>Sifat</strong></span>: Biasa
        </div>
        <div class="field">
            <span class="label"><strong>Lampiran</strong></span>: ----
        </div>
        <div class="field">
            <span class="label"><strong>Perihal</strong></span>: <strong><i>Jaminan Biaya Perawatan / Pengobatan</i></strong>
        </div>
        <div class="field">
            <span class="label"></span> <strong>An. <?= esc($info['nama_lengkap']) ?></strong>
        </div>
        <hr>
        <p>Yang Terhormat,</p>
        <p>Direktur Rumah Sakit <?= esc($info['rumah_sakit_dituju']) ?></p>
        <p>Jl. POM IX</p>
        <p>di-</p>
        <p>Palembang</p>
        <br>
        <p>Yang bertanda tangan dibawah ini, AVP SDM, Umum, Keuangan dan CSR PTBA, Tbk Unit Dermaga Kertapati Palembang menerangkan bahwa:</p>

        <div class="field">
            <span class="label">Nama</span>: <?= esc($info['nama_lengkap']) ?>
        </div>
        <div class="field">
            <span class="label">Umur / JK</span>: <?= esc($info['umur']) ?> Tahun / <?= esc($info['jenis_kelamin']) ?>
        </div>
        <div class="field">
            <span class="label">Keluarga / NP</span>: <?= esc($info['nama_keluarga']) ?> / <?= esc($info['np']) ?>
        </div>
        <div class="field">
            <span class="label">Jabatan</span>: <?= esc($info['jenjang_jabatan']) ?>
        </div>

        <br>
        <p>Adalah Keluarga Pegawai <b><i>PT Bukit Asam, Tbk Unit Dermaga Kertapati</i></b> yang kiranya kepada yang bersangkutan dapat diberikan pemeriksaan tindakan perawatan/pengobatan dengan fasilitas pemeriksaan <b>rawat jalan</b>.</p>
        <p>Selanjutnya, biaya yang timbul menjadi beban PT Bukit Asam, Tbk. Mohon ditagihkan kepada kami dengan melampirkan surat jaminan ini.</p>
        <p>Dengan ketentuan:</p>
        <ol class="list">
            <li>Pengobatan harus berjenjang dari <b>Dokter Umum/Dokter Gigi Umum/PPK I</b>, baru ke Spesialis (kecuali Sp Anak, Sp Kandungan, Sp Mata).</li>
            <li>Surat Jaminan ini hanya berlaku di RS yang ada perjanjian kerjasama dengan PT Bukit Asam, Tbk.</li>
            <li>Surat jaminan ini hanya <b><i>dipergunakan untuk pembayaran selisih</i></b> bila biaya perawatan pasien melebihi budget maksimal BPJS. Selisih biaya seperti jasa dokter, kamar, dan obat-obatan dapat ditagihkan ke PT Bukit Asam, Tbk.</li>
            <li>Bila tidak dapat dicover oleh BPJS, maka dapat ditagihkan secara penuh.</li>
            <li>Beban Biaya: 43291</li>
            <li>Ybs. diwajibkan menandatangani Nota Biaya Perawatan.</li>
            <li>Surat Jaminan ini berlaku 3 (tiga) hari <b><i>sejak ditandatangani</i></b>.</li>
            <li>Jika pasien dirujuk ke dokter lain pada RS yang sama, dapat menggunakan <b><i>Surat Jaminan Pertama</i></b> dengan batas waktu 3 hari sejak ditandatangani.</li>
            <li>Surat Jaminan ini harus dilampirkan pada invoice/tagihan biaya rawat jalan/inap dan tidak dapat dicopy untuk penagihan atau dijadikan alat pembayaran.</li>
        </ol>
        <br>
        <p>Demikian disampaikan. Atas perhatian dan kerjasamanya, diucapkan terima kasih.</p>
    </div>

    <div class="signature">
        <p>AVP SDM, Umum, Keuangan dan CSR,</p>
        <br><br>
        <p><b>Yulian Sudarmawan</b></p>
    </div>

    <div class="footer">
        <p>PT. Bukit Asam Tbk. Unit Dermaga Kertapati | JL Stasiun Kereta Api, Kertapati, Kec. Kertapati, Kota Palembang, Sumatera Selatan 30142</p>
    </div>
</body>

</html>