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
        if (request()->ajax()) {
            $query = ketua_program::with('user')->latest();

            // Handle search
            if ($search = request('search.value')) {
                $query->where(function ($q) use ($search) {
                    $q->where('nip', 'like', "%{$search}%")
                      ->orWhere('nama_ketua_program', 'like', "%{$search}%")
                      ->orWhereHas('user', function ($q2) use ($search) {
                          $q2->where('email', 'like', "%{$search}%");
                      });
                });
            }

            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('nip', fn($kaprog) => $kaprog->nip)
                ->addColumn('nama_ketua_program', fn($kaprog) => $kaprog->nama_ketua_program)
                ->addColumn('email', fn($kaprog) => $kaprog->user->email ?? '-')
                ->addColumn('jurusan', fn($kaprog) => $kaprog->jurusan)
                ->addColumn('aksi', function ($kaprog) {
                    return '
                        <div class="flex justify-center space-x-2">
                            <button class="text-blue-600 hover:text-blue-900" title="Edit"
                                onclick="openEditModal(\'' . $kaprog->nip . '\', \'' . e($kaprog->nama_ketua_program) . '\', \'' . e($kaprog->jurusan) . '\', \'' . e($kaprog->user->username ?? '') . '\')">
                                ✏️
                            </button>
                            <button class="text-red-600 hover:text-red-900" title="Hapus"
                                onclick="openDeleteModal(\'' . $kaprog->nip . '\', \'' . e($kaprog->nama_ketua_program) . '\')">
                                🗑️
                            </button>
                        </div>
                    ';
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }

        return view('wakasek.kaprog.index');
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
