<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-1">
                <!--begin::Page Heading-->
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <!--begin::Page Title-->
                    <h5 class="text-dark font-weight-bold my-1 mr-5">Menu Role</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item">
                            <a href="" class="text-muted">Edit</a>
                        </li>
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page Heading-->
            </div>
            <!--end::Info-->
        </div>
    </div>
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
                                <select class="form-control" name="idmenu" id="idmenu">
                                    <option value="">Menu</option>
                                    <?php foreach ($menu as $rows) : ?>
                                        <option value="<?= $rows->idmenu; ?>" <?php if ($rows->idmenu == $menurole->idmenu) { ?> selected <?php } ?>><?= $rows->menu; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Role</label>
                                <select class="form-control" name="idrole" id="idrole">
                                    <option value="">Role</option>
                                    <?php foreach ($role as $rows) : ?>
                                        <option value="<?= $rows->idrole; ?>" <?php if ($rows->idrole == $menurole->idrole) { ?> selected <?php } ?>><?= $rows->role; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="radio-inline" role="group">
                            <label class="radio radio-square">
                                <input type="radio" checked="checked" name="lihat" id="lihat" value="1" <?php if ($menurole->lihat == '1') { ?> checked <?php } ?> autocomplete="off">
                                <span></span>Lihat</label>
                            <label class="radio radio-square">
                                <input type="radio" name="tambah" id="tambah" value="1" <?php if ($menurole->tambah == '1') { ?> checked <?php } ?> autocomplete="off">
                                <span></span>Tambah</label>
                            <label class="radio radio-square">
                                <input type="radio" name="ubah" id="ubah" value="1" <?php if ($menurole->ubah == '1') { ?> checked <?php } ?> autocomplete="off">
                                <span></span>Ubah</label>
                            <label class="radio radio-square">
                                <input type="radio" name="hapus" id="hapus" value="1" <?php if ($menurole->hapus == '1') { ?> checked <?php } ?> autocomplete="off">
                                <span></span>Hapus</label>
                        </div>
                    </div>
                    <hr>
                    <div class="clearfix"></div>
                    <div class="text-right">
                        <a href="<?php echo (site_url('menu-role')) ?>" class="btn btn-danger">Kembali</a>
                        <button type="submit" id="simpan" class="btn btn-success">Simpan</button>

                    </div>
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