<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PembagianMapel;
use App\Models\Learning;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\User;

class PembagianMapelController extends Controller
{
    /*
    =========================
    🔹 LIST DATA
    =========================
    */
    public function index()
    {
        $tahun = Learning::all();
        $guru  = User::all();

        $kelas = Kelas::when(request('jenjang'), function($q) {
                    $q->where('jenjang', request('jenjang'));
                })
                ->orderBy('nama_kelas')
                ->get();

        $data = PembagianMapel::with(['learning', 'kelas', 'mapel', 'guru'])
            ->when(request('tp_id'),    fn($q) => $q->where('tp_id',    request('tp_id')))
            ->when(request('jenjang'),  fn($q) => $q->where('jenjang',  request('jenjang')))
            ->when(request('kelas_id'), fn($q) => $q->where('kelas_id', request('kelas_id')))
            ->when(request('guru_id'),  fn($q) => $q->where('guru_id',  request('guru_id')))
            ->orderBy('tp_id')
            ->orderBy('kelas_id')
            ->get()
            ->groupBy(fn($item) => $item->tp_id.'-'.$item->kelas_id.'-'.$item->guru_id);

        return view('mapel.data_pembagian_mapel', compact('data', 'tahun', 'kelas', 'guru'));
    }
    /*
    =========================
    🔹 FORM CREATE
    =========================
    */
    public function create()
    {
        $tahun = Learning::all();
        $guru  = User::all();

        $kelas = Kelas::when(request('jenjang'), function($q) {
                    $q->where('jenjang', request('jenjang'));
                })
                ->orderBy('nama_kelas')
                ->get();

        $mapel = Mapel::when(request('jenjang'), function($q) {
                    $q->where('jenjang', request('jenjang'));
                })
                ->orderBy('nama_mapel')
                ->get();

        return view('mapel.create_pembagian_mapel', compact('tahun', 'guru', 'kelas', 'mapel'));
    }

    /*
    =========================
    🔹 SIMPAN DATA
    =========================
    */
    public function store(Request $request)
    {
        $request->validate([
            'tp_id'    => 'required',
            'jenjang'  => 'required',
            'kelas_id' => 'required',
            'guru_id'  => 'required',
            'mapel_id' => 'required|array|min:1',
        ]);

        foreach ($request->mapel_id as $mapel_id) {

            // cek duplikat manual sebelum insert
            $exists = PembagianMapel::where('tp_id',    $request->tp_id)
                ->where('kelas_id', $request->kelas_id)
                ->where('mapel_id', $mapel_id)
                ->where('guru_id',  $request->guru_id)
                ->exists();

            if (!$exists) {
                PembagianMapel::create([
                    'tp_id'    => $request->tp_id,
                    'jenjang'  => $request->jenjang,
                    'kelas_id' => $request->kelas_id,
                    'mapel_id' => $mapel_id,
                    'guru_id'  => $request->guru_id,
                ]);
            }
        }

        return redirect('/pembagian-mapel')
            ->with('success', 'Pembagian mapel berhasil disimpan!');
    }

    /*
    =========================
    🔹 EDIT
    =========================
    */
    public function edit($id)
    {
        $first = PembagianMapel::findOrFail($id);

        $selected = PembagianMapel::where('tp_id', $first->tp_id)
            ->where('kelas_id', $first->kelas_id)
            ->where('guru_id', $first->guru_id)
            ->pluck('mapel_id')
            ->toArray();

        $tahun = Learning::all();
        $guru  = User::all();

        $kelas = Kelas::where('jenjang', $first->jenjang)
                    ->orderBy('nama_kelas')
                    ->get();

        $mapel = Mapel::where('jenjang', $first->jenjang)
                    ->orderBy('nama_mapel')
                    ->get();

        return view('mapel.edit_pembagian_mapel', compact(
            'first', 'selected', 'tahun', 'kelas', 'mapel', 'guru'
        ));
    }

    /*
    =========================
    🔹 UPDATE
    =========================
    */
    public function update(Request $request, $id)
    {
        $request->validate([
            'tp_id'    => 'required',
            'jenjang'  => 'required',
            'kelas_id' => 'required',
            'guru_id'  => 'required',
            'mapel_id' => 'required|array|min:1',
        ]);

        $first = PembagianMapel::findOrFail($id);

        // hapus data lama
        PembagianMapel::where('tp_id', $first->tp_id)
            ->where('kelas_id', $first->kelas_id)
            ->where('guru_id', $first->guru_id)
            ->delete();

        // insert ulang
        foreach ($request->mapel_id as $mapel_id) {
            PembagianMapel::create([
                'tp_id'    => $request->tp_id,
                'jenjang'  => $request->jenjang,
                'kelas_id' => $request->kelas_id,
                'mapel_id' => $mapel_id,
                'guru_id'  => $request->guru_id,
            ]);
        }

        return redirect('/pembagian-mapel')
            ->with('success', 'Data berhasil diupdate');
    }

    /*
    =========================
    🔹 DELETE
    =========================
    */
    public function destroy($id)
    {
        $first = PembagianMapel::findOrFail($id);

        PembagianMapel::where('tp_id', $first->tp_id)
            ->where('kelas_id', $first->kelas_id)
            ->where('guru_id', $first->guru_id)
            ->delete();

        return back()->with('success', 'Data berhasil dihapus');
    }
}
