<?= $this->extend('admin/layout/template') ?>
<?= $this->section('content') ?>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Subheader-->
    <?= $this->include('admin/layout/_headerBawah'); ?>
    <!--end::Subheader-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <div class="card shadow card-body">
                <form action="<?php echo (site_url('petani/simpan')) ?>" id="form" method="post" enctype="multipart/form-data">
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
                                <small for="">Komoditi</small>
                                <select class="form-control" name="idkomoditi" id="idkomoditi">
                                    <option value="">pilih</option>
                                    <?php foreach ($komoditi as $rows) : ?>
                                        <option value="<?= $rows->idkomoditi; ?>"><?= $rows->komoditi; ?></option>
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
                                <small for="">No Hp</small>
                                <input type="text" id="nohp" name="nohp" onkeypress="return hanyaAngka(event)" class="form-control" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <small for="">Luas Tanah</small>
                                <input type="text" id="luas" name="luas" class="form-control" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <small>Foto Lokasi</small>
                                <input class="form-control" type="file" id="lokasi_gambar" name="lokasi_gambar" accept="image/jpg, image/png, image/jpeg">
                                <small>Foto menggunakan geotegging</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mt-4">
                                <small for="">Sertifikasi</small>
                                <div class="radio-inline" role="group">
                                    <label class="radio radio-square">
                                        <input type="radio" name="sertifikasi" id="sertifikasi1" value="1" autocomplete="off">
                                        <span></span>Ter-Sertifikasi</label>
                                    <label class="radio radio-square">
                                        <input type="radio" name="sertifikasi" id="sertifikasi2" value="0" autocomplete="off">
                                        <span></span>Tidak Tersertifikasi</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6" id="sertifikasi_tampil">
                            <div class="form-group">
                                <small>Foto Sertifikasi</small>
                                <input class="form-control" type="file" id="sertifikasi_gambar" name="sertifikasi_gambar" accept="image/jpg, image/png, image/jpeg">
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
    $("#sertifikasi_tampil").hide();
    $(document).ready(function() {
        var data = $("#sertifikasi1").val();
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

                // lokasi_gambar: {
                //     validators: {
                //         file: {
                //             extension: 'jpeg,png',
                //             type: 'image/jpeg,image/png',
                //             message: 'Foto lokasi tidak boleh kosong'
                //         },
                //         notEmpty: {
                //             message: 'Foto lokasi tidak boleh kosong'
                //         },
                //     }

                // },
                lokasi_gambar: {
                    validators: {
                        file: {
                            extension: 'jpg,jpeg,png',
                            type: 'image/jpg,image/jpeg,image/png',
                            message: 'Foto extension jpg,jpeg,png'
                        },
                        notEmpty: {
                            message: 'Foto lokasi tidak boleh kosong'
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

    $("#lokasi_gambar").on("change", function(e) {
        e.preventDefault();
        var files = $('#lokasi_gambar')[0].files;
        if (files.length > 0) {
            var fd = new FormData();

            // Append data 
            fd.append('lokasi_gambar', files[0]);

            // Hide alert 
            $('#responseMsg').hide();

            // AJAX request 
            $.ajax({
                url: "<?php echo site_url("petani/ceklokasi") ?>",
                method: 'post',
                data: fd,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(response) {
                    if (response.success != '1') {
                        $("#lokasi_gambar").val('');
                        $('#simpan').prop('readonly', true);
                        $('#simpan').prop('disabled', true);
                        alert("Foto tidak ada geotegging, silahkan upload foto yang sudah ada geotegging lokasinya");
                    } else {
                        $('#simpan').prop('readonly', false);
                        $('#simpan').prop('disabled', false);
                    }
                },
                error: function(response) {
                    // console.log("error : " + JSON.stringify(response));
                }
            });
        } else {
            alert("Please select a file.");
        }
    });
</script>
<?= $this->endSection() ?>