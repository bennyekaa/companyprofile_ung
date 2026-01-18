@extends('frontend.layout.app')

@section('content')
    <!-- Hero Section -->
    <section id="hero" class="hero hero-bg">

        <div class="swiper hero-swiper">
            <div class="swiper-wrapper">

                @foreach ($hero as $item)
                    @php
                        $ext = strtolower(pathinfo($item->berkas, PATHINFO_EXTENSION));
                        $src = asset('storage/' . str_replace('public/', '', $item->berkas));
                    @endphp

                    <div class="swiper-slide hero-slide">

                        @if (in_array($ext, ['mp4', 'webm', 'ogg', 'avi']))
                            <video class="hero-video" muted playsinline>
                                <source src="{{ $src }}" type="video/{{ $ext }}">
                            </video>
                        @else
                            <div class="hero-image" style="background-image: url('{{ $src }}')"></div>
                        @endif

                        <div class="hero-overlay"></div>

                        {{-- <div class="container position-relative hero-content">
                            <div class="row justify-content-center text-center">
                                <div class="col-lg-10">
                                    <h1 class="hero-title">{{ $item->detail }}</h1>
                                    <h2 class="hero-subtitle">{{ $item->deskripsi }}</h2>
                                </div>
                            </div>
                        </div> --}}

                    </div>
                @endforeach

            </div>

            <div class="swiper-pagination"></div>
        </div>

    </section>

    <!-- /Hero Section -->

    <!-- Recent Blog Postst Section -->
    <section id="recent-blog-postst" class="recent-blog-postst section light-background">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>INFORMASI</h2>
            {{-- <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p> --}}
        </div><!-- End Section Title -->

        <div class="container">

            <div class="row gy-5">

                @forelse ($informasi as $item)
                    <div class="col-xl-4 col-md-6">
                        <div class="post-item position-relative h-100" data-aos="fade-up" data-aos-delay="100">

                            <div class="post-img position-relative overflow-hidden">
                                <img src="{{ asset('storage/' . str_replace('public/', '', $item->berkas)) }}"
                                    class="img-fluid" alt="{{ $item->judul }}">
                                <span class="post-date">
                                    {{ $item->tanggal->format('d M Y') }}
                                </span>
                            </div>

                            <div class="post-content d-flex flex-column">

                                <h3 class="post-title">{{ $item->judul }}</h3>

                                {{-- <div class="meta d-flex align-items-center">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-person"></i> <span class="ps-2">Julia Parker</span>
                                    </div>
                                    <span class="px-3 text-black-50">/</span>
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-folder2"></i> <span class="ps-2">Politics</span>
                                    </div>
                                </div> --}}

                                <hr>

                                <a href="blog-details.html" class="readmore stretched-link"><span>Read More</span><i
                                        class="bi bi-arrow-right"></i></a>

                            </div>

                        </div>
                    </div><!-- End post item -->

                @empty
                    <div class="swiper-slide">
                        <p class="text-center">Belum ada Berita tersedia.</p>
                    </div>
                @endforelse
            </div>
            @if ($informasi->count() > 2)
            <div class="text-center mt-4">
                <a href="#" class="btn btn-outline-primary">
                    Baca Selengkapnya
                </a>
            </div>
            @endif

        </div>

    </section><!-- /Recent Blog Postst Section -->
    <!-- Testimonials Section -->
    <section id="testimonials" class="testimonials section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>AGENDA</h2>
            {{-- <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p> --}}
        </div><!-- End Section Title -->

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="swiper init-swiper">
                <script type="application/json" class="swiper-config">
            {
              "loop": true,
              "speed": 600,
              "autoplay": {
                "delay": 5000
              },
              "slidesPerView": "auto",
              "pagination": {
                "el": ".swiper-pagination",
                "type": "bullets",
                "clickable": true
              }
            }
          </script>
                <div class="swiper-wrapper">

                    @forelse ($agenda as $item)
                        <div class="swiper-slide">
                            <div class="testimonial-item">
                                {{-- <img src="frontend/assets/img/person/person-m-9.webp" class="testimonial-img" alt=""> --}}
                                {{-- <h3>{{$item->judul}}</h3> --}}
                                <h3>{{ $item->detail }}</h3>
                                <h4>{{ $item->tanggal->format('d M Y') }}</h4>
                                {{-- <div class="stars">
                                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                    class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                    class="bi bi-star-fill"></i>
                            </div> --}}
                                <p>
                                    {{-- <i class="bi bi-quote quote-icon-left"></i> --}}
                                    <span>{{ $item->deskripsi }}</span>
                                    {{-- <i class="bi bi-quote quote-icon-right"></i> --}}
                                </p>
                            </div>
                        </div><!-- End testimonial item -->
                    @empty
                        <div class="swiper-slide">
                            <p class="text-center">Belum ada Agenda tersedia.</p>
                        </div>
                    @endforelse
                </div>
                <div class="swiper-pagination"></div>
            </div>

        </div>

    </section><!-- /Testimonials Section -->
@endsection
@section('tambahanjs')
    <script>
        const heroSwiper = new Swiper('.hero-swiper', {
            loop: true,
            speed: 800,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true
            },
            on: {
                slideChange: function() {
                    document.querySelectorAll('.hero-video').forEach(v => {
                        v.pause();
                        v.currentTime = 0;
                    });

                    const activeVideo = this.slides[this.activeIndex].querySelector('.hero-video');
                    if (activeVideo) {
                        activeVideo.play();
                    }
                }
            }
        });
    </script>
@endsection
