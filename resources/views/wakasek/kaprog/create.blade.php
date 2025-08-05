@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tambah Ketua Program</h2>
<form action="{{ route('wakasek.kaprog.store') }}" method="POST">
    @csrf

    <label for="nip_kaprog">NIP Kaprog:</label>
    <input type="text" name="nip_kaprog" required>

    <label for="nama_ketua_program">Nama:</label>
    <input type="text" name="nama_ketua_program" required>

    <label for="jurusan">Jurusan:</label>
    <input type="text" name="jurusan" required>

    <label for="username">Username:</label>
    <input type="text" name="username" required>

    <button type="submit">Simpan</button>
</form>

</div>
@endsection
