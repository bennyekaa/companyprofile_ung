@extends('backend.layout.app')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Kelompok</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Master</a></li>
                        <li class="breadcrumb-item active">Kelompok</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show mx-3 mt-2" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show mx-3 mt-2" role="alert">
                {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Kelompok</h3>
                            <div class="card-tools">
                                <ul class="nav nav-pills ml-auto">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="{{ url('master/kelompok/tambah') }}">Tambah</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th>Keterangan</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($kelompok as $item)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $item->nama }}</td>
                                            <td>{{ $item->keterangan }}</td>
                                            <td>
                                                @if ($item->status == 0)
                                                    <button type="button"
                                                        class="btn btn-block bg-gradient-danger disabled">Tidak
                                                        Aktif</button>
                                                @else
                                                    <button type="button"
                                                        class="btn btn-block bg-gradient-success disabled">Aktif</button>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    @if ($item->status == 0)
                                                        <a href="{{ url('master/kelompok/status') }}/{{ encrypt($item->id) }}/1"
                                                            class="btn btn-success w-100" title="Aktifkan"><ion-icon
                                                                name="checkmark-circle-sharp"></ion-icon></a>
                                                    @else
                                                        <a href="{{ url('master/kelompok/status') }}/{{ encrypt($item->id) }}/0"
                                                            class="btn btn-danger w-100" title="Non-Aktif"><ion-icon
                                                                name="close-sharp"></ion-icon></a>
                                                    @endif
                                                    <a href="{{ url('master/kelompok/edit') }}/{{ encrypt($item->id) }}"
                                                        class="btn btn-warning w-100" title="Edit"><ion-icon
                                                            name="pencil-sharp"></ion-icon></a>
                                                    <a href="{{ url('master/kelompok/hapus') }}/{{ encrypt($item->id) }}"
                                                        class="btn btn-danger btn-hapus" title="Hapus"><ion-icon
                                                            name="ban-sharp"></ion-icon></a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
@section('tambahanjs')
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
@endsection
