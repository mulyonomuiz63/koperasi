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
                        <input type="hidden" name="ltambah" id="ltambah" value="edit">
                        <div class="col-md-6 pt-2">
                            <div class="form-group required">
                                <label for="">Produk</label>
                                <input type="text" id="produk" name="produk" class="form-control" placeholder="produk" value="<?= $produk->produk; ?>">
                                <input type="hidden" id="idpengepul" name="idpengepul" class="form-control" value="<?= $pengepul->idpengepul; ?>">
                                <input type="hidden" id="idproduk" name="idproduk" class="form-control" value="<?= $produk->idproduk; ?>">
                            </div>
                        </div>

                        <div class="col-md-6 pt-2">
                            <div class="form-group">
                                <small for="">Komoditi</small>
                                <select class="form-control" name="idkomoditi" id="idkomoditi">
                                    <option value="">pilih</option>
                                    <?php foreach ($komoditi as $rows) : ?>
                                        <option value="<?= $rows->idkomoditi; ?>" <?= $produk->idkomoditi == $rows->idkomoditi ? 'selected' : ''; ?>><?= $rows->komoditi; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 pt-2">
                            <div class="form-group required">
                                <label for="">QTY</label>
                                <input type="number" id="qty" name="qty" class="form-control" placeholder="QTY" value="<?= $produk->qty; ?>">
                            </div>
                        </div>
                        <div class="col-md-6 pt-2">
                            <div class="form-group required">
                                <label for="">Harga Satuan</label>
                                <input type="number" id="harga" name="harga" class="form-control" placeholder="Harga" value="<?= $produk->harga; ?>">
                            </div>
                        </div>
                        <div class="col-md-12 pt-2">
                            <table class="table table-bordered border-none">
                                <thead class="text-center bg-primary">
                                    <tr>
                                        <th class="text-left">Kualitas Produk</th>
                                        <th class="text-left">Nilai Kualitas</th>
                                        <th class="text-center">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($kualitasAll as $rows) { ?>
                                        <tr>
                                            <td class="text-left"><?= $rows->kualitas; ?></td>
                                            <td class="text-left"><?= $rows->persen; ?></td>
                                            <td class="text-center">
                                                <a href="javascript:void(0)" onclick="hapusKualitas('<?= $rows->idkualitas; ?>')" class="btn btn-sm btn-danger btn-circle" data-toggle="tooltip" data-placement="left" title="Hapus">
                                                    <i class="fas fa-trash text-white"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
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
                        </div>
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

            }
        });
    })

    function hapusKualitas($id) {
        var id = $id;
        var result = confirm('Yakin, Anda akan menghapus data');
        if (result) {
            $.ajax({
                type: "POST",
                url: "<?php echo site_url("produk/kualitas/delete") ?>",
                data: {
                    id
                }, // since, you need to delete post of particular id
                success: function(data) {

                    if (!data) {
                        window.location.reload();
                    } else {
                        alert("Gagal menghapus data");
                    }
                    return false;

                },
                error: function(er) {
                    console.log(er);
                }
            });
        }
    }
    var i = 1;
    $('#add').click(function() {
        i++;
        <?php $kual = $kualitas; ?>
        $('#dynamic_field').append('<tr id="row' + i + '"><td><div class="row"><div class="col-md-6"><div class="form-group"><select name="idqreport[]" class="form-control"><option value="">Pilih</option><?php foreach ($kualitas as $rows) { ?><option value="<?= $rows->idqreport; ?>"><?= $rows->kualitas; ?></option> <?php } ?></select></div></div><div class="col-md-6"><div class="form-group"><input  type="text" name="kualitas[]" class="form-control"/></div></div></div></td><td><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove">X</button></td></tr>');
    });
    $(document).on('click', '.btn_remove', function() {
        var button_id = $(this).attr("id");
        $('#row' + button_id + '').remove();
    });
</script>
<?= $this->endSection() ?>