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
        
        .drop-area {
            border:2px dashed green;
            height:200px;
            display:flex;
            justify-content:center;
            align-items:center;
            position:relative;
            cursor:pointer;
        }
        #preview-img {
            position:absolute;
            width:100%;
            height:100%;
            object-fit:cover;
            display:none;
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
                        <h1 class="m-0 text-info"><i class="fas fa-school"></i> Data Siswa</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="">Home</a></li>
                            <li class="breadcrumb-item active">Data Siswa</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="card card-info card-outline shadow-sm">
                <div class="card-header d-flex align-items-center">
                    <h5 class="mb-0"><b>Data Siswa</b></h5>
                    <div class="card-tools ml-auto">
                        <button class="btn btn-success" data-toggle="modal" data-target="#modalTambahStudent">
                            <i class="fas fa-plus-square"></i> Tambah Data
                        </button>
                    </div>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover mb-0">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th width="10%">Foto</th>
                                    <th>NIS</th>
                                    <th>NISN</th>
                                    <th>Nama Siswa</th>
                                    <th>JK</th>
                                    <th>Angkatan</th>
                                    <th>Jenjang</th>
                                    <th>Ket</th>
                                    <th width="15%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($dtstudent as $item)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}.</td>
                                    <td class="text-center">
                                        @if($item->foto)
                                            <img src="{{ asset($item->foto) }}" width="30" height="30" style="object-fit:cover; border-radius:50%;">
                                        @else
                                            <span class="text-muted"><i>Tidak ada</i></span>
                                        @endif
                                    </td>
                                    <td>{{ $item->nis }}</td>
                                    <td>{{ $item->nisn }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->jk }}</td>
                                    <td>{{ $item->angkatan }}</td>
                                    <td>{{ $item->jenjang }}</td>
                                    <td>{{ $item->ket }}</td>
                                    <td class="text-center">
                                        <button class="btn btn-primary btn-sm btn-action"
                                                data-toggle="modal"
                                                data-target="#modalEditStudent{{ $item->id }}">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <a href="{{ url('delete-student', $item->id) }}"
                                           class="btn btn-danger btn-sm btn-action"
                                           onclick="return confirm('Yakin ingin menghapus data ini?')">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>

                                {{-- Modal Edit --}}
                                @include('student.edit_data_student')

                                @empty
                                <tr>
                                    <td colspan="10" class="text-center text-muted">Tidak ada data siswa</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card-footer text-center">
                    {{ $dtstudent->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>

    @include('template.footer')
</div>

@include('student.tambah_data_student')
@include('template.script')

<script>
    const dropArea = document.getElementById('drop-area');
    const fileInput = document.getElementById('fileElem');
    const preview = document.getElementById('preview-img');
    const text = document.getElementById('text-drop');

    // klik
    dropArea.onclick = () => fileInput.click();

    // pilih file
    fileInput.onchange = () => handleFile(fileInput.files[0]);

    // drag over
    dropArea.ondragover = (e) => e.preventDefault();

    // drop
    dropArea.ondrop = (e) => {
        e.preventDefault();
        handleFile(e.dataTransfer.files[0]);
    };

    // preview
    function handleFile(file){
        if(!file) return;

        const reader = new FileReader();
        reader.onload = e => {
            preview.src = e.target.result;
            preview.style.display = 'block';
            text.style.display = 'none';
        }
        reader.readAsDataURL(file);

        let dt = new DataTransfer();
        dt.items.add(file);
        fileInput.files = dt.files;
    }

    //edit
    document.addEventListener("DOMContentLoaded", function () {

    @foreach($dtstudent as $item)

    const drop{{ $item->id }} = document.getElementById('drop-area-{{ $item->id }}');
    const input{{ $item->id }} = document.getElementById('fileElem-{{ $item->id }}');
    const preview{{ $item->id }} = document.getElementById('preview-img-{{ $item->id }}');
    const text{{ $item->id }} = document.getElementById('text-drop-{{ $item->id }}');

    drop{{ $item->id }}.onclick = () => input{{ $item->id }}.click();

    input{{ $item->id }}.onchange = () =>
        handleFile(input{{ $item->id }}.files[0], preview{{ $item->id }}, text{{ $item->id }}, input{{ $item->id }});

    drop{{ $item->id }}.ondragover = (e) => e.preventDefault();

    drop{{ $item->id }}.ondrop = (e) => {
        e.preventDefault();
        handleFile(e.dataTransfer.files[0], preview{{ $item->id }}, text{{ $item->id }}, input{{ $item->id }});
    };

    @endforeach

    function handleFile(file, preview, text, input){
        if(!file) return;

        const reader = new FileReader();
        reader.onload = e => {
            preview.src = e.target.result;
            preview.style.display = 'block';
            text.style.display = 'none';
        }
        reader.readAsDataURL(file);

        let dt = new DataTransfer();
        dt.items.add(file);
        input.files = dt.files;
    }
});
</script>
</body>
</html>
@endif