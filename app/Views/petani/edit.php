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
                <form action="<?php echo (site_url('petani/simpan')) ?>" id="form" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <input type="hidden" name="ltambah" id="ltambah" value="edit">

                        <div class="col-md-6">
                            <div class="form-group">
                                <small for="">Nama Lengkap</small>
                                <input type="text" id="nama" name="nama" value="<?= $petani->nama; ?>" class="form-control" autocomplete="off">
                                <input type="hidden" id="idtani" name="idtani" value="<?= $petani->idtani; ?>" class="form-control" autocomplete="off">
                                <input type="hidden" id="lat" name="lat" value="<?= $petani->latitude; ?>" class="form-control" autocomplete="off">
                                <input type="hidden" id="long" name="long" value="<?= $petani->longitude; ?>" class="form-control" autocomplete="off">

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <small for="">Komoditi</small>
                                <select class="form-control" name="idkomoditi" id="idkomoditi">
                                    <option value="">pilih</option>
                                    <?php foreach ($komoditi as $rows) : ?>
                                        <option value="<?= $rows->idkomoditi; ?>" <?= $petani->idkomoditi == $rows->idkomoditi ? 'selected' : ''; ?>><?= $rows->komoditi; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <small for="">Provinsi</small>
                                <select class="form-control" name="idprovinsi" id="idprovinsi">
                                    <option value="">pilih</option>
                                    <?php foreach ($provinsi as $rows) : ?>
                                        <option value="<?= $rows->idprovinsi; ?>" <?= $petani->idprovinsi == $rows->idprovinsi ? 'selected' : ''; ?>><?= $rows->provinsi; ?></option>
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
                            <input type="hidden" value="<?= $petani->idkota; ?>" id='idkotas'>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <small for="">Kecamatan</small>
                                <select class="form-control" name="idkecamatan" id="idkecamatan">
                                    <option value="">pilih</option>
                                </select>
                            </div>
                            <input type="hidden" value="<?= $petani->idkecamatan; ?>" id='idkecamatans'>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <small for="">Kel/Desa</small>
                                <select class="form-control" name="idkelurahan" id="idkelurahan">
                                    <option value="">pilih</option>
                                </select>
                            </div>
                            <input type="hidden" value="<?= $petani->idkelurahan; ?>" id='idkelurahans'>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mt-4">
                                <small for="">Jenis Kelamin</small>
                                <div class="radio-inline" role="group">
                                    <label class="radio radio-square">
                                        <input type="radio" name="jk" id="jk1" value="L" <?= $petani->jk == 'L' ? 'checked' : ''; ?> autocomplete="off">
                                        <span></span>Laki-Laki</label>
                                    <label class="radio radio-square">
                                        <input type="radio" name="jk" id="jk2" value="P" <?= $petani->jk == 'P' ? 'checked' : ''; ?> autocomplete="off">
                                        <span></span>Perempuan</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <small for="">Agama</small>
                                <select class="form-control" name="agama" id="agama">
                                    <option value="">pilih</option>
                                    <option value="Islam" <?= $petani->agama == 'Islam' ? 'selected' : ''; ?>>Islam</option>
                                    <option value="Khatolik" <?= $petani->agama == 'Khatolik' ? 'selected' : ''; ?>>Khatolik</option>
                                    <option value="Kristen" <?= $petani->agama == 'Kristen' ? 'selected' : ''; ?>>Kristen</option>
                                    <option value="Hindu" <?= $petani->agama == 'Hindu' ? 'selected' : ''; ?>>Hindu</option>
                                    <option value="Buda" <?= $petani->agama == 'Buda' ? 'selected' : ''; ?>>Buda</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <small for="">No Hp</small>
                                <input type="text" id="nohp" name="nohp" value="<?= $petani->nohp; ?>" onkeypress="return hanyaAngka(event)" class="form-control" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <small for="">Luas Tanah</small>
                                <input type="text" id="luas" name="luas" value="<?= $petani->luas; ?>" class="form-control" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <small>Foto Lokasi</small>
                                <input class="form-control" type="file" id="lokasi_gambar" name="lokasi_gambar">
                                <small>Foto menggunakan geotegging</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mt-4">
                                <small for="">Sertifikasi</small>
                                <div class="radio-inline" role="group">
                                    <label class="radio radio-square">
                                        <input type="radio" name="sertifikasi" id="sertifikasi1" value="1" <?= $petani->sertifikasi == '1' ? 'checked' : ''; ?> autocomplete="off">
                                        <span></span>Ter-Sertifikasi</label>
                                    <label class="radio radio-square">
                                        <input type="radio" name="sertifikasi" id="sertifikasi2" value="0" <?= $petani->sertifikasi == '0' ? 'checked' : ''; ?> autocomplete="off">
                                        <span></span>Tidak Tersertifikasi</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6" id="sertifikasi_tampil">
                            <div class="form-group">
                                <small>Foto Sertifikasi</small>
                                <input class="form-control" type="file" id="sertifikasi_gambar" name="sertifikasi_gambar">
                            </div>
                        </div>
                        <div class="col-md-12 mt-4">
                            <div class="row">
                                <div class="col-md-6 mt-4">
                                    <div class="form-group">
                                        <small>Foto Lokasi</small>
                                        <img class="img-fluid" src="<?php echo base_url('uploads/lokasi/thumbnails/' . $petani->lokasi_gambar) ?>">
                                        <input type="hidden" name="lokasi_gambar_lama" value="<?= $petani->lokasi_gambar; ?>">
                                    </div>
                                </div>
                                <?php if ($petani->sertifikasi_gambar != '' || $petani->sertifikasi_gambar != null) { ?>
                                    <div class="col-md-6 mt-4">
                                        <div class="form-group">
                                            <small>Foto Sertifikasi</small>
                                            <img class="img-fluid" src="<?php echo base_url('uploads/sertifikasi/thumbnails/' . $petani->sertifikasi_gambar) ?>">
                                            <input type="hidden" name="sertifikasi_gambar_lama" value="<?= $petani->sertifikasi_gambar; ?>">
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <?= $map['html']; ?>

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
        if ($('input[name="sertifikasi"]:checked').val() == '1') {
            $("#sertifikasi_tampil").show();
        } else {
            $("#sertifikasi_tampil").hide();
        }
        var url = "<?php echo site_url('petani/add_ajax_kota'); ?>/" + $('#idprovinsi').val();
        $('#idkota').load(url);
        setTimeout(function() {
            kota($('#idkotas').val());
        }, 1000);
        setTimeout(function() {
            var url = "<?php echo site_url('petani/add_ajax_kecamatan'); ?>/" + $('#idkota').val();
            $('#idkecamatan').load(url);
            setTimeout(function() {
                kecamatan($('#idkecamatans').val());
            }, 1000);
        }, 2000);
        setTimeout(function() {
            var url = "<?php echo site_url('petani/add_ajax_kelurahan'); ?>/" + $('#idkecamatan').val();
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
                idkomoditi: {
                    validators: {
                        notEmpty: {
                            message: 'Komoditi tidak boleh kosong'
                        },
                    }
                },
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
                nohp: {
                    validators: {
                        notEmpty: {
                            message: 'Nomor Hp tidak boleh kosong'
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


                sertifikasi: {
                    validators: {
                        notEmpty: {
                            message: 'Sertifikasi tidak boleh kosong'
                        },
                    }
                },
            }
        });
    })

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
        var url = "<?php echo site_url('petani/add_ajax_kota'); ?>/" + $(this).val();
        $('#idkota').load(url);

        return false;
    })
    $("#idkota").change(function() {
        var url = "<?php echo site_url('petani/add_ajax_kecamatan'); ?>/" + $(this).val();
        $('#idkecamatan').load(url);
        return false;
    })
    $("#idkecamatan").change(function() {
        var url = "<?php echo site_url('petani/add_ajax_kelurahan'); ?>/" + $(this).val();
        $('#idkelurahan').load(url).on('change', function(e) {
            // Revalidate the date field
            $('#form').bootstrapValidator('revalidateField', 'idkelurahan');
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
    $(document).on('keyup', '#luas', function(e) {

        var regex = /[^\d.]|\.(?=.*\.)/g;
        var subst = "";

        var str = $(this).val();
        var result = str.replace(regex, subst);
        $(this).val(result);

    });
    $(document).on('click', '#sertifikasi1', function(e) {
        $("#sertifikasi_tampil").show();
    });
    $(document).on('click', '#sertifikasi2', function(e) {
        $("#sertifikasi_tampil").hide();
    });
</script>
<?= $this->endSection() ?>