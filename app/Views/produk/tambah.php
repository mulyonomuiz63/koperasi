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
                    <h5 class="text-dark font-weight-bold my-1 mr-5">Produk</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item">
                            <a href="" class="text-muted">Tambah</a>
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

                <form action="<?php echo (site_url('produk/simpan')) ?>" id="form" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <input type="hidden" name="ltambah" id="ltambah" value="tambah">
                        <div class="col-md-6 pt-2">
                            <div class="form-group required">
                                <label for="">Produk</label>
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
                                <label for="">QTY</label>
                                <input type="number" id="qty" name="qty" class="form-control" placeholder="QTY">
                            </div>
                        </div>
                        <div class="col-md-6 pt-2">
                            <div class="form-group required">
                                <label for="">Harga Satuan</label>
                                <input type="number" id="harga" name="harga" class="form-control" placeholder="Harga">
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="clearfix"></div>
                    <div class="text-right">
                        <a href="<?php echo (site_url('produk')) ?>" class="btn btn-danger">Kembali</a>
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

            }
        });
    })
</script>
<?= $this->endSection() ?>