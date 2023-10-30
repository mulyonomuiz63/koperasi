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
                    <h5 class="text-dark font-weight-bold my-1 mr-5">User</h5>
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
                <form action="<?php echo (site_url('user/simpan')) ?>" id="form" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <input type="hidden" name="ltambah" id="ltambah" value="tambah">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Role</label>
                                <select class="form-control" name="idrole" id="idrole">
                                    <option value="">Role</option>
                                    <?php foreach ($role as $rows) : ?>
                                        <option value="<?= $rows->idrole; ?>"><?= $rows->role; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Nama User</label>
                                <input type="text" id="nama" name="nama" class="form-control" placeholder="nama" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" id="email" name="email" class="form-control" placeholder="email" onkeyup='cek_email()' autocomplete="off">
                                <span id='pesan_email'></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Hp</label>
                                <input type="tel" id="hp" name="hp" class="form-control" placeholder="hp" onkeyup='cek_hp()' onkeypress="return hanyaAngka(event)" autocomplete="off">
                                <span id='pesan_hp'></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mt-4">
                                <label for="">Status</label>
                                <div class="radio-inline" role="group">
                                    <label class="radio radio-square">
                                        <input type="radio" checked="checked" name="status" id="status1" value="1" autocomplete="off" checked>
                                        <span></span>Aktif</label>
                                    <label class="radio radio-square">
                                        <input type="radio" name="status" id="status2" value="0" autocomplete="off">
                                        <span></span>Tidak Aktif</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Sandi</label>
                                <input type="password" name="password" id="password" class="form-control" placeholder="Sandi" onkeyup='cek_password_new()' value="" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Ulangi Sandi</label>
                                <input type="password" name="password_new" id="password_new" class="form-control" placeholder="ulangi sandi" onkeyup='cek_password()' value="" autocomplete="off">
                                <span id='conf_pass'></span>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="clearfix"></div>
                    <div class="text-right">
                        <a href="<?php echo (site_url('user')) ?>" class="btn btn-danger">Kembali</a>
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
                idrole: {
                    validators: {
                        notEmpty: {
                            message: 'Role tidak boleh kosong'
                        },
                    }
                },
                email: {
                    validators: {
                        notEmpty: {
                            message: 'email tidak boleh kosong'
                        },
                    }
                },
                hp: {
                    validators: {
                        notEmpty: {
                            message: 'Hp tidak boleh kosong'
                        },
                        stringLength: {
                            max: 15,
                            message: 'Panjang angka diperbolehkan 15'
                        },
                    }
                },
                nama: {
                    validators: {
                        notEmpty: {
                            message: 'Nama tidak boleh kosong'
                        },
                        stringLength: {
                            min: 3,
                            max: 100,
                            message: 'Panjang Karakter diperbolehkan dari 3 sd 100'
                        },
                    }
                },
                password: {
                    validators: {
                        notEmpty: {
                            message: 'Sandi tidak boleh kosong'
                        },

                    }
                },
                password_new: {
                    validators: {
                        notEmpty: {
                            message: 'Ulangi sandi tidak boleh kosong'
                        },
                    }
                },

            }
        });
    })

    function cek_password() {
        var password = $("#password").val();
        var confirmPassword = $("#password_new").val();
        console.log(confirmPassword);
        if (password != confirmPassword) {
            $("#conf_pass").css("color", "#fc5d32");
            $('#conf_pass').html('Sandi tidak sama');
            $('#simpan').prop('disabled', true);
        } else {
            $('#conf_pass').html('');
            $('#simpan').prop('disabled', false);
        }
        return true;
    };

    function cek_password_new() {
        var password = $("#password").val();
        var confirmPassword = $("#password_new").val();
        if (confirmPassword == "") {
            $('#simpan').prop('disabled', true);
        } else {
            if (password != confirmPassword) {
                $("#conf_pass").css("color", "#fc5d32");
                $('#conf_pass').html('Sandi tidak sama');
                $('#simpan').prop('disabled', true);
            } else {
                $('#conf_pass').html('');
                $('#simpan').prop('disabled', false);
            }
        }
        return true;
    };

    function cek_email() {
        // $("#pesan_email").hide();

        // ambil value email dari form
        var email = $("#email").val();


        // proses pengecekan email tersedia atau tidak.
        $.ajax({
            url: "<?php echo site_url() . '/user/cek_status_email'; ?>", //arahkan pada proses_tambah di controller member
            data: 'email=' + email,
            type: "POST",
            success: function(msg) {
                if (msg == 1) {
                    $("#pesan_email").css("color", "#fc5d32");
                    $("#email").css("border-color", "#fc5d32");
                    $("#pesan_email").html("Maaf Email sudah digunakan.");
                    $('#email').val('');

                } else {
                    $("#pesan_email").css("color", "#ced4da");
                    $("#email").css("border-color", "#ced4da");
                    $("#pesan_email").html("");

                }
                $("#pesan_email").fadeIn(1000);
            }
        });

    }

    function cek_hp() {

        var hp = $("#hp").val();
        var str1 = $("#hp").val().substring(0, 1);
        var filter = /^[08][0-9]{10,14}$/;
        if (str1 != '0') {
            $("#hp").val('');
        }

        $.ajax({
            url: "<?php echo site_url() . '/user/cek_status_hp'; ?>", //arahkan pada proses_tambah di controller member
            data: 'hp=' + hp,
            type: "POST",
            success: function(msg) {
                if (msg == 1) {
                    $("#pesan_hp").css("color", "#fc5d32");
                    $("#hp").css("border-color", "#fc5d32");
                    $("#pesan_hp").html("Maaf nomor hp sudah digunakan.");
                    $('#hp').val('');

                } else {
                    $("#pesan_hp").css("color", "#ced4da");
                    $("#hp").css("border-color", "#ced4da");
                    $("#pesan_hp").html("");

                }
                $("#pesan_hp").fadeIn(1000);
            }
        });

    }
</script>
<?= $this->endSection() ?>