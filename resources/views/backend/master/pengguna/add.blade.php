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
                        <li class="breadcrumb-item active">Tambah</li>
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
                            <h3 class="card-title">Tambah Pengguna</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ url('master/pengguna/action') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="fungsi" value="tambah">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Role</label>
                                    <select class="custom-select rounded-0" id="role" name="role" required>
                                        <option value=""> -- Pilih Role --</option>
                                        @foreach ($role as $val)
                                            <option value="{{ $val->id }}">{{ $val->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label id="labelUsername">Username</label>
                                    <input type="text" class="form-control" name="username"
                                        placeholder="Masukkan Username">
                                </div>

                                <div class="form-group">
                                    <label id="labelPassword">Password</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" name="password" id="password"
                                            placeholder="Masukkan Password">
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
                                    <button type="submit" class="btn btn-primary">Tambah</button>
                                    <button type="submit" class="btn btn-danger float-right">Cancel</button>
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

            togglePassword.addEventListener('click', function() {
                visible = !visible;
                passwordInput.type = visible ? 'text' : 'password';
                togglePassword.innerHTML = visible ?
                    '<ion-icon name="eye-outline"></ion-icon>' :
                    '<ion-icon name="eye-off-outline"></ion-icon>';
            });
        });
    </script>
    <script>
        function fileValidation_() {
            const fileInput = document.getElementById('berkas');
            const filePath = fileInput.value;
            const allowed = /(\.jpg|\.jpeg|\.png|\.gif)$/i;

            if (!allowed.exec(filePath)) {
                alert('Type File tidak sesuai!');
                fileInput.value = '';
                return false;
            }
            if (fileInput.files && fileInput.files[0]) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    document.getElementById('imagePreview').innerHTML =
                        '<img src="' + e.target.result + '" class="img-fluid" style="max-height:200px">';
                };
                reader.readAsDataURL(fileInput.files[0]);
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            const selectKategori = document.getElementById('kategori');
            const labelJudul = document.getElementById('labelJudul');

            // Brosur
            const groupBrosur = document.getElementById('groupBrosur');
            const inputBrosur = document.getElementById('deskripsi');

            // Keterangan
            const groupKetHtml = document.getElementById('groupKetHtml');
            const summernote = document.getElementById('summernote');

            const groupKetExpo = document.getElementById('groupKetExpo');
            const ketExpo = document.getElementById('ket_expo');

            function setName(el, name) {
                if (el) el.setAttribute('name', name);
            }

            function removeName(el) {
                if (el) el.removeAttribute('name');
            }

            function toggleEkspo() {
                const isEkspo = (selectKategori && selectKategori.value === '7');

                // Judul
                if (labelJudul) labelJudul.textContent = isEkspo ? 'Nama Universitas' : 'Judul';

                // Brosur (deskripsi)
                if (isEkspo) {
                    groupBrosur.classList.remove('d-none');
                    inputBrosur.disabled = false;
                    inputBrosur.required = true;
                } else {
                    groupBrosur.classList.add('d-none');
                    inputBrosur.required = false;
                    inputBrosur.disabled = true;
                    inputBrosur.value = '';
                }

                // Keterangan
                if (isEkspo) {
                    // tampilkan textarea plain, sembunyikan summernote
                    groupKetExpo.classList.remove('d-none');
                    groupKetHtml.classList.add('d-none');

                    ketExpo.disabled = false;
                    ketExpo.required = true;
                    setName(ketExpo, 'keterangan');

                    // summernote jangan ikut submit
                    removeName(summernote);
                    if (summernote) summernote.required = false;
                } else {
                    // tampilkan summernote, sembunyikan textarea plain
                    groupKetExpo.classList.add('d-none');
                    groupKetHtml.classList.remove('d-none');

                    ketExpo.disabled = true;
                    ketExpo.required = false;
                    removeName(ketExpo);

                    setName(summernote, 'keterangan');
                    // kalau mau wajib di kategori lain:
                    // if (summernote) summernote.required = true;
                }
            }

            toggleEkspo(); // inisialisasi saat halaman load (menghormati nilai awal)
            if (selectKategori) {
                selectKategori.addEventListener('change', toggleEkspo);
            }
        });
    </script>
@endsection
