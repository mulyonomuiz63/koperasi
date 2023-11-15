<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Subheader-->
    <?= $this->include('layout/_headerBawah'); ?>
    <!--end::Subheader-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <div class="card shadow card-body">

                <form action="<?php echo (site_url('kualitas/simpan')) ?>" id="form" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <input type="hidden" name="ltambah" id="ltambah" value="edit">
                        <?php foreach ($kualitas as $rows) : ?>
                            <div class="col-md-12">
                                <div class="form-group required">
                                    <label for="">Kualitas</label>
                                    <input type="hidden" name="idqreport" value="<?= $rows->idqreport; ?>">
                                    <input type="text" name="kualitas" value="<?= $rows->kualitas; ?>" class="form-control" placeholder="kualitas">
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <hr>
                    <div class="clearfix"></div>
                    <?= $this->include('tools/tombol'); ?>
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
                kualitas: {
                    validators: {
                        notEmpty: {
                            message: 'kualitas tidak boleh kosong'
                        },
                        stringLength: {
                            min: 3,
                            max: 100,
                            message: 'Panjang Karakter diperbolehkan dari 3 sd 100'
                        },
                    }
                },

            }
        });
    })
</script>
<?= $this->endSection() ?>