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
