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
                <form action="<?php echo (site_url('kelompok-tani/simpan')) ?>" id="form" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <input type="hidden" name="ltambah" id="ltambah" value="edit">

                        <div class="col-md-12">
                            <div class="form-group">
                                <small for="">Nama Kelompok Tani</small>
                                <input type="text" id="nama" name="nama" value="<?= $kelompok_tani->nama; ?>" class="form-control" autocomplete="off">
                                <input type="hidden" id="idpengepul" name="idpengepul" value="<?= $kelompok_tani->idpengepul; ?>" class="form-control" autocomplete="off">
                                <input type="hidden" id="idkeltani" name="idkeltani" value="<?= $kelompok_tani->idkeltani; ?>" class="form-control" autocomplete="off">
                            </div>
                        </div>


                        <hr>
                        <div class="clearfix"></div>
                        <div class="col-md-12">
                            <?= $this->include('tools/tombol'); ?>
                        </div>
                </form>

            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
<?= $this->section('script') ?>
<script type="text/javascript">
    $(document).ready(function() {
        $('#form').bootstrapValidator({
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                nama: {
                    validators: {
                        notEmpty: {
                            message: 'Nama kelompok tani tidak boleh kosong'
                        },
                    }
                },

            }
        });
    })
</script>
<?= $this->endSection() ?>