@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Ketua Program</h2>
    <form action="{{ route('wakasek.kaprog.update', $kp->nip_kaprog) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="nip_kaprog">NIP Kaprog</label>
            <input type="number" name="nip_kaprog" class="form-control" value="{{ $kp->nip_kaprog }}" readonly>
        </div>
        <div class="mb-3">
            <label for="nama_ketua_program">Nama Ketua Program</label>
            <input type="text" name="nama_ketua_program" class="form-control" value="{{ $kp->nama_ketua_program }}" required>
        </div>
        <div class="mb-3">
            <label for="jurusan">Jurusan</label>
            <input type="text" name="jurusan" class="form-control" value="{{ $kp->jurusan }}" required>
        </div>
        <div class="mb-3">
            <label for="id_user">User</label>
            <select name="id_user" class="form-control" required>
                <option value="">-- Pilih User --</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ $kp->id_user == $user->id ? 'selected' : '' }}>
                        {{ $user->username }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('wakasek.kaprog.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
