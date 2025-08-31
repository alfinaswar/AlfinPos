<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID Produk</th>
            <th>Nama Produk</th>
            <th>Harga Modal</th>
            <th>Harga Jual</th>
            <th>Total Terjual</th>
            <th>Total Penjualan</th>
            <th>Profit</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($grouped as $row)
            <tr>
                <td>{{ $row['IdProduk'] }}</td>
                <td>{{ $row['NamaProduk'] }}</td>
                <td>{{ number_format($row['HargaModal'], 0, ',', '.') }}</td>
                <td>{{ number_format($row['HargaJual'], 0, ',', '.') }}</td>
                <td>{{ $row['TotalQty'] }}</td>
                <td>{{ number_format($row['TotalJual'], 0, ',', '.') }}</td>
                <td>{{ number_format($row['Profit'], 0, ',', '.') }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
