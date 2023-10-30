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
                    <h5 class="text-dark font-weight-bold my-1 mr-5">Pengepul</h5>
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
                <form action="<?php echo (site_url('pengepul/simpan')) ?>" id="form" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <input type="hidden" name="ltambah" id="ltambah" value="edit">
                        <input type="hidden" name="idpengepul" id="idpengepul" value="<?= $pengepul->idpengepul; ?>">
                        <div class="col-md-6">
                            <div class="form-group">
                                <small for="">Provinsi</small>
                                <select class="form-control" name="idprovinsi" id="idprovinsi">
                                    <option value="">pilih</option>
                                    <?php foreach ($provinsi as $rows) : ?>
                                        <option value="<?= $rows->idprovinsi; ?>" <?php echo $rows->idprovinsi == $pengepul->idprovinsi ? 'selected' : '' ?>><?= $rows->provinsi; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <small for="">Kab/Kota</small>
                                <select class="form-control" name="idkota" id="idkota">
                                    <option value="">pilih</option>
                                </select>
                                <input type="hidden" value="<?= $pengepul->idkota; ?>" id='idkotas'>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <small for="">Kecamatan</small>
                                <select class="form-control" name="idkecamatan" id="idkecamatan">
                                    <option value="">pilih</option>
                                </select>
                                <input type="hidden" value="<?= $pengepul->idkecamatan; ?>" id='idkecamatans'>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <small for="">Kel/Desa</small>
                                <select class="form-control" name="idkelurahan" id="idkelurahan">
                                    <option value="">pilih</option>
                                </select>
                                <input type="hidden" value="<?= $pengepul->idkelurahan; ?>" id='idkelurahans'>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <small for="">Nama Lengkap</small>
                                <input type="text" id="nama" name="nama" value="<?= $pengepul->nama; ?>" class="form-control" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <small for="">Tempat Lahir</small>
                                <input type="text" id="tempat_lahir" name="tempat_lahir" value="<?= $pengepul->tempat_lahir; ?>" class="form-control" autocomplete="off">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <small for="">Tanggal Lahir</small>
                                <input type="text" id="tgl_lahir" name="tgl_lahir" value="<?= date('d-m-Y', strtotime($pengepul->tgl_lahir)); ?>" class="form-control" autocomplete="off">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mt-4">
                                <small for="">Jenis Kelamin</small>
                                <div class="radio-inline" role="group">
                                    <label class="radio radio-square">
                                        <input type="radio" name="jk" id="jk1" value="L" <?= $pengepul->jk == 'L' ? 'checked' : ''; ?> autocomplete="off">
                                        <span></span>Laki-Laki</label>
                                    <label class="radio radio-square">
                                        <input type="radio" name="jk" id="jk2" value="P" <?= $pengepul->jk == 'P' ? 'checked' : ''; ?> autocomplete="off">
                                        <span></span>Perempuan</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <small for="">Agama</small>
                                <select class="form-control" name="agama" id="agama">
                                    <option value="">pilih</option>
                                    <option value="Islam" <?= $pengepul->agama == 'Islam' ? 'selected' : ''; ?>>Islam</option>
                                    <option value="Khatolik" <?= $pengepul->agama == 'Khatolik' ? 'selected' : ''; ?>>Khatolik</option>
                                    <option value="Kristen" <?= $pengepul->agama == 'Kristen' ? 'selected' : ''; ?>>Kristen</option>
                                    <option value="Hindu" <?= $pengepul->agama == 'Hindu' ? 'selected' : ''; ?>>Hindu</option>
                                    <option value="Buda" <?= $pengepul->agama == 'Buda' ? 'selected' : ''; ?>>Buda</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <small for="">No.rek</small>
                                <input type="text" id="norek" name="norek" class="form-control" value="<?= $pengepul->norek; ?>" onkeypress="return hanyaAngka(event)" autocomplete="off">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <small for="">Nama Bank</small>
                                <input type="text" id="nama_bank" name="nama_bank" value="<?= $pengepul->nama_bank; ?>" class="form-control" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <small>NIK</small>
                                <input class="form-control" type="number" maxlength="16" id="nik" name="nik" value="<?= $pengepul->nik; ?>" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <small>Foto KTP</small>
                                <input class="form-control" type="file" id="foto_ktp" name="foto_ktp">
                                <input class="form-control border border-0" type="hidden" id="foto_ktp_lama" name="foto_ktp_lama" value="<?= $pengepul->foto_ktp; ?>">
                            </div>
                        </div>
                        <div class="col-md-6 mt-4">
                            <div class="form-group">
                                <small>Foto KTP</small>
                                <img height="20%" width="20%" src="<?php echo base_url('uploads/pengepul/thumbnails/' . $pengepul->foto_ktp) ?>">
                            </div>
                        </div>
                    </div>

                    <hr>
                    <div class="clearfix"></div>
                    <div class="text-right">
                        <a href="<?php echo (site_url('pengepul')) ?>" class="btn btn-danger">Kembali</a>
                        <button type="submit" id="simpan" class="btn btn-success">Simpan</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        //start untuk alamat
        var url = "<?php echo site_url('pengepul/add_ajax_kota'); ?>/" + $('#idprovinsi').val();
        $('#idkota').load(url);
        setTimeout(function() {
            kota($('#idkotas').val());
        }, 1000);
        setTimeout(function() {
            var url = "<?php echo site_url('pengepul/add_ajax_kecamatan'); ?>/" + $('#idkota').val();
            $('#idkecamatan').load(url);
            setTimeout(function() {
                kecamatan($('#idkecamatans').val());
            }, 1000);
        }, 2000);
        setTimeout(function() {
            var url = "<?php echo site_url('pengepul/add_ajax_kelurahan'); ?>/" + $('#idkecamatan').val();
            $('#idkelurahan').load(url);
            setTimeout(function() {
                kelurahan($('#idkelurahans').val());
            }, 1000);
        }, 4000);
        //end untuk alamat
        $('#form').bootstrapValidator({
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                idkelurahan: {
                    validators: {
                        notEmpty: {
                            message: 'Kelurahan tidak boleh kosong'
                        },
                    }
                },
                nama: {
                    validators: {
                        notEmpty: {
                            message: 'Nama lengkap tidak boleh kosong'
                        },
                    }
                },
                tempat_lahir: {
                    validators: {
                        notEmpty: {
                            message: 'Tempat lahir tidak boleh kosong'
                        },

                    }
                },
                tgl_lahir: {
                    validators: {
                        notEmpty: {
                            message: 'Tanggal lahir tidak boleh kosong'
                        },
                    }
                },
                agama: {
                    validators: {
                        notEmpty: {
                            message: 'Agama tidak boleh kosong'
                        },

                    }
                },
                norek: {
                    validators: {
                        notEmpty: {
                            message: 'No rek tidak boleh kosong'
                        },
                    }
                },
                nama_bank: {
                    validators: {
                        notEmpty: {
                            message: 'Nama bank tidak boleh kosong'
                        },
                    }
                },
                nik: {
                    validators: {
                        notEmpty: {
                            message: 'NIK tidak boleh kosong'
                        },
                    }
                },
            }
        });
    })

    //start untuk alamat
    function kota($id) {
        $('#idkota option[value=' + $id + ']').prop('selected', true);

    }

    function kecamatan($id) {
        $('#idkecamatan option[value=' + $id + ']').prop('selected', true);

    }

    function kelurahan($id) {
        $('#idkelurahan option[value=' + $id + ']').prop('selected', true);

    }

    $("#idprovinsi").change(function() {
        var url = "<?php echo site_url('pengepul/add_ajax_kota'); ?>/" + $(this).val();
        $('#idkota').load(url);
        return false;
    })
    $("#idkota").change(function() {
        var url = "<?php echo site_url('pengepul/add_ajax_kecamatan'); ?>/" + $(this).val();
        $('#idkecamatan').load(url);
        return false;
    })
    $("#idkecamatan").change(function() {
        var url = "<?php echo site_url('pengepul/add_ajax_kelurahan'); ?>/" + $(this).val();
        $('#idkelurahan').load(url);
        return false;
    })

    //end untuk alamat

    $('#tgl_lahir').datepicker({
        maxDate: new Date(),
        dateFormat: "dd-mm-yy",
        autoclose: true,
        disableTouchKeyboard: true,
        Readonly: true
    }).attr("readonly", "readonly");
</script>
<?= $this->endSection() ?>