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
                    <td>{{ $item->pelanggaran_ke }}</td>
                    <td>{{ $item->kategori }}</td>
                    <td>{{ $item->uraian }}</td>
                    <td>{{ $item->indikator_poin }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>