 <?= $this->extend('admin/login/template') ?>
 <?= $this->section('content') ?>
 <!--begin:Forgot Password Form-->
 <div>
     <div class="text-center mb-10 mb-lg-20">
         <h3 class="">Lupa Sandi?</h3>
         <p class="text-muted font-weight-bold">Masukan email anda untuk mengatur sandi baru</p>
     </div>
     <form class="form text-left" action="<?php echo (site_url('resetPassword')) ?>" method="post" enctype="multipart/form-data">
         <div class="form-group py-2 m-0 border-bottom">
             <input class="form-control h-auto border-0 px-0 placeholder-dark-75" type="email" placeholder="Email" name="email" autocomplete="off" required />
         </div>
         <div class="form-group d-flex flex-wrap flex-center mt-10">
             <button type="submit" class="btn btn-primary btn-pill font-weight-bold px-9 py-4 my-3 mx-2">Submit</button>
             <a href="<?= base_url('login'); ?>" class="btn btn-outline-primary btn-pill font-weight-bold px-9 py-4 my-3 mx-2">Kembali</a>
         </div>
     </form>
 </div>
 <!--end:Forgot Password Form-->
 <?= $this->endSection() ?>