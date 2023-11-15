<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>
<div class="d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Subheader-->
    <?= $this->include('layout/_headerBawah'); ?>
    <!--end::Subheader-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <div class="card shadow card-body">
                <form action="<?php echo (site_url('karyawan/simpan')) ?>" id="form" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <input type="hidden" name="ltambah" id="ltambah" value="edit">
                        <div class="col-md-6">
                            <div class="form-group">
                                <small for="">Nama Lengkap</small>
                                <input type="text" id="nama" name="nama" value="<?= $karyawan->nama; ?>" class="form-control" autocomplete="off">
                                <input type="hidden" id="idkaryawan" name="idkaryawan" value="<?= $karyawan->idkaryawan; ?>" class="form-control" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <small for="">Tempat Lahir</small>
                                <input type="text" id="tempat_lahir" name="tempat_lahir" value="<?= $karyawan->tempat_lahir; ?>" class="form-control" autocomplete="off">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <small for="">Tanggal Lahir</small>
                                <input type="text" id="tgl_lahir" name="tgl_lahir" value="<?= date('d-m-Y', strtotime($karyawan->tgl_lahir)); ?>" class="form-control" autocomplete="off">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mt-4">
                                <small for="">Jenis Kelamin</small>
                                <div class="radio-inline" role="group">
                                    <label class="radio radio-square">
                                        <input type="radio" name="jk" id="jk1" value="L" <?= $karyawan->jk == 'L' ? 'checked' : ''; ?> autocomplete="off">
                                        <span></span>Laki-Laki</label>
                                    <label class="radio radio-square">
                                        <input type="radio" name="jk" id="jk2" value="P" <?= $karyawan->jk == 'P' ? 'checked' : ''; ?> autocomplete="off">
                                        <span></span>Perempuan</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <small for="">Agama</small>
                                <select class="form-control" name="agama" id="agama">
                                    <option value="">pilih</option>
                                    <option value="Islam" <?= $karyawan->agama == 'Islam' ? 'selected' : ''; ?>>Islam</option>
                                    <option value="Khatolik" <?= $karyawan->agama == 'Khatolik' ? 'selected' : ''; ?>>Khatolik</option>
                                    <option value="Kristen" <?= $karyawan->agama == 'Kristen' ? 'selected' : ''; ?>>Kristen</option>
                                    <option value="Hindu" <?= $karyawan->agama == 'Hindu' ? 'selected' : ''; ?>>Hindu</option>
                                    <option value="Buda" <?= $karyawan->agama == 'Buda' ? 'selected' : ''; ?>>Buda</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <small for="">Provinsi</small>
                                <select class="form-control" name="idprovinsi" id="idprovinsi">
                                    <option value="">pilih</option>
                                    <?php foreach ($provinsi as $rows) : ?>
                                        <option value="<?= $rows->idprovinsi; ?>" <?= $karyawan->idprovinsi == $rows->idprovinsi ? 'selected' : ''; ?>><?= $rows->provinsi; ?></option>
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
                            <input type="hidden" value="<?= $karyawan->idkota; ?>" id='idkotas'>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <small for="">Kecamatan</small>
                                <select class="form-control" name="idkecamatan" id="idkecamatan">
                                    <option value="">pilih</option>
                                </select>
                            </div>
                            <input type="hidden" value="<?= $karyawan->idkecamatan; ?>" id='idkecamatans'>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <small for="">Kel/Desa</small>
                                <select class="form-control" name="idkelurahan" id="idkelurahan">
                                    <option value="">pilih</option>
                                </select>
                            </div>
                            <input type="hidden" value="<?= $karyawan->idkelurahan; ?>" id='idkelurahans'>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group">
                                <small for="">No.rek</small>
                                <input type="text" id="norek" name="norek" value="<?= $karyawan->norek; ?>" class="form-control" onkeypress="return hanyaAngka(event)" autocomplete="off">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <small for="">Nama Bank</small>
                                <input type="text" id="nama_bank" name="nama_bank" value="<?= $karyawan->nama_bank; ?>" class="form-control" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <small>NIK</small>
                                <input class="form-control" type="number" maxlength="16" id="nik" name="nik" value="<?= $karyawan->nik; ?>" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <small>Jabatan</small>
                                <input class="form-control" type="text" id="jabatan" name="jabatan" value="<?= $karyawan->jabatan; ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <small>Foto Profil</small>
                                <input class="form-control" type="file" id="foto" name="foto">
                                <input class="form-control" type="hidden" id="fotolama" name="fotolama" value="<?= $karyawan->foto; ?>">
                            </div>
                        </div>
                        <div class="col-md-6 mt-4">
                            <div class="form-group">
                                <small>Foto Profil</small>
                                <img height="20%" width="20%" src="<?php echo base_url('uploads/karyawan/thumbnails/' . $karyawan->foto) ?>">
                            </div>
                        </div>

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
        var url = "<?php echo site_url('karyawan/add_ajax_kota'); ?>/" + $('#idprovinsi').val();
        $('#idkota').load(url);
        setTimeout(function() {
            kota($('#idkotas').val());
        }, 1000);
        setTimeout(function() {
            var url = "<?php echo site_url('karyawan/add_ajax_kecamatan'); ?>/" + $('#idkota').val();
            $('#idkecamatan').load(url);
            setTimeout(function() {
                kecamatan($('#idkecamatans').val());
            }, 1000);
        }, 2000);
        setTimeout(function() {
            var url = "<?php echo site_url('karyawan/add_ajax_kelurahan'); ?>/" + $('#idkecamatan').val();
            $('#idkelurahan').load(url);
            setTimeout(function() {
                kelurahan($('#idkelurahans').val());
            }, 1000);
        }, 4000);


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
        $('#idkelurahan').load(url).on('change', function(e) {
            // Revalidate the date field
            $('#form').bootstrapValidator('revalidateField', 'idkecamatan');
        });
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