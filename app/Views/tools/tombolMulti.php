<?php
$uris = service('uri');
$url = $uris->getSegment(1);
$enid = encode($id);
?>
<?php if (aprove(session()->get('iduser'), "$url")) { ?>
    <a href="<?= site_url("$url/aprove/$enid"); ?>" class="btn btn-sm btn-warning btn-circle" data-toggle="tooltip" data-placement="left" title="Approved">
        <i class="far fa-check-circle"></i>
    </a>
<?php } ?>
<?php if (ubah(session()->get('iduser'), "$url")) { ?>
    <a href="<?= site_url("$url/edit/$enid"); ?>" class="btn btn-sm btn-warning btn-circle" data-toggle="tooltip" data-placement="left" title="Ubah">
        <i class="fas fa-edit text-white"></i>
    </a>
<?php } ?>
<?php if (hapus(session()->get('iduser'), "$url")) { ?>
    <a href="#" onclick="hapus('<?= $id; ?>')" class="btn btn-sm btn-danger btn-circle" data-toggle="tooltip" data-placement="left" title="Hapus">
        <i class="fas fa-trash text-white"></i>
    </a>
<?php } ?>