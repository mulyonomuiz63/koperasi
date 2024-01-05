<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="Content-type" content="text/html;charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta property="og:title" content="Koperasi multi pihak surya makmur agro teknologi" />
    <meta property="og:url" content="<?= base_url('/'); ?>" />
    <meta property="og:description" content="Koperasi multi pihak surya makmur agro teknologi membangun sebuah kepercayaan terhadap masyarakat tentu bukanlah hal yang mudah, apalagi bagi sebuah perusahaan Koperasi yang lahir dan tumbuh di daerah, berawal dari sebuah cita-cita membangun ekonomi dari Daerah" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="KOPERASI MULTI PIHAK SURYA MAKMUR AGRO TEKNOLOGI">

    <title>Koperasi multi pihak surya makmur agro teknologi</title>

    <!-- Favicons -->
    <link rel="shortcut icon" href="<?= base_url('assets/media/logos/favicon.png') ?>" />


    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Source+Sans+Pro:ital,wght@0,300;0,400;0,600;0,700;1,300;1,400;1,600;1,700&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="<?php echo (base_url('assetLanding/vendor/bootstrap/css/bootstrap.min.css')) ?>" rel="stylesheet">
    <link href="<?php echo (base_url('assetLanding/vendor/bootstrap-icons/bootstrap-icons.css')) ?>" rel="stylesheet">
    <link href="<?php echo (base_url('assetLanding/vendor/aos/aos.css')) ?>" rel="stylesheet">
    <link href="<?php echo (base_url('assetLanding/vendor/glightbox/css/glightbox.min.css')) ?>" rel="stylesheet">
    <link href="<?php echo (base_url('assetLanding/vendor/swiper/swiper-bundle.min.css')) ?>" rel="stylesheet">


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@3.6.12/dist/css/splide.min.css">


    <!-- Variables CSS Files. Uncomment your preferred color scheme -->
    <link href="<?php echo (base_url('assetLanding/css/variables.css')) ?>" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="<?php echo (base_url('assetLanding/css/main.css')) ?>" rel="stylesheet">

    <style>
        .splide__slide {
            height: 100% !important;
        }
    </style>

</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top" data-scrollto-offset="0">
        <div class="container-fluid d-flex align-items-center justify-content-between">

            <a href="<?php echo base_url("/") ?>" class=" d-flex align-items-center scrollto me-auto me-lg-0">
                <img src="<?= base_url('assets/media/logos/logo-light.png'); ?>" style="width:200px; height:60px">
            </a>

            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="nav-link scrollto" href="#">Home</a></li>
                    <li><a class="nav-link scrollto" href="index.html#about">Tentang Kami</a></li>
                    <li><a class="nav-link scrollto" href="index.html#services">Produk</a></li>
                    <li><a class="nav-link scrollto" href="index.html#contact">Kontak</a></li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle d-none"></i>
            </nav><!-- .navbar -->

            <a class="btn-getstarted scrollto" href="<?php echo base_url('login') ?>">Masuk</a>

        </div>
    </header><!-- End Header -->

    <section id="hero-animated" class="hero-animated d-flex align-items-center">
        <div class="container d-flex flex-column justify-content-center align-items-center text-center position-relative" data-aos="zoom-out">
            <img src="<?php echo (base_url('uploads/landing/tanamankopi.png')) ?>" height="300" width="300" class="img-fluid animated">
            <h4>Hello Rekan <span>KMP Smart</span></h4>
            <p>Selamat datang di media kmp smart.</p>
        </div>
    </section>

    <main id="main">

        <!-- ======= Featured Services Section ======= -->
        <section id="featured-services" class="featured-services">
            <div class="container">

                <div class="row gy-4">

                    <div class="col-xl-4 col-md-6 d-flex" data-aos="zoom-out">
                        <div class="service-item position-relative">
                            <div class="icon"><i class="bi bi-activity icon"></i></div>
                            <h4><a href="" class="stretched-link">Berstandar</a></h4>
                            <p>Kemudahan dalam penjualan produk dibidang pertanian Khususnya pada kopi</p>
                        </div>
                    </div><!-- End Service Item -->

                    <div class="col-xl-4 col-md-6 d-flex" data-aos="zoom-out" data-aos-delay="200">
                        <div class="service-item position-relative">
                            <div class="icon"><i class="bi bi-bounding-box-circles icon"></i></div>
                            <h4><a href="" class="stretched-link">Aman DalamTransaksi</a></h4>
                            <p>Setiap transaksi melakukan penjualan dan pembelian data terjaga keamanannya oleh sistem kmpsmart kami</p>
                        </div>
                    </div><!-- End Service Item -->


                    <div class="col-xl-4 col-md-6 d-flex" data-aos="zoom-out" data-aos-delay="600">
                        <div class="service-item position-relative">
                            <div class="icon"><i class="bi bi-broadcast icon"></i></div>
                            <h4><a href="" class="stretched-link">Beroprasi</a></h4>
                            <p>Aplikasi KMP Smart dapat di akses kapan saja dan dimana saja 24 jam tanpa batas</p>
                        </div>
                    </div><!-- End Service Item -->

                </div>

            </div>
        </section><!-- End Featured Services Section -->

        <!-- ======= About Section ======= -->
        <section id="about" class="about">
            <div class="container" data-aos="fade-up">

                <div class="section-header">
                    <h2>Mengenal KMP Smart</h2>
                    <p>
                        Membangun sebuah kepercayaan terhadap masyarakat tentu bukanlah hal yang mudah, apalagi bagi sebuah perusahaan Koperasi yang lahir dan tumbuh di daerah, berawal dari sebuah cita-cita membangun ekonomi dari Daerah, KMP Smart mencoba menjawab tantangan itu dengan pendekatan melalui sebuah tekhnologi, namun hal itu tidak semudah membalik telapak tangan, dengan berbagai macam warna masyarakat daerah, sosialisasi dan edukasi menjadi hal yang sangat penting guna mengoptimalkan daya guna teknologi di daerah.
                    </p>
                </div>
            </div>
        </section><!-- End About Section -->

        <!-- ======= Call To Action Section ======= -->
        <section id="cta" class="cta">
            <div class="container" data-aos="zoom-out">

                <div class="row g-5">

                    <div class="col-lg-8 col-md-6 content d-flex flex-column justify-content-center order-last order-md-first">
                        <h3>Segara <em>jual atau beli hasil pertanian di KMP Smart</em>...</h3>
                        <p> Kami akan melayani penjualan dan pembelian hasil pertanian, silahkan melakukan pendaftaran sebagai pengepul untuk dapat menampung produk pertanian.</p>
                        <a class="cta-btn align-self-start" href="<?= base_url('login'); ?>">Daftar</a>
                    </div>

                    <div class="col-lg-4 col-md-6 order-first order-md-last d-flex align-items-center">
                        <div class="img">
                            <img src="<?php echo (base_url('uploads/landing/kopi.jpg')) ?>" alt="" class="img-fluid">
                        </div>
                    </div>

                </div>

            </div>
        </section><!-- End Call To Action Section -->

        <!-- ======= On Focus Section ======= -->
        <section id="onfocus" class="onfocus">
            <div class="container-fluid p-0" data-aos="fade-up">

                <div class="row g-0">
                    <div class="col-lg-6 video-play position-relative">
                    </div>
                    <div class="col-lg-6">
                        <div class="content d-flex flex-column justify-content-center h-100">
                            <h3>Tingkatkan penjualan kopi anda </h3>
                            <p class="fst-italic">

                            </p>
                            <ul>
                                <li><i class="bi bi-check-circle"></i> Dapatkan diskon untuk pembelian kopi</li>
                                <li><i class="bi bi-check-circle"></i> Kualitas kopi yang dijual bagus</li>
                            </ul>
                            <a href="<?= base_url('login'); ?>" class="read-more align-self-start"><span>Gabung Sekarang Jadi Pengepul</span><i class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>
                </div>

            </div>
        </section><!-- End On Focus Section -->

        <!-- ======= Services Section ======= -->
        <section id="services" class="services">
            <div class="container" data-aos="fade-up">

                <div class="section-header">
                    <h2>Produk</h2>
                    <p>Anda dapat memilih setiap Produk yang telah kami sediakan. Produk tersebut diantaranya adalah:</p>
                </div>

                <div class="row gy-5">

                    <?php foreach ($produk as $rows) { ?>
                        <div class="col-xl-4 col-md-6" data-aos="zoom-in" data-aos-delay="200">
                            <div class="service-item card">
                                <div class="img">
                                    <img src="<?php echo (base_url('uploads/produk/thumbnails/' . $rows->gambar_produk)) ?>" class="img-fluid" alt="">
                                </div>
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <h5 class="card-title"><?= $rows->produk; ?></h5>
                                        <h5 class="card-title">Rp. <?= number_format($rows->harga); ?></h5>
                                    </div>

                                    <ul>
                                        <?php
                                        $db      = \Config\Database::connect();
                                        $builder = $db->table('kualitas a');
                                        $builder->select('a.*, b.kualitas as nama_kualitas');
                                        $builder->join('quality_report b', "a.idqreport=b.idqreport");
                                        $dataKualitas = $builder->where('idproduk', $rows->idproduk)->get()->getResult();

                                        $total = 0;
                                        foreach ($dataKualitas as $rows) {
                                            $total += $rows->total;
                                        ?>
                                            <li><?= ucfirst($rows->nama_kualitas) . ' ' . $rows->total ?></li>
                                        <?php } ?>
                                        <?php if (isset($dataKualitas)) : ?>
                                            <li>Randemen <?= $total; ?></li>
                                        <?php endif; ?>
                                    </ul>
                                    <!-- <a href="#" class="btn btn-primary">Lihat</a> -->
                                </div>
                            </div>
                        </div><!-- End Service Item -->
                    <?php } ?>
                </div>
            </div>
        </section><!-- End Services Section -->


        <!-- ======= Contact Section ======= -->
        <section id="contact" class="contact">
            <div class="container">

                <div class="section-header">
                    <h2>Hubungi Kami</h2>
                    <p>Anda dapat menghubungi kapan saja dan kami akan menyambut anda dengan senang hati</p>
                </div>

            </div>

            <div class="map">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3972.186825673572!2d105.2296512689939!3d-5.388472841886511!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e40da97db3a5b8b%3A0xb9fa4c4741c5a1ac!2sGg.%20Swadaya%202%2C%20Gn.%20Terang%2C%20Kec.%20Langkapura%2C%20Kota%20Bandar%20Lampung%2C%20Lampung!5e0!3m2!1sid!2sid!4v1701767390329!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div><!-- End Google Maps -->

            <div class="container">

                <div class="row gy-5 gx-lg-5">

                    <div class="col-lg-4">

                        <div class="info">
                            <h3>kmpsmart.co.id</h3>
                            <p>Pengembang software kmpsmart di bidang koperasi berbasis teknologi</p>

                            <div class="info-item d-flex">
                                <i class="bi bi-geo-alt flex-shrink-0"></i>
                                <div>
                                    <h4>Kantor:</h4>
                                    <p>JL. PURNAWIRAWAN GG SWADAYA 9
                                        GUNUNGTERANG, LANGKAPURA
                                        KOTA BANDAR LAMPUNG LAMPUNG</p>
                                </div>
                            </div><!-- End Info Item -->

                            <div class="info-item d-flex">
                                <i class="bi bi-envelope flex-shrink-0"></i>
                                <div>
                                    <h4>Email:</h4>
                                    <p></p>
                                </div>
                            </div><!-- End Info Item -->

                            <div class="info-item d-flex">
                                <i class="bi bi-phone flex-shrink-0"></i>
                                <div>
                                    <h4>Telephone:</h4>
                                    <p>+62 878-9948-4098</p>
                                </div>
                            </div><!-- End Info Item -->

                        </div>

                    </div>

                    <div class="col-lg-8">
                        <form name="contact-me-nurtiyas" class="php-email-form">
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <input type="text" name="name" class="form-control" id="name" placeholder="Nama Anda" required>
                                </div>
                                <div class="col-md-6 form-group mt-3 mt-md-0">
                                    <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
                                </div>
                            </div>
                            <div class="form-group mt-3">
                                <input type="text" class="form-control" name="subject" id="subject" placeholder="Judul" required>
                            </div>
                            <div class="form-group mt-3">
                                <textarea class="form-control" name="message" placeholder="Tuliskan pesan anda disini..." required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary btn-send">Kirim Pesan</button>

                            <button class="btn btn-primary btn-loading d-none" type="button" disabled>
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Proses...
                            </button>
                            <br>
                            <br>
                            <div class="alert alert-success alert-dismissible fade show d-none my-alert" role="alert">
                                <strong>Berhasil.</strong> Kami telah menerima pesan anda
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </form>
                    </div><!-- End Contact Form -->

                </div>

            </div>
        </section><!-- End Contact Section -->

    </main><!-- End #main -->

    <a href="https://wa.me/6287899484098" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-whatsapp"></i></a>

    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="<?php echo (base_url('assetLanding/vendor/bootstrap/js/bootstrap.bundle.min.js')) ?>"></script>
    <script src="<?php echo (base_url('assetLanding/vendor/aos/aos.js')) ?>"></script>
    <script src="<?php echo (base_url('assetLanding/vendor/glightbox/js/glightbox.min.js')) ?>"></script>
    <script src="<?php echo (base_url('assetLanding/vendor/isotope-layout/isotope.pkgd.min.js')) ?>"></script>
    <script src="<?php echo (base_url('assetLanding/vendor/swiper/swiper-bundle.min.js')) ?>"></script>
    <script src="<?php echo (base_url('assetLanding/vendor/php-email-form/validate.js')) ?>"></script>

    <!-- Template Main JS File -->
    <script src="<?php echo (base_url('assetLanding/js/main.js')) ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@3.6.12/dist/js/splide.min.js"></script>
    <script>
        var splide = new Splide('.splide', {
            type: 'loop',
            perPage: 3,
            rewind: true,
            breakpoints: {
                640: {
                    perPage: 2,
                    gap: '.7rem',
                    height: '12rem',
                },
                480: {
                    perPage: 1,
                    gap: '.7rem',
                    height: '12rem',
                },
            },
        });
        splide.mount();
    </script>



</body>

</html>