<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Walikelas; 
use App\Models\Kelas; // Pastikan model Kelas sudah diimport
use App\Models\User; // Pastikan model Kelas sudah diimport

class WalikelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      
        $walikelas = Walikelas::all(); 
        $kelas = Kelas::all(); 
        $user = User::all(); 

        // Kirim data walikelas dan kelas ke view
        return view('wakasek.walikelas.index', compact('walikelas', 'kelas', 'user'));

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
        'nip_walikelas' => 'required',
        'nama_walikelas' => 'required',
        'id_kelas' => 'required',
    ]);

    
    // Buat walikelas baru dan simpan ID user
    // Buat user baru
    $user = User::create([
        'username' => $request->nama_walikelas,
        'email' => $request->nama_walikelas . '@gmail.com',
        'password' => bcrypt('password'), // Gantilah dengan password yang sesuai
        'role' => 3,
    ]);
    
     Walikelas::create([
        'nip_walikelas' => $request->nip_walikelas,
        'username' => $user->username,
        'nama_walikelas' => $request->nama_walikelas,
        'id_kelas' => $request->id_kelas,
    ]);

    return redirect()->route('walikelas.index')->with('success', 'Data walikelas berhasil ditambahkan');
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
    public function edit($nip_walikelas)
    {
       

    }

    /**
     * Update the specified resource in storage.
     */
public function update(Request $request, $nip_walikelas, $username)
{
 
    $request->validate([
        'nip_walikelas' => 'required|integer',
        'username' => 'required|string',
        'id_kelas' => 'required|string',
        'nama_walikelas' => 'required|string',
    ]);
  

    $walikelas = Walikelas::where('nip_walikelas', $nip_walikelas)->firstOrFail();
    $user = User::where('username', $username)->first();


    $user->update([
        'username' => $request->username,
        'email' => $request->nama_walikelas . '@gmail.com',
    ]);
    
    $walikelas->update([
        'nip_walikelas' => $request->nip_walikelas,
        'username' => $user->username, // Tetap gunakan username yang sudah ada
        'nama_walikelas' => $request->nama_walikelas,
        'id_kelas' => $request->id_kelas,
        
    ]);



    return redirect()->route('walikelas.index')->with('success', 'Data berhasil diperbarui.');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($nip_walikelas)
    {
        $walikelas = Walikelas::where('nip_walikelas', $nip_walikelas)->firstOrFail();
        
        $walikelas->delete();

        return redirect()->route('walikelas.index')->with('success', 'Data Walikelas berhasil dihapus.');
    }
}
