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
    return isset($romanNumerals[$month]) ? $romanNumerals[$month] : $month;
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Surat Perobatan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            line-height: 1;
        }

        .header {
            text-align: center;
            margin-bottom: 40px;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
        }

        .content {
            margin-bottom: 30px;
        }

        .content p {
            margin: 3px 0;
        }

        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 14px;
        }

        .signature {
            margin-top: 50px;
            text-align: right;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>Surat Perobatan</h1>
        <p>PT. Bukit Asam Tbk. Unit Dermaga Kertapati</p>
    </div>

    <div class="content">
        <p><strong>Nomor:</strong> B/<?= $info['id'] ?>/25601/LK.05.01/<?= convertMonthToRoman(date('n')) ?>/2025</p>
        <p><strong>Sifat:</strong> Biasa</p>
        <p><strong>Lampiran:</strong> ----</p>
        <p><strong>Perihal:</strong> <strong><i>Jaminan Biaya Perawatan / Pengobatan <br>An. </span><?= esc($info['nama_lengkap']) ?> </i></strong></p>
        <p><strong>Tanggal:</strong> <?= date('d-m-Y') ?></p>
        <hr>
        <p>Yang Terhormat,</p>
        <p> Direktur Rumah Sakit <?= esc($info['rumah_sakit_dituju']) ?></p>
        <p>Jl. POM IX</p>
        <p>di-</p>
        <p>Palembang</p>
        <p><br>Yang bertanda tangan dibawah ini, AVP SDM, Umum, Keuangan dan CSR PTBA, Tbk Unit Dermaga Kertapati Palembang Menerangkan bahwa:
        </p>
        <p>Nama: <?= esc($info['nama_lengkap']) ?></p>
        <p>Umur/Jenis Kelamin: <?= esc($info['umur']) ?> Tahun/<?= esc($info['jenis_kelamin']) ?></p>
        <p>Nama Keluarga/NP: <?= esc($info['nama_keluarga']) ?>/<?= esc($info['np']) ?></p>
        <p>Jenjang Jabatan: <?= esc($info['jenjang_jabatan']) ?></p>
        <br>
        <p>Adalah Keluarga Pegawai <i><b> PT Bukit Asam, Tbk Unit Dermaga Kertapati</b></i> kiranya kepada yang bersangkutan dapat diberikan Pemeriksaan tindakan Perawatan/ Pengobatan dengan fasilitas Pemeriksaan <b> Rawat jalan.</b></p>
        <p>Selanjutnya biaya yang timbul menjadi beban PT Bukit Asam, Tbk. Dan mohon ditagihkan kepada kami dengan melampirkan Surat Jaminan ini.</p>
        <p>Dengan ketentuan:</p>
        <p>1. Pengobatan harus berjenjang dari <b>Dokter Umum/Dokter Gigi Umum/PPK I, baru ke Spesialis</b> kecuali Sp Anak, Sp Kandungan, Sp Mata</p>
        <p>2. Surat Jaminan ini hanya berlaku di Rumah Sakit yang ada perjanjian kerjasama dengan PT Bukit Asalm, Tbk</p>
        <p>3. Surat jaminan ini hanya <b><i>dipergunakan untuk pembayaran selisih,</i></b> bila biaya perawatan pasien melebihi budget maksimal yang sudah ditentukan oleh kantor BPJS Provider Prabumulih dan selisih biaya perawatan seperti jasa dokter, kamar dan obat-obatan dapat ditagihkan ke Perusahaan PT. Bukit Asam Tbk, Unit Dermaga Kertapati Palembang</p>
        <p>4. Bila tidak bisa dicover oleh BPJS maka dapat ditagihkan secara penuh</p>
        <p>5. Beban Biaya: </p>
        <p>6. Ybs. Diwajibkan menandatangani Nota Biaya Perawatan</p>
        <p>7. Surat Jaminan ini berlaku 3 (tiga) hari <i><b>sejak ditanda tangani</b></i></p>
        <p>8. Jika Pasien di rujuk ke dokter lain pada rumah sakit yang sama dapat menggunakan <i><b>Surat Jaminan Pertama dan batas waktu 3 (tiga) hari sejak ditanda tangani</b></i></p>
        <p>9. Surat Jaminan ini harus dilampirkan pada invoice/ tagihan biaya rawat jalan/inap dan surat jaminan tidak dapat di copy untuk menagih atau alat pembayaran</p>
        <br>
        <p>Demikian disampaikan, atas perhatian kerjasamanya diucapkan terima kasih</p>
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