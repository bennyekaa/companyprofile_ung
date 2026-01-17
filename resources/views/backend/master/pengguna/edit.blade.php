@extends('backend.layout.app')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Pengguna</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Master</a></li>
                        <li class="breadcrumb-item"><a href="#">Pengguna</a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Edit Pengguna</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ url('master/pengguna/action') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="fungsi" value="edit">
                            <input type="hidden" name="id" value="{{ encrypt($pengguna->id) }}">

                            <div class="card-body">
                                {{-- Role --}}
                                <div class="form-group">
                                    <label>Role</label>
                                    <select class="custom-select rounded-0" id="role" name="role" required>
                                        <option value=""> -- Pilih Role --</option>
                                        @foreach ($role as $val)
                                            <option value="{{ $val->id }}"
                                                {{ $pengguna->role == $val->id ? 'selected' : '' }}>
                                                {{ $val->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- Username --}}
                                <div class="form-group">
                                    <label id="labelUsername">Username</label>
                                    <input type="text" class="form-control" name="username"
                                        placeholder="Masukkan Username" value="{{ old('username', $pengguna->username) }}">
                                </div>

                                {{-- Password --}}
                                <div class="form-group">
                                    <label id="labelPassword">
                                        Password
                                        <small class="text-light">(kosongkan jika tidak ingin mengubah)</small>
                                    </label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" name="password" id="password"
                                            placeholder="Masukkan Password baru (opsional)">
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="togglePassword" style="cursor:pointer;">
                                                <ion-icon name="eye-off-outline"></ion-icon>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <div class="btn-group">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                    <a href="{{ url('master/pengguna') }}" class="btn btn-danger float-right">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

@section('tambahanjs')
    <script>
        // Toggle Lihat Password
        document.addEventListener('DOMContentLoaded', function() {
            const passwordInput = document.getElementById('password');
            const togglePassword = document.getElementById('togglePassword');
            let visible = false;

            if (togglePassword && passwordInput) {
                togglePassword.addEventListener('click', function() {
                    visible = !visible;
                    passwordInput.type = visible ? 'text' : 'password';
                    togglePassword.innerHTML = visible ?
                        '<ion-icon name="eye-outline"></ion-icon>' :
                        '<ion-icon name="eye-off-outline"></ion-icon>';
                });
            }
        });
    </script>
@endsection
