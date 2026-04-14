pdfActivity.blade

<!DOCTYPE html>
<html>

<head>
    <title>Data Siswa</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f0f0f0;
        }

        h2 {
            text-align: center;
        }
    </style>
</head>

<body>
    <h2>Daftar Aktifitas</h2>
    <h2>{{ $siswa->nama_siswa }}</h2>
    <table>
        <thead>
            <tr>
                <th>NIS</th>
                <th>Kategori</th>
                <th>Aktivitas</th>
                <th>Deskripsi</th>
                <th>Poin</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($activity as $item)
                <tr>
                    <td>{{ $item->nis }}</td>
                    <td>{{ $item->kategori }}</td>
                    <td>{{ $item->activity }}</td>
                    <td>{{ $item->description }}</td>
                    <td>{{ $item->point }}</td>
                    <td>{{ $item->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
