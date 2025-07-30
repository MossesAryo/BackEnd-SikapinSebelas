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
        return view('wakasek.guru_bk.guru_bk', [
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
            'role' => 4
        ]);

        guru_bk::create([
            'nip_bk' => $request->nip_bk,
            'username' => $request->username,
            'nama_guru_bk' => $request->nama_guru_bk,
        ]);

        return redirect()->route('gurubk.index')->with('success', 'Guru BK berhasil ditambahkan');
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'nip_bk' => 'required',
            'username' => 'required',
            'nama_guru_bk' => 'required',
        ]);

        guru_bk::find($id)->update($data);
        return redirect()->route('gurubk')->with('success', 'Guru BK berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = guru_bk::find($id)->delete();

        return redirect()->route('gurubk')->with('success', 'Guru BK berhasil dihapus');
    }
}
