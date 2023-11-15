<!--begin::Aside-->
<div class="aside aside-left  aside-fixed  d-flex flex-column flex-row-auto" id="kt_aside">

	<!--begin::Brand-->
	<div class="brand flex-column-auto " id="kt_brand">

		<!--begin::Logo-->
		<a href="<?php echo base_url('/') ?>" class="brand-logo">
			<img height="50px" width="140px" alt="Logo" src="<?= base_url('assets/media/logos/logo-light.png') ?>" />
		</a>

		<!--end::Logo-->

		<!--begin::Toggle-->
		<button class="brand-toggle btn btn-sm px-0" id="kt_aside_toggle">
			<span class="svg-icon svg-icon svg-icon-xl">

				<!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Angle-double-left.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
					<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
						<polygon points="0 0 24 0 24 24 0 24" />
						<path d="M5.29288961,6.70710318 C4.90236532,6.31657888 4.90236532,5.68341391 5.29288961,5.29288961 C5.68341391,4.90236532 6.31657888,4.90236532 6.70710318,5.29288961 L12.7071032,11.2928896 C13.0856821,11.6714686 13.0989277,12.281055 12.7371505,12.675721 L7.23715054,18.675721 C6.86395813,19.08284 6.23139076,19.1103429 5.82427177,18.7371505 C5.41715278,18.3639581 5.38964985,17.7313908 5.76284226,17.3242718 L10.6158586,12.0300721 L5.29288961,6.70710318 Z" fill="#000000" fill-rule="nonzero" transform="translate(8.999997, 11.999999) scale(-1, 1) translate(-8.999997, -11.999999) " />
						<path d="M10.7071009,15.7071068 C10.3165766,16.0976311 9.68341162,16.0976311 9.29288733,15.7071068 C8.90236304,15.3165825 8.90236304,14.6834175 9.29288733,14.2928932 L15.2928873,8.29289322 C15.6714663,7.91431428 16.2810527,7.90106866 16.6757187,8.26284586 L22.6757187,13.7628459 C23.0828377,14.1360383 23.1103407,14.7686056 22.7371482,15.1757246 C22.3639558,15.5828436 21.7313885,15.6103465 21.3242695,15.2371541 L16.0300699,10.3841378 L10.7071009,15.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(15.999997, 11.999999) scale(-1, 1) rotate(-270.000000) translate(-15.999997, -11.999999) " />
					</g>
				</svg>

				<!--end::Svg Icon-->
			</span> </button>

		<!--end::Toolbar-->
	</div>

	<!--end::Brand-->

	<?php
	$komoditi = array(
		'komoditi',
	);
	$kualitas = array(
		'kualitas',
	);
	$produk = array(
		'produk',
	);
	$produk_tani = array_merge($komoditi, $kualitas, $produk);


	$dashboard = array(
		'dashboard',
	);
	$user = array(
		'user',
	);
	$menu = array(
		'menu',
	);
	$menu_role = array(
		'menu-role',
	);
	$role = array(
		'role',
	);
	$setting = array_merge($user, $menu, $menu_role, $role);
	$bayer = array(
		'bayer',
	);
	$pengepul = array(
		'pengepul',
	);
	$kelompok_tani = array(
		'kelompok-tani',
	);
	$petani = array(
		'petani',
	);
	$pelanggan = array_merge($pengepul, $kelompok_tani, $petani);
	$karyawan = array(
		'karyawan',
	);
	?>

	<!--begin::Aside Menu-->
	<div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">

		<!--begin::Menu Container-->
		<div id="kt_aside_menu" class="aside-menu my-4 " data-menu-vertical="1" data-menu-scroll="1" data-menu-dropdown-timeout="500">

			<!--begin::Menu Nav-->
			<ul class="menu-nav ">
				<?php if (roleAkses(session()->get('iduser'), 'dashboard')) : ?>
					<li class="menu-item  <?php echo set_active('') ?>" aria-haspopup="true">
						<a href="<?php echo base_url('/') ?>" class="menu-link ">
							<span class="svg-icon menu-icon">
								<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
									<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
										<polygon points="0 0 24 0 24 24 0 24" />
										<path d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z" fill="#000000" fill-rule="nonzero" />
										<path d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z" fill="#000000" opacity="0.3" />
									</g>
								</svg>

								<!--end::Svg Icon-->
							</span>
							<span class="menu-text">Dashboard</span>
						</a>
					</li>
				<?php endif; ?>
				<li class="menu-section ">
					<h4 class="menu-text">Custom</h4>
					<i class="menu-icon ki ki-bold-more-hor icon-md"></i>
				</li>

				<?php if (roleAksesMenu(session()->get('iduser'), "('komoditi','produk','kualitas')")) : ?>
					<li class="menu-item  menu-item-submenu <?php echo set_active($produk_tani) ?> " aria-haspopup="true" data-menu-toggle="hover">
						<a href="javascript:;" class="menu-link menu-toggle">
							<span class="svg-icon menu-icon">
								<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
									<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
										<rect x="0" y="0" width="24" height="24" />
										<rect fill="#000000" x="4" y="4" width="7" height="7" rx="1.5" />
										<path d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z" fill="#000000" opacity="0.3" />
									</g>
								</svg>
							</span>
							<span class="menu-text">Produk Tani</span>
							<i class="menu-arrow"></i>
						</a>
						<?php if (roleAkses(session()->get('iduser'), $komoditi[0])) : ?>
							<div class="menu-submenu"><i class="menu-arrow"></i>
								<ul class="menu-subnav">
									<li class="menu-item <?php echo set_active_submenu($komoditi) ?>" aria-haspopup="true"><a href="<?= base_url('komoditi') ?>" class="menu-link "><i class="menu-bullet menu-bullet-dot"><span></span></i><span class="menu-text">Komoditi</span></a></li>
								</ul>
							</div>
						<?php endif; ?>
						<?php if (roleAkses(session()->get('iduser'), $kualitas[0])) : ?>
							<div class="menu-submenu"><i class="menu-arrow"></i>
								<ul class="menu-subnav">
									<li class="menu-item <?php echo set_active_submenu($kualitas) ?>" aria-haspopup="true"><a href="<?= base_url('kualitas') ?>" class="menu-link "><i class="menu-bullet menu-bullet-dot"><span></span></i><span class="menu-text">Kualitas</span></a></li>
								</ul>
							</div>
						<?php endif; ?>
						<?php if (roleAkses(session()->get('iduser'), $produk[0])) : ?>
							<div class="menu-submenu"><i class="menu-arrow"></i>
								<ul class="menu-subnav">
									<li class="menu-item <?php echo set_active_submenu($produk) ?>" aria-haspopup="true"><a href="<?= base_url('produk') ?>" class="menu-link "><i class="menu-bullet menu-bullet-dot"><span></span></i><span class="menu-text">Produk</span></a></li>
								</ul>
							</div>
						<?php endif; ?>
					</li>
				<?php endif; ?>


				<?php if (roleAksesMenu(session()->get('iduser'), "('pengepul','kelompok-tani', 'petani')")) : ?>
					<li class="menu-item  menu-item-submenu <?php echo set_active($pelanggan) ?> " aria-haspopup="true" data-menu-toggle="hover">
						<a href="javascript:;" class="menu-link menu-toggle">
							<span class="svg-icon menu-icon">
								<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
									<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
										<rect x="0" y="0" width="24" height="24" />
										<rect fill="#000000" x="4" y="4" width="7" height="7" rx="1.5" />
										<path d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z" fill="#000000" opacity="0.3" />
									</g>
								</svg>
							</span>
							<span class="menu-text">Pelanggan</span>
							<i class="menu-arrow"></i>
						</a>
						<?php if (roleAkses(session()->get('iduser'), $pengepul[0])) : ?>
							<div class="menu-submenu"><i class="menu-arrow"></i>
								<ul class="menu-subnav">
									<li class="menu-item <?php echo set_active_submenu($pengepul) ?>" aria-haspopup="true"><a href="<?= base_url('pengepul') ?>" class="menu-link "><i class="menu-bullet menu-bullet-dot"><span></span></i><span class="menu-text">Pengepul</span></a></li>
								</ul>
							</div>
						<?php endif; ?>
						<?php if (roleAkses(session()->get('iduser'), $kelompok_tani[0]) || roleAkses(session()->get('iduser'), $petani[0])) : ?>
							<div class="menu-submenu"><i class="menu-arrow"></i>
								<ul class="menu-subnav">
									<li class="menu-item <?php echo set_active_submenu($kelompok_tani), set_active_submenu($petani) ?>" aria-haspopup="true"><a href="<?= base_url('kelompok-tani') ?>" class="menu-link "><i class="menu-bullet menu-bullet-dot"><span></span></i><span class="menu-text">kelompok Tani</span></a></li>
								</ul>
							</div>
						<?php endif; ?>

					</li>
				<?php endif; ?>

				<?php if (roleAkses(session()->get('iduser'), $bayer[0])) : ?>
					<li class="menu-item  menu-item-submenu <?php echo set_active($bayer) ?> " aria-haspopup="true" data-menu-toggle="hover">
						<a href="<?= base_url('bayer') ?>" class="menu-link menu-toggle">
							<span class="svg-icon menu-icon">
								<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
									<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
										<polygon points="0 0 24 0 24 24 0 24" />
										<path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
										<path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero" />
									</g>
								</svg>
							</span>
							<span class="menu-text">Bayer</span>
						</a>
					</li>
				<?php endif; ?>
				<?php if (roleAkses(session()->get('iduser'), $karyawan[0])) : ?>
					<li class="menu-item  menu-item-submenu <?php echo set_active($karyawan) ?> " aria-haspopup="true" data-menu-toggle="hover">
						<a href="<?= base_url('karyawan') ?>" class="menu-link menu-toggle">
							<span class="svg-icon menu-icon">
								<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
									<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
										<polygon points="0 0 24 0 24 24 0 24" />
										<path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
										<path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero" />
									</g>
								</svg>
							</span>
							<span class="menu-text">Karyawan</span>
						</a>
					</li>
				<?php endif; ?>
				<?php if (roleAksesMenu(session()->get('iduser'), "('user','menu','role','menu-role')")) : ?>
					<li class="menu-item  menu-item-submenu <?php echo set_active($setting) ?> " aria-haspopup="true" data-menu-toggle="hover">
						<a href="javascript:;" class="menu-link menu-toggle">
							<span class="svg-icon menu-icon">
								<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
									<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
										<rect x="0" y="0" width="24" height="24" />
										<path d="M18.6225,9.75 L18.75,9.75 C19.9926407,9.75 21,10.7573593 21,12 C21,13.2426407 19.9926407,14.25 18.75,14.25 L18.6854912,14.249994 C18.4911876,14.250769 18.3158978,14.366855 18.2393549,14.5454486 C18.1556809,14.7351461 18.1942911,14.948087 18.3278301,15.0846699 L18.372535,15.129375 C18.7950334,15.5514036 19.03243,16.1240792 19.03243,16.72125 C19.03243,17.3184208 18.7950334,17.8910964 18.373125,18.312535 C17.9510964,18.7350334 17.3784208,18.97243 16.78125,18.97243 C16.1840792,18.97243 15.6114036,18.7350334 15.1896699,18.3128301 L15.1505513,18.2736469 C15.008087,18.1342911 14.7951461,18.0956809 14.6054486,18.1793549 C14.426855,18.2558978 14.310769,18.4311876 14.31,18.6225 L14.31,18.75 C14.31,19.9926407 13.3026407,21 12.06,21 C10.8173593,21 9.81,19.9926407 9.81,18.75 C9.80552409,18.4999185 9.67898539,18.3229986 9.44717599,18.2361469 C9.26485393,18.1556809 9.05191298,18.1942911 8.91533009,18.3278301 L8.870625,18.372535 C8.44859642,18.7950334 7.87592081,19.03243 7.27875,19.03243 C6.68157919,19.03243 6.10890358,18.7950334 5.68746499,18.373125 C5.26496665,17.9510964 5.02757002,17.3784208 5.02757002,16.78125 C5.02757002,16.1840792 5.26496665,15.6114036 5.68716991,15.1896699 L5.72635306,15.1505513 C5.86570889,15.008087 5.90431906,14.7951461 5.82064513,14.6054486 C5.74410223,14.426855 5.56881236,14.310769 5.3775,14.31 L5.25,14.31 C4.00735931,14.31 3,13.3026407 3,12.06 C3,10.8173593 4.00735931,9.81 5.25,9.81 C5.50008154,9.80552409 5.67700139,9.67898539 5.76385306,9.44717599 C5.84431906,9.26485393 5.80570889,9.05191298 5.67216991,8.91533009 L5.62746499,8.870625 C5.20496665,8.44859642 4.96757002,7.87592081 4.96757002,7.27875 C4.96757002,6.68157919 5.20496665,6.10890358 5.626875,5.68746499 C6.04890358,5.26496665 6.62157919,5.02757002 7.21875,5.02757002 C7.81592081,5.02757002 8.38859642,5.26496665 8.81033009,5.68716991 L8.84944872,5.72635306 C8.99191298,5.86570889 9.20485393,5.90431906 9.38717599,5.82385306 L9.49484664,5.80114977 C9.65041313,5.71688974 9.7492905,5.55401473 9.75,5.3775 L9.75,5.25 C9.75,4.00735931 10.7573593,3 12,3 C13.2426407,3 14.25,4.00735931 14.25,5.25 L14.249994,5.31450877 C14.250769,5.50881236 14.366855,5.68410223 14.552824,5.76385306 C14.7351461,5.84431906 14.948087,5.80570889 15.0846699,5.67216991 L15.129375,5.62746499 C15.5514036,5.20496665 16.1240792,4.96757002 16.72125,4.96757002 C17.3184208,4.96757002 17.8910964,5.20496665 18.312535,5.626875 C18.7350334,6.04890358 18.97243,6.62157919 18.97243,7.21875 C18.97243,7.81592081 18.7350334,8.38859642 18.3128301,8.81033009 L18.2736469,8.84944872 C18.1342911,8.99191298 18.0956809,9.20485393 18.1761469,9.38717599 L18.1988502,9.49484664 C18.2831103,9.65041313 18.4459853,9.7492905 18.6225,9.75 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
										<path d="M12,15 C13.6568542,15 15,13.6568542 15,12 C15,10.3431458 13.6568542,9 12,9 C10.3431458,9 9,10.3431458 9,12 C9,13.6568542 10.3431458,15 12,15 Z" fill="#000000" />
									</g>
								</svg>
							</span>
							<span class="menu-text">Setting</span>
							<i class="menu-arrow"></i>
						</a>
						<?php if (roleAkses(session()->get('iduser'), $user[0])) : ?>
							<div class="menu-submenu"><i class="menu-arrow"></i>
								<ul class="menu-subnav">
									<li class="menu-item <?php echo set_active_submenu($user) ?>" aria-haspopup="true"><a href="<?= base_url('user') ?>" class="menu-link "><i class="menu-bullet menu-bullet-dot"><span></span></i><span class="menu-text">User</span></a></li>
								</ul>
							</div>
						<?php endif; ?>
						<?php if (roleAkses(session()->get('iduser'), $menu[0])) : ?>
							<div class="menu-submenu"><i class="menu-arrow"></i>
								<ul class="menu-subnav">
									<li class="menu-item <?php echo set_active_submenu($menu) ?>" aria-haspopup="true"><a href="<?= base_url('menu') ?>" class="menu-link "><i class="menu-bullet menu-bullet-dot"><span></span></i><span class="menu-text">Menu</span></a></li>
								</ul>
							</div>
						<?php endif; ?>
						<?php if (roleAkses(session()->get('iduser'), $menu_role[0])) : ?>
							<div class="menu-submenu"><i class="menu-arrow"></i>
								<ul class="menu-subnav">
									<li class="menu-item <?php echo set_active_submenu($menu_role) ?>" aria-haspopup="true"><a href="<?= base_url('menu-role') ?>" class="menu-link "><i class="menu-bullet menu-bullet-dot"><span></span></i><span class="menu-text">Menu Role</span></a></li>
								</ul>
							</div>
						<?php endif; ?>
						<?php if (roleAkses(session()->get('iduser'), $role[0])) : ?>
							<div class="menu-submenu"><i class="menu-arrow"></i>
								<ul class="menu-subnav">
									<li class="menu-item <?php echo set_active_submenu($role) ?>" aria-haspopup="true"><a href="<?= base_url('role') ?>" class="menu-link "><i class="menu-bullet menu-bullet-dot"><span></span></i><span class="menu-text">Role</span></a></li>
								</ul>
							</div>
						<?php endif; ?>
					</li>
				<?php endif; ?>
			</ul>

			<!--end::Menu Nav-->
		</div>

		<!--end::Menu Container-->
	</div>

	<!--end::Aside Menu-->
</div>

<!--end::Aside-->