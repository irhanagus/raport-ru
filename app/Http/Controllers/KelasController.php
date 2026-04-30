<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;

class KelasController extends Controller
{
    // tampil data kelas
    public function index()
    {
        $dtkelas = Kelas::orderBy('created_at', 'asc')->paginate(10);
        return view('learning.data_kelas', compact('dtkelas'));
    }

    // simpan kelas baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:100',
            'jenjang'    => 'required|string',
            'status'     => 'required|string',
        ]);

        Kelas::create([
            'nama_kelas'=> $request->nama_kelas,
            'jenjang'   => $request->jenjang,
            'status'    => $request->status,
        ]);

        return redirect()->route('data-kelas')->with('success', 'Data berhasil ditambahkan!');
    }

    // update kelas
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:100',
            'jenjang'    => 'required|string',
            'status'     => 'required|string',
        ]);

        $dtkelas = Learning::findOrFail($id);
        $dtkelas->nama_kelas = $request->nama_kelas;
        $dtkelas->jenjang    = $request->jenjang;
        $dtkelas->status  = $request->status;

        $dtkelas->save();

        return redirect()->route('data-kelas')->with('success', 'Pembelajaran berhasil diperbarui!');
    }

    // hapus kelas
    public function destroy($id)
    {
        $dtkelas = Kelas::findOrFail($id);
        $dtkelas->delete();
        return redirect()->route('data-kelas')->with('success', 'Pembelajaran berhasil dihapus!');
    }
}
