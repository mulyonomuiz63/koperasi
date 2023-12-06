 <?= $this->extend('admin/login/template') ?>
 <?= $this->section('content') ?>
 <!--begin:Forgot Password Form-->
 <div class="login-forgot">
     <div class="text-center mb-10 mb-lg-20">
         <h3 class="">Lupa Password?</h3>
         <p class="text-muted font-weight-bold">Masukan email anda untuk mengatur password baru</p>
     </div>
     <form class="form text-left" id="kt_login_forgot_form">
         <div class="form-group py-2 m-0 border-bottom">
             <input class="form-control h-auto border-0 px-0 placeholder-dark-75" type="text" placeholder="Email" name="email" autocomplete="off" />
         </div>
         <div class="form-group d-flex flex-wrap flex-center mt-10">
             <button id="kt_login_forgot_submit" class="btn btn-primary btn-pill font-weight-bold px-9 py-4 my-3 mx-2">Submit</button>
             <button id="kt_login_forgot_cancel" class="btn btn-outline-primary btn-pill font-weight-bold px-9 py-4 my-3 mx-2">Cancel</button>
         </div>
     </form>
 </div>
 <!--end:Forgot Password Form-->
 <?= $this->endSection() ?>