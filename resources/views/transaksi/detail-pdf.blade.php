<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Transaksi {{ $data->Kode }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid #333;
            padding: 5px;
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .text-left {
            text-align: left;
        }

        .header,
        .footer {
            text-align: center;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>
    <div class="header">
        <h2>Detail Transaksi</h2>
        <p>Kode: {{ $data->Kode }} | Tanggal: {{ $data->Tanggal }}</p>
    </div>

    <p><b>Kasir:</b> {{ $data->NamaKasir->name ?? '-' }} <br>
        <b>Metode Pembayaran:</b> {{ $data->MetodePembayaran ?? 'Cash' }} <br>
        <b>Status:</b> {{ ucfirst($data->status_transaksi) }}
    </p>

    <table>
        <thead>
            <tr>
                <th>Produk</th>
                <th>Qty</th>
                <th>Harga Satuan</th>
                <th>Diskon</th>
                <th>Subtotal</th>
                <th>Total Akhir</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data->detailTransaksi as $item)
                <tr>
                    <td class="text-left">{{ $item->getProduk->NamaProduk ?? '-' }}</td>
                    <td>{{ $item->Qty }}</td>
                    <td class="text-right">Rp{{ number_format($item->HargaSatuan, 0, ',', '.') }}</td>
                    <td>
                        @if ($item->Diskon > 0)
                            {{ $item->Diskon }} ({{ $item->TipeDiskon }})
                        @else
                            -
                        @endif
                    </td>
                    <td class="text-right">Rp{{ number_format($item->Subtotal, 0, ',', '.') }}</td>
                    <td class="text-right">Rp{{ number_format($item->TotalAkhir, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h4>Ringkasan Pembayaran</h4>
    <table>
        <tr>
            <td>Subtotal</td>
            <td class="text-right">Rp{{ number_format($data->Subtotal, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td>Diskon</td>
            <td class="text-right">Rp{{ number_format($data->TotalDiskon, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td>Pajak</td>
            <td class="text-right">Rp{{ number_format($data->Pajak, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td>Biaya Layanan</td>
            <td class="text-right">Rp{{ number_format($data->BiayaLayanan, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td><b>Total Akhir</b></td>
            <td class="text-right"><b>Rp{{ number_format($data->TotalAkhir, 0, ',', '.') }}</b></td>
        </tr>
        <tr>
            <td>Jumlah Bayar</td>
            <td class="text-right">Rp{{ number_format($data->JumlahBayar, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td>Kembalian</td>
            <td class="text-right">Rp{{ number_format($data->kembalian, 0, ',', '.') }}</td>
        </tr>
    </table>

    <div class="footer">
        <p>DreamsPOS - Alfin Aswar</p>
    </div>
</body>

</html>
