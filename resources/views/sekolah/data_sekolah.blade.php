@if (auth()->user()->level == "admin")
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Raport-RU | Data Sekolah</title>
    @include('template.head')
    <style>
        .table thead th {
            background-color: #17a2b8;
            color: #fff;
            text-align: center;
            vertical-align: middle;
        }
        .table tbody td { vertical-align: middle; }
        .table tbody tr:hover {
            background-color: #f1f9fc;
            transition: background 0.3s ease;
        }
        .btn-action { border-radius: 6px; padding: 5px 10px; }
    </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    @include('template.navbar')
    @include('template.sidebar')

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-info"><i class="fas fa-school"></i> Data Sekolah</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="">Home</a></li>
                            <li class="breadcrumb-item active">Data Sekolah</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="card card-info card-outline shadow-sm">
                <div class="card-header d-flex align-items-center">
                    <h5 class="mb-0"><b>Data Sekolah</b></h5>
                    <div class="card-tools ml-auto">
                        <button class="btn btn-success" data-toggle="modal" data-target="#modalTambahSekolah">
                            <i class="fas fa-plus-square"></i> Tambah Data
                        </button>
                    </div>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover mb-0">
                            <thead>
                                <tr>
                                    <th width="5%">NO</th>
                                    <th width="10%">Logo</th>
                                    <th>Nama Sekolah</th>
                                    <th>NPSN</th>
                                    <th width="15%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($dtsekolah as $item)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}.</td>
                                    <td class="text-center">
                                        @if($item->logo)
                                            <img src="{{ asset($item->logo) }}" width="60" height="60"
                                                 style="object-fit:contain; border-radius:4px;">
                                        @else
                                            <span class="text-muted"><i>Tidak ada</i></span>
                                        @endif
                                    </td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->npsn }}</td>
                                    <td class="text-center">
                                        <button class="btn btn-primary btn-sm btn-action"
                                                data-toggle="modal"
                                                data-target="#modalEditSekolah{{ $item->id }}">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <a href="{{ url('delete-sekolah', $item->id) }}"
                                           class="btn btn-danger btn-sm btn-action"
                                           onclick="return confirm('Yakin ingin menghapus data ini?')">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>

                                {{-- Modal Edit --}}
                                <div class="modal fade" id="modalEditSekolah{{ $item->id }}" tabindex="-1">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <form action="{{ url('update-sekolah', $item->id) }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-header bg-info text-white">
                                                    <h5 class="modal-title">Edit Sekolah</h5>
                                                    <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label>Logo</label>
                                                        <input type="file" name="logo" class="form-control">
                                                        @if($item->logo)
                                                            <img src="{{ asset($item->logo) }}" width="80" class="mt-2" style="object-fit:contain; border-radius:4px;">
                                                        @endif
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Nama Sekolah</label>
                                                        <input type="text" name="name" class="form-control" value="{{ $item->name }}" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>NPSN</label>
                                                        <input type="text" name="npsn" class="form-control" value="{{ $item->npsn }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>NIS/NSS/NDS</label>
                                                        <input type="text" name="nis_nss_nds" class="form-control" value="{{ $item->nis_nss_nds }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Alamat</label>
                                                        <input type="text" name="alamat" class="form-control" value="{{ $item->alamat }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Desa</label>
                                                        <input type="text" name="desa" class="form-control" value="{{ $item->desa }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Kecamatan</label>
                                                        <input type="text" name="kec" class="form-control" value="{{ $item->kec }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Kabupaten</label>
                                                        <input type="text" name="kab" class="form-control" value="{{ $item->kab }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Provinsi</label>
                                                        <input type="text" name="prov" class="form-control" value="{{ $item->prov }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Kode POS</label>
                                                        <input type="text" name="kodepos" class="form-control" value="{{ $item->kodepos }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Telepon</label>
                                                        <input type="text" name="telp" class="form-control" value="{{ $item->telp }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Website</label>
                                                        <input type="text" name="website" class="form-control" value="{{ $item->website }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Email</label>
                                                        <input type="email" name="email" class="form-control" value="{{ $item->email }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Kepala Sekolah</label>
                                                        <input type="text" name="kepsek" class="form-control" value="{{ $item->kepsek }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>NIY Kepala Sekolah</label>
                                                        <input type="text" name="niy_kepsek" class="form-control" value="{{ $item->niy_kepsek }}">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted">Tidak ada data sekolah</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card-footer text-center">
                    {{ $dtsekolah->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>

    @include('template.footer')
</div>

{{-- Modal Tambah --}}
<div class="modal fade" id="modalTambahSekolah" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('store-sekolah') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title">Tambah Sekolah</h5>
                    <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Logo</label>
                        <input type="file" name="logo" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Nama Sekolah</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>NPSN</label>
                        <input type="text" name="npsn" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>NIS/NSS/NDS</label>
                        <input type="text" name="nis_nss_nds" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <input type="text" name="alamat" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Desa</label>
                        <input type="text" name="desa" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Kecamatan</label>
                        <input type="text" name="kec" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Kabupaten</label>
                        <input type="text" name="kab" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Provinsi</label>
                        <input type="text" name="prov" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Kode POS</label>
                        <input type="text" name="kodepos" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Telepon</label>
                        <input type="text" name="telp" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Website</label>
                        <input type="text" name="website" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Kepala Sekolah</label>
                        <input type="text" name="kepsek" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>NIY Kepala Sekolah</label>
                        <input type="text" name="niy_kepsek" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>

@include('template.script')
</body>
</html>
@endif