  <h2>Daftar Penghargaan</h2>
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Tangal Penghargaan</th>
                <th>Level Penghargaan</th>            
                <th>Alasan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($penghargaan as $item)
                <tr>
                    <td>{{ $item->id_penghargaan }}</td>
                    <td>{{ $item->tanggal_penghargaan }}</td>
                    <td>{{ $item->level_penghargaan }}</td>
                    <td>{{ $item->alasan }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>