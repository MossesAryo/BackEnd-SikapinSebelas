<!DOCTYPE html>
<html>

<head>
    <title>Export PDF - Skoring Pelanggaran</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 6px;
            text-align: left;
        }

        th {
            background: #f2f2f2;
        }

        h2 {
            text-align: center;
        }
    </style>
</head>

<body>
    <h2>Daftar Skoring Pelanggaran</h2>
    <table>
        <thead>
            <tr>
                <th>NIS</th>
                <th>Nama Siswa</th>
                <th>Tanggal</th>
                <th>Jenis Pelanggaran</th>
                <th>Skor</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <td>{{ $item->siswa->nis ?? '-' }}</td>
                    <td>{{ $item->siswa->nama_siswa ?? '-' }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->tanggal_pelanggaran)->format('Y-m-d') }}</td>
                    <td>{{ $item->aspek_penilaian->jenis_poin ?? '-' }}</td>
                    <td>{{ $item->aspek_penilaian->indikator_poin ?? 0 }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
