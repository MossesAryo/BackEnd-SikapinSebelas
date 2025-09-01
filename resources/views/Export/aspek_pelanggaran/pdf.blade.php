<!DOCTYPE html>
<html>
<head>
    <title>Data Aspek Pelanggaran</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
        th { background-color: #f0f0f0; }
        h2 { text-align: center; }
    </style>
</head>
<body>
    <h2>Daftar Aspek Pelanggaran</h2>
    <table>
        <thead>
            <tr>
                <th>Kode</th>
                <th>Jenis Poin</th>
                <th>Kategori</th>
                <th>Uraian</th>
                <th>Poin</th>
            </tr>
        </thead>
        <tbody>
            @foreach($aspek_penilaian as $item)
                <tr>
                    <td>{{ $item->id_aspekpenilaian }}</td>
                    <td>{{ $item->jenis_poin }}</td>
                    <td>{{ $item->kategori }}</td>
                    <td>{{ $item->uraian }}</td>
                    <td>{{ $item->indikator_poin }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
    