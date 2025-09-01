<!DOCTYPE html>
<html>
<head>
    <title>Data Penghargaan</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
        th { background-color: #f0f0f0; }
        h2 { text-align: center; }
    </style>
</head>
<body>
    <h2>Daftar Penghargaan</h2>
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Tangal Penghargaan</th>
                <th>Level Penghargaan</th>            
                <th>Alasan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($penghargaan as $item)
                <tr>
                    <td>{{ $item->id_penghargaan }}</td>
                    <td>{{ $item->tanggal_penghargaan }}</td>
                    <td>{{ $item->level_penghargaan }}</td>
                    <td>{{ $item->alasan }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
    