<!DOCTYPE html>
<html>
<head>
    <title>Data Akumulasi</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
        th { background-color: #f0f0f0; }
        h2 { text-align: center; }
    </style>
</head>
<body>
    <h2>Daftar Akumulasi</h2>
    <table>
        <thead>
            <tr>
                <th>NIS</th>
                <th>Nama Siswa</th>
                <th>Kelas</th>
                <th>Skor Apresiasi</th>
                <th>Skor Pelanggaran</th>
                <th>Akumulasi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($akumulasi as $item)
                <tr>
                    <td>{{ $item->nis}}</td>
                    <td>{{ $item->nama_siswa}}</td>
                    <td>{{ $item->kelas->nama_kelas ?? '-' }}</td>
                    <td>{{ $item->poin_apresiasi}}</td>
                    <td>{{ $item->poin_pelanggaran}}</td>
                    <td>{{ $item->poin_total}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
    