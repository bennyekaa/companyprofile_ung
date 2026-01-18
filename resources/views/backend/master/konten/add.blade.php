@extends('backend.layout.app')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Konten</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Master</a></li>
                        <li class="breadcrumb-item"><a href="#">Konten</a></li>
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
                            <h3 class="card-title">Tambah Konten</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ url('master/konten/action') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="fungsi" value="tambah">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Kategori</label>
                                    <select class="custom-select rounded-0" id="kategori" name="kategori" required>
                                        <option value=""> -- Pilih Kategori --</option>
                                        @foreach ($kategori as $val)
                                            <option value="{{ $val->id }}">{{ $val->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- Field 1: Judul / Nama Universitas / Nama Gambar --}}
                                <div class="form-group">
                                    <label id="labelJudul">Judul</label>
                                    <input type="text" class="form-control" name="judul" placeholder="Masukkan Judul">
                                </div>

                                <div class="form-group">
                                    <label id="labelJudul">Detail</label>
                                    <input type="text" class="form-control" name="detail" placeholder="Masukkan Detail">
                                </div>

                                <div class="form-group">
                                    <label id="labelJudul">Deskripsi</label>
                                    <input type="text" class="form-control" name="deskripsi" placeholder="Masukkan Deskripsi">
                                </div>

                                {{-- Tanggal --}}
                                <div class="form-group">
                                    <label>Tanggal</label>
                                    <input type="text" class="form-control datepicker" name="tanggal"
                                        placeholder="Masukkan Tanggal">
                                </div>

                                {{-- Tanggal --}}
                                <div class="form-group">
                                    <label>Tanggal Aktif</label>
                                    <input type="text" class="form-control datepicker" name="tanggal_posting"
                                        placeholder="Masukkan Tanggal Aktif">
                                </div>

                                {{-- Keterangan (Summernote) -> default --}}
                                <div class="form-group">
                                    <label>Keterangan</label>
                                    <div class="col-sm-12">
                                        <textarea class="form-control" id="summernote" name="keterangan"></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Berkas</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="form-control" id="berkas" name="berkas"
                                                accept="image/*,video/*" onchange="return fileValidation_()">
                                            <div id="imagePreview" class="mt-2"></div>
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
        function fileValidation_() {
            const fileInput = document.getElementById('berkas');
            const file = fileInput.files[0];

            if (!file) return false;

            const allowedTypes = [
                'image/jpeg',
                'image/png',
                'image/gif',
                'video/mp4',
                'video/webm',
                'video/ogg'
            ];

            if (!allowedTypes.includes(file.type)) {
                alert('File harus berupa gambar atau video!');
                fileInput.value = '';
                return false;
            }

            const preview = document.getElementById('imagePreview');
            preview.innerHTML = '';

            const reader = new FileReader();
            reader.onload = (e) => {
                if (file.type.startsWith('image/')) {
                    preview.innerHTML =
                        `<img src="${e.target.result}" class="img-fluid" style="max-height:200px">`;
                } else if (file.type.startsWith('video/')) {
                    preview.innerHTML =
                        `<video src="${e.target.result}" controls style="max-height:200px; width:100%"></video>`;
                }
            };
            reader.readAsDataURL(file);

            return true; // ✅ wajib
        }

        document.addEventListener('DOMContentLoaded', function() {
            const selectKategori = document.getElementById('kategori');
            const labelJudul = document.getElementById('labelJudul');

            // Deskripsi
            const groupBrosur = document.getElementById('groupBrosur');
            const labelDeskripsi = document.getElementById('labelDeskripsi');
            const hintDeskripsi = document.getElementById('hintDeskripsi');
            const inputBrosur = document.getElementById('deskripsi');

            // Tanggal
            const groupTanggal = document.getElementById('groupTanggal');

            // Keterangan
            const groupKetHtml = document.getElementById('groupKetHtml'); // summernote
            const summernote = document.getElementById('summernote');

            const groupKetExpo = document.getElementById('groupKetExpo');
            const ketExpo = document.getElementById('ket_expo');

            const groupKetGambar = document.getElementById('groupKetGambar');
            const ketGambar = document.getElementById('ket_gambar');

            // 👉 SESUAIKAN dengan ID kategori "Gambar" di DB
            const GALLERY_CATEGORY_ID = '8';

            function setName(el, name) {
                if (el) el.setAttribute('name', name);
            }

            function removeName(el) {
                if (el) el.removeAttribute('name');
            }

            function toggleKategori() {
                const val = selectKategori ? selectKategori.value : '';
                const isEkspo = (val === '7');
                const isGambar = (val === GALLERY_CATEGORY_ID);

                // ===== LABEL JUDUL =====
                if (isEkspo) {
                    labelJudul.textContent = 'Nama Universitas';
                } else if (isGambar) {
                    labelJudul.textContent = 'Nama Gambar';
                } else {
                    labelJudul.textContent = 'Judul';
                }

                // ===== MODE EKspo =====
                if (isEkspo) {
                    // Deskripsi URL
                    groupBrosur.classList.remove('d-none');
                    inputBrosur.disabled = false;
                    inputBrosur.required = true;
                    inputBrosur.value = '';
                    inputBrosur.placeholder = 'https://contoh.com/brosur.pdf';
                    inputBrosur.setAttribute('type', 'url');

                    labelDeskripsi.textContent = 'Deskripsi (Link Brosur)';
                    hintDeskripsi.classList.remove('d-none');

                    // Tanggal ON
                    groupTanggal.classList.remove('d-none');

                    // Keterangan khusus ekspo (plain)
                    groupKetExpo.classList.remove('d-none');
                    ketExpo.disabled = false;
                    ketExpo.required = true;
                    setName(ketExpo, 'keterangan');

                    // Matikan summernote & textarea gambar
                    groupKetHtml.classList.add('d-none');
                    removeName(summernote);

                    groupKetGambar.classList.add('d-none');
                    ketGambar.disabled = true;
                    removeName(ketGambar);

                    return;
                }

                // ===== MODE GAMBAR =====
                if (isGambar) {
                    // Deskripsi teks biasa
                    groupBrosur.classList.remove('d-none');
                    inputBrosur.disabled = false;
                    inputBrosur.required = false;
                    inputBrosur.value = '';
                    inputBrosur.placeholder = 'Masukkan deskripsi gambar...';
                    inputBrosur.setAttribute('type', 'text');

                    labelDeskripsi.textContent = 'Deskripsi';
                    hintDeskripsi.classList.add('d-none');

                    // Tanggal OFF
                    groupTanggal.classList.add('d-none');

                    // Keterangan textarea biasa
                    groupKetGambar.classList.remove('d-none');
                    ketGambar.disabled = false;
                    setName(ketGambar, 'keterangan');

                    // Matikan summernote & ket_expo
                    groupKetHtml.classList.add('d-none');
                    removeName(summernote);

                    groupKetExpo.classList.add('d-none');
                    ketExpo.disabled = true;
                    ketExpo.required = false;
                    removeName(ketExpo);

                    return;
                }

                // ===== MODE BIASA =====
                // Deskripsi disembunyikan
                groupBrosur.classList.add('d-none');
                inputBrosur.disabled = true;
                inputBrosur.required = false;
                inputBrosur.value = '';
                inputBrosur.placeholder = 'https://contoh.com/brosur.pdf';
                inputBrosur.setAttribute('type', 'text');
                labelDeskripsi.textContent = 'Deskripsi (Link Brosur)';
                hintDeskripsi.classList.remove('d-none');

                // Tanggal ON
                groupTanggal.classList.remove('d-none');

                // Keterangan pakai summernote
                groupKetHtml.classList.remove('d-none');
                setName(summernote, 'keterangan');

                // Matikan ket_expo & ket_gambar
                groupKetExpo.classList.add('d-none');
                ketExpo.disabled = true;
                ketExpo.required = false;
                removeName(ketExpo);

                groupKetGambar.classList.add('d-none');
                ketGambar.disabled = true;
                removeName(ketGambar);
            }

            toggleKategori(); // inisialisasi
            if (selectKategori) {
                selectKategori.addEventListener('change', toggleKategori);
            }
        });
    </script>
@endsection
