@if (auth()->user()->level == "admin")
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Raport-RU | Data Mapel</title>
    @include('template.head')
    <style>
        /* Styling Tabel */
        .table thead th {
            background-color: #17a2b8;
            color: #fff;
            text-align: center;
            vertical-align: middle;
        }
        .table tbody td {
            vertical-align: middle;
        }
        .table tbody tr:hover {
            background-color: #f1f9fc;
            transition: background 0.3s ease;
        }
        .badge-level {
            font-size: 0.85rem;
            padding: 5px 10px;
            border-radius: 6px;
        }
        .btn-action {
            border-radius: 6px;
            padding: 5px 10px;
        }
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
                        <h1 class="m-0 text-info"><i class="fas fa-users"></i> Data TP+Semester</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="">Home</a></li>
                            <li class="breadcrumb-item active">Data Mapel</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <div class="content">
            <div class="card card-info card-outline shadow-sm">
                <div class="card-header d-flex align-items-center">
                    <h5 class="mb-0 fw-bold"><b>Data Mapel</b></h5>
                    <div class="card-tools ml-auto">
                        <div class="btn-group">
                            <button class="btn btn-success" data-toggle="modal" data-target="#modalTambahMapel">
                                <i class="fas fa-plus-square"></i> Tambah Data
                            </button>
                        </div>
                    </div>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover align-middle mb-0">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th>Nama Mapel</th>
                                    <th>Jenjang</th>
                                    <th>Status</th>
                                    <th width="20%">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($dtmapel as $item)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}.</td>
                                    <td class="text-center">{{ $item->nama_mapel }}</td>
                                    <td class="text-center">{{ $item->jenjang }}</td>
                                    <td class="text-center">{{ $item->status }}</td>
                                    <td class="text-center">
                                        <button class="btn btn-primary btn-sm btn-action" 
                                                data-toggle="modal" 
                                                data-target="#modalEditMapel{{ $item->id }}">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <a href="{{ url('delete-mapel',$item->id) }}" 
                                           class="btn btn-danger btn-sm btn-action"
                                           onclick="return confirm('Yakin ingin menghapus data ini?')">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>

                                <!-- Modal Edit Mapel -->
                                <div class="modal fade" id="modalEditMapel{{ $item->id }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="{{ url('update-mapel', $item->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-header bg-info text-white">
                                                    <h5 class="modal-title">Edit Mapel</h5>
                                                    <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label>Nama Mapel</label>
                                                        <input type="text" name="nama_mapel" class="form-control" value="{{ $item->nama_mapel }}" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Jenjang</label>
                                                        <select name="jenjang" class="form-control" required>
                                                            <option value="SMK" {{ $item->jenjang == 'SMK' ? 'selected' : '' }}>SMK</option>
                                                            <option value="SMP" {{ $item->jenjang == 'SMP' ? 'selected' : '' }}>SMP</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Status</label>
                                                        <select name="status" class="form-control" required>
                                                            <option value="Aktif" {{ $item->status == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                                            <option value="Non Aktif" {{ $item->status == 'Non Aktif' ? 'selected' : '' }}>Non Aktif</option>
                                                        </select>
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
                                    <td colspan="6" class="text-center text-muted">Tidak ada data mata pelajaran</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card-footer text-center">
                    {{ $dtmapel->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>

    @include('template.footer')

</div>

<!-- Modal Tambah User -->
<div class="modal fade" id="modalTambahMapel" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('store-mapel') }}" method="POST">
                @csrf
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title">Tambah Data</h5>
                    <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Mapel</label>
                        <input type="text" name="nama_mapel" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Jenjang</label>
                        <select name="jenjang" class="form-control" required>
                            <option value="SMK">SMK</option>
                            <option value="SMP">SMP</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control" required>
                            <option value="Aktif">Aktif</option>
                            <option value="Non Aktif">Non Aktif</option>
                        </select>
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
