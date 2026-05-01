@if (auth()->user()->level == "admin")
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Pembagian Kelas</title>
    @include('template.head')

    <style>
        .card-header { background-color: #17a2b8; color: #fff; }
        .siswa-box {
            max-height: 350px;
            overflow-y: auto;
            border: 1px solid #dee2e6;
            border-radius: 6px;
        }
        .siswa-box table { margin-bottom: 0; }
        .siswa-box thead th {
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
                <i class="fas fa-edit"></i> Edit Pembagian Kelas
            </h1>
            <a href="{{ url('pembagian-kelas') }}" class="btn btn-secondary btn-sm">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>
</div>

<div class="content">
<div class="container-fluid">
<div class="card shadow-sm">

    <div class="card-header">
        <b><i class="fas fa-edit"></i> Form Edit Pembagian Kelas</b>
    </div>

    <div class="card-body">

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

        <form method="POST" action="{{ url('pembagian-kelas/update/'.$first->id) }}">
        @csrf

        <div class="row">

            <div class="col-md-3">
                <label>Tahun Pelajaran <span class="text-danger">*</span></label>
                <select name="tp_id" class="form-control" required>
                    <option value="">-- pilih --</option>
                    @foreach($tahun as $t)
                        <option value="{{ $t->id }}"
                            {{ $first->tp_id == $t->id ? 'selected' : '' }}>
                            {{ $t->tahun_pelajaran }} - {{ $t->semester }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3">
                <label>Jenjang <span class="text-danger">*</span></label>
                <select name="jenjang" class="form-control" required>
                    <option value="">-- pilih --</option>
                    <option value="SMK" {{ $first->jenjang == 'SMK' ? 'selected' : '' }}>SMK</option>
                    <option value="SMP" {{ $first->jenjang == 'SMP' ? 'selected' : '' }}>SMP</option>
                </select>
            </div>

            <div class="col-md-3">
                <label>Kelas <span class="text-danger">*</span></label>
                <select name="kelas_id" class="form-control" required>
                    <option value="">-- pilih kelas --</option>
                    @foreach($kelas as $k)
                        <option value="{{ $k->id }}"
                            {{ $first->kelas_id == $k->id ? 'selected' : '' }}>
                            {{ $k->nama_kelas }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3">
                <label>Pengelola <span class="text-danger">*</span></label>
                <select name="user_id" class="form-control" required>
                    <option value="">-- pilih user --</option>
                    @foreach($user as $u)
                        <option value="{{ $u->id }}"
                            {{ $first->user_id == $u->id ? 'selected' : '' }}>
                            {{ $u->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3 mt-2">
                <label>Nama Wali <span class="text-danger">*</span></label>
                <input type="text" name="wali" class="form-control"
                    value="{{ old('wali', $first->wali) }}" required>
            </div>

        </div>

        <hr>

        {{-- TABEL SISWA --}}
        <div class="d-flex justify-content-between align-items-center mb-2">
            <label class="mb-0"><b>Daftar Siswa</b></label>
            <small class="text-muted">Total: {{ $siswa->count() }} siswa |
                Terpilih: {{ count($selected) }} siswa
            </small>
        </div>

        <div class="siswa-box">
            <table class="table table-bordered table-hover table-sm">
                <thead class="bg-info text-white text-center">
                    <tr>
                        <th width="5%">
                            <input type="checkbox" id="checkAll" title="Pilih Semua">
                        </th>
                        <th>NIS</th>
                        <th>Nama</th>
                        <th>Jenjang</th>
                        <th>Angkatan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($siswa as $s)
                        <tr>
                            <td class="text-center">
                                <input type="checkbox"
                                    class="siswa-check"
                                    name="siswa_id[]"
                                    value="{{ $s->id }}"
                                    {{ in_array($s->id, $selected) ? 'checked' : '' }}>
                            </td>
                            <td>{{ $s->nis ?? '-' }}</td>
                            <td>{{ $s->name }}</td>
                            <td class="text-center">{{ $s->jenjang ?? '-' }}</td>
                            <td class="text-center">{{ $s->angkatan ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-3">
                                <i class="fas fa-info-circle"></i> Tidak ada siswa ditemukan
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <br>

        <button type="submit" class="btn btn-primary">
            <i class="fas fa-save"></i> Update
        </button>

        <a href="{{ url('pembagian-kelas') }}" class="btn btn-secondary">
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
    document.getElementById('checkAll').addEventListener('change', function () {
        document.querySelectorAll('.siswa-check').forEach(c => c.checked = this.checked);
    });
</script>

</body>
</html>
@endif