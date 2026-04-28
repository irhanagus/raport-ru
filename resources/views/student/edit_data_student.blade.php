<div class="modal fade" id="modalEditStudent{{ $item->id }}" tabindex="-1">
<div class="modal-dialog modal-xl">
<div class="modal-content">

<form action="{{ url('update-student', $item->id) }}" method="POST" enctype="multipart/form-data">
@csrf
@method('PUT')

<div class="modal-header bg-info text-white">
    <h5 class="modal-title">Edit Siswa</h5>
    <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
</div>

<div class="modal-body">

<div class="row">

    <!-- FOTO -->
    <div class="col-md-4">
        <label>Foto</label>

        <div id="drop-area-{{ $item->id }}" class="drop-area">
            <p id="text-drop-{{ $item->id }}"
            style="{{ $item->foto ? 'display:none;' : '' }}">
                Drag & drop / klik
            </p>

            <img id="preview-img-{{ $item->id }}"
                src="{{ $item->foto ? asset($item->foto) : '' }}"
                style="width:100%; height:220px; object-fit:cover; border-radius:10px;
                {{ $item->foto ? '' : 'display:none;' }}">

            <input type="file" name="foto" id="fileElem-{{ $item->id }}" hidden>
        </div>
    </div>

    <!-- DATA UTAMA -->
    <div class="col-md-8">

        <div class="form-group">
            <label>Nama</label>
            <input type="text" name="name" class="form-control" value="{{ $item->name }}" required>
        </div>

        <div class="form-row">
            <div class="col-md-4">
                <label>Jenis Kelamin</label>
                <select name="jk" class="form-control">
                    <option value="L" {{ $item->jk == 'L' ? 'selected' : '' }}>L</option>
                    <option value="P" {{ $item->jk == 'P' ? 'selected' : '' }}>P</option>
                </select>
            </div>
            <div class="col-md-4">
                <label>NIS</label>
                <input type="text" name="nis" class="form-control" value="{{ $item->nis }}" required>
            </div>
            <div class="col-md-4">
                <label>NISN</label>
                <input type="text" name="nisn" class="form-control" value="{{ $item->nisn }}" required>
            </div>
        </div>

        <div class="form-row mt-2">
            <div class="col-md-4">
                <label>Angkatan</label>
                <input type="number" name="angkatan" class="form-control" value="{{ $item->angkatan }}" required>
            </div>
            <div class="col-md-4">
                <label>Jenjang</label>
                <select name="jenjang" class="form-control">
                    <option value="smp" {{ $item->jenjang == 'smp' ? 'selected' : '' }}>SMP</option>
                    <option value="smk" {{ $item->jenjang == 'smk' ? 'selected' : '' }}>SMK</option>
                </select>
            </div>
            <div class="col-md-4">
                <label>Status</label>
                <select name="ket" class="form-control">
                    <option value="1" {{ $item->ket == '1' ? 'selected' : '' }}>Aktif</option>
                    <option value="2" {{ $item->ket == '2' ? 'selected' : '' }}>Lulus</option>
                    <option value="3" {{ $item->ket == '3' ? 'selected' : '' }}>Pindah</option>
                    <option value="4" {{ $item->ket == '4' ? 'selected' : '' }}>Dikeluarkan</option>
                </select>
            </div>
        </div>

    </div>

</div>

<hr>

<!-- DATA TAMBAHAN -->
<div class="row">

    <!-- KOLOM 1 -->
    <div class="col-md-3">
        <label>Tempat Lahir</label>
        <input type="text" name="tempat_lahir" class="form-control mb-2" value="{{ $item->tempat_lahir }}">

        <label>Tanggal Lahir</label>
        <input type="date" name="tanggal" class="form-control mb-2" value="{{ $item->tanggal }}">

        <label>Agama</label>
        <input type="text" name="agama" class="form-control mb-2" value="{{ $item->agama }}">

        <label>Status Keluarga</label>
        <input type="text" name="status_klrga" class="form-control mb-2" value="{{ $item->status_klrga }}">

        <label>Anak ke</label>
        <input type="number" name="anak_ke" class="form-control mb-2" value="{{ $item->anak_ke }}">
    </div>

    <!-- KOLOM 2 -->
    <div class="col-md-3">
        <label>Alamat</label>
        <input type="text" name="alamat" class="form-control mb-2" value="{{ $item->alamat }}">

        <label>Telp</label>
        <input type="text" name="telp" class="form-control mb-2" value="{{ $item->telp }}">

        <label>Asal Sekolah</label>
        <input type="text" name="asal_sekolah" class="form-control mb-2" value="{{ $item->asal_sekolah }}">

        <label>Diterima di Kelas</label>
        <input type="text" name="diterima_di_kelas" class="form-control mb-2" value="{{ $item->diterima_di_kelas }}">

        <label>Tanggal Diterima</label>
        <input type="date" name="diterima_tgl" class="form-control mb-2" value="{{ $item->diterima_tgl }}">
    </div>

    <!-- KOLOM 3 -->
    <div class="col-md-3">
        <label>Ayah</label>
        <input type="text" name="ayah" class="form-control mb-2" value="{{ $item->ayah }}">

        <label>Ibu</label>
        <input type="text" name="ibu" class="form-control mb-2" value="{{ $item->ibu }}">

        <label>Alamat Ortu</label>
        <input type="text" name="alamat_ortu" class="form-control mb-2" value="{{ $item->alamat_ortu }}">

        <label>Pekerjaan Ayah</label>
        <input type="text" name="pekerjaan_ayah" class="form-control mb-2" value="{{ $item->pekerjaan_ayah }}">

        <label>Pekerjaan Ibu</label>
        <input type="text" name="pekerjaan_ibu" class="form-control mb-2" value="{{ $item->pekerjaan_ibu }}">
    </div>

    <!-- KOLOM 4 -->
    <div class="col-md-3">
        <label>Telp Ortu</label>
        <input type="text" name="telp_ortu" class="form-control mb-2" value="{{ $item->telp_ortu }}">

        <label>Nama Wali</label>
        <input type="text" name="nama_wali" class="form-control mb-2" value="{{ $item->nama_wali }}">

        <label>Alamat Wali</label>
        <input type="text" name="alamat_wali" class="form-control mb-2" value="{{ $item->alamat_wali }}">

        <label>Pekerjaan Wali</label>
        <input type="text" name="pekerjaan_wali" class="form-control mb-2" value="{{ $item->pekerjaan_wali }}">

        <label>Telp Wali</label>
        <input type="text" name="telp_wali" class="form-control mb-2" value="{{ $item->telp_wali }}">
    </div>

</div>

</div>

<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
    <button type="submit" class="btn btn-primary">Simpan</button>
</div>

</form>
</div>
</div>
</div>