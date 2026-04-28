<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Student;

class StudentController extends Controller
{
    public function index()
    {
        $dtstudent = Student::latest()->paginate(10);

        return view('student.data_student', compact('dtstudent'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'foto'     => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'angkatan' => 'required',
            'jenjang'  => 'required',
            'nis'      => 'required',
            'nisn'     => 'required',
            'name'     => 'required',
            'ket'      => 'required',
        ]);

        $path = null;
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('uploads/foto'), $filename);
            $path = 'uploads/foto/'.$filename;
        }

        Student::create([
            'foto' => $path,
            'angkatan' => $request->angkatan,
            'jenjang'  => $request->jenjang,
            'nis'      => $request->nis,
            'nisn'     => $request->nisn,
            'name'     => $request->name,
            'jk'       => $request->jk,
            'ket'      => $request->ket,

            // default
            'tempat_lahir' => '',
            'tanggal' => null,
            'agama' => '',
            'status_klrga' => '',
            'anak_ke' => 0,
            'alamat' => '',
            'telp' => '',
            'asal_sekolah' => '',
            'diterima_di_kelas' => '',
            'diterima_tgl' => null,
            'ayah' => '',
            'ibu' => '',
            'alamat_ortu' => '',
            'pekerjaan_ayah' => '',
            'pekerjaan_ibu' => '',
            'telp_ortu' => '',
            'nama_wali' => '',
            'alamat_wali' => '',
            'pekerjaan_wali' => '',
            'telp_wali' => '',
            'is_draft' => 0
        ]);

        return back()->with('success','Data berhasil ditambahkan');
    }

    
    public function update(Request $request, $id)
    {
        $request->validate([
            'foto'              => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'angkatan'          => 'required|max:255',
            'jenjang'           => 'required|max:255',
            'nis'               => 'required|max:255',
            'nisn'              => 'required|max:255',
            'name'              => 'required|max:255',
            'tempat_lahir'      => 'nullable',
            'tanggal'           => 'nullable',
            'jk'                => 'nullable',
            'agama'             => 'nullable',
            'status_klrga'      => 'nullable',
            'anak_ke'           => 'nullable',
            'alamat'            => 'nullable',
            'telp'              => 'nullable',
            'asal_sekolah'      => 'nullable',
            'diterima_di_kelas' => 'nullable',
            'diterima_tgl'      => 'nullable',
            'ayah'              => 'nullable',
            'ibu'               => 'nullable',
            'alamat_ortu'       => 'nullable',
            'pekerjaan_ayah'    => 'nullable',
            'pekerjaan_ibu'     => 'nullable',
            'telp_ortu'         => 'nullable',
            'nama_wali'         => 'nullable',
            'alamat_wali'       => 'nullable',
            'pekerjaan_wali'    => 'nullable',
            'telp_wali'         => 'nullable',
            'ket'               => 'required|max:255',
        ]);

        $student = Student::findOrFail($id);

        if ($request->hasFile('foto')) {
            // Hapus file lama
            if ($student->foto) {
                $oldPath = public_path($student->foto);
                if (file_exists($oldPath)) unlink($oldPath);
            }

            $file     = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/foto'), $filename);
            $student->foto = 'uploads/foto/' . $filename;
        }

        $student->angkatan          = $request->angkatan;
        $student->jenjang           = $request->jenjang;
        $student->nis               = $request->nis;
        $student->nisn              = $request->nisn;
        $student->name              = $request->name;
        $student->tempat_lahir      = $request->tempat_lahir;
        $student->tanggal           = $request->tanggal;
        $student->jk                = $request->jk;
        $student->agama             = $request->agama;
        $student->status_klrga      = $request->status_klrga;
        $student->anak_ke           = $request->anak_ke;
        $student->alamat            = $request->alamat;
        $student->telp              = $request->telp;
        $student->asal_sekolah      = $request->asal_sekolah;
        $student->diterima_di_kelas = $request->diterima_di_kelas;
        $student->diterima_tgl      = $request->diterima_tgl;
        $student->ayah              = $request->ayah;
        $student->ibu               = $request->ibu;
        $student->alamat_ortu       = $request->alamat_ortu;
        $student->pekerjaan_ayah    = $request->pekerjaan_ayah;
        $student->pekerjaan_ibu     = $request->pekerjaan_ibu;
        $student->telp_ortu         = $request->telp_ortu;
        $student->nama_wali         = $request->nama_wali;
        $student->alamat_wali       = $request->alamat_wali;
        $student->pekerjaan_wali    = $request->pekerjaan_wali;
        $student->telp_wali         = $request->telp_wali;
        $student->ket               = $request->ket;
        $student->save();

        return redirect()->back()->with('success', 'Data siswa berhasil diperbarui');
    }

    public function destroy($id)
    {
        $student = Student::findOrFail($id);

        if ($student->foto) {
            $oldPath = public_path($student->foto);
            if (file_exists($oldPath)) unlink($oldPath);
        }

        $student->delete();

        return redirect()->back()->with('success', 'Data siswa berhasil dihapus');
    }

    public function deleteDraft($id)
    {
        Student::where('id', $id)
            ->where('is_draft', 1)
            ->delete();

        return response()->json(['success' => true]);
    }
}

