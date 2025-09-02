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
        @foreach ($akumulasi as $item)
            <tr>
                <td>{{ $item->nis }}</td>
                <td>{{ $item->nama_siswa }}</td>
                <td>{{ $item->kelas->nama_kelas ?? '-' }}</td>
                <td>{{ $item->poin_apresiasi }}</td>
                <td>{{ $item->poin_pelanggaran }}</td>
                <td>{{ $item->poin_total }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
