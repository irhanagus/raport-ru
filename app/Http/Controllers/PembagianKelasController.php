<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PembagianKelas;
use App\Models\Learning;
use App\Models\Kelas;
use App\Models\Student;
use App\Models\User;

class PembagianKelasController extends Controller
{
    /*
    =========================
    🔹 LIST DATA
    =========================
    */
    public function index()
    {
        $data = PembagianKelas::with(['kelas','learnings','students','users'])
            ->get()
            ->groupBy(function($item){
                return $item->tp_id.'-'.$item->kelas_id;
            });

        return view('kelas.data_pembagian_kelas', compact('data'));
    }


    public function create()
    {
        $tahun = Learning::all();
        $user  = User::all();

        $kelas = Kelas::when(request('jenjang'), function($q){
                    $q->where('jenjang', request('jenjang'));
                })
                ->orderBy('nama_kelas')
                ->get();

        $siswa = collect();
        if (request('kelas_id') && request('jenjang')) {
            $siswa = Student::where('jenjang', request('jenjang'))
                        ->orderBy('name')
                        ->get();
        }

        return view('kelas.create_pembagian_kelas', compact('tahun', 'user', 'kelas', 'siswa'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tp_id'    => 'required',
            'jenjang'  => 'required',
            'kelas_id' => 'required',
            'user_id'  => 'required',
            'wali'     => 'required',
            'siswa_id' => 'required|array|min:1',
        ]);

        foreach ($request->siswa_id as $siswa) {
            PembagianKelas::firstOrCreate([
                'tp_id'    => $request->tp_id,
                'kelas_id' => $request->kelas_id,
                'siswa_id' => $siswa,
            ],[
                'jenjang'  => $request->jenjang,
                'user_id'  => $request->user_id,
                'wali'     => $request->wali,
            ]);
        }

        return redirect('/pembagian-kelas')
            ->with('success', 'Pembagian kelas berhasil disimpan!');
    }

    public function edit($id)
    {
        $first = PembagianKelas::findOrFail($id);

        $selected = PembagianKelas::where('tp_id', $first->tp_id)
            ->where('kelas_id', $first->kelas_id)
            ->pluck('siswa_id')
            ->toArray();

        $tahun = Learning::all();
        $user  = User::all();

        $kelas = Kelas::where('jenjang', $first->jenjang)
                    ->orderBy('nama_kelas')
                    ->get();

        $siswa = Student::where('jenjang', $first->jenjang)
                    ->orderBy('name')
                    ->get();

        return view('kelas.edit_pembagian_kelas', compact(
            'first', 'selected', 'tahun', 'kelas', 'siswa', 'user'
        ));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tp_id'    => 'required',
            'jenjang'  => 'required',
            'kelas_id' => 'required',
            'user_id'  => 'required',
            'wali'     => 'required',
            'siswa_id' => 'required|array|min:1',
        ]);

        $first = PembagianKelas::findOrFail($id);

        // ⚠️ hapus pakai tp_id & kelas_id LAMA dulu sebelum ditimpa
        PembagianKelas::where('tp_id', $first->tp_id)
            ->where('kelas_id', $first->kelas_id)
            ->delete();

        // insert ulang dengan data BARU
        foreach ($request->siswa_id as $siswa_id) {
            PembagianKelas::create([
                'tp_id'    => $request->tp_id,
                'jenjang'  => $request->jenjang,
                'kelas_id' => $request->kelas_id,
                'user_id'  => $request->user_id,
                'siswa_id' => $siswa_id,
                'wali'     => $request->wali,
            ]);
        }

        return redirect('/pembagian-kelas')
            ->with('success', 'Data berhasil diupdate');
    }

    /*
    =========================
    🔹 DELETE
    =========================
    */
    public function destroy($id)
    {
        $first = PembagianKelas::findOrFail($id);

        PembagianKelas::where('tp_id', $first->tp_id)
            ->where('kelas_id', $first->kelas_id)
            ->delete();

        return back()->with('success','Data berhasil dihapus');
    }
}