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
            @foreach($surat_peringatan as $item)
                <tr>
                    <td>{{ $item->id_sp}}</td>
                    <td>{{ $item->tanggal_sp}}</td>
                    <td>{{ $item->level_sp}}</td>
                    <td>{{ $item->alasan}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>