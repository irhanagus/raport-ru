@if (auth()->user()->level == "admin")
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Pembagian Mapel</title>
    @include('template.head')

    <style>
        .card-header { background-color: #17a2b8; color: #fff; }
        .mapel-box {
            max-height: 350px;
            overflow-y: auto;
            border: 1px solid #dee2e6;
            border-radius: 6px;
        }
        .mapel-box table { margin-bottom: 0; }
        .mapel-box thead th {
            position: sticky;
            top: 0;
            z-index: 1;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

@include('template.navbar')
@include('template.sidebar')

<div class="content-wrapper">

{{-- HEADER --}}
<div class="content-header">
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center">
            <h1 class="text-info mb-0">
                <i class="fas fa-plus"></i> Tambah Pembagian Mapel
            </h1>
            <a href="{{ url('pembagian-mapel') }}" class="btn btn-secondary btn-sm">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>
</div>

<div class="content">
<div class="container-fluid">
<div class="card shadow-sm">

    <div class="card-header">
        <b><i class="fas fa-filter"></i> Filter Data</b>
    </div>

    <div class="card-body">

        {{-- ===================== --}}
        {{-- FORM FILTER (GET)     --}}
        {{-- ===================== --}}
        <form method="GET" action="{{ url('pembagian-mapel/create') }}" id="form-filter">
            <div class="row">

                <div class="col-md-3">
                    <label>Tahun Pelajaran <span class="text-danger">*</span></label>
                    <select name="tp_id" class="form-control">
                        <option value="">-- pilih --</option>
                        @foreach($tahun as $t)
                            <option value="{{ $t->id }}"
                                {{ request('tp_id') == $t->id ? 'selected' : '' }}>
                                {{ $t->tahun_pelajaran }} - {{ $t->semester }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3">
                    <label>Jenjang <span class="text-danger">*</span></label>
                    <select name="jenjang" class="form-control" id="select-jenjang">
                        <option value="">-- pilih --</option>
                        <option value="SMK" {{ request('jenjang') == 'SMK' ? 'selected' : '' }}>SMK</option>
                        <option value="SMP" {{ request('jenjang') == 'SMP' ? 'selected' : '' }}>SMP</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <label>Kelas <span class="text-danger">*</span></label>
                    <select name="kelas_id" class="form-control">
                        <option value="">-- pilih kelas --</option>
                        @foreach($kelas as $k)
                            <option value="{{ $k->id }}"
                                {{ request('kelas_id') == $k->id ? 'selected' : '' }}>
                                {{ $k->nama_kelas }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-search"></i> Tampilkan Mapel
                    </button>
                </div>

            </div>
        </form>

        <hr>

        {{-- ===================== --}}
        {{-- FORM SIMPAN (POST)    --}}
        {{-- ===================== --}}
        <form method="POST" action="{{ url('pembagian-mapel') }}">
        @csrf

        {{-- kirim ulang nilai filter --}}
        <input type="hidden" name="tp_id"    value="{{ request('tp_id') }}">
        <input type="hidden" name="jenjang"  value="{{ request('jenjang') }}">
        <input type="hidden" name="kelas_id" value="{{ request('kelas_id') }}">

        {{-- alert error --}}
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row mb-3">
            <div class="col-md-4">
                <label>Guru Pengajar <span class="text-danger">*</span></label>
                <select name="guru_id" class="form-control" required>
                    <option value="">-- pilih guru --</option>
                    @foreach($guru as $g)
                        <option value="{{ $g->id }}"
                            {{ old('guru_id') == $g->id ? 'selected' : '' }}>
                            {{ $g->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <hr>

        {{-- ===================== --}}
        {{-- TABEL DAFTAR MAPEL    --}}
        {{-- ===================== --}}
        <div class="d-flex justify-content-between align-items-center mb-2">
            <label class="mb-0"><b>Daftar Mata Pelajaran</b></label>
            @if($mapel->isNotEmpty())
                <small class="text-muted">Total: {{ $mapel->count() }} mapel</small>
            @endif
        </div>

        <div class="mapel-box">
            <table class="table table-bordered table-hover table-sm">
                <thead class="bg-info text-white text-center">
                    <tr>
                        <th width="5%">
                            <input type="checkbox" id="checkAll" title="Pilih Semua">
                        </th>
                        <th>Kode Mapel</th>
                        <th>Nama Mata Pelajaran</th>
                        <th>Jenjang</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($mapel as $m)
                        <tr>
                            <td class="text-center">
                                <input type="checkbox"
                                    class="mapel-check"
                                    name="mapel_id[]"
                                    value="{{ $m->id }}"
                                    {{ in_array($m->id, old('mapel_id', [])) ? 'checked' : '' }}>
                            </td>
                            <td>{{ $m->kode_mapel ?? '-' }}</td>
                            <td>{{ $m->nama_mapel }}</td>
                            <td class="text-center">{{ $m->jenjang ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-3">
                                @if(request('kelas_id'))
                                    <i class="fas fa-info-circle"></i> Tidak ada mata pelajaran ditemukan
                                @else
                                    <i class="fas fa-info-circle"></i> Silakan pilih filter terlebih dahulu
                                @endif
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <br>

        @if($mapel->isNotEmpty())
            <button type="submit" class="btn btn-success">
                <i class="fas fa-save"></i> Simpan
            </button>
        @endif

        <a href="{{ url('pembagian-mapel') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>

        </form>

    </div>
</div>
</div>
</div>

</div>

@include('template.footer')
@include('template.script')

<script>
    document.getElementById('select-jenjang').addEventListener('change', function () {
        document.getElementById('form-filter').submit();
    });

    document.getElementById('checkAll').addEventListener('change', function () {
        document.querySelectorAll('.mapel-check').forEach(c => c.checked = this.checked);
    });
</script>

</body>
</html>
@endif