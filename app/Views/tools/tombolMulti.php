<?php
$uris = service('uri');
$url = $uris->getSegment(1);
$enid = encode($id);
?>

<!-- tombol ubah -->
<?= $this->section('ubah') ?>
<?php if (ubah(session()->get('iduser'), "$url")) { ?>
    <a href="<?= site_url("$url/edit/$enid"); ?>" class="btn btn-sm btn-warning btn-circle" data-toggle="tooltip" data-placement="left" title="Ubah">
        <i class="fas fa-edit text-white"></i>
    </a>
<?php } ?>
<?= $this->endSection() ?>
<!-- end tombol ubah -->

<!-- tombol hapus -->
<?= $this->section('hapus') ?>
<?php if (hapus(session()->get('iduser'), "$url")) { ?>
    <a href="#" onclick="hapus('<?= $enid; ?>')" class="btn btn-sm btn-danger btn-circle" data-toggle="tooltip" data-placement="left" title="Hapus">
        <i class="fas fa-trash text-white"></i>
    </a>
<?php } ?>
<?= $this->endSection() ?>
<!-- end tombol hapus -->

<!-- tombol aprove -->
<?= $this->section('aprove') ?>
<?php if (aprove(session()->get('iduser'), "$url")) { ?>
    <a href="<?= site_url("$url/edit/$enid"); ?>" class="btn btn-sm btn-success btn-circle" data-toggle="tooltip" data-placement="left" title="Approved">
        <i class="far fa-check-circle"></i>
    </a>
<?php  } ?>
<?= $this->endSection() ?>
<!-- end tombol aprove -->



<!-- untuk  kondisi tombol yang akan di tampilkan -->
<?php if ($url == 'produk') : ?>
    <?= $this->renderSection('aprove'); ?>
    <?= $this->renderSection('ubah'); ?>
    <?php if ($status == 'N' || $status == 'N1') : ?>
        <?= $this->renderSection('hapus'); ?>
    <?php endif; ?>
<?php endif; ?>

<?php if ($url != 'produk') : ?>
    <?= $this->renderSection('ubah'); ?>
    <?= $this->renderSection('hapus'); ?>
<?php endif; ?>

<!-- end kondisi tombol yang akan di tampilkan -->