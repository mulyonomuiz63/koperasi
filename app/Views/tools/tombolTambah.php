<?php
$uris = service('uri');
$url = $uris->getSegment(1);
?>

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
        <a href="<?php echo ($url . '/tambah') ?>" class="btn btn-primary font-weight-bolder" id="tambah">
            <i class="fa fa-plus-circle text-white"></i>
        </a>
        <!--end::Button-->
    </div>
</div>