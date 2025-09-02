<table>
    <thead>
        <tr>
            <th rowspan="2">No</th>
            <th rowspan="2">Item</th>
            <th rowspan="2">Harga Modal</th>
            <th rowspan="2">Harga Jual</th>
            @foreach ($tanggalList as $tgl)
                <th colspan="3">{{ $tgl }}</th>
            @endforeach
        </tr>
        <tr>
            @foreach ($tanggalList as $tgl)
                <th>Qty</th>
                <th>Total</th>
                <th>Profit</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach ($transaksi as $key => $row)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $row['Nama'] }}</td>
                <td>{{ number_format($row['HargaModal'], 0, ',', '.') }}</td>
                <td>{{ number_format($row['HargaJual'], 0, ',', '.') }}</td>
                @foreach ($tanggalList as $tgl)
                    @php
                        $hari = $row['Hari'][$tgl] ?? ['QtyPenjualan' => 0, 'Total' => 0, 'Profit' => 0];
                    @endphp
                    <td>{{ $hari['QtyPenjualan'] }}</td>
                    <td>{{ number_format($hari['Total'], 0, ',', '.') }}</td>
                    <td>{{ number_format($hari['Profit'], 0, ',', '.') }}</td>
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>