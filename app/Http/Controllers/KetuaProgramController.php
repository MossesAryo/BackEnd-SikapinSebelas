<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ketua_program;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Routing\Controller;

class KetuaProgramController extends Controller
{
    public function index()
    {
      return view('wakasek.kaprog.index', [
            'ketua_program' => ketua_program::get(),
        ]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'nip_kaprog' => 'required|unique:ketua_program,nip_kaprog',
            'nama_ketua_program' => 'required|string|max:255',
            'jurusan' => 'required|string|max:255',
        ]);


        $user = User::create([
            'username' => $request->nama_ketua_program,
            'email' => strtolower(Str::slug($request->nama_ketua_program)) . '@gmail.com',
            'password' => bcrypt('password'),
            'role' => 4,
        ]);


        ketua_program::create([
            'nip_kaprog' => $request->nip_kaprog,
            'nama_ketua_program' => $request->nama_ketua_program,
            'jurusan' => $request->jurusan,
            'username' => $user->username,
        ]);

        return redirect()->route('kaprog.index')->with('success', 'Data Ketua Program berhasil disimpan.');
    }




    public function edit($nip_kaprog,)
    {
        $kp = ketua_program::where('nip_kaprog', $nip_kaprog)->firstOrFail();
        $users = User::all();
        return view('wakasek.kaprog.edit', compact('kp', 'users'));
    }

    public function update(Request $request, $nip_kaprog, $username)
    {

        $request->validate([
            'nip_kaprog' => 'required|unique:ketua_program,nip_kaprog,' . $nip_kaprog . ',nip_kaprog',
            'nama_ketua_program' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'jurusan' => 'required|string|max:255',
        ]);


        $kp = ketua_program::where('nip_kaprog', $nip_kaprog)->firstOrFail();


        User::where('username', $username)->update([
            'username' => $request->username
        ]);

        $kp->update([
            'nip_kaprog' => $request->nip_kaprog,
            'nama_ketua_program' => $request->nama_ketua_program,
            'jurusan' => $request->jurusan,
            'username' => $request->username
        ]);

        return redirect()->route('kaprog.index')->with('success', 'Data berhasil diperbarui.');
    }


    public function destroy($nip_kaprog)
    {
        $kp = ketua_program::where('nip_kaprog', $nip_kaprog)->firstOrFail();
        User::where('username', $kp->username)->delete();

        $kp->delete();

        return redirect()->route('kaprog.index')->with('success', 'Data Ketua Program berhasil dihapus.');
    }
}
