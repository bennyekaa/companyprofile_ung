@extends('backend.layout.app')

@section('content')
    <!-- Content Header -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Konten</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Master</a></li>
                        <li class="breadcrumb-item"><a href="#">Konten</a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">

                    <div class="card card-warning">
                        <div class="card-header">
                            <h3 class="card-title">Edit Konten</h3>
                        </div>

                        <form action="{{ url('master/konten/action') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="fungsi" value="edit">
                            <input type="hidden" name="id" value="{{ encrypt($konten->id) }}">

                            <div class="card-body">

                                {{-- Kategori --}}
                                <div class="form-group">
                                    <label>Kategori</label>
                                    <select class="custom-select rounded-0" name="kategori" required>
                                        @foreach ($kategori as $val)
                                            <option value="{{ $val->id }}"
                                                {{ $konten->id_kategori == $val->id ? 'selected' : '' }}>
                                                {{ $val->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- Judul --}}
                                <div class="form-group">
                                    <label>Judul</label>
                                    <input type="text" class="form-control" name="judul" value="{{ $konten->judul }}">
                                </div>

                                {{-- Detail --}}
                                <div class="form-group">
                                    <label>Detail</label>
                                    <input type="text" class="form-control" name="detail" value="{{ $konten->detail }}">
                                </div>

                                {{-- Deskripsi --}}
                                <div class="form-group">
                                    <label>Deskripsi</label>
                                    <input type="text" class="form-control" name="deskripsi"
                                        value="{{ $konten->deskripsi }}">
                                </div>

                                {{-- Tanggal --}}
                                <div class="form-group">
                                    <label>Tanggal</label>
                                    <input type="text" class="form-control datepicker" name="tanggal"
                                        value="{{ $konten->tanggal }}">
                                </div>

                                {{-- Tanggal Posting --}}
                                <div class="form-group">
                                    <label>Tanggal Aktif</label>
                                    <input type="text" class="form-control datepicker" name="tanggal_posting"
                                        value="{{ $konten->tanggal_posting }}">
                                </div>

                                {{-- Keterangan --}}
                                <div class="form-group">
                                    <label>Keterangan</label>
                                    <textarea class="form-control" id="summernote" name="keterangan">
                                    {!! $konten->keterangan !!}
                                    </textarea>
                                </div>

                                {{-- PREVIEW FILE LAMA --}}
                                @if ($konten->berkas)
                                    @php
                                        $ext = pathinfo($konten->berkas, PATHINFO_EXTENSION);
                                        $url = asset('storage/' . str_replace('public/', '', $konten->berkas));
                                    @endphp

                                    <div class="form-group">
                                        <label class="text-muted">Berkas Saat Ini</label><br>

                                        @if (in_array(strtolower($ext), ['jpg', 'jpeg', 'png', 'gif', 'webp']))
                                            <img src="{{ $url }}" style="max-height:200px;border-radius:8px">
                                        @elseif (in_array(strtolower($ext), ['mp4', 'webm', 'ogg']))
                                            <video src="{{ $url }}" controls
                                                style="max-height:200px;width:100%"></video>
                                        @endif
                                    </div>
                                @endif

                                {{-- GANTI FILE --}}
                                <div class="form-group">
                                    <label>Ganti Berkas (Opsional)</label>
                                    <input type="file" class="form-control" name="berkas" id="berkas"
                                        accept="image/*,video/*" onchange="return fileValidation_()">

                                    <small class="text-muted">
                                        Kosongkan jika tidak ingin mengganti gambar / video
                                    </small>

                                    <div id="imagePreview" class="mt-2"></div>
                                </div>

                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-warning">Update</button>
                                <a href="{{ session('konten') }}" class="btn btn-secondary">Kembali</a>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('tambahanjs')
    <script>
        function fileValidation_() {
            const fileInput = document.getElementById('berkas');
            const file = fileInput.files[0];
            if (!file) return false;

            const allowedTypes = [
                'image/jpeg', 'image/png', 'image/gif', 'image/webp',
                'video/mp4', 'video/webm', 'video/ogg'
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
                } else {
                    preview.innerHTML =
                        `<video src="${e.target.result}" controls style="max-height:200px;width:100%"></video>`;
                }
            };
            reader.readAsDataURL(file);

            return true;
        }
    </script>
@endsection
