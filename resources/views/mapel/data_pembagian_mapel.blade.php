@if (auth()->user()->level == "admin")
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Pembagian Mapel</title>
    @include('template.head')

    <style>
        .card-header { background-color: #17a2b8; color: #fff; }
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
                        <i class="fas fa-users"></i> Pembagian Mapel
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Pembagian Mapel</li>
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
                <h5 class="mb-0"><b>Data Pembagian Mapel</b></h5>

                <div class="card-tools ml-auto">
                    <a href="{{ url('pembagian-mapel/create') }}" class="btn btn-success">
                        <i class="fas fa-plus"></i> Tambah
                    </a>
                </div>
            </div>

            <div class="card-body">

                {{-- alert sukses --}}
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        <i class="fas fa-check-circle"></i> {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert">
                            <span>&times;</span>
                        </button>
                    </div>
                @endif

                {{-- ===================== --}}
                {{-- FORM FILTER (GET)     --}}
                {{-- ===================== --}}
                <form method="GET" action="{{ url('pembagian-mapel') }}" id="form-filter">
                    <div class="row">

                        <div class="col-md-3">
                            <label>Tahun Pelajaran</label>
                            <select name="tp_id" class="form-control">
                                <option value="">-- semua --</option>
                                @foreach($tahun as $t)
                                    <option value="{{ $t->id }}"
                                        {{ request('tp_id') == $t->id ? 'selected' : '' }}>
                                        {{ $t->tahun_pelajaran }} - {{ $t->semester }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-2">
                            <label>Jenjang</label>
                            <select name="jenjang" class="form-control" id="select-jenjang">
                                <option value="">-- semua --</option>
                                <option value="SMK" {{ request('jenjang') == 'SMK' ? 'selected' : '' }}>SMK</option>
                                <option value="SMP" {{ request('jenjang') == 'SMP' ? 'selected' : '' }}>SMP</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label>Kelas</label>
                            <select name="kelas_id" class="form-control">
                                <option value="">-- semua --</option>
                                @foreach($kelas as $k)
                                    <option value="{{ $k->id }}"
                                        {{ request('kelas_id') == $k->id ? 'selected' : '' }}>
                                        {{ $k->nama_kelas }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-2">
                            <label>Guru</label>
                            <select name="guru_id" class="form-control">
                                <option value="">-- semua --</option>
                                @foreach($guru as $g)
                                    <option value="{{ $g->id }}"
                                        {{ request('guru_id') == $g->id ? 'selected' : '' }}>
                                        {{ $g->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-2 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-search"></i> Filter
                            </button>
                        </div>

                    </div>
                </form>

                <hr>

                {{-- ===================== --}}
                {{-- TABEL DATA            --}}
                {{-- ===================== --}}
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <small class="text-muted">
                        Total: <b>{{ $data->count() }}</b> data
                    </small>
                    @if(request()->anyFilled(['tp_id','jenjang','kelas_id','guru_id']))
                        <a href="{{ url('pembagian-mapel') }}" class="btn btn-sm btn-outline-secondary">
                            <i class="fas fa-times"></i> Reset Filter
                        </a>
                    @endif
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-sm">
                        <thead class="bg-info text-white text-center">
                            <tr>
                                <th width="5%">No</th>
                                <th>Tahun Pelajaran</th>
                                <th>Jenjang</th>
                                <th>Kelas</th>
                                <th>Guru Pengajar</th>
                                <th>Mata Pelajaran</th>
                                <th width="10%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = 1; @endphp

                            @forelse($data as $grupKey => $items)
                                {{-- ambil 1 row sebagai representasi grup --}}
                                @php $item = $items->first(); @endphp
                                <tr>
                                    <td class="text-center">{{ $no++ }}</td>
                                    <td>{{ $item->learning->tahun_pelajaran ?? '-' }} - {{ $item->learning->semester ?? '' }}</td>
                                    <td class="text-center">{{ $item->jenjang }}</td>
                                    <td>{{ $item->kelas->nama_kelas ?? '-' }}</td>
                                    <td>{{ $item->guru->name ?? '-' }}</td>
                                    <td>
                                        {{-- tampilkan semua mapel dalam grup --}}
                                        @foreach($items as $row)
                                            <span class="badge badge-info mb-1">
                                                {{ $row->mapel->nama_mapel ?? '-' }}
                                            </span>
                                        @endforeach
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ url('pembagian-mapel/'.$item->id.'/edit') }}"
                                            class="btn btn-warning btn-xs">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="{{ url('pembagian-mapel/delete/'.$item->id) }}"
                                            class="btn btn-danger btn-xs"
                                            onclick="return confirm('Yakin hapus data ini?')">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted py-3">
                                        <i class="fas fa-info-circle"></i> Tidak ada data
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

</div>

@include('template.footer')
@include('template.script')

<script>
    // auto submit saat jenjang diganti
    document.getElementById('select-jenjang').addEventListener('change', function () {
        document.getElementById('form-filter').submit();
    });
</script>

</body>
</html>
@endif