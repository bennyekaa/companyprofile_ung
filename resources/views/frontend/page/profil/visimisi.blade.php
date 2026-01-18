@extends('frontend.page.layout.app')

@section('content')
    <!-- Page Title -->
    <div class="page-title" data-aos="fade">
        <div class="container">
            <nav class="breadcrumbs">
                <ol>
                    <li>Profil</li>
                    <li class="current">Visi Dan Misi</li>
                </ol>
            </nav>
            <h1>Visi Dan Misi Fakultas Kedokteran UNG</h1>
        </div>
    </div><!-- End Page Title -->

    <!-- Content Section -->
    <section id="starter-section" class="starter-section section">
        <div class="container" data-aos="fade-up">

            {{-- ================= VISI FAKULTAS ================= --}}
            <h2 class="mb-3">Visi Fakultas Kedokteran UNG</h2>
            <blockquote class="fst-italic">
                “Menjadi Fakultas yang menghasilkan lulusan yang unggul dan berdaya saing
                di bidang Kedokteran Gawat Darurat Bencana di Kawasan Timur Indonesia.”
            </blockquote>

            {{-- ================= MISI FAKULTAS ================= --}}
            <h3 class="mt-4">Misi Fakultas Kedokteran UNG</h3>
            <ol>
                <li>Mengembangkan pendidikan kedokteran yang unggul dan berdaya saing untuk menghasilkan lulusan yang
                    berkarakter dan profesional, terutama dalam penguasaan teknologi.</li>
                <li>Meningkatkan kompetensi penelitian yang inovatif berbasis kearifan lokal, sains, dan teknologi.</li>
                <li>Mengembangkan kegiatan pengabdian kepada masyarakat dalam rangka meningkatkan pengetahuan dan
                    kesejahteraan masyarakat untuk menunjang pembangunan daerah dan nasional.</li>
                <li>Meningkatkan kerja sama yang bermanfaat dalam meningkatkan daya saing pengembangan pendidikan
                    kedokteran.</li>
                <li>Menyelenggarakan tata kelola yang efektif, efisien, transparan, dan akuntabel dalam pengembangan mutu.
                </li>
            </ol>

            {{-- ================= VISI PRODI KEDOKTERAN ================= --}}
            <h2 class="mt-5 mb-3">Visi Program Studi Kedokteran UNG</h2>
            <blockquote class="fst-italic">
                “Mengembangkan keilmuan kedokteran yang unggul dan berdaya saing dengan
                kekhususan Gawat Darurat Bencana di Kawasan Timur Indonesia pada Tahun 2035.”
            </blockquote>

            {{-- ================= MISI PRODI KEDOKTERAN ================= --}}
            <h3 class="mt-4">Misi Program Studi Kedokteran UNG</h3>
            <ol>
                <li>Menyelenggarakan pendidikan kedokteran dan profesi dokter yang unggul dan berdaya saing untuk
                    menghasilkan lulusan yang berkarakter, profesional, dan kompetitif, khususnya di bidang kegawatdaruratan
                    bencana.</li>
                <li>Mengembangkan dan menyelenggarakan penelitian yang inovatif, terutama pada isu kegawatdaruratan bencana
                    yang berbasis nilai budaya, sains, dan teknologi.</li>
                <li>Menyelenggarakan pengabdian kepada masyarakat yang bersifat responsif bencana untuk meningkatkan
                    pengetahuan dan kesiapsiagaan masyarakat.</li>
                <li>Mengembangkan jejaring kerja sama di tingkat lokal, nasional, dan internasional untuk menunjang
                    Tridharma Perguruan Tinggi.</li>
                <li>Menyelenggarakan tata kelola program studi yang efektif, akuntabel, adaptif, dan berorientasi mutu
                    sesuai PPEPP.</li>
            </ol>

            {{-- ================= VISI PRODI PROFESI DOKTER ================= --}}
            <h2 class="mt-5 mb-3">Visi Program Studi Profesi Dokter</h2>
            <blockquote class="fst-italic">
                “Mengembangkan keilmuan profesi dokter yang unggul dan berdaya saing dengan
                fokus pada kompetensi layanan kegawatdaruratan bencana di Kawasan Timur Indonesia Tahun 2035.”
            </blockquote>

            {{-- ================= MISI PRODI PROFESI DOKTER ================= --}}
            <h3 class="mt-4">Misi Program Studi Profesi Dokter</h3>
            <ol>
                <li>Menyelenggarakan pendidikan kedokteran dan profesi dokter yang unggul dan berdaya saing untuk
                    menghasilkan lulusan berkarakter, profesional, dan kompetitif di bidang kegawatdaruratan bencana.</li>
                <li>Mengembangkan dan menyelenggarakan penelitian inovatif pada isu kegawatdaruratan bencana berbasis nilai
                    budaya, sains, dan teknologi.</li>
                <li>Menyelenggarakan pengabdian kepada masyarakat yang responsif bencana untuk meningkatkan kesiapsiagaan
                    dan pengetahuan masyarakat.</li>
                <li>Mengembangkan jejaring kerja sama yang luas di tingkat lokal, nasional, dan internasional guna menunjang
                    Tridharma Perguruan Tinggi.</li>
                <li>Menyelenggarakan tata kelola program studi yang efektif, akuntabel, adaptif, dan berorientasi mutu
                    sesuai PPEPP.</li>
            </ol>

            {{-- ================= PROFIL LULUSAN ================= --}}
            <h2 class="mt-5 mb-3">Profil Lulusan</h2>
            <ol>
                <li>Lulusan yang berkarakter, profesional, dan berdaya saing di bidang kegawatdaruratan bencana.</li>
                <li>Mampu mengembangkan penelitian inovatif berbasis nilai budaya, sains, dan teknologi.</li>
                <li>Mampu melaksanakan pengabdian kepada masyarakat yang responsif terhadap bencana.</li>
                <li>Mampu mengembangkan jejaring kerja sama di tingkat lokal, nasional, dan internasional.</li>
                <li>Mampu berperan dalam tata kelola institusi yang efektif, akuntabel, adaptif, dan berorientasi mutu.</li>
            </ol>

        </div>
    </section><!-- /Content Section -->
@endsection
