<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>
<?php
$uris = service('uri');
$url = $uris->getSegment(1);
?>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Subheader-->
    <?= $this->include('layout/_headerBawah'); ?>
    <!--end::Subheader-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <div class="card shadow card-body">

                <?php if (session()->get('idrole') == '5' || session()->get('idrole') == '6') { ?>
                    <?php if ($produk->status == 'V') {  ?>
                        <form action="<?php echo (site_url('produk/aproveBuktiTransfer')) ?>" id="forms" method="post" enctype="multipart/form-data">
                        <?php } else { ?>
                            <form action="<?php echo (site_url('produk/aprove')) ?>" id="form" method="post" enctype="multipart/form-data">
                            <?php } ?>
                        <?php } else { ?>
                            <?php if ($produk->status == 'N') { ?>
                                <form action="<?php echo (site_url('produk/simpan')) ?>" id="form" method="post" enctype="multipart/form-data">
                                <?php } else { ?>
                                    <form>
                                    <?php } ?>
                                <?php } ?>
                                <div class="row">
                                    <input type="hidden" name="ltambah" id="ltambah" value="edit">
                                    <div class="col-md-6 pt-2">
                                        <div class="form-group required">
                                            <label for="">Produk</label>
                                            <?php if (aprove(session()->get('iduser'), "$url") != 1) { ?>
                                                <input type="text" id="produk" name="produk" class="form-control" placeholder="produk" value="<?= $produk->produk; ?>">
                                            <?php } else { ?>
                                                <label for="" class="form-control"><?= $produk->produk; ?></label>
                                                <input type="hidden" id="produk" name="produk" class="form-control" placeholder="produk" value="<?= $produk->produk; ?>">
                                            <?php } ?>
                                            <input type="hidden" id="idpengepul" name="idpengepul" class="form-control" value="<?= $produk->idpengepul; ?>">
                                            <input type="hidden" id="idproduk" name="idproduk" class="form-control" value="<?= $produk->idproduk; ?>">
                                        </div>
                                    </div>

                                    <div class="col-md-6 pt-2">
                                        <div class="form-group">
                                            <small for="">Komoditi</small>
                                            <?php if (aprove(session()->get('iduser'), "$url") != 1) { ?>
                                                <select class="form-control" name="idkomoditi" id="idkomoditi">
                                                    <option value="">pilih</option>
                                                    <?php foreach ($komoditi as $rows) : ?>
                                                        <option value="<?= $rows->idkomoditi; ?>" <?= $produk->idkomoditi == $rows->idkomoditi ? 'selected' : ''; ?>><?= $rows->komoditi; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            <?php } else { ?>
                                                <label for="" class="form-control"><?= $produk->komoditi; ?></label>
                                                <input type="hidden" id="idkomoditi" name="idkomoditi" class="form-control" value="<?= $produk->komoditi; ?>">
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6 pt-2">
                                        <div class="form-group required">
                                            <label for="">QTY</label>
                                            <?php if (aprove(session()->get('iduser'), "$url") != 1) { ?>
                                                <input type="number" id="qty" name="qty" class="form-control" placeholder="QTY" value="<?= $produk->qty; ?>">
                                            <?php } else { ?>
                                                <label for="" class="form-control"><?= $produk->qty; ?></label>
                                                <input type="hidden" id="qty" name="qty" class="form-control" value="<?= $produk->qty; ?>">
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6 pt-2">
                                        <div class="form-group required">
                                            <label for="">Harga Satuan</label>
                                            <input type="text" id="harga" name="harga" class="form-control" placeholder="Harga" value="<?= $produk->harga; ?>">
                                        </div>
                                    </div>

                                    <?php if (session()->get('idrole') == '3') { ?>
                                        <div class="col-md-6 pt-2">
                                            <div class="form-group required">
                                                <label for="">Gambar Produk</label>
                                                <input type="file" id="gambar_produk" name="gambar_produk" class="form-control">
                                                <input type="hidden" id="gambar_produk_lama" name="gambar_produk_lama" class="form-control" value="<?= $produk->gambar_produk; ?>">
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <?php if ($produk->gambar_produk != '') { ?>
                                        <div class="col-md-6 pt-2">
                                            <div class="form-group required">
                                                <label for="">Gambar Produk</label>
                                                <img class="img-fluid" src="<?php echo base_url('uploads/produk/thumbnails/' . $produk->gambar_produk) ?>">
                                            </div>
                                        </div>
                                    <?php } ?>
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
                                                            <?php if (aprove(session()->get('iduser'), "$url") != 1) { ?>
                                                                <?php if ($produk->status == 'N' && session()->get('idrole') == '3') { ?>
                                                                    <a href="javascript:void(0)" onclick="hapusKualitas('<?= $rows->idkualitas; ?>')" class="btn btn-sm btn-danger btn-circle" data-toggle="tooltip" data-placement="left" title="Hapus">
                                                                        <i class="fas fa-trash text-white"></i>
                                                                    </a>
                                                                <?php } ?>
                                                            <?php } ?>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                        <?php
                                        if (aprove(session()->get('iduser'), "$url") != 1) { ?>
                                            <?php if ($produk->status == 'N' && session()->get('idrole') == '3') { ?>
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

                                            <?php } ?>
                                        <?php } ?>
                                        <?php if (session()->get('idrole') == '5') { ?>
                                            <?php if ($produk->status == 'V') { ?>

                                                <div class="col-md-6 pt-2">
                                                    <div class="form-group required">
                                                        <label for="">Bukti Transfer</label>
                                                        <input type="file" id="bukti_transfer" name="bukti_transfer" class="form-control">
                                                    </div>
                                                </div>

                                            <?php } elseif ($produk->status == 'B') { ?>
                                                <div class="col-md-6 pt-2">
                                                    <div class="form-group required">
                                                        <label for="">Bukti Transfer</label>
                                                        <img class="img-fluid" src="<?php echo base_url('uploads/buktiTransfer/thumbnails/' . $produk->bukti_transfer) ?>">
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        <?php } else { ?>
                                            <?php if ($produk->status == 'B') { ?>
                                                <div class="col-md-6 pt-2">
                                                    <div class="form-group required">
                                                        <label for="">Bukti Transfer</label>
                                                        <img class="img-fluid" src="<?php echo base_url('uploads/buktiTransfer/thumbnails/' . $produk->bukti_transfer) ?>">
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        <?php } ?>
                                        <?php if ($produk->status == 'T' || $produk->status == 'V') : ?>
                                            <div class="radio-inline" role="group">
                                                <?php if ($produk->status == 'V') : ?>
                                                    <label class="radio radio-square">
                                                        <input type="radio" name="aprove" value="V" <?php if ($produk->status == 'V') { ?> checked <?php } ?> autocomplete="off">
                                                        <span></span> Produk Ter-Approved
                                                    </label>
                                                <?php endif; ?>
                                                <?php if ($produk->status == 'T') : ?>
                                                    <label class="radio radio-square">
                                                        <input type="radio" name="aprove" value="T" <?php if ($produk->status == 'T') { ?> checked <?php } ?> autocomplete="off">
                                                        <span></span> Produk Ter-Tolak
                                                    </label>
                                                <?php endif; ?>
                                            </div>
                                        <?php endif; ?>
                                        <?php if (session()->get('idrole') == '6') : ?>
                                            <div class="radio-inline" role="group">
                                                <label class="radio radio-square">
                                                    <input type="radio" name="aprove" value="V" checked autocomplete="off">
                                                    <span></span>Approved Produk
                                                </label>
                                                <label class="radio radio-square">
                                                    <input type="radio" name="aprove" value="T" autocomplete="off">
                                                    <span></span>Tolak Produk
                                                </label>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <br>
                                <div class="clearfix"></div>
                                <?php
                                $data['id'] = $produk->idproduk;
                                $data['status'] = $produk->status;
                                ?>
                                <?php echo view('tools/tombol', $data) ?>
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
        $('#forms').bootstrapValidator({
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                bukti_transfer: {
                    validators: {
                        file: {
                            extension: 'jpeg,png,jpg',
                            type: 'image/jpeg,image/jpg,image/png',
                            message: 'Bukti transfer tidak boleh kosong'
                        },
                        notEmpty: {
                            message: 'Bukti transfer tidak boleh kosong'
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