<?php
$uris = service('uri');
$url = $uris->getSegment(1);
if (isset($id)) {
    $enid = encode($id);
} else {
    $enid = null;
}
if (isset($status)) {
    $status = $status;
} else {
    $status = null;
}
?>

<!-- untuk tombol simpan -->
<?= $this->section('simpan') ?>
<?php if (tambah(session()->get('iduser'), "$url") or ubah(session()->get('iduser'), "$url")) : ?>
    <?php if ($url != 'produk') : ?>
        <button type="submit" id="simpan" class="btn btn-success" data-toggle="tooltip" data-theme="dark" title="Simpan"><i class="fa fa-save text-white"></i></button>
    <?php endif; ?>

    <?php if ($url == 'produk') : ?>
        <?php if ($status == null || $status == 'N') : ?>
            <button type="submit" id="simpan" class="btn btn-success" data-toggle="tooltip" data-theme="dark" title="Simpan"><i class="fa fa-save text-white"></i></button>
        <?php elseif ($status == 'N1') : ?>
            <button type="submit" id="simpan" class="btn btn-success" data-toggle="tooltip" data-theme="dark" title="Simpan"><i class="fa fa-save text-white"></i></button>
        <?php else : ?>
            <button type="button" id="simpan" class="btn btn-success" data-toggle="tooltip" data-theme="dark" title="Sudah Approved"><i class="fa fa-save text-white"></i></button>
        <?php endif; ?>
    <?php endif; ?>
<?php endif ?>
<?= $this->endSection() ?>
<!-- end untuk tombol simpan -->

<!-- untuk tombol kembali -->
<?= $this->section('kembali') ?>
<a href="<?php echo (site_url("$url")) ?>" class="btn btn-danger" data-toggle="tooltip" data-theme="dark" title="Kembali"><i class="fas fa-reply text-white"></i></a>
<?= $this->endSection() ?>
<!-- end untuk tombol kembali -->

<!-- untuk tombol aprove -->
<?= $this->section('aprove') ?>
<?php if (aprove(session()->get('iduser'), "$url")) : ?>
    <?php if (session()->get('idrole') == '5' && $status == 'V' || session()->get('idrole') == '6' && $status == 'N') : ?>
        <button type="submit" id="simpan" class="btn btn-success btn-circle" data-toggle="tooltip" data-theme="dark" title="Approved"><i class="far fa-check-circle"></i></button>
    <?php else :  ?>
        <button type="button" id="simpan" class="btn btn-success btn-circle" data-toggle="tooltip" data-theme="dark" title="Sudah Approved"><i class="far fa-check-circle"></i></button>
    <?php endif ?>
<?php endif ?>
<?= $this->endSection() ?>
<!-- end untuk tombol aprove -->



<div class="text-right">
    <!-- untuk  kondisi tombol yang akan di tampilkan -->
    <?= $this->renderSection('kembali'); ?>
    <?= $this->renderSection('aprove'); ?>
    <?= $this->renderSection('simpan'); ?>
    <!-- end kondisi tombol yang akan di tampilkan -->
</div>