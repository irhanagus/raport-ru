@if (auth()->user()->level == "admin")
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Raport-RU | Data Pengguna</title>
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
                        <h1 class="m-0 text-info"><i class="fas fa-users"></i> Data User</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="">Home</a></li>
                            <li class="breadcrumb-item active">Data User</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <div class="content">
            <div class="card card-info card-outline shadow-sm">
                <div class="card-header d-flex align-items-center">
                    <h5 class="mb-0 fw-bold"><b>Data Pengguna</b></h5>
                    <div class="card-tools ml-auto">
                        <div class="btn-group">
                            <button class="btn btn-success" data-toggle="modal" data-target="#modalTambahUser">
                                <i class="fas fa-plus-square"></i> Tambah Pengguna
                            </button>
                        </div>
                    </div>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover align-middle mb-0">
                            <thead>
                                <tr>
                                    <th width="5%">NO</th>
                                    <th>NAMA</th>
                                    <th>NO HP</th>
                                    <th>LEVEL</th>
                                    <th width="20%">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($dtuser as $item)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}.</td>
                                    <td>{{ $item->name }}</td>
                                    <td class="text-center">{{ $item->hp }}</td>
                                    <td class="text-center">
                                        <span class="badge bg-info badge-level">{{ ucwords($item->level) }}</span>
                                    </td>
                                    <td class="text-center">
                                        <button class="btn btn-primary btn-sm btn-action" 
                                                data-toggle="modal" 
                                                data-target="#modalEditUser{{ $item->id }}">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <a href="{{ url('delete-user',$item->id) }}" 
                                           class="btn btn-danger btn-sm btn-action"
                                           onclick="return confirm('Yakin ingin menghapus user ini?')">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>

                                <!-- Modal Edit User -->
                                <div class="modal fade" id="modalEditUser{{ $item->id }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="{{ url('update-user', $item->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-header bg-info text-white">
                                                    <h5 class="modal-title">Edit User</h5>
                                                    <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label>Nama</label>
                                                        <input type="text" name="name" class="form-control" value="{{ $item->name }}" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Email</label>
                                                        <input type="email" name="email" class="form-control" value="{{ $item->email }}" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>No HP</label>
                                                        <input type="text" name="alamat" class="form-control" value="{{ $item->hp }}" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Level</label>
                                                        <select name="level" class="form-control" required>
                                                            <option value="admin" {{ $item->level == 'admin' ? 'selected' : '' }}>Admin</option>
                                                            <option value="kurikulum" {{ $item->level == 'kurikulum' ? 'selected' : '' }}>Kurikulum</option>
                                                            <option value="wali" {{ $item->level == 'wali' ? 'selected' : '' }}>Wali</option>
                                                            <option value="guru" {{ $item->level == 'guru' ? 'selected' : '' }}>Guru</option>
                                                        </select>
                                                    </div>
                                                    <!-- Password Baru -->
                                                    <div class="form-group text-left">
                                                        <label>Password Baru</label>
                                                        <input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak ingin mengubah">
                                                    </div>

                                                    <!-- Konfirmasi Password -->
                                                    <div class="form-group text-left">
                                                        <label>Konfirmasi Password</label>
                                                        <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi password baru">
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
                                    <td colspan="4" class="text-center text-muted">Tidak ada data user</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card-footer text-center">
                    {{ $dtuser->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>

    @include('template.footer')

</div>

<!-- Modal Tambah User -->
<div class="modal fade" id="modalTambahUser" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('store-user') }}" method="POST">
                @csrf
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title">Tambah User</h5>
                    <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <input type="text" name="alamat" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Level</label>
                        <select name="level" class="form-control" required>
                            <option value="">-- Pilih Level --</option>
                            <option value="admin">Admin</option>
                            <option value="wilayah">Wilayah</option>
                            <option value="cabang">Cabang</option>
                            <option value="anakcabang">Anak Cabang</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" required>
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
