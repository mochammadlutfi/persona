<x-landing-layout>
    <div class="js-slider slick-nav-black slick-dotted-inner slick-dotted-white" data-dots="true" data-arrows="true">
        <div class="slider-wrapper">
            <img class="img-fluid" src="/images/sliders/1.jpg" alt="">
        </div>
        <div class="slider-wrapper">
            <img class="img-fluid" src="/images/sliders/2.jpg" alt="">
        </div>
    </div>
    <div class="bg-white">
        <div class="content content-full" id="services">
            <div class="pt-5 pb-5">
                <div class="pb-4 position-relative">
                    <h2 class="fw-bold text-center mb-2">
                        Siapa
                        <span class="text-primary">Kami</span>?
                    </h2>
                </div>
                <div class="row g-6 py-2">
                    <div class="col-md-6">
                        <div class="w-100 py-4">
                            <p class="fw-medium text-muted">
                                Persona Public Speaking adalah lembaga pelatihan public speaking & presentation skill
                                yang memiliki visi untuk membangun sumber daya manusia (SDM) di indonesia yang unggul.
                            </p>
                            <p class="fw-medium text-muted">Fokus sasaran kami adalah membantu meningkatkan kompetensi
                                para peserta pelatihan di bidang communication skills, public speaking & presentation
                                skills. </p>
                            <p class="fw-medium text-muted">
                                Dengan berbekal kemampuan ini, mereka akan mampu menghadapi tantangan bisnis, meraih
                                akselerasi karir, dan meningkatkan kinerja secara keseluruhan di perusahaan atau
                                organisasi Anda.</p>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <iframe width="100%" height="400" src="https://www.youtube.com/embed/cMs0sre28lU"
                            title="Profile Persona Public Speaking - Lembaga Pelatihan Public Speaking" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="position-relative bg-body-extra-light">
        <div class="position-absolute top-0 end-0 bottom-0 start-0 bg-body-light skew-y-1"></div>
        <div class="position-relative">
            <div class="content content-full">
                <div class="pt-5 pb-5">
                    <div class="pb-4 position-relative">
                        <h2 class="fw-bold mb-2 text-center">
                            Kelas Terbaru <span class="text-primary">Kami</span>
                        </h2>
                    </div>
                    <div class="row py-2">
                        @foreach ($training as $t)
                        <div class="col-md-4">
                            <x-card-training :data="$t" />
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="position-relative bg-white">
        <div class="position-absolute top-0 end-0 bottom-0 start-0 bg-white skew-y-1"></div>
        <div class="position-relative">
            <div class="content content-full">
                <div class="pt-5 pb-5">
                    <div class="pb-4 position-relative">
                        <h2 class="fw-bold mb-2 text-center">
                            Kenapa Memilih <span class="text-primary">Kami</span>?
                        </h2>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-3">
                            <div class="text-center">
                                <img src="/images/icons/experience.png" class="icon-img mb-2"/>
                                <p class="fw-bold">Trainer Berpengalaman Lebih Dari 11 Tahun</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="text-center">
                                <img src="/images/icons/training.png" class="icon-img mb-2"/>
                                <p class="fw-bold">Metode pelatihan didesain praktis, interaktif dan aplikatif</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="text-center">
                                <img src="/images/icons/guide.png" class="icon-img mb-2"/>
                                <p class="fw-bold">Pendampingan peserta secara personal</p>
                            </div>
                        </div>
                    </div>
                    <div class="pb-4 position-relative">
                        <h2 class="fw-bold mb-2 text-center">
                            Layanan setelah <span class="text-primary">Training</span>
                        </h2>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-3">
                            <div class="text-center">
                                <img src="/images/icons/consultant.png" class="icon-img mb-2"/>
                                <p class="fw-bold">Gratis konsultasi dengan instruktur pelatihan</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="text-center">
                                <img src="/images/icons/data.png" class="icon-img mb-2"/>
                                <p class="fw-bold">Enrichment session dari para trainer persona public speaking</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="text-center">
                                <img src="/images/icons/meeting.png" class="icon-img mb-2"/>
                                <p class="fw-bold">Panggung berlatih khusus alumni dalam wadah persona Talks & Ngoper (Ngobrol Bareng Alumni Persona)</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bg-white">
        
        <div class="content content-full">
            <div class="pt-7 pb-5">
                <div class="position-relative">
                    <h2 class="fw-bold text-center mb-2">
                        Apa Kata
                        <span class="text-primary">Mereka</span>
                    </h2>
                </div>
            </div>
            <div class="row yt-gallery js-slider" data-autoplay="true" data-dots="true" data-arrows="true" data-slides-to-show="3">
                @foreach ($youtube as $y)
                <div class="col-md-4">
                    <a
                        class="block block-rounded yt-lightbox"
                        href="https://www.youtube.com/watch?v={{ $y }}">
                        <div class="block-content">
                            <img src="https://i2.ytimg.com/vi/{{ $y }}/hqdefault.jpg" class="img-fluid"/>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="bg-white">
        
        <div class="content content-full">
            <div class="pt-7 pb-5">
                <div class="position-relative">
                    <h2 class="fw-bold text-center mb-2">
                        Client
                        <span class="text-primary">Kami</span>
                    </h2>
                    <h3 class="h4 fw-medium text-muted text-center mb-5">
                        Pelanggan yang percaya dengan hasil kerja kami.
                    </h3>
                </div>
            </div>
            <div class="row justify-content-center js-gallery" id="client-list">
                @foreach ($clients as $c)
                <div class="col-md-2 animated fadeIn">
                  <a class="img-link img-link-zoom-in img-thumb img-lightbox" href="{{ $c }}">
                    <img class="img-fluid" src="{{ $c }}" alt="">
                  </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @push('styles')
    <link rel="stylesheet" href="/js/plugins/magnific-popup/magnific-popup.css">
    <link rel="stylesheet" href="/js/plugins/slick-carousel/slick.css">
    <link rel="stylesheet" href="/js/plugins/slick-carousel/slick-theme.css">
    <style>
        /**
        * Simple fade transition,
        */
        .slider-wrapper{
            width: 100%;
            height: 400px;
            overflow: hidden;
        }

        .slider-wrapper img{
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .mfp-fade.mfp-bg {
            opacity: 0;
            -webkit-transition: all 0.15s ease-out;
            -moz-transition: all 0.15s ease-out;
            transition: all 0.15s ease-out;
        }
        .mfp-fade.mfp-bg.mfp-ready {
            opacity: 0.8;
        }
        .mfp-fade.mfp-bg.mfp-removing {
            opacity: 0;
        }

        .mfp-fade.mfp-wrap .mfp-content {
            opacity: 0;
            -webkit-transition: all 0.15s ease-out;
            -moz-transition: all 0.15s ease-out;
            transition: all 0.15s ease-out;
        }
        .mfp-fade.mfp-wrap.mfp-ready .mfp-content {
            opacity: 1;
        }
        .mfp-fade.mfp-wrap.mfp-removing .mfp-content {
            opacity: 0;
        }

        </style>
    @endpush
    @push('scripts')
        <script src="/js/plugins/magnific-popup/jquery.magnific-popup.min.js"></script>
        <script src="/js/plugins/slick-carousel/slick.min.js"></script>
        <script>
            $('.js-gallery').addClass('js-gallery-enabled').magnificPopup({
                delegate: 'a.img-lightbox',
                type: 'image',
                gallery: {
                    enabled: true
                }
            });
            $('.yt-gallery').magnificPopup({
                delegate: 'a.yt-lightbox',
                disableOn: 700,
                type: 'iframe',
                mainClass: 'mfp-fade',
                removalDelay: 160,
                preloader: false,
                fixedContentPos: false,
                gallery: {
                    enabled: true
                }
            });

            $('.js-slider:not(.js-slider-enabled)').each((index, element) => {
            let el = $(element);

            // Add .js-slider-enabled class to tag it as activated and init it
            el.addClass('js-slider-enabled').slick({
                arrows: el.data('arrows') || false,
                dots: el.data('dots') || false,
                slidesToShow: el.data('slides-to-show') || 1,
                centerMode: el.data('center-mode') || false,
                autoplay: el.data('autoplay') || false,
                autoplaySpeed: el.data('autoplay-speed') || 3000,
                infinite: typeof el.data('infinite') === 'undefined' ? true : el.data('infinite')
            });
            });
        </script>
    @endpush
</x-landing-layout>