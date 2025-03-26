<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Surat Perobatan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            line-height: 1.5;
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
            margin: 5px 0;
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
        <p><strong>Nomor Surat:</strong> <?= date('Y') ?>/<?= $info['id'] ?></p>
        <p><strong>Tanggal:</strong> <?= date('d-m-Y') ?></p>
        <hr>
        <p>Kepada Yth,</p>
        <p>Nama: <?= esc($info['nama_lengkap']) ?></p>
        <p>Email: <?= esc($info['email']) ?></p>
        <p>NIK: <?= esc($info['nik']) ?></p>
        <p>Alamat: <?= esc($info['alamat']) ?></p>
        <p>Keterangan: <?= esc($info['keterangan']) ?></p>
        <br>
        <p>Dengan ini dinyatakan bahwa permintaan surat perobatan telah <strong>disetujui</strong> oleh pihak manajemen. Silakan membawa surat ini sebagai bukti verifikasi untuk keperluan medis.</p>
    </div>

    <div class="signature">
        <p>Hormat kami,</p>
        <br><br>
        <p>( <?= esc(session()->get('nama')) ?> )</p>
    </div>

    <div class="footer">
        <p>PT. Bukit Asam Tbk. Unit Dermaga Kertapati | JL Stasiun Kereta Api, Kertapati, Kec. Kertapati, Kota Palembang, Sumatera Selatan 30142</p>
    </div>
</body>

</html>