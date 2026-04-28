<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sekolah;

class SekolahController extends Controller
{
    public function index()
    {
        $dtsekolah = Sekolah::latest()->paginate(10);
        return view('sekolah.data_sekolah', compact('dtsekolah'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'logo'        => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'name'        => 'required|max:255',
            'npsn'        => 'nullable',
            'nis_nss_nds' => 'nullable',
            'alamat'      => 'nullable',
            'desa'        => 'nullable',
            'kec'         => 'nullable',
            'kab'         => 'nullable',
            'prov'        => 'nullable',
            'kodepos'     => 'nullable',
            'telp'        => 'nullable',
            'website'     => 'nullable',
            'email'       => 'nullable',
            'kepsek'      => 'nullable',
            'niy_kepsek'  => 'nullable',
        ]);

        $path = null;
        if ($request->hasFile('logo')) {
            $file     = $request->file('logo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/logo'), $filename);
            $path = 'uploads/logo/' . $filename;
        }

        Sekolah::create([
            'logo'        => $path,
            'name'        => $request->name,
            'npsn'        => $request->npsn,
            'nis_nss_nds' => $request->nis_nss_nds,
            'alamat'      => $request->alamat,
            'desa'        => $request->desa,
            'kec'         => $request->kec,
            'kab'         => $request->kab,
            'prov'        => $request->prov,
            'kodepos'     => $request->kodepos,
            'telp'        => $request->telp,
            'website'     => $request->website,
            'email'       => $request->email,
            'kepsek'      => $request->kepsek,
            'niy_kepsek'  => $request->niy_kepsek,
        ]);

        return redirect()->back()->with('success', 'Data sekolah berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'logo'        => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'name'        => 'required|max:255',
            'npsn'        => 'nullable',
            'nis_nss_nds' => 'nullable',
            'alamat'      => 'nullable',
            'desa'        => 'nullable',
            'kec'         => 'nullable',
            'kab'         => 'nullable',
            'prov'        => 'nullable',
            'kodepos'     => 'nullable',
            'telp'        => 'nullable',
            'website'     => 'nullable',
            'email'       => 'nullable',
            'kepsek'      => 'nullable',
            'niy_kepsek'  => 'nullable',
        ]);

        $sekolah = Sekolah::findOrFail($id);

        if ($request->hasFile('logo')) {
            // Hapus file lama
            if ($sekolah->logo) {
                $oldPath = public_path($sekolah->logo);
                if (file_exists($oldPath)) unlink($oldPath);
            }

            $file     = $request->file('logo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/logo'), $filename);
            $sekolah->logo = 'uploads/logo/' . $filename;
        }

        $sekolah->name        = $request->name;
        $sekolah->npsn        = $request->npsn;
        $sekolah->nis_nss_nds = $request->nis_nss_nds;
        $sekolah->alamat      = $request->alamat;
        $sekolah->desa        = $request->desa;
        $sekolah->kec         = $request->kec;
        $sekolah->kab         = $request->kab;
        $sekolah->prov        = $request->prov;
        $sekolah->kodepos     = $request->kodepos;
        $sekolah->telp        = $request->telp;
        $sekolah->website     = $request->website;
        $sekolah->email       = $request->email;
        $sekolah->kepsek      = $request->kepsek;
        $sekolah->niy_kepsek  = $request->niy_kepsek;
        $sekolah->save();

        return redirect()->back()->with('success', 'Data sekolah berhasil diperbarui');
    }

    public function destroy($id)
    {
        $sekolah = Sekolah::findOrFail($id);

        if ($sekolah->logo) {
            $oldPath = public_path($sekolah->logo);
            if (file_exists($oldPath)) unlink($oldPath);
        }

        $sekolah->delete();

        return redirect()->back()->with('success', 'Data sekolah berhasil dihapus');
    }
}