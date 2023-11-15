<div class="text-right">
    <?php
    $uris = service('uri');
    $url = $uris->getSegment(1); ?>
    <a href="<?php echo (site_url("$url")) ?>" class="btn btn-danger" data-toggle="tooltip" data-theme="dark" title="Kembali"><i class="fas fa-reply text-white"></i></a>
    <button type="submit" id="simpan" class="btn btn-success" data-toggle="tooltip" data-theme="dark" title="Simpan"><i class="fa fa-save text-white"></i></button>

</div>