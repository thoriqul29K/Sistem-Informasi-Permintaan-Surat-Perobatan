<?php

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

if (! empty($info['qr_token'])) {
    $url    = base_url("ruler/sign/{$info['id']}/{$info['qr_token']}");
    $qrCode = QrCode::create($url)
        ->setSize(150)
        ->setMargin(10);

    $writer = new PngWriter();
    $result = $writer->write($qrCode);

    // sisipkan sebagai data-uri
    $qrImage = $result->getDataUri();
}

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
            margin-top: 1.2cm;
            /* naikkan margin atas */
            margin-bottom: 0.5cm;
            /* naikkan margin bawah */
            margin-left: 1.5cm;
            margin-right: 1.5cm;
            /* margin cetak */
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            /* menggunakan @page untuk margin */
            font-size: 10pt;
            line-height: 1;
            color: #000;
        }

        .header {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            margin-bottom: 10mm;
        }

        .header-logo {
            margin: 0;
        }

        .header-date {
            position: relative;
            left: -27px;
            /* geser 10px ke kiri */
            margin: 2mm 0 6mm;
            font-size: 10pt;
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
        <img src="<?= esc($logoDataUri) ?>" alt="Logo Bukit Asam" class="header-logo" width="180px">
        <p class="header-date">
            Palembang, <?= date('j') . ' ' . ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'][date('n') - 1] . ' ' . date('Y') ?>
        </p>
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
            <span class="label"></span> <strong>An. <?= esc($info['nama_lengkap']) ?> Keluarga <?= esc($info['nama_keluarga']) ?> (NP. <?= esc($info['np']) ?>) </strong>
        </div>
        <hr>
        <p>Yang Terhormat,</p>
        <p>Direktur Rumah Sakit <?= esc($info['nama_rs']   ?? '-') ?>
        </p>
        <?php if (! empty($info['jalan_rs'])): ?>
            <p><?= esc($info['jalan_rs']) ?></p>
        <?php endif; ?>

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
        <p>AVP SDM, Umum, Keuangan dan CSR</p>
        <br>
        <!-- Tampilkan QR sebagai gambar inline -->
        <img src="<?= $qrImage ?>" alt="QR Code Tanda Tangan" height="100px" width="auto">
        <br>
        <p><b>Yulian Sudarmawan</b></p>
    </div>

    <div class="footer">
        <p>PT. Bukit Asam Tbk. Unit Dermaga Kertapati | JL Stasiun Kereta Api, Kertapati, Kec. Kertapati, Kota Palembang, Sumatera Selatan 30142</p>
    </div>
</body>

</html>