@if (auth()->user()->level == "admin")
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Raport-RU | Data TP+Semester</title>
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
                            <li class="breadcrumb-item active">Data TP+Semester</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <div class="content">
            <div class="card card-info card-outline shadow-sm">
                <div class="card-header d-flex align-items-center">
                    <h5 class="mb-0 fw-bold"><b>Data TP+Semester</b></h5>
                    <div class="card-tools ml-auto">
                        <div class="btn-group">
                            <button class="btn btn-success" data-toggle="modal" data-target="#modalTambahLearning">
                                <i class="fas fa-plus-square"></i> Tambah Data TP+Semester
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
                                    <th>Tahun Pembelajaran</th>
                                    <th>Semester</th>
                                    <th>Tanggal Pembagian Raport</th>
                                    <th>Status</th>
                                    <th width="20%">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($dtlearning as $item)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}.</td>
                                    <td class="text-center">{{ $item->tahun_pelajaran }}</td>
                                    <td class="text-center">{{ $item->semester }}</td>
                                    <td class="text-center">{{ $item->tgl_bagi_raport }}</td>
                                    <td class="text-center">{{ $item->status }}</td>
                                    <td class="text-center">
                                        <button class="btn btn-primary btn-sm btn-action" 
                                                data-toggle="modal" 
                                                data-target="#modalEditLearning{{ $item->id }}">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <a href="{{ url('delete-learning',$item->id) }}" 
                                           class="btn btn-danger btn-sm btn-action"
                                           onclick="return confirm('Yakin ingin menghapus data ini?')">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>

                                <!-- Modal Edit Learning -->
                                <div class="modal fade" id="modalEditLearning{{ $item->id }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="{{ url('update-learning', $item->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-header bg-info text-white">
                                                    <h5 class="modal-title">Edit TP+Semester</h5>
                                                    <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label>Tahun Pelajaran</label>
                                                        <input type="text" name="tahun_pelajaran" class="form-control" value="{{ $item->tahun_pelajaran }}" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Semester</label>
                                                        <select name="semester" class="form-control" required>
                                                            <option value="Ganjil" {{ $item->semester == 'Ganjil' ? 'selected' : '' }}>Ganjil</option>
                                                            <option value="Genap" {{ $item->semester == 'Genap' ? 'selected' : '' }}>Genap</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Tanggal Pembagian Raport</label>
                                                        <input type="date" name="tgl_bagi_raport" class="form-control" value="{{ $item->tgl_bagi_raport }}" required>
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
                                    <td colspan="6" class="text-center text-muted">Tidak ada data TP dan Semester</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card-footer text-center">
                    {{ $dtlearning->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>

    @include('template.footer')

</div>

<!-- Modal Tambah User -->
<div class="modal fade" id="modalTambahLearning" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('store-learning') }}" method="POST">
                @csrf
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title">Tambah Data</h5>
                    <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Tahun Pelajaran</label>
                        <input type="text" name="tahun_pelajaran" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Semester</label>
                        <select name="semester" class="form-control" required>
                            <option value="Ganjil">Ganjil</option>
                            <option value="Genap">Genap</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Pembagian Raport</label>
                        <input type="date" name="tgl_bagi_raport" class="form-control" required>
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
