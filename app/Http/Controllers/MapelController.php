<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mapel;

class MapelController extends Controller
{
     // tampil data mapel
    public function index()
    {
        $dtmapel = Mapel::orderBy('created_at', 'asc')->paginate(10);
        return view('learning.data_mapel', compact('dtmapel'));
    }

    // simpan mapel baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_mapel' => 'required|string|max:100',
            'jenjang'    => 'required|string',
            'status'     => 'required|string',
        ]);

        Mapel::create([
            'nama_mapel'=> $request->nama_mapel,
            'jenjang'   => $request->jenjang,
            'status'    => $request->status,
        ]);

        return redirect()->route('data-mapel')->with('success', 'Data berhasil ditambahkan!');
    }

    // update mapel
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_mapel' => 'required|string|max:100',
            'jenjang'    => 'required|string',
            'status'     => 'required|string',
        ]);

        $dtmapel = Mapel::findOrFail($id);
        $dtmapel->nama_mapel = $request->nama_mapel;
        $dtmapel->jenjang    = $request->jenjang;
        $dtmapel->status  = $request->status;

        $dtmapel->save();

        return redirect()->route('data-mapel')->with('success', 'Pembelajaran berhasil diperbarui!');
    }

    // hapus mapel
    public function destroy($id)
    {
        $dtmapel = Mapel::findOrFail($id);
        $dtmapel->delete();
        return redirect()->route('data-mapel')->with('success', 'Pembelajaran berhasil dihapus!');
    }
}
