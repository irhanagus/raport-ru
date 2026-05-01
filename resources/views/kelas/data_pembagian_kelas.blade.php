@if (auth()->user()->level == "admin")
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Raport-RU | Pembagian Kelas</title>
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
            transition: 0.3s;
        }
        .btn-action { padding:5px 10px; border-radius:6px; }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

@include('template.navbar')
@include('template.sidebar')

<div class="content-wrapper">

    <!-- HEADER -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-info">
                        <i class="fas fa-users"></i> Pembagian Kelas
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Pembagian Kelas</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- CONTENT -->
    <div class="content">
        <div class="card card-info card-outline shadow-sm">

            <!-- HEADER CARD -->
            <div class="card-header d-flex align-items-center">
                <h5 class="mb-0"><b>Data Pembagian Kelas</b></h5>

                <div class="card-tools ml-auto">
                    <a href="{{ url('pembagian-kelas/create') }}" class="btn btn-success">
                        <i class="fas fa-plus"></i> Tambah
                    </a>
                </div>
            </div>

            <!-- BODY -->
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover mb-0">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th>Tahun</th>
                                <th>Kelas</th>
                                <th>Wali</th>
                                <th>Jumlah Siswa</th>
                                <th width="15%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>

                        @forelse($data as $key => $group)
                            @php
                                $first = $group->first();
                            @endphp

                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>
                                    {{ $first->learnings->tahun_pelajaran ?? '-' }} 
                                    - 
                                    {{ $first->learnings->semester ?? '' }}
                                </td>
                                <td>{{ $first->kelas->nama_kelas ?? '-' }}</td>
                                <td>{{ $first->wali ?? '-' }}</td>
                                <td class="text-center">
                                    <span class="badge badge-info">
                                        {{ count($group) }} siswa
                                    </span>
                                </td>

                                <td class="text-center">

                                    <!-- EDIT -->
                                    <a href="{{ url('pembagian-kelas/edit/'.$first->id) }}"
                                       class="btn btn-primary btn-sm btn-action">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <!-- DELETE -->
                                    <a href="{{ url('pembagian-kelas/delete/'.$first->id) }}"
                                       class="btn btn-danger btn-sm btn-action"
                                       onclick="return confirm('Yakin hapus semua siswa di kelas ini?')">
                                        <i class="fas fa-trash"></i>
                                    </a>

                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">
                                    Belum ada data pembagian kelas
                                </td>
                            </tr>
                        @endforelse

                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

</div>

@include('template.footer')
@include('template.script')

</body>
</html>
@endif