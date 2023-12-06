 <?= $this->extend('admin/login/template') ?>
 <?= $this->section('content') ?>
 <!--begin:Sign In Form-->
 <div class="login-signin">
     <div class="text-center mb-10 mb-lg-20">
         <h2 class="font-weight-bold">Masuk</h2>
         <p class="text-muted font-weight-bold">Masukan username and password</p>
     </div>
     <form class="form text-left" id="kt_login_signin_form" method="post" action="<?php echo (site_url('login/cek_login')) ?>">
         <div class="form-group py-2 m-0">
             <input class="form-control h-auto border-0 px-0 placeholder-dark-75" type="email" placeholder="email" name="email" value="" autocomplete="off" />
         </div>
         <div class="form-group py-2 border-top m-0">
             <input class="form-control h-auto border-0 px-0 placeholder-dark-75" type="Password" placeholder="Password" name="password" value="" />
         </div>
         <div class="form-group d-flex flex-wrap justify-content-between align-items-center mt-5">
             <!-- <div class="checkbox-inline">
                                        <label class="checkbox m-0 text-muted font-weight-bold">
                                            <input type="checkbox" name="remember" />
                                            <span></span>Remember me</label>
                                    </div> -->
             <a href="javascript:;" id="kt_login_forgot" class="text-muted text-hover-primary font-weight-bold">Forget Password ?</a>
         </div>
         <div class="text-center mt-15">
             <button type="submit" class="btn btn-primary btn-pill shadow-sm py-4 px-9 font-weight-bold">Masuk</button>
         </div>
     </form>
 </div>
 <!--end:Sign In Form-->
 <?= $this->endSection() ?>