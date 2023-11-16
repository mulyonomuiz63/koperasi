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

<div class="text-right">
    <?php
    $uris = service('uri');
    $url = $uris->getSegment(1); ?>
    <a href="<?php echo (site_url("$url")) ?>" class="btn btn-danger" data-toggle="tooltip" data-theme="dark" title="Kembali"><i class="fas fa-reply text-white"></i></a>

    <?php if (aprove(session()->get('iduser'), "$url")) { ?>
        <?php if (session()->get('idrole') == '5' && $status == 'V' || session()->get('idrole') == '6' && $status == 'N') { ?>
            <button type="submit" id="simpan" class="btn btn-success btn-circle" data-toggle="tooltip" data-theme="dark" title="Approved"><i class="far fa-check-circle"></i></button>
        <?php } else { ?>
            <button type="button" id="simpan" class="btn btn-success btn-circle" data-toggle="tooltip" data-theme="dark" title="Sudah Approved"><i class="far fa-check-circle"></i></button>
        <?php } ?>
    <?php } else { ?>
        <?php if (ubah(session()->get('iduser'), "$url") || tambah(session()->get('iduser'), "$url")) { ?>
            <?php if ($status == 'N' || $url == 'produk') {  ?>
                <button type="submit" id="simpan" class="btn btn-success" data-toggle="tooltip" data-theme="dark" title="Simpan"><i class="fa fa-save text-white"></i></button>
            <?php } elseif ($url != 'produk') { ?>
                <button type="submit" id="simpan" class="btn btn-success" data-toggle="tooltip" data-theme="dark" title="Simpan"><i class="fa fa-save text-white"></i></button>
            <?php } else { ?>
                <button type="button" id="simpan" class="btn btn-success" data-toggle="tooltip" data-theme="dark" title="Sudah Terverifikasi"><i class="fa fa-save text-white"></i></button>
            <?php } ?>
        <?php } ?>
    <?php } ?>
</div>