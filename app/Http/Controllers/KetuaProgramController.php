<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ketua_program;
use Illuminate\Routing\Controller;

class KetuaProgramController extends Controller
{
    public function index()
    {
        $data = ketua_program::with('user')->get();
        return view('wakasek.kaprog.index', compact('data'));
    }

    public function create()
    {
        $users = User::all();
        return view('wakasek.kaprog.create', compact('users'));
    }

   public function store(Request $request)
{
    $request->validate([
        'nip_kaprog' => 'required|unique:ketua_programs,nip_kaprog',
        'nama_ketua_program' => 'required|string|max:255',
        'jurusan' => 'required|string|max:255',
        'username' => 'required|string|max:255|unique:users,username',
    ]);

    // Buat user baru
    $user = User::create([
        'username' => $request->username,
        'email' => strtolower(Str::slug($request->username)) . '@gmail.com',
        'password' => bcrypt('password'), // default password
        'role' => 3, // asumsi 3 itu untuk kaprog
    ]);

    // Buat ketua program
    ketua_program::create([
        'nip_kaprog' => $request->nip_kaprog,
        'nama_ketua_program' => $request->nama_ketua_program,
        'jurusan' => $request->jurusan,
        'id_user' => $user->id,
    ]);

    return redirect()->route('wakasek.kaprog.index')->with('success', 'Data Ketua Program berhasil disimpan.');
}




    public function edit($nip_kaprog)
    {
        $kp = ketua_program::where('nip_kaprog', $nip_kaprog)->firstOrFail();
        $users = User::all();
        return view('wakasek.kaprog.edit', compact('kp', 'users'));
    }

    public function update(Request $request, $nip_kaprog)
    {
        $request->validate([
            'nama_ketua_program' => 'required|string|max:255',
            'jurusan' => 'required|string|max:255',
            'id_user' => 'required|exists:users,id',
        ]);

        $kp = ketua_program::where('nip_kaprog', $nip_kaprog)->firstOrFail();
        $kp->update([
            'nama_ketua_program' => $request->nama_ketua_program,
            'jurusan' => $request->jurusan,
            'id_user' => $request->id_user,
        ]);

        return redirect()->route('wakasek.kaprog.index')->with('success', 'Data Ketua Program berhasil diupdate.');
    }

    public function destroy($nip_kaprog)
    {
        $kp = ketua_program::where('nip_kaprog', $nip_kaprog)->firstOrFail();
        $kp->delete();

        return redirect()->route('wakasek.kaprog.index')->with('success', 'Data Ketua Program berhasil dihapus.');
    }
}
