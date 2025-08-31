<!DOCTYPE html>
<html>
<head>
    <title>Data Peringatan</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
        th { background-color: #f0f0f0; }
        h2 { text-align: center; }
    </style>
</head>
<body>
    <h2>Daftar Peringatan</h2>
    <table>
        <thead>
            <tr>
                <th>Kode</th>
                <th>Tanggal Surat Peringatan</th>
                <th>Level Surat Peringatan</th>
                <th>Level Surat Peringatan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($peringatan as $item)
                <tr>
                    <td>{{ $item->id_sp}}</td>
                    <td>{{ $item->tanggal_sp}}</td>
                    <td>{{ $item->level_sp}}</td>
                    <td>{{ $item->alasan}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
    