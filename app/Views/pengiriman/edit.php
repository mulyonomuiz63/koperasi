<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row pt-4">
        <div class="col d-flex flex-row align-items-center">
            <h4 class="">Role</h4>
            <i class="mx-2 fa-solid fa-angles-right"></i>
            <span class="text-success">Role</span>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-info">Tambah Data Role</h6>
        </div>
        <div class="card-body">


            <form action="<?php echo (site_url('role/simpan')) ?>" id="form" method="post" enctype="multipart/form-data">
                <div class="row">
                    <input type="hidden" name="ltambah" id="ltambah" value="edit">
                    <?php foreach ($role as $rows) : ?>
                        <div class="col-md-9">
                            <div class="form-group required">
                                <label for="">Role</label>
                                <input type="hidden" name="idrole" value="<?= $rows->idrole; ?>">
                                <input type="text" name="role" value="<?= $rows->role; ?>" class="form-control" placeholder="Role">
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <hr>
                <div class="clearfix"></div>
                <div class="text-right">
                    <a href="<?php echo (site_url('role')) ?>" class="btn btn-danger">Kembali</a>
                    <button type="submit" id="simpan" class="btn btn-success">Simpan</button>

                </div>
            </form>

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
                role: {
                    validators: {
                        notEmpty: {
                            message: 'Role tidak boleh kosong'
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