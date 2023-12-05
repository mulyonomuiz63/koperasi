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

                <form action="<?php echo (site_url('produk/simpan')) ?>" id="form" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <input type="hidden" name="ltambah" id="ltambah" value="tambah">
                        <div class="col-md-6 pt-2">
                            <div class="form-group required">
                                <label for="">Produk</label>
                                <input type="hidden" id="idpengepul" name="idpengepul" class="form-control" value="<?= $pengepul->idpengepul; ?>">
                                <input type="text" id="produk" name="produk" class="form-control" placeholder="produk">
                            </div>
                        </div>

                        <div class="col-md-6 pt-2">
                            <div class="form-group">
                                <small for="">Komoditi</small>
                                <select class="form-control" name="idkomoditi" id="idkomoditi">
                                    <option value="">pilih</option>
                                    <?php foreach ($komoditi as $rows) : ?>
                                        <option value="<?= $rows->idkomoditi; ?>"><?= $rows->komoditi; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 pt-2">
                            <div class="form-group required">
                                <label for="">QTY Per/Kg</label>
                                <input type="text" onkeypress="return hanyaAngka(event)" id="qty" name="qty" class="form-control" placeholder="QTY">
                                <small>Satuan/Kg</small>
                            </div>
                        </div>
                        <div class="col-md-6 pt-2">
                            <div class="form-group required">
                                <label for="">Harga Per/Kg</label>
                                <input type="text" onkeypress="return hanyaAngka(event)" id="harga" name="harga" class="form-control" placeholder="Harga">
                            </div>
                        </div>
                        <div class="col-md-6 pt-2">
                            <div class="form-group required">
                                <label for="">Gambar Produk</label>
                                <input type="file" id="gambar_produk" name="gambar_produk" class="form-control">
                            </div>
                        </div>

                        <!-- <div class="col-md-12 pt-2">
                            <table class="table table-bordered border-none" id="dynamic_field">
                                <tr>
                                    <td>
                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Kualitas Produk</label>
                                                    <select name="idqreport[]" class="form-control">
                                                        <option value="">Pilih</option>
                                                        <?php foreach ($kualitas as $rows) { ?>
                                                            <option value="<?= $rows->idqreport; ?>"><?= $rows->kualitas; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Nilai kualitas</label>
                                                    <input type="text" onkeypress="return hanyaAngka(event)" name="kualitas[]" class="form-control" />
                                                </div>
                                            </div>
                                        </div>

                                    </td>
                                    <td>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for=""></label>
                                                    <div>
                                                        <button type="button" name="add" id="add" class="btn btn-success"> <i class="fa fa-plus-circle text-white"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div> -->
                    </div>
                    <br>
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
                produk: {
                    validators: {
                        notEmpty: {
                            message: 'Produk tidak boleh kosong'
                        },
                        stringLength: {
                            min: 3,
                            max: 100,
                            message: 'Panjang Karakter diperbolehkan dari 3 sd 100'
                        },
                    }
                },
                idkomoditi: {
                    validators: {
                        notEmpty: {
                            message: 'Komoditi tidak boleh kosong'
                        },
                    }
                },
                qty: {
                    validators: {
                        notEmpty: {
                            message: 'QTY tidak boleh kosong'
                        },
                    }
                },
                harga: {
                    validators: {
                        notEmpty: {
                            message: 'Harga tidak boleh kosong'
                        },
                    }
                },
                gambar_produk: {
                    validators: {
                        file: {
                            extension: 'jpeg,png,jpg',
                            type: 'image/jpeg,image/jpg,image/png',
                            message: 'Foto produk tidak boleh kosong'
                        },
                        notEmpty: {
                            message: 'Foto produk tidak boleh kosong'
                        },
                    }

                },

            }
        });
    })

    var i = 1;
    $('#add').click(function() {
        i++;
        <?php $kual = $kualitas; ?>
        $('#dynamic_field').append('<tr id="row' + i + '"><td><div class="row"><div class="col-md-6"><div class="form-group"><select name="idqreport[]" class="form-control"><option value="">Pilih</option><?php foreach ($kualitas as $rows) { ?><option value="<?= $rows->idqreport; ?>"><?= $rows->kualitas; ?></option> <?php } ?></select></div></div><div class="col-md-6"><div class="form-group"><input  type="text" onkeypress="return hanyaAngka(event)" name="kualitas[]" class="form-control"/></div></div></div></td><td><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove">X</button></td></tr>');
    });
    $(document).on('click', '.btn_remove', function() {
        var button_id = $(this).attr("id");
        $('#row' + button_id + '').remove();
    });
</script>
<?= $this->endSection() ?>