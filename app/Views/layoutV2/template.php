<!DOCTYPE html>

<head>

    <html lang="en" dir="ltr">

    </html>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="<?= base_url('assets/css/style.css'); ?>" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

    <!-- datatables -->
    <link rel="stylesheet" href="<?= base_url('assets/css/jquery.dataTables.css'); ?>" />
    <script type="text/javascript" src="<?= base_url('assets/js/jquery.js') ?>"></script>

    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link href="https://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css" rel="Stylesheet" type="text/css" />
    <script type="text/javascript" src="https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>


    <style>
        .help-block {
            color: red
        }
    </style>
</head>

<body>
    <!-- sidebar -->
    <?= $this->include('Layout/sidebar'); ?>
    <!-- end sidebar -->

    <section class="Dashboard_Text">
        <!-- content -->
        <?= $this->renderSection('content'); ?>
        <!-- end content -->
    </section>

    <script type="text/javascript">
        $(document).ready(function() {
            //defenisi datatable
            $('#table-view').DataTable({});
        });
    </script>

    <script>
        let sidebar = document.querySelector(".sidebar_menu");
        let closeBtn = document.querySelector("#Button");
        let searchBtn = document.querySelector(".bx-search");
        closeBtn.addEventListener("click", () => {
            sidebar.classList.toggle("open");
            menuBtnChange();
        });
        // searchBtn.addEventListener("click", () => {
        //     sidebar.classList.toggle("open");
        //     menuBtnChange();
        // });

        function menuBtnChange() {
            if (sidebar.classList.contains("open")) {
                closeBtn.classList.replace("bx-menu", "bxs-x-circle");
            } else {
                closeBtn.classList.replace("bxs-x-circle", "bx-menu");
            }
        }
        $(document).ready(function() {
            if (sidebar.classList.contains("open")) {
                closeBtn.classList.replace("bx-menu", "bxs-x-circle");
            } else {
                closeBtn.classList.replace("bxs-x-circle", "bx-menu");
            }
        })

        function hanyaAngka(evt) {
            var charCode = (evt.which) ? evt.which : event.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                return false;
            }
            return true

        }
    </script>

    <!-- Bootstrap validator -->
    <script src="<?php echo (base_url('assets/bootstrap-validator/js/bootstrapValidator.js')) ?>"></script>


    <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

    <!-- datatables -->
    <script src="<?= base_url('assets/js/jquery.dataTables.js') ?>"></script>



</body>

</html>