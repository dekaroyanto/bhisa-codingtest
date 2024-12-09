<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .table td,
        .table th {
            border: 1px solid #000;
        }

        .table thead th {
            text-align: center;
            vertical-align: middle;
        }

        .table tbody td {
            text-align: center;
        }

        .total-row td {
            font-weight: bold;
        }

        .signature p {
            margin: 0;
            line-height: 1.6;
        }

        .text-uppercase {
            text-transform: uppercase;
        }
    </style>
</head>

<body onload="window.print()">
    <div class="container mt-5">
        <div class="row mt-4">
            <div class="col-6">
                <h5 class="text-uppercase">PT. Bhinneka Sangkuriang Transport</h5>
                <p>Jl. Gedebage Selatan No.121A, Cisaranten Kidul, Kec. Gedebage,<br>Kota Bandung, Jawa Barat 40552</p>
            </div>
            <div class="col-6 text-end">
                <p>
                    Kepada Yth:<br>
                    <strong><?= $transaksi['nama_perusahaan'] ?></strong><br>
                    <?= $transaksi['alamat_perusahaan'] ?><br>
                    <strong>Up: <?= $transaksi['nama_up'] ?></strong>
                </p>
            </div>
        </div>
        <div class="col-6">
            <p>No. Faktur: <strong><?= $transaksi['no_faktur'] ?></strong></p>
        </div>
        <table class="table">
            <thead style="background-color:lightgray ;">
                <tr>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>Satuan</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th>Total Harga</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $totalJumlah = 0;
                $totalHarga = 0;
                $totalUnitHarga = 0;
                foreach ($detail as $d):
                    $totalJumlah += $d['jumlah'];
                    $totalUnitHarga += $d['harga'];
                    $totalHarga += $d['total_harga'];
                ?>
                    <tr>
                        <td><?= $d['kode_barang'] ?></td>
                        <td><?= $d['nama_barang'] ?></td>
                        <td><?= $d['satuan'] ?></td>
                        <td><?= $d['jumlah'] ?></td>
                        <td class="text-end"><?= number_format($d['harga'], 0, ',', '.') ?></td>
                        <td class="text-end"><?= number_format($d['total_harga'], 0, ',', '.') ?></td>
                    </tr>
                <?php endforeach; ?>
                <tr class="total-row">
                    <td colspan="3" class="text-end">TOTAL</td>
                    <td><?= $totalJumlah ?></td>
                    <td class="text-end"><?= number_format($totalUnitHarga, 0, ',', '.') ?></td>
                    <td class="text-end"><?= number_format($totalHarga, 0, ',', '.') ?></td>
                </tr>
            </tbody>
        </table>
        <div class="row mt-5">
            <div class="col-6 signature">
                <p>Purchasing</p>
                <br><br>
                <p><strong><?= $transaksi['nama_purchasing'] ?></strong></p>
            </div>
            <div class="col-6 text-end signature">
                <p>Cirebon, <?= date('d F Y', strtotime($transaksi['tanggal'])) ?></p>
                <br><br>
                <p><strong><?= $transaksi['nama_up'] ?></strong></p>
            </div>
        </div>
    </div>
</body>

</html>