    <h2>Daftar Walikelas</h2>
    <table>
        <thead>
            <tr>
                <th>NIP</th>
                <th>Nama Walikelas</th>
                <th>Kelas</th>
            </tr>
        </thead>
        <tbody>
            @foreach($walikelas as $item)
                <tr>
                    <td>{{ $item->nip_walikelas }}</td>
                    <td>{{ $item->username }}</td>
                    <td>{{ $item->id_kelas }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>