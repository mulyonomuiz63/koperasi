 <?= $this->extend('admin/login/template') ?>
 <?= $this->section('content') ?>
 <!--begin:Sign Up Form-->
 <div>
     <form action="<?php echo (site_url('simpanRegistrasi')) ?>" id="form" class="form text-left" method="post" enctype="multipart/form-data">
         <div class="text-center mb-10 mb-lg-20">
             <h3 class="">Daftar</h3>
             <p class="text-muted font-weight-bold">Masukkan data anda untuk membuat akun anda</p>
         </div>
         <div class="form-group py-2 m-0">
             <input class="form-control h-auto border-0 px-0 placeholder-dark-75" type="text" placeholder="Nama" name="nama" />
         </div>
         <div class="form-group py-2 m-0 border-top">
             <input class="form-control h-auto border-0 px-0 placeholder-dark-75" type="text" placeholder="Email" name="email" autocomplete="off" />
         </div>
         <div class="form-group py-2 m-0 border-top">
             <input class="form-control h-auto border-0 px-0 placeholder-dark-75" type="text" placeholder="hp" name="hp" onkeypress="return hanyaAngka(event)" autocomplete="off" />
         </div>
         <div class="form-group py-2 m-0 border-top">
             <input class="form-control h-auto border-0 px-0 placeholder-dark-75" type="password" placeholder="Password" name="password" id="password" onkeyup='cek_password_new()' />
         </div>
         <div class="form-group py-2 m-0 border-top">
             <input class="form-control h-auto border-0 px-0 placeholder-dark-75" type="password" placeholder="Confirm Password" name="cpassword" id="cpassword" onkeyup='cek_password()' />
             <span id='conf_pass'></span>
         </div>
         <div class="form-group mt-5">
             <div class="checkbox-inline">
                 <label class="checkbox checkbox-outline font-weight-bold">
                     <input type="checkbox" name="privasi" value="1" />
                     <span></span>Syarat dan Ketentuan
                     <a href="#" class="ml-1"></a>.</label>
             </div>
         </div>
         <div class="form-group d-flex flex-wrap flex-center">
             <button type="submit" id="button" class="btn btn-primary btn-pill font-weight-bold px-9 py-4 my-3 mx-2">Daftar</button>
             <a href="<?= base_url('login'); ?>" class="btn btn-outline-primary btn-pill font-weight-bold px-9 py-4 my-3 mx-2">Kembali</a>
         </div>
     </form>
 </div>
 <!--end:Sign Up Form-->
 <?= $this->endSection() ?>
 <?= $this->section('script') ?>
 <script type="text/javascript">
     $('#form').bootstrapValidator({
         feedbackIcons: {
             valid: 'glyphicon glyphicon-ok',
             invalid: 'glyphicon glyphicon-remove',
             validating: 'glyphicon glyphicon-refresh'
         },
         fields: {
             nama: {
                 validators: {
                     notEmpty: {
                         message: 'Nama harus diisi'
                     }
                 }
             },
             email: {
                 validators: {
                     notEmpty: {
                         message: 'Email harus diisi'
                     },
                     emailAddress: {
                         message: 'Email yang dimasukan tidak valid'
                     }
                 }
             },
             hp: {
                 validators: {
                     notEmpty: {
                         message: 'No hp harus diisi'
                     },
                 }
             },
             password: {
                 validators: {
                     notEmpty: {
                         message: 'Sandi harus diisi'
                     }
                 }
             },
             cpassword: {
                 validators: {
                     notEmpty: {
                         message: 'Masukan ulang kata sandi anda'
                     },
                     identical: {
                         compare: function() {
                             return form.querySelector('[name="password"]').value;
                         },
                         message: 'Kata sandi konfirmasi tidak sama'
                     }
                 }
             },
             privasi: {
                 validators: {
                     notEmpty: {
                         message: 'Ceklis untuk menyetujui syarat dan ketentuan'
                     }
                 }
             },
         },
     });

     function cek_password() {
         var password = $("#password").val();
         var confirmPassword = $("#cpassword").val();
         if (password != confirmPassword) {
             $("#conf_pass").css("color", "#fc5d32");
             $('#conf_pass').html('Sandi tidak sama');
             $('#button').prop('disabled', true);
         } else {
             $('#conf_pass').html('');
             $('#button').prop('disabled', false);
         }
         return true;
     };

     function cek_password_new() {
         var password = $("#password").val();
         var confirmPassword = $("#cpassword").val();
         if (confirmPassword == "") {
             $('#button').prop('disabled', true);
         } else {
             if (password != confirmPassword) {
                 $("#conf_pass").css("color", "#fc5d32");
                 $('#conf_pass').html('Sandi tidak sama');
                 $('#button').prop('disabled', true);
             } else {
                 $('#conf_pass').html('');
                 $('#button').prop('disabled', false);
             }
         }
         return true;
     };
 </script>
 <?= $this->endSection() ?>