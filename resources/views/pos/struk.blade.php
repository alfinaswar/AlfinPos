<!DOCTYPE html>
<html>

<head>
    <title>Struk Belanja</title>
    <style>
        body {
            font-family: monospace;
            font-size: 12px;
            width: 58mm;
            /* lebar struk 58mm */
            margin: 0;
            padding: 0;
        }

        .center {
            text-align: center;
        }

        .line {
            border-top: 1px dashed #000;
            margin: 5px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            font-size: 12px;
            padding: 2px 0;
        }

        .right {
            text-align: right;
        }

        .left {
            text-align: left;
        }
    </style>
</head>

<body onload="window.print()">
    <div class="center">
        <strong>Toko XYZ</strong><br>
        Jl. Contoh No.123<br>
        08xx-xxxx-xxxx
    </div>

    <div class="line"></div>

    <p>
        No: {{ $transaksi->Kode }} <br>
        Tgl: {{ $transaksi->created_at->format('d-m-Y H:i') }} <br>
        Kasir: {{ $transaksi->kasir->name ?? '-' }}
    </p>

    <div class="line"></div>

    <table>
        @foreach ($transaksi->detailTransaksi as $d)
            <tr>
                <td colspan="3">{{ $d->getProduk->Nama }}</td>
            </tr>
            <tr>
                <td class="left">{{ $d->Qty }} x {{ number_format($d->HargaSatuan, 0, ',', '.') }}</td>
                <td></td>
                <td class="right">{{ number_format($d->Subtotal, 0, ',', '.') }}</td>
            </tr>
        @endforeach
    </table>

    <div class="line"></div>

    <table>
        <tr>
            <td class="left">Total</td>
            <td class="right">Rp {{ number_format($transaksi->TotalAkhir, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td class="left">Bayar</td>
            <td class="right">Rp {{ number_format($transaksi->JumlahBayar, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td class="left">Kembali</td>
            <td class="right">Rp {{ number_format($transaksi->Kembalian, 0, ',', '.') }}</td>
        </tr>
    </table>

    <div class="line"></div>

    <div class="center">
        <p>Terima kasih 🙏<br>Belanja di Toko XYZ</p>
    </div>
</body>

</html>
