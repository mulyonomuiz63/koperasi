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
                    <h5 class="text-dark font-weight-bold my-1 mr-5">Karyawan</h5>
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
                <form action="<?php echo (site_url('karyawan/simpan')) ?>" id="form" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <input type="hidden" name="ltambah" id="ltambah" value="tambah">
                        <div class="col-md-6">
                            <div class="form-group">
                                <small for="">Nama Lengkap</small>
                                <input type="text" id="nama" name="nama" class="form-control" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <small for="">Tempat Lahir</small>
                                <input type="text" id="tempat_lahir" name="tempat_lahir" class="form-control" autocomplete="off">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <small for="">Tanggal Lahir</small>
                                <input type="text" id="tgl_lahir" name="tgl_lahir" class="form-control" autocomplete="off">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mt-4">
                                <small for="">Jenis Kelamin</small>
                                <div class="radio-inline" role="group">
                                    <label class="radio radio-square">
                                        <input type="radio" name="jk" id="jk1" value="L" autocomplete="off" checked>
                                        <span></span>Laki-Laki</label>
                                    <label class="radio radio-square">
                                        <input type="radio" name="jk" id="jk2" value="P" autocomplete="off">
                                        <span></span>Perempuan</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <small for="">Agama</small>
                                <select class="form-control" name="agama" id="agama">
                                    <option value="">pilih</option>
                                    <option value="Islam">Islam</option>
                                    <option value="Khatolik">Khatolik</option>
                                    <option value="Kristen">Kristen</option>
                                    <option value="Hindu">Hindu</option>
                                    <option value="Buda">Buda</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <small for="">Provinsi</small>
                                <select class="form-control" name="idprovinsi" id="idprovinsi">
                                    <option value="">pilih</option>
                                    <?php foreach ($provinsi as $rows) : ?>
                                        <option value="<?= $rows->idprovinsi; ?>"><?= $rows->provinsi; ?></option>
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
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <small for="">Kecamatan</small>
                                <select class="form-control" name="idkecamatan" id="idkecamatan">
                                    <option value="">pilih</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <small for="">Kel/Desa</small>
                                <select class="form-control" name="idkelurahan" id="idkelurahan">
                                    <option value="">pilih</option>
                                </select>
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group">
                                <small for="">No.rek</small>
                                <input type="text" id="norek" name="norek" class="form-control" onkeypress="return hanyaAngka(event)" autocomplete="off">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <small for="">Nama Bank</small>
                                <input type="text" id="nama_bank" name="nama_bank" class="form-control" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <small>NIK</small>
                                <input class="form-control" type="number" maxlength="16" id="nik" name="nik" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <small>Foto Profil</small>
                                <input class="form-control" type="file" id="foto" name="foto">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <small>Jabatan</small>
                                <input class="form-control" type="text" id="jabatan" name="jabatan">
                            </div>
                        </div>
                    </div>

                    <hr>
                    <div class="clearfix"></div>
                    <div class="text-right">
                        <a href="<?php echo (site_url('karyawan')) ?>" class="btn btn-danger">Kembali</a>
                        <button type="submit" id="simpan" class="btn btn-success">Simpan</button>
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
                foto_ktp: {
                    validators: {
                        notEmpty: {
                            message: 'Foto ktp tidak boleh kosong'
                        },
                    }
                },
                jabatan: {
                    validators: {
                        notEmpty: {
                            message: 'Jabatan tidak boleh kosong'
                        },
                    }
                },
            }
        });
    })

    $("#idprovinsi").change(function() {
        console.log($(this).val())
        var url = "<?php echo site_url('karyawan/add_ajax_kota'); ?>/" + $(this).val();
        $('#idkota').load(url);
        return false;
    })
    $("#idkota").change(function() {
        var url = "<?php echo site_url('karyawan/add_ajax_kecamatan'); ?>/" + $(this).val();
        $('#idkecamatan').load(url);
        return false;
    })
    $("#idkecamatan").change(function() {
        var url = "<?php echo site_url('karyawan/add_ajax_kelurahan'); ?>/" + $(this).val();
        $('#idkelurahan').load(url);
        return false;
    })

    $('#tgl_lahir').datepicker({
        endDate: new Date(),
        changeMonth: true,
        changeYear: true,
        format: "dd-mm-yyyy",
        autoclose: true,
        disableTouchKeyboard: true,
        Readonly: false,
    }).on('change', function(e) {
        // Revalidate the date field
        $('#form').bootstrapValidator('revalidateField', 'tgl_lahir');
    });
</script>
<?= $this->endSection() ?>