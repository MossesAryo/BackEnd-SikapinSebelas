<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\guru_bk;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class Guru_bkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('wakasek.guru_bk.index', [
            'guru_bk' => guru_bk::get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nip_bk' => 'required',
            'username' => 'required',
            'nama_guru_bk' => 'required',
        ]);

        $user = User::create([
            'username' => $request->username,
            'email' => strtolower(Str::slug($request->username)) . '@gmail.com',
            'password' => bcrypt('password'),
            'role' => 2
        ]);

        guru_bk::create([
            'nip_bk' => $request->nip_bk,
            'username' => $request->username,
            'nama_guru_bk' => $request->nama_guru_bk,
        ]);

        return redirect()->route('gurubk.index')->with('success', 'Guru BK berhasil ditambahkan');
    }

    public function update(Request $request, $nip_bk)
    {
        $request->validate([
            'nip_bk' => 'required',
            'username' => 'required',
            'nama_guru_bk' => 'required',
        ]);

        $bk = guru_bk::where('nip_bk', $nip_bk)->firstOrFail();


        User::where('username', $bk->username)->update([
            'username' => $request->username
        ]); 

        $bk->update([
            'nip_bk' => $request->nip_bk,
            'username' => $request->username,
            'nama_guru_bk' => $request->nama_guru_bk,
        ]);

        return redirect()->route('gurubk.index')->with('success', 'Data berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = guru_bk::find($id)->delete();

        return redirect()->route('gurubk.index')->with('success', 'Guru BK berhasil dihapus');
    }
}
