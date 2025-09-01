 <h2>Daftar Siswa</h2>
    <table>
        <thead>
            <tr>
                <th>NIS</th>
                <th>Id Kelas</th>
                <th>Nama Siswa</th>
                <th>Poin Apresiasi</th>
                <th>Poin Pelanggaran</th>
                <th>Poin Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($siswa as $item)
                <tr>
                    <td>{{ $item->nis}}</td>
                    <td>{{ $item->id_kelas}}</td>
                    <td>{{ $item->nama_siswa}}</td>
                    <td>{{ $item->poin_apresiasi}}</td>
                    <td>{{ $item->poin_pelanggaran}}</td>
                    <td>{{ $item->poin_total}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>