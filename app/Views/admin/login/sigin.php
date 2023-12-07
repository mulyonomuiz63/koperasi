 <?= $this->extend('admin/login/template') ?>
 <?= $this->section('content') ?>
 <!--begin:Sign In Form-->
 <div class="login-signin">
     <div class="text-center mb-10 mb-lg-20">
         <h2 class="font-weight-bold">Masuk</h2>
         <p class="text-muted font-weight-bold">Masukan username and password</p>
     </div>
     <form class="form text-left" id="form" method="post" action="<?php echo (site_url('login/cek_login')) ?>">
         <div class="form-group py-2 m-0">
             <input class="form-control h-auto border-0 px-0 placeholder-dark-75" type="email" placeholder="email" name="email" value="" autocomplete="off" />
         </div>
         <div class="form-group py-2 border-top m-0">
             <input class="form-control h-auto border-0 px-0 placeholder-dark-75" type="Password" placeholder="Password" name="password" value="" />
         </div>
         <div class="form-group d-flex flex-wrap justify-content-between align-items-center mt-5">
             <a href="javascript:;" id="kt_login_forgot" class="text-muted text-hover-primary font-weight-bold">Forget Password ?</a>
         </div>
         <div class="text-center mt-15">
             <button type="submit" class="btn btn-primary btn-pill shadow-sm py-4 px-9 font-weight-bold">Masuk</button>
         </div>
     </form>
 </div>
 <!--end:Sign In Form-->
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
             password: {
                 validators: {
                     notEmpty: {
                         message: 'Sandi harus diisi'
                     }
                 }
             },
         },
     });
 </script>
 <?= $this->endSection() ?>