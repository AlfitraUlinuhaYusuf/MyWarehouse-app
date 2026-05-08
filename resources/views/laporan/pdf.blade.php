<!DOCTYPE html>
<html>
<head>
    <title>Laporan Bulanan MyWarehouse</title>
    <style>
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid black; padding: 8px; text-align: left; }
        h2 { text-align: center; }
    </style>
    </title>
</head>
<body>
    <h2>Laporan Transaksi MyWarehouse</h2>
    <p>Periode: {{ Carbon\Carbon::now()->subMonth()->format('d M Y') }} - {{ Carbon\Carbon::now()->format('d M Y') }}</p>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Jenis</th>
                <th>Produk</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @foreach($laporan as $row)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $row->created_at->format('d/m/Y') }}</td>
                <td>{{ ucfirst($row->jenis) }}</td>
                <td>{{ $row->produk->nama_produk }}</td>
                <td>{{ $row->jumlah }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>