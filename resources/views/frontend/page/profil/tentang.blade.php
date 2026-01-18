@extends('frontend.page.layout.app')

@section('content')
    <!-- Page Title -->
    <div class="page-title" data-aos="fade">
        <div class="container">
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li class="current">Tentang Fakultas</li>
                </ol>
            </nav>
            <h1>Tentang Fakultas Kedokteran</h1>
        </div>
    </div>
    <!-- End Page Title -->

    <section id="starter-section" class="starter-section section">
        <div class="container" data-aos="fade-up">

            <!-- SEJARAH -->
            <div class="mb-5">
                <h2 class="mb-3">Sejarah Fakultas Kedokteran</h2>

                <p>
                    Pendirian Program Studi Kedokteran Universitas Negeri Gorontalo dimulai dengan pengusulan
                    Proposal Pembukaan Program Studi Pendidikan Dokter pada tahun 2009 kepada Kementerian Riset,
                    Teknologi, dan Pendidikan Tinggi. Namun proses tersebut belum dapat dilanjutkan karena adanya
                    moratorium pembukaan Program Studi Pendidikan Dokter oleh DIKTI pada tahun 2010.
                </p>

                <p>
                    Pada tahun 2015, moratorium dibuka kembali dengan persyaratan yang lebih kompleks. Namun,
                    proses pengajuan masih terkendala karena akreditasi institusi Universitas Negeri Gorontalo
                    belum keluar pada saat asesmen dokumen dilakukan.
                </p>

                <p>
                    Pada September 2017, pengajuan Program Studi Pendidikan Dokter kembali dibuka. Proposal kembali
                    diajukan dengan pendampingan Fakultas Kedokteran Universitas Hasanuddin sebagai fakultas mitra.
                    Setelah seluruh persyaratan terpenuhi, dilakukan asesmen lapangan pada 9 Januari 2019.
                </p>

                <p>
                    Izin operasional Program Studi Kedokteran Program Sarjana dan Program Studi Pendidikan Profesi
                    Dokter resmi diterbitkan pada 10 Januari 2019 berdasarkan SK Nomor 1/KTP/2019 dan diserahkan
                    langsung oleh Menteri Ristek Dikti kepada Rektor UNG pada 24 Januari 2019.
                </p>

                <p>
                    Program Studi Kedokteran UNG mulai menerima mahasiswa pada tahun akademik 2019/2020 dengan
                    kuota 50 mahasiswa. Hingga saat ini, jumlah mahasiswa aktif mencapai 150 orang dari tiga
                    angkatan.
                </p>
            </div>

            <!-- KURIKULUM -->
            <div class="mb-5">
                <h2 class="mb-3">Kurikulum</h2>

                <p>
                    Kurikulum Program Studi Kedokteran Universitas Negeri Gorontalo dikembangkan sesuai dengan
                    Standar Nasional Pendidikan Tinggi (SN-Dikti) dan dirancang untuk mendukung capaian
                    tridharma perguruan tinggi.
                </p>

                <p>
                    Kurikulum mencakup integrasi kegiatan penelitian dan pengabdian kepada masyarakat dalam proses
                    pembelajaran. Setiap dosen diharapkan melibatkan mahasiswa dalam kegiatan riset dan PkM
                    sebagai bagian dari penguatan kompetensi lulusan.
                </p>

                <p>
                    Profil lulusan mengacu pada konsep <strong>Five Star Doctor</strong> WHO dan WONCA, serta
                    Standar Kompetensi Dokter Indonesia dari KKI, dengan penekanan pada kegawatdaruratan bencana
                    sesuai visi misi program studi.
                </p>
            </div>

            <!-- DOSEN -->
            <div class="mb-5">
                <h2 class="mb-3">Daftar Dosen</h2>

                <div class="row">
                    @php
                        $dosen = [
                            'dr. Zuhriana K Yusuf, M.Kes',
                            'Dr. dr. Muhammad Isman Yusuf, Sp.S',
                            'Dr. dr. Vivien Novarina A. Kasim, M.Kes',
                            'dr. Sri Manovita Pateda, M.Kes., Ph.D',
                            'dr. St. Rahma, M.Kes',
                            'dr. Irmawati, M.Kes, Sp.N',
                            'dr. Elvie F. Dungga, M.Kes',
                            'dr. Nanang R. Paramata, M.Kes',
                            'dr. Edwina R. Monayo, M.Biomed',
                            'dr. Ivan Virnanda Amu, M.Kes, Sp.PD',
                            'dr. Winansih Gubali, Sp.Rad (K), M.Kes',
                            'dr. Vickry Wahiji, Sp.JP (K)',
                            'dr. Rahmawaty Samad, Sp.GK, M.Kes',
                            'dr. Rully Chandra Antuli, Sp.An',
                        ];
                    @endphp

                    @foreach ($dosen as $item)
                        <div class="col-md-6 col-lg-4 mb-2">
                            <i class="bi bi-person-badge me-2 text-success"></i>{{ $item }}
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- TENAGA KEPENDIDIKAN -->
            <div>
                <h2 class="mb-3">Tenaga Kependidikan</h2>

                <h5 class="mt-3">Laboran</h5>
                <ul>
                    <li>Wiranto A. Dunggio, S.Kep</li>
                    <li>Erwin Umar, S.Kep</li>
                    <li>Della Friska Kululu, A.Md.Kes</li>
                </ul>

                <h5 class="mt-3">Administrasi</h5>
                <ul>
                    <li>Sri Hayatiningsih Jusuf, M.Pd</li>
                    <li>Albert H. Mohammad, S.Sos</li>
                    <li>Zulfikar Puluhulawa, S.Sos</li>
                </ul>

                <h5 class="mt-3">IT</h5>
                <ul>
                    <li>Mohamad Aqil Yahudala, S.AP</li>
                </ul>
            </div>

        </div>
    </section>
@endsection
