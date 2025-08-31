<!DOCTYPE html>
<html>
<head>
    <title>Data Walikelas</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
        th { background-color: #f0f0f0; }
        h2 { text-align: center; }
    </style>
</head>
<body>
    <h2>Daftar Walikelas</h2>
    <table>
        <thead>
            <tr>
                <th>NIP</th>
                <th>Nama Walikelas</th>
                <th>Kelas</th>
            </tr>
        </thead>
        <tbody>
            @foreach($walikelas as $item)
                <tr>
                    <td>{{ $item->nip_walikelas }}</td>
                    <td>{{ $item->username }}</td>
                    <td>{{ $item->id_kelas }}</td>
                    <td>{{ $item->nama_walikelas }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
    