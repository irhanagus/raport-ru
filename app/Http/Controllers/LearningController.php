<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Learning;

class LearningController extends Controller
{
    // tampil data pembelajaran
    public function index()
    {
        $dtlearning = Learning::orderBy('created_at', 'asc')->paginate(10);
        return view('learning.data_learning', compact('dtlearning'));
    }

    // simpan learning baru
    public function store(Request $request)
    {
        $request->validate([
            'tahun_pelajaran'    => 'required|string|max:100',
            'semester'           => 'required|string',
            'tgl_bagi_raport'    => 'required|date',
            'status'             => 'required|string',
        ]);

        Learning::create([
            'tahun_pelajaran'    => $request->tahun_pelajaran,
            'semester'           => $request->semester,
            'tgl_bagi_raport'    => $request->tgl_bagi_raport,
            'status'             => $request->status,
        ]);

        return redirect()->route('data-learning')->with('success', 'Data berhasil ditambahkan!');
    }

    // update learning
    public function update(Request $request, $id)
    {
        $request->validate([
            'tahun_pelajaran'    => 'required|string|max:100',
            'semester'           => 'required|string',
            'tgl_bagi_raport'    => 'required|date',
            'status'             => 'required|string',
        ]);

        $dtlearning = Learning::findOrFail($id);
        $dtlearning->tahun_pelajaran = $request->tahun_pelajaran;
        $dtlearning->semester        = $request->semester;
        $dtlearning->tgl_bagi_raport = $request->tgl_bagi_raport;
        $dtlearning->status          = $request->status;

        $dtlearning->save();

        return redirect()->route('data-learning')->with('success', 'Pembelajaran berhasil diperbarui!');
    }

    // hapus learning
    public function destroy($id)
    {
        $dtlearning = Learning::findOrFail($id);
        $dtlearning->delete();
        return redirect()->route('data-learning')->with('success', 'Pembelajaran berhasil dihapus!');
    }
}
