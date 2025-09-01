 <h2>Daftar Ketua Program</h2>
    <table>
        <thead>
            <tr>
                <th>NIP</th>
                <th>Username</th>
                <th>Nama Ketua Program</th>
                <th>Jursan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ketua_program as $item)
                <tr>
                    <td>{{ $item->nip_kaprog }}</td>
                    <td>{{ $item->username }}</td>
                    <td>{{ $item->nama_ketua_program }}</td>
                    <td>{{ $item->jurusan }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>