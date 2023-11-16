<?php
$uris = service('uri');
$url = $uris->getSegment(1);
$enid = encode($id);
?>
<!-- untuk aprove -->

<!-- // manager keuangan 5 -->
<?php if (session()->get('idrole') == '5') { ?>
    <?php if (aprove(session()->get('iduser'), "$url")) { ?>
        <a href="<?= site_url("$url/edit/$enid"); ?>" class="btn btn-sm btn-success btn-circle" data-toggle="tooltip" data-placement="left" title="Approved">
            <i class="far fa-check-circle"></i>
        </a>
    <?php  } ?>
    <!-- // manager bisnis 6 -->
<?php } elseif (session()->get('idrole') == '6') { ?>

    <?php if (isset($status) && $status == 'N') { ?>
        <a href="<?= site_url("$url/edit/$enid"); ?>" class="btn btn-sm btn-success btn-circle" data-toggle="tooltip" data-placement="left" title="Approved">
            <i class="far fa-check-circle"></i>
        </a>
    <?php  } ?>
<?php } ?>

<!-- end untuk aprove -->



<?php if (ubah(session()->get('iduser'), "$url")) { ?>
    <a href="<?= site_url("$url/edit/$enid"); ?>" class="btn btn-sm btn-warning btn-circle" data-toggle="tooltip" data-placement="left" title="Ubah">
        <i class="fas fa-edit text-white"></i>
    </a>
<?php } ?>
<?php if (hapus(session()->get('iduser'), "$url")) { ?>
    <a href="#" onclick="hapus('<?= $enid; ?>')" class="btn btn-sm btn-danger btn-circle" data-toggle="tooltip" data-placement="left" title="Hapus">
        <i class="fas fa-trash text-white"></i>
    </a>
<?php } ?>