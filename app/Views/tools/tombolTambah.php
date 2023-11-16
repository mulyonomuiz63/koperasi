<?php
$uris = service('uri');
$url = $uris->getSegment(1);
?>
<?php if (tambah(session()->get('iduser'), "$url")) { ?>
    <div class="card-header flex-wrap bg-light-warning">
        <div class="card-title">
            <!-- <h3 class="card-label">Menu Role
                        </h3> -->
        </div>
        <div class="card-toolbar">
            <!--begin::Dropdown-->
            <!-- $this->include('layout/custom/_export');  -->
            <!--end::Dropdown-->
            <!--begin::Button-->
            <?php if ($url == 'petani') { ?>
                <a href="<?php echo (site_url("kelompok-tani")) ?>" class="btn btn-danger mr-2" data-toggle="tooltip" data-theme="dark" title="Kembali"><i class="fas fa-reply text-white"></i></a>
            <?php } ?>
            <a href="<?php echo ($url . '/tambah') ?>" class="btn btn-primary font-weight-bolder" id="tambah">
                <i class="fa fa-plus-circle text-white"></i>
            </a>
            <!--end::Button-->
        </div>
    </div>
<?php } ?>