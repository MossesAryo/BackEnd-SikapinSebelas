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
    <h2>Daftar Guru Bk</h2>
    <table>
        <thead>
            <tr>
                <th>NIP</th>
                <th>Username</th>
                <th>Nama Guru Bk</th>
            </tr>
        </thead>
        <tbody>
            @foreach($guru_bk as $item)
                <tr>
                    <td>{{ $item->nip_bk}}</td>
                    <td>{{ $item->username }}</td>
                    <td>{{ $item->nama_guru_bk }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
    