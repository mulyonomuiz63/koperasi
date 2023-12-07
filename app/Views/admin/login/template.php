<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->

<head>
    <meta charset="utf-8" />
    <meta property="og:title" content="Koperasi multi pihak surya makmur agro teknologi" />
    <!--<meta property="og:type" content="article" />-->
    <meta property="og:url" content="<?= base_url('/'); ?>" />
    <meta property="og:description" content="Koperasi multi pihak surya makmur agro teknologi membangun sebuah kepercayaan terhadap masyarakat tentu bukanlah hal yang mudah, apalagi bagi sebuah perusahaan Koperasi yang lahir dan tumbuh di daerah, berawal dari sebuah cita-cita membangun ekonomi dari Daerah" />

    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Page Custom Styles(used by this page)-->
    <link href="<?= base_url('assets/css/pages/login/classic/login-6.css') ?>" rel="stylesheet" type="text/css" />
    <!--end::Page Custom Styles-->
    <!--begin::Global Theme Styles(used by all pages)-->
    <link href="<?= base_url('assets/css/style.bundle.css') ?>" rel="stylesheet" type="text/css" />
    <!--end::Global Theme Styles-->
    <!--begin::Layout Themes(used by all pages)-->
    <!--end::Layout Themes-->
    <link rel="shortcut icon" href="<?= base_url('assets/media/logos/favicon.png') ?>" />
    <style>
        .help-block {
            color: red;
        }
    </style>
</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
    <!--begin::Main-->
    <div class="d-flex flex-column flex-root">
        <!--begin::Login-->
        <div class="login login-6 login-signin-on login-signin-on d-flex flex-column-fluid" id="kt_login">
            <div class="d-flex flex-column flex-lg-row flex-row-fluid text-center" style="background-image: url(<?= base_url('assets/media/bg/bg-3.jpg') ?>);">
                <!--begin:Aside-->
                <div class="d-flex w-100 flex-center p-15">
                    <div class="login-wrapper">
                        <!--begin:Aside Content-->
                        <div class="text-dark-75">
                            <a href="#">
                                <img src="<?= base_url('assets/media/logos/logo-light.png') ?>" class="max-h-75px" alt="" />
                            </a>
                            <h3 class="mb-8 mt-22 font-weight-bold">KOPERASI MULTI PIHAK SURYA MAKMUR AGRO TEKNOLOGI</h3>
                            <!-- <p class="mb-15 text-muted font-weight-bold">The ultimate Bootstrap &amp; Angular 6 admin theme framework for next generation web apps.</p> -->
                            <a href="<?= base_url('registrasi'); ?>" id="kt_login_signup" class="btn btn-outline-primary btn-pill py-4 px-9 font-weight-bold">Buat Akun</a>
                        </div>
                        <!--end:Aside Content-->
                    </div>
                </div>
                <!--end:Aside-->
                <!--begin:Divider-->
                <div class="login-divider">
                    <div></div>
                </div>
                <!--end:Divider-->
                <!--begin:Content-->
                <div class="d-flex w-100 flex-center p-15 position-relative overflow-hidden">
                    <div class="login-wrapper">
                        <?php
                        $pesan = session()->getFlashdata('pesan');
                        if (!empty($pesan)) {
                            echo $pesan;
                        }
                        ?>
                        <?= $this->renderSection('content'); ?>
                    </div>
                </div>
                <!--end:Content-->
            </div>
        </div>
        <!--end::Login-->
    </div>


    <!--begin::Global Theme Bundle(used by all pages)-->
    <script src="<?php echo base_url('assets/plugins/global/plugins.bundle.js') ?>"></script>
    <script src="<?php echo base_url('assets/plugins/custom/prismjs/prismjs.bundle.js') ?>"></script>
    <!--end::Global Theme Bundle-->
    <!--begin::Page Scripts(used by this page)-->
    <script src="<?php echo (base_url('assets/bootstrap-validator/js/bootstrapValidator.js')) ?>"></script>

    <!--end::Page Scripts-->
    <?= $this->renderSection('script'); ?>
    <script type="text/javascript">
        function hanyaAngka(evt) {
            var charCode = (evt.which) ? evt.which : event.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                return false;
            }
            return true

        }
    </script>
</body>
<!--end::Body-->

</html>