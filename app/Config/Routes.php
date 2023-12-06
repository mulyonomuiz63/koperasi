<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

$routes->get('/', 'Front\Landing::index');


// $routes->get('home', 'Home::index');
$routes->get('login', 'Admin\Login::index', ['filter' => 'guestFilter']);
$routes->get('keluar', 'Admin\Login::keluar', ['filter' => 'authFilter']);
$routes->post('login/cek_login', 'Admin\Login::cek_login', ['filter' => 'guestFilter']);



$routes->get('dashboard', 'Admin\Home::index', ['filter' => 'authFilter']);

// untuk komoditi
$routes->get('komoditi', 'Admin\Komoditi::index', ['filter' => 'authFilter']);
$routes->post('komoditi/datatablesource', 'Admin\Komoditi::datatablesource', ['filter' => 'authFilter']);
$routes->get('komoditi/tambah', 'Admin\Komoditi::tambah', ['filter' => 'authFilter']);
$routes->post('komoditi/simpan', 'Admin\Komoditi::simpan', ['filter' => 'authFilter']);
$routes->get('komoditi/edit/(:any)', 'Admin\Komoditi::edit/$1', ['filter' => 'authFilter']);
$routes->get('komoditi/delete/(:any)', 'Admin\Komoditi::delete/$1', ['filter' => 'authFilter']);


// untuk kualitas
$routes->get('kualitas', 'Admin\Kualitas::index', ['filter' => 'authFilter']);
$routes->post('kualitas/datatablesource', 'Admin\Kualitas::datatablesource', ['filter' => 'authFilter']);
$routes->get('kualitas/tambah', 'Admin\Kualitas::tambah', ['filter' => 'authFilter']);
$routes->post('kualitas/simpan', 'Admin\Kualitas::simpan', ['filter' => 'authFilter']);
$routes->get('kualitas/edit/(:any)', 'Admin\Kualitas::edit/$1', ['filter' => 'authFilter']);
$routes->get('kualitas/delete/(:any)', 'Admin\Kualitas::delete/$1', ['filter' => 'authFilter']);



// untuk pengepul
$routes->get('pengepul', 'Admin\Pengepul::index', ['filter' => 'authFilter']);
$routes->post('pengepul/datatablesource', 'Admin\Pengepul::datatablesource', ['filter' => 'authFilter']);
$routes->get('pengepul/add_ajax_kota/(:any)', 'Admin\Pengepul::add_ajax_kota/$1', ['filter' => 'authFilter']);
$routes->get('pengepul/add_ajax_kecamatan/(:any)', 'Admin\Pengepul::add_ajax_kecamatan/$1', ['filter' => 'authFilter']);
$routes->get('pengepul/add_ajax_kelurahan/(:any)', 'Admin\Pengepul::add_ajax_kelurahan/$1', ['filter' => 'authFilter']);
$routes->get('pengepul/tambah', 'Admin\Pengepul::tambah', ['filter' => 'authFilter']);
$routes->post('pengepul/simpan', 'Admin\Pengepul::simpan', ['filter' => 'authFilter']);
$routes->get('pengepul/edit/(:any)', 'Admin\Pengepul::edit/$1', ['filter' => 'authFilter']);
$routes->get('pengepul/delete/(:any)', 'Admin\Pengepul::delete/$1', ['filter' => 'authFilter']);

// untuk pengirim
$routes->get('pengirim', 'Admin\Pengirim::index', ['filter' => 'authFilter']);
$routes->post('pengirim/datatablesource', 'Admin\Pengirim::datatablesource', ['filter' => 'authFilter']);
$routes->get('pengirim/delete/(:any)', 'Admin\Pengirim::delete/$1', ['filter' => 'authFilter']);
$routes->get('pengirim/edit/(:any)', 'Admin\Pengirim::edit/$1', ['filter' => 'authFilter']);

// untuk produk
$routes->get('produk', 'Admin\Produk::index', ['filter' => 'authFilter']);
$routes->post('produk/datatablesource', 'Admin\Produk::datatablesource', ['filter' => 'authFilter']);
$routes->get('produk/tambah', 'Admin\Produk::tambah', ['filter' => 'authFilter']);
$routes->post('produk/simpan', 'Admin\produk::simpan', ['filter' => 'authFilter']);
$routes->post('produk/simpan/kualitas', 'Admin\produk::simpanKualitas', ['filter' => 'authFilter']);
$routes->get('produk/delete/(:any)', 'Admin\Produk::delete/$1', ['filter' => 'authFilter']);
$routes->post('produk/kualitas/delete', 'Admin\Produk::deleteKualitas', ['filter' => 'authFilter']);
$routes->get('produk/edit/(:any)', 'Admin\Produk::edit/$1', ['filter' => 'authFilter']);
$routes->post('produk/aprove', 'Admin\Produk::aprove', ['filter' => 'authFilter']);
$routes->post('produk/aproveBuktiTransfer', 'Admin\Produk::aproveBuktiTransfer', ['filter' => 'authFilter']);

// untuk bayer
$routes->get('bayer', 'Admin\Bayer::index', ['filter' => 'authFilter']);
$routes->post('bayer/datatablesource', 'Admin\Bayer::datatablesource', ['filter' => 'authFilter']);
$routes->get('bayer/tambah', 'Admin\Bayer::tambah', ['filter' => 'authFilter']);
$routes->post('bayer/simpan', 'Admin\Bayer::simpan', ['filter' => 'authFilter']);
$routes->get('bayer/edit/(:any)', 'Admin\Bayer::edit/$1', ['filter' => 'authFilter']);
$routes->get('bayer/delete/(:any)', 'Admin\Bayer::delete/$1', ['filter' => 'authFilter']);

// untuk menu-role
$routes->get('menu-role', 'Admin\MenuRole::index', ['filter' => 'authFilter']);
$routes->post('menu-role/datatablesource', 'Admin\MenuRole::datatablesource', ['filter' => 'authFilter']);
$routes->get('menu-role/tambah', 'Admin\MenuRole::tambah', ['filter' => 'authFilter']);
$routes->post('menu-role/simpan', 'Admin\MenuRole::simpan', ['filter' => 'authFilter']);
$routes->get('menu-role/edit/(:any)', 'Admin\MenuRole::edit/$1', ['filter' => 'authFilter']);
$routes->get('menu-role/delete/(:any)', 'Admin\MenuRole::delete/$1', ['filter' => 'authFilter']);

// untuk role
$routes->get('role', 'Admin\Role::index', ['filter' => 'authFilter']);
$routes->post('role/datatablesource', 'Admin\Role::datatablesource', ['filter' => 'authFilter']);
$routes->get('role/tambah', 'Admin\Role::tambah', ['filter' => 'authFilter']);
$routes->post('role/simpan', 'Admin\Role::simpan', ['filter' => 'authFilter']);
$routes->get('role/edit/(:any)', 'Admin\Role::edit/$1', ['filter' => 'authFilter']);
$routes->get('role/delete/(:any)', 'Admin\Role::delete/$1', ['filter' => 'authFilter']);

// untuk menu
$routes->get('menu', 'Admin\Menu::index', ['filter' => 'authFilter']);
$routes->post('menu/datatablesource', 'Admin\Menu::datatablesource', ['filter' => 'authFilter']);
$routes->get('menu/tambah', 'Admin\Menu::tambah', ['filter' => 'authFilter']);
$routes->post('menu/simpan', 'Admin\Menu::simpan', ['filter' => 'authFilter']);
$routes->get('menu/edit/(:any)', 'Admin\Menu::edit/$1', ['filter' => 'authFilter']);
$routes->get('menu/delete/(:any)', 'Admin\Menu::delete/$1', ['filter' => 'authFilter']);

// untuk user
$routes->get('user', 'Admin\User::index',  ['filter' => 'authFilter']);
$routes->post('user/datatablesource', 'Admin\User::datatablesource', ['filter' => 'authFilter']);
$routes->post('user/cek_status_email', 'Admin\User::cek_status_email', ['filter' => 'authFilter']);
$routes->post('user/cek_status_hp', 'Admin\User::cek_status_hp', ['filter' => 'authFilter']);
$routes->get('user/tambah', 'Admin\User::tambah', ['filter' => 'authFilter']);
$routes->post('user/simpan', 'Admin\User::simpan', ['filter' => 'authFilter']);
$routes->get('user/edit/(:any)', 'Admin\User::edit/$1',  ['filter' => 'authFilter']);
$routes->get('user/delete/(:any)', 'Admin\User::delete/$1', ['filter' => 'authFilter']);


// untuk karyawan
$routes->get('karyawan', 'Admin\Karyawan::index', ['filter' => 'authFilter']);
$routes->post('karyawan/datatablesource', 'Admin\Karyawan::datatablesource', ['filter' => 'authFilter']);
$routes->get('karyawan/add_ajax_kota/(:any)', 'Admin\Karyawan::add_ajax_kota/$1', ['filter' => 'authFilter']);
$routes->get('karyawan/add_ajax_kecamatan/(:any)', 'Admin\Karyawan::add_ajax_kecamatan/$1', ['filter' => 'authFilter']);
$routes->get('karyawan/add_ajax_kelurahan/(:any)', 'Admin\Karyawan::add_ajax_kelurahan/$1', ['filter' => 'authFilter']);
$routes->get('karyawan/tambah', 'Admin\Karyawan::tambah', ['filter' => 'authFilter']);
$routes->post('karyawan/simpan', 'Admin\Karyawan::simpan', ['filter' => 'authFilter']);
$routes->get('karyawan/edit/(:any)', 'Admin\Karyawan::edit/$1', ['filter' => 'authFilter']);
$routes->get('karyawan/delete/(:any)', 'Admin\Karyawan::delete/$1', ['filter' => 'authFilter']);


// untuk kelompok-tani
$routes->get('kelompok-tani', 'Admin\KelompokTani::index', ['filter' => 'authFilter']);
$routes->post('kelompok-tani/datatablesource', 'Admin\KelompokTani::datatablesource', ['filter' => 'authFilter']);
$routes->get('kelompok-tani/tambah', 'Admin\KelompokTani::tambah', ['filter' => 'authFilter']);
$routes->post('kelompok-tani/simpan', 'Admin\KelompokTani::simpan', ['filter' => 'authFilter']);
$routes->get('kelompok-tani/edit/(:any)', 'Admin\KelompokTani::edit/$1', ['filter' => 'authFilter']);
$routes->get('kelompok-tani/delete/(:any)', 'Admin\KelompokTani::delete/$1', ['filter' => 'authFilter']);


// untuk petani
$routes->get('petani/props/(:any)', 'Admin\Petani::props/$1', ['filter' => 'authFilter']);
$routes->get('petani', 'Admin\Petani::index', ['filter' => 'authFilter']);
$routes->post('petani/datatablesource', 'Admin\Petani::datatablesource', ['filter' => 'authFilter']);
$routes->get('petani/add_ajax_kota/(:any)', 'Admin\Petani::add_ajax_kota/$1', ['filter' => 'authFilter']);
$routes->get('petani/add_ajax_kecamatan/(:any)', 'Admin\Petani::add_ajax_kecamatan/$1', ['filter' => 'authFilter']);
$routes->get('petani/add_ajax_kelurahan/(:any)', 'Admin\Petani::add_ajax_kelurahan/$1', ['filter' => 'authFilter']);
$routes->get('petani/tambah', 'Admin\Petani::tambah', ['filter' => 'authFilter']);
$routes->post('petani/simpan', 'Admin\Petani::simpan', ['filter' => 'authFilter']);
$routes->get('petani/edit/(:any)', 'Admin\Petani::edit/$1', ['filter' => 'authFilter']);
$routes->get('petani/delete/(:any)', 'Admin\Petani::delete/$1', ['filter' => 'authFilter']);
$routes->post('petani/ceklokasi', 'Admin\Petani::cekLokasi', ['filter' => 'authFilter']);
/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
