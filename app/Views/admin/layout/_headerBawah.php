<?php
$uris = service('uri');
$url = $uris->getSegment(1);
$total = $uris->getTotalSegments();
?>
<!--begin::Subheader-->
<div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Info-->
        <div class="d-flex align-items-center flex-wrap mr-1">
            <!--begin::Page Heading-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Page Title-->
                <a href="<?= base_url($url); ?>">
                    <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5"><?= ucwords($url); ?></h5>
                </a>
                <!--end::Page Title-->
                <!--begin::Actions-->
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <?php if ($total == 1) { ?>
                    <a href="" class="btn btn-light-warning font-weight-bolder btn-sm">View</a>
                <?php } else { ?>
                    <a href="" class="btn btn-light-warning font-weight-bolder btn-sm"><?= ucwords($uris->getSegment(2)); ?></a>
                <?php } ?>
                <!--end::Actions-->
            </div>
            <!--end::Page Heading-->
        </div>
        <!--end::Info-->
    </div>
</div>
<!--end::Subheader-->