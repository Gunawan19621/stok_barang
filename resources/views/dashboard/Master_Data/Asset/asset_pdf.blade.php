<!DOCTYPE html>
<html>

<head>
    <style>
        #customers {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #customers td,
        #customers th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #customers tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #customers tr:hover {
            background-color: #ddd;
        }

        #customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #4aa2dd;
            color: white;
        }
    </style>
</head>

<body>

    {{-- <h1>Laporan Keuangan</h1> --}}
    <h1 class="text-gray-800">Tabel Asset</h1>
    <div class="mb-3">
        <p>Our Item Tables are enhanced with the help of the DataTables plugin. This is a powerful tool that allows you
            to explore return data in a more interactive and efficient way</p>
    </div>
    <table id="customers">
        <thead>
            <tr>
                <th>No. Seri</th>
                <th>Nama</th>
                <th>Deskripsi</th>
                <th>Gudang</th>
                <th>Tanggal</th>
                <th>QR</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($asset as $data)
                <tr>
                    <td>{{ $data->seri }}</td>
                    <td>{{ $data->name }}</td>
                    <td>{{ $data->description }}</td>
                    <td>{{ $data->warehouse->name }}</td>
                    <td>{{ \Carbon\Carbon::parse($data->date)->format('d-m-Y') }}</td>
                    <td>{{ $data->qr_count }}</td>
                </tr>
            @empty
                <p>Data Kosong</p>
            @endforelse
        </tbody>
        <tfoot>
            <tr>
                <th>No. Seri</th>
                <th>Nama</th>
                <th>Deskripsi</th>
                <th>Gudang</th>
                <th>Tanggal</th>
                <th>QR</th>
            </tr>
        </tfoot>

    </table>

</body>

</html>
