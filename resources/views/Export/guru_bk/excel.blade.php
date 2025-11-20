  <h2>Daftar Guru Bk</h2>
    <table>
        <thead>
            <tr>
                <th>NIP</th>
                <th>Username</th>
                <th>Nama Guru Bk</th>
            </tr>
        </thead>
        <tbody>
            @foreach($guru_bk as $item)
                <tr>
                    <td>{{ $item->nip_bk}}</td>
                    <td>{{ $item->username }}</td>
                    <td>{{ $item->nama_guru_bk }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>