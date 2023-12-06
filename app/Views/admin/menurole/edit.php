<?= $this->extend('admin/layout/template') ?>
<?= $this->section('content') ?>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Subheader-->
    <?= $this->include('admin/layout/_headerBawah'); ?>
    <!--end::Subheader-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <div class="card shadow card-body">
                <form action="<?php echo (site_url('menu-role/simpan')) ?>" id="form" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <input type="hidden" name="ltambah" id="ltambah" value="edit">
                        <input type="hidden" name="idmenurole" id="idmenurole" value="<?= $menurole->idmenurole; ?>">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Menu</label>
                                <label for="" class="form-control"><?= $menurole->menu; ?></label>
                                <input type="hidden" name="idmenu" id="idmenu" value="<?= $menurole->idmenu; ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Role</label>
                                <label for="" class="form-control"><?= $menurole->role; ?></label>
                                <input type="hidden" name="idrole" id="idrole" value="<?= $menurole->idrole; ?>">
                            </div>
                        </div>
                        <div class="radio-inline" role="group">
                            <label class="radio radio-square">
                                <input type="checkbox" name="lihat" id="lihat" value="1" <?php if ($menurole->lihat == '1') { ?> checked <?php } ?> autocomplete="off">
                                <span></span>Lihat</label>
                            <label class="radio radio-square">
                                <input type="checkbox" name="tambah" id="tambah" value="1" <?php if ($menurole->tambah == '1') { ?> checked <?php } ?> autocomplete="off">
                                <span></span>Tambah</label>
                            <label class="radio radio-square">
                                <input type="checkbox" name="ubah" id="ubah" value="1" <?php if ($menurole->ubah == '1') { ?> checked <?php } ?> autocomplete="off">
                                <span></span>Ubah</label>
                            <label class="radio radio-square">
                                <input type="checkbox" name="hapus" id="hapus" value="1" <?php if ($menurole->hapus == '1') { ?> checked <?php } ?> autocomplete="off">
                                <span></span>Hapus</label>
                            <label class="radio radio-square">
                                <input type="checkbox" name="aprove" id="aprove" value="1" <?php if ($menurole->aprove == '1') { ?> checked <?php } ?> autocomplete="off">
                                <span></span>Approve</label>
                            <label class="radio radio-square">
                                <input type="checkbox" name="cetak" id="cetak" value="1" <?php if ($menurole->cetak == '1') { ?> checked <?php } ?> autocomplete="off">
                                <span></span>Cetak</label>
                            <label class="radio radio-square">
                                <input type="checkbox" name="export" id="export" value="1" <?php if ($menurole->export == '1') { ?> checked <?php } ?> autocomplete="off">
                                <span></span>Export</label>
                        </div>
                    </div>
                    <hr>
                    <div class="clearfix"></div>
                    <?= $this->include('tools/tombol'); ?>
                </form>

            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#form').bootstrapValidator({
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                idmenu: {
                    validators: {
                        notEmpty: {
                            message: 'Menu tidak boleh kosong'
                        },
                    }
                },
                idrole: {
                    validators: {
                        notEmpty: {
                            message: 'Role tidak boleh kosong'
                        },
                    }
                },
            }
        });
    })
</script>
<?= $this->endSection() ?>