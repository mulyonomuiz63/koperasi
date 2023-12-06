<!DOCTYPE html>
<html lang="en">

<!--begin::Head-->

<head>
    <base href="">
    <meta charset="utf-8" />
    <meta http-equiv="Content-type" content="text/html;charset=UTF-8" />

    <meta property="og:title" content="Koperasi multi pihak surya makmur agro teknologi" />
    <!--<meta property="og:type" content="article" />-->
    <meta property="og:url" content="<?php echo base_url('/'); ?>" />
    <meta property="og:description" content="Koperasi multi pihak surya makmur agro teknologi membangun sebuah kepercayaan terhadap masyarakat tentu bukanlah hal yang mudah, apalagi bagi sebuah perusahaan Koperasi yang lahir dan tumbuh di daerah, berawal dari sebuah cita-cita membangun ekonomi dari Daerah" />


    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Page Vendors Styles(used by this page)-->
    <link href="<?php echo base_url('assets/plugins/custom/fullcalendar/fullcalendar.bundle.css') ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('assets/plugins/custom/datatables/datatables.bundle.css') ?>" rel="stylesheet" type="text/css" />
    <!--end::Page Vendors Styles-->
    <!--begin::Global Theme Styles(used by all pages)-->
    <link href="<?php echo base_url('assets/plugins/global/plugins.bundle.css') ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('assets/plugins/custom/prismjs/prismjs.bundle.css') ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('assets/css/style.bundle.css') ?>" rel="stylesheet" type="text/css" />
    <!--end::Global Theme Styles-->
    <!--begin::Layout Themes(used by all pages)-->
    <link href="<?php echo base_url('assets/css/themes/layout/header/base/light.css') ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('assets/css/themes/layout/header/menu/light.css') ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('assets/css/themes/layout/brand/dark.css') ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('assets/css/themes/layout/aside/dark.css') ?>" rel="stylesheet" type="text/css" />
    <!--end::Layout Themes-->
    <link rel="shortcut icon" href="<?php echo base_url('assets/media/logos/favicon.png') ?>" />

    <style>
        .help-block {
            color: red;
        }
    </style>

    <?= empty($map['js']) ? '' : $map['js']; ?>
</head>
<!--end::Head-->

<!--begin::Body-->

<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">

    <!--begin::Main-->

    <!--[html-partial:include:{"file":"partials/_header-mobile.html"}]/-->
    <?= $this->include('admin/layout/partials/_header-mobile'); ?>
    <div class="d-flex flex-column flex-root">

        <!--begin::Page-->
        <div class="d-flex flex-row flex-column-fluid page">

            <!--[html-partial:include:{"file":"partials/_aside.html"}]/-->
            <?= $this->include('admin/layout/partials/_aside'); ?>

            <!--begin::Wrapper-->
            <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">

                <!--[html-partial:include:{"file":"partials/_header.html"}]/-->
                <?= $this->include('admin/layout/partials/_header'); ?>

                <!--begin::Content-->
                <div class="content  d-flex flex-column flex-column-fluid" id="kt_content">
                    <!--Content area here-->
                    <?= $this->renderSection('content'); ?>
                </div>

                <!--end::Content-->

                <!--[html-partial:include:{"file":"partials/_footer.html"}]/-->
                <?= $this->include('admin/layout/partials/_footer'); ?>

            </div>

            <!--end::Wrapper-->
        </div>

        <!--end::Page-->
    </div>

    <!--end::Main-->

    <!--[html-partial:include:{"file":"partials/_extras/offcanvas/quick-user.html"}]/-->
    <?= $this->include('admin/layout/partials/_extras/offcanvas/quick-user'); ?>

    <!--[html-partial:include:{"file":"partials/_extras/offcanvas/quick-cart.html"}]/-->

    <!--[html-partial:include:{"file":"partials/_extras/offcanvas/quick-panel.html"}]/-->

    <!--[html-partial:include:{"file":"partials/_extras/chat.html"}]/-->

    <!--[html-partial:include:{"file":"partials/_extras/scrolltop.html"}]/-->
    <?= $this->include('admin/layout/partials/_extras/scrolltop'); ?>

    <!--[html-partial:include:{"file":"partials/_extras/toolbar.html"}]/-->

    <!--[html-partial:include:{"file":"partials/_extras/offcanvas/demo-panel.html"}]/-->


    <script>
        var HOST_URL = "https://preview.keenthemes.com/metronic/theme/html/tools/preview";
    </script>
    <!--begin::Global Config(global config for global JS scripts)-->
    <script>
        var KTAppSettings = {
            "breakpoints": {
                "sm": 576,
                "md": 768,
                "lg": 992,
                "xl": 1200,
                "xxl": 1400
            },
            "colors": {
                "theme": {
                    "base": {
                        "white": "#ffffff",
                        "primary": "#24ca4b",
                        "secondary": "#E5EAEE",
                        "success": "#1BC5BD",
                        "info": "#8950FC",
                        "warning": "#FFA800",
                        "danger": "#F64E60",
                        "light": "#E4E6EF",
                        "dark": "#181C32"
                    },
                    "light": {
                        "white": "#ffffff",
                        "primary": "#E1F0FF",
                        "secondary": "#EBEDF3",
                        "success": "#C9F7F5",
                        "info": "#EEE5FF",
                        "warning": "#FFF4DE",
                        "danger": "#FFE2E5",
                        "light": "#F3F6F9",
                        "dark": "#D6D6E0"
                    },
                    "inverse": {
                        "white": "#ffffff",
                        "primary": "#ffffff",
                        "secondary": "#3F4254",
                        "success": "#ffffff",
                        "info": "#ffffff",
                        "warning": "#ffffff",
                        "danger": "#ffffff",
                        "light": "#464E5F",
                        "dark": "#ffffff"
                    }
                },
                "gray": {
                    "gray-100": "#F3F6F9",
                    "gray-200": "#EBEDF3",
                    "gray-300": "#E4E6EF",
                    "gray-400": "#D1D3E0",
                    "gray-500": "#B5B5C3",
                    "gray-600": "#7E8299",
                    "gray-700": "#5E6278",
                    "gray-800": "#3F4254",
                    "gray-900": "#181C32"
                }
            },
            "font-family": "Poppins"
        };
    </script>

    <!--end::Global Config-->
    <!--begin::Global Theme Bundle(used by all pages)-->
    <script src="<?php echo base_url('assets/plugins/global/plugins.bundle.js') ?>"></script>
    <script src="<?php echo base_url('assets/plugins/custom/prismjs/prismjs.bundle.js') ?>"></script>
    <script src="<?php echo base_url('assets/js/scripts.bundle.js') ?>"></script>
    <!--end::Global Theme Bundle-->
    <!--begin::Page Vendors(used by this page)-->
    <script src="<?php echo base_url('assets/plugins/custom/fullcalendar/fullcalendar.bundle.js') ?>"></script>
    <script src="<?php echo base_url('assets/plugins/custom/datatables/datatables.bundle.js') ?>"></script>
    <script src="<?php echo (base_url('assets/bootstrap-validator/js/bootstrapValidator.js')) ?>"></script>
    <!--end::Page Vendors-->
    <!--begin::Page Scripts(used by this page)-->
    <script src="<?php echo base_url('assets/js/pages/widgets.js') ?>"></script>
    <script src="<?php echo base_url('assets/js/jquery.mask.min.js') ?>"></script>
    <!--end::Page Scripts-->
    <?= $this->renderSection('script'); ?>
    <script type="text/javascript">
        $(document).ready(function() {

            // Format mata uang.
            $('#harga').mask('000.000.000.000', {
                reverse: true
            });

        })

        function hanyaAngka(evt) {
            var charCode = (evt.which) ? evt.which : event.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                return false;
            }
            return true

        }

        $(document).on('keyup', '#kualitas', function(e) {

            var regex = /[a-zA-Z!"#$'()_=&`~|{}^:;/?<>@,]/g;
            var subst = "";

            var str = $(this).val();
            var result = str.replace(regex, subst);
            $(this).val(result);
            console.log(e)
            $('#nilai_pembulat1').val($(this).val());

        });

        function hapus($id) {
            <?php
            $uris = service('uri');
            $url = $uris->getSegment(1);
            ?>
            var result = confirm('Yakin, Anda akan menghapus data');
            if (result) {
                window.location = "<?php echo site_url($url . "/delete/") ?>" + $id;
            }
        }
        $("#tambah").hover(function() {
            // $(this).css('cursor', 'pointer').attr('title', 'This is a hover text.');
            $("#tambah").attr("title", "Tambah").tooltip("_fixTitle").tooltip("show");
        });
    </script>
</body>

<!--end::Body-->

</html>