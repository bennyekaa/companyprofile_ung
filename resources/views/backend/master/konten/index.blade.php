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
                        <li class="breadcrumb-item active">Konten</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">

        {{-- Flash Messages --}}
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
                            <div class="d-flex flex-wrap align-items-center justify-content-between">
                                <h3 class="card-title mb-2 mb-sm-0">Data Konten</h3>

                                <div class="d-flex flex-wrap align-items-center" style="gap:10px;">
                                    {{-- Filter Kategori --}}
                                    <div class="form-inline">
                                        <label for="filterKategori" class="mr-2 text-muted mb-0">Kategori</label>
                                        <select id="filterKategori" class="custom-select custom-select-sm border-primary"
                                            style="min-width:200px;">
                                            <option value="">Semua Kategori</option>
                                            @isset($kategori)
                                                @foreach ($kategori as $kat)
                                                    <option value="{{ $kat->nama }}">{{ $kat->nama }}</option>
                                                @endforeach
                                            @endisset
                                        </select>
                                    </div>

                                    {{-- Tombol Tambah --}}
                                    <a href="{{ url('master/konten/tambah') }}"
                                        class="btn btn-sm btn-primary shadow-sm">Tambah</a>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Judul</th>
                                        <th>Tanggal</th>
                                        <th>Tanggal Aktif</th>
                                        <th>Detail</th>
                                        <th>Deskripsi</th>
                                        <th>Keterangan</th>
                                        <th>Kategori</th>
                                        <th>Berkas</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $no = 1; @endphp
                                    @foreach ($konten as $item)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $item->judul }}</td>
                                            <td>{{ $item->tanggal?->format('d M Y') }}</td>
                                            <td>{{ $item->tanggal_posting?->format('d M Y') }}</td>
                                            <td>{{ $item->detail }}</td>
                                            <td>{{ $item->deskripsi }}</td>
                                            <td>{{ \Illuminate\Support\Str::limit(strip_tags($item->keterangan), 100, '...') }}
                                            </td>
                                            <td>{{ $item->kategori->nama }}</td>
                                            <td class="text-center">
                                                @if ($item->berkas)
                                                    @php
                                                        $ext = pathinfo($item->berkas, PATHINFO_EXTENSION);
                                                    @endphp

                                                    @if (in_array(strtolower($ext), ['jpg', 'jpeg', 'png', 'gif', 'webp']))
                                                        <img src="{{ asset('storage/' . str_replace('public/', '', $item->berkas)) }}"
                                                            alt="gambar" style="max-height:80px; border-radius:6px;">
                                                    @elseif (in_array(strtolower($ext), ['mp4', 'webm', 'ogg', 'avi']))
                                                        <video
                                                            src="{{ asset('storage/' . str_replace('public/', '', $item->berkas)) }}"
                                                            style="max-height:80px; width:120px;" controls></video>
                                                    @else
                                                        <span class="badge badge-secondary">File</span>
                                                    @endif
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>
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
                                                        <a href="{{ url('master/konten/status') }}/{{ encrypt($item->id) }}/1"
                                                            class="btn btn-success w-100" title="Aktifkan">
                                                            <ion-icon name="checkmark-circle-sharp"></ion-icon>
                                                        </a>
                                                    @else
                                                        <a href="{{ url('master/konten/status') }}/{{ encrypt($item->id) }}/0"
                                                            class="btn btn-danger w-100" title="Non-Aktif">
                                                            <ion-icon name="close-sharp"></ion-icon>
                                                        </a>
                                                    @endif
                                                    {{-- <a href="#" class="btn btn-dark w-100"
                                                        title="Lihat Data"><ion-icon name="eye"></ion-icon></a>
                                                    <a href="#" class="btn btn-secondary w-100"
                                                        title="Lihat Berkas"><ion-icon name="document"></ion-icon></a> --}}
                                                    <a href="{{ url('master/konten/edit') }}/{{ encrypt($item->id) }}"
                                                        class="btn btn-warning w-100" title="Edit"><ion-icon
                                                            name="pencil-sharp"></ion-icon></a>
                                                    <a href="{{ url('master/konten/hapus') }}/{{ encrypt($item->id) }}"
                                                        class="btn btn-danger btn-hapus" title="Hapus"><ion-icon
                                                            name="ban-sharp"></ion-icon></a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div><!-- /.card -->

                </div>
            </div>
        </div>
    </section>
@endsection

@section('tambahanjs')
    <script>
        $(function() {
            const table = $("#example1").DataTable({
                responsive: true,
                lengthChange: false,
                autoWidth: false,
                stateSave: true,
                language: {
                    searchPlaceholder: "Cari data...",
                    search: "",
                    info: "Menampilkan _START_–_END_ dari _TOTAL_ data",
                    paginate: {
                        previous: "←",
                        next: "→"
                    }
                },
                buttons: [{
                        extend: "copy",
                        className: "btn btn-sm btn-light border mr-1"
                    },
                    {
                        extend: "excel",
                        className: "btn btn-sm btn-success border mr-1"
                    },
                    {
                        extend: "pdf",
                        className: "btn btn-sm btn-danger border mr-1"
                    },
                    {
                        extend: "print",
                        className: "btn btn-sm btn-info border mr-1"
                    },
                    {
                        extend: "colvis",
                        className: "btn btn-sm btn-secondary border"
                    }
                ]
            });

            table.buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

            // Bangun opsi dropdown dari tabel jika $kategori tidak ada
            @empty($kategori)
                (function() {
                    const data = table.column(7).data().toArray(); // kolom "Kategori" (0-based)
                    const unique = [...new Set(data)].filter(Boolean).sort();
                    const $sel = $('#filterKategori').empty().append(
                        '<option value="">Semua Kategori</option>');
                    unique.forEach(v => $sel.append(`<option value="${v}">${v}</option>`));
                })();
            @endempty

            // Filter kategori (exact match, regex ^...$)
            $('#filterKategori').on('change', function() {
                const val = $(this).val();
                table.column(7).search(val ? '^' + $.fn.dataTable.util.escapeRegex(val) + '$' : '', true,
                    false).draw();
            });
        });
    </script>
@endsection
