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

// $routes->get('home', 'Home::index');
$routes->get('login', 'Login::index', ['filter' => 'guestFilter']);
$routes->get('keluar', 'Login::keluar', ['filter' => 'authFilter']);
$routes->post('login/cek_login', 'Login::cek_login', ['filter' => 'guestFilter']);



$routes->get('/', 'Home::index', ['filter' => 'authFilter']);

// untuk komoditi
$routes->get('komoditi', 'Komoditi::index', ['filter' => 'authFilter']);
$routes->post('komoditi/datatablesource', 'Komoditi::datatablesource', ['filter' => 'authFilter']);
$routes->get('komoditi/tambah', 'Komoditi::tambah', ['filter' => 'authFilter']);
$routes->post('komoditi/simpan', 'Komoditi::simpan', ['filter' => 'authFilter']);
$routes->get('komoditi/edit/(:any)', 'Komoditi::edit/$1', ['filter' => 'authFilter']);
$routes->get('komoditi/delete/(:any)', 'Komoditi::delete/$1', ['filter' => 'authFilter']);


// untuk kualitas
$routes->get('kualitas', 'Kualitas::index', ['filter' => 'authFilter']);
$routes->post('kualitas/datatablesource', 'Kualitas::datatablesource', ['filter' => 'authFilter']);
$routes->get('kualitas/tambah', 'Kualitas::tambah', ['filter' => 'authFilter']);
$routes->post('kualitas/simpan', 'Kualitas::simpan', ['filter' => 'authFilter']);
$routes->get('kualitas/edit/(:any)', 'Kualitas::edit/$1', ['filter' => 'authFilter']);
$routes->get('kualitas/delete/(:any)', 'Kualitas::delete/$1', ['filter' => 'authFilter']);



// untuk pengepul
$routes->get('pengepul', 'Pengepul::index', ['filter' => 'authFilter']);
$routes->post('pengepul/datatablesource', 'Pengepul::datatablesource', ['filter' => 'authFilter']);
$routes->get('pengepul/add_ajax_kota/(:any)', 'Pengepul::add_ajax_kota/$1', ['filter' => 'authFilter']);
$routes->get('pengepul/add_ajax_kecamatan/(:any)', 'Pengepul::add_ajax_kecamatan/$1', ['filter' => 'authFilter']);
$routes->get('pengepul/add_ajax_kelurahan/(:any)', 'Pengepul::add_ajax_kelurahan/$1', ['filter' => 'authFilter']);
$routes->get('pengepul/tambah', 'Pengepul::tambah', ['filter' => 'authFilter']);
$routes->post('pengepul/simpan', 'Pengepul::simpan', ['filter' => 'authFilter']);
$routes->get('pengepul/edit/(:any)', 'Pengepul::edit/$1', ['filter' => 'authFilter']);
$routes->get('pengepul/delete/(:any)', 'Pengepul::delete/$1', ['filter' => 'authFilter']);

// untuk pengirim
$routes->get('pengirim', 'Pengirim::index', ['filter' => 'authFilter']);
$routes->post('pengirim/datatablesource', 'Pengirim::datatablesource', ['filter' => 'authFilter']);
$routes->get('pengirim/delete/(:any)', 'Pengirim::delete/$1', ['filter' => 'authFilter']);
$routes->get('pengirim/edit/(:any)', 'Pengirim::edit/$1', ['filter' => 'authFilter']);

// untuk produk
$routes->get('produk', 'Produk::index', ['filter' => 'authFilter']);
$routes->post('produk/datatablesource', 'Produk::datatablesource', ['filter' => 'authFilter']);
$routes->get('produk/tambah', 'Produk::tambah', ['filter' => 'authFilter']);
$routes->post('produk/simpan', 'produk::simpan', ['filter' => 'authFilter']);
$routes->post('produk/simpan/kualitas', 'produk::simpanKualitas', ['filter' => 'authFilter']);
$routes->get('produk/delete/(:any)', 'Produk::delete/$1', ['filter' => 'authFilter']);
$routes->post('produk/kualitas/delete', 'Produk::deleteKualitas', ['filter' => 'authFilter']);
$routes->get('produk/edit/(:any)', 'Produk::edit/$1', ['filter' => 'authFilter']);
$routes->post('produk/aprove', 'Produk::aprove', ['filter' => 'authFilter']);
$routes->post('produk/aproveBuktiTransfer', 'Produk::aproveBuktiTransfer', ['filter' => 'authFilter']);

// untuk bayer
$routes->get('bayer', 'Bayer::index', ['filter' => 'authFilter']);
$routes->post('bayer/datatablesource', 'Bayer::datatablesource', ['filter' => 'authFilter']);
$routes->get('bayer/tambah', 'Bayer::tambah', ['filter' => 'authFilter']);
$routes->post('bayer/simpan', 'Bayer::simpan', ['filter' => 'authFilter']);
$routes->get('bayer/edit/(:any)', 'Bayer::edit/$1', ['filter' => 'authFilter']);
$routes->get('bayer/delete/(:any)', 'Bayer::delete/$1', ['filter' => 'authFilter']);

// untuk menu-role
$routes->get('menu-role', 'MenuRole::index', ['filter' => 'authFilter']);
$routes->post('menu-role/datatablesource', 'MenuRole::datatablesource', ['filter' => 'authFilter']);
$routes->get('menu-role/tambah', 'MenuRole::tambah', ['filter' => 'authFilter']);
$routes->post('menu-role/simpan', 'MenuRole::simpan', ['filter' => 'authFilter']);
$routes->get('menu-role/edit/(:any)', 'MenuRole::edit/$1', ['filter' => 'authFilter']);
$routes->get('menu-role/delete/(:any)', 'MenuRole::delete/$1', ['filter' => 'authFilter']);

// untuk role
$routes->get('role', 'Role::index', ['filter' => 'authFilter']);
$routes->post('role/datatablesource', 'Role::datatablesource', ['filter' => 'authFilter']);
$routes->get('role/tambah', 'Role::tambah', ['filter' => 'authFilter']);
$routes->post('role/simpan', 'Role::simpan', ['filter' => 'authFilter']);
$routes->get('role/edit/(:any)', 'Role::edit/$1', ['filter' => 'authFilter']);
$routes->get('role/delete/(:any)', 'Role::delete/$1', ['filter' => 'authFilter']);

// untuk menu
$routes->get('menu', 'Menu::index', ['filter' => 'authFilter']);
$routes->post('menu/datatablesource', 'Menu::datatablesource', ['filter' => 'authFilter']);
$routes->get('menu/tambah', 'Menu::tambah', ['filter' => 'authFilter']);
$routes->post('menu/simpan', 'Menu::simpan', ['filter' => 'authFilter']);
$routes->get('menu/edit/(:any)', 'Menu::edit/$1', ['filter' => 'authFilter']);
$routes->get('menu/delete/(:any)', 'Menu::delete/$1', ['filter' => 'authFilter']);

// untuk user
$routes->get('user', 'User::index',  ['filter' => 'authFilter']);
$routes->post('user/datatablesource', 'User::datatablesource', ['filter' => 'authFilter']);
$routes->post('user/cek_status_email', 'User::cek_status_email', ['filter' => 'authFilter']);
$routes->post('user/cek_status_hp', 'User::cek_status_hp', ['filter' => 'authFilter']);
$routes->get('user/tambah', 'User::tambah', ['filter' => 'authFilter']);
$routes->post('user/simpan', 'User::simpan', ['filter' => 'authFilter']);
$routes->get('user/edit/(:any)', 'User::edit/$1',  ['filter' => 'authFilter']);
$routes->get('user/delete/(:any)', 'User::delete/$1', ['filter' => 'authFilter']);


// untuk karyawan
$routes->get('karyawan', 'Karyawan::index', ['filter' => 'authFilter']);
$routes->post('karyawan/datatablesource', 'Karyawan::datatablesource', ['filter' => 'authFilter']);
$routes->get('karyawan/add_ajax_kota/(:any)', 'Karyawan::add_ajax_kota/$1', ['filter' => 'authFilter']);
$routes->get('karyawan/add_ajax_kecamatan/(:any)', 'Karyawan::add_ajax_kecamatan/$1', ['filter' => 'authFilter']);
$routes->get('karyawan/add_ajax_kelurahan/(:any)', 'Karyawan::add_ajax_kelurahan/$1', ['filter' => 'authFilter']);
$routes->get('karyawan/tambah', 'Karyawan::tambah', ['filter' => 'authFilter']);
$routes->post('karyawan/simpan', 'Karyawan::simpan', ['filter' => 'authFilter']);
$routes->get('karyawan/edit/(:any)', 'Karyawan::edit/$1', ['filter' => 'authFilter']);
$routes->get('karyawan/delete/(:any)', 'Karyawan::delete/$1', ['filter' => 'authFilter']);


// untuk kelompok-tani
$routes->get('kelompok-tani', 'KelompokTani::index', ['filter' => 'authFilter']);
$routes->post('kelompok-tani/datatablesource', 'KelompokTani::datatablesource', ['filter' => 'authFilter']);
$routes->get('kelompok-tani/tambah', 'KelompokTani::tambah', ['filter' => 'authFilter']);
$routes->post('kelompok-tani/simpan', 'KelompokTani::simpan', ['filter' => 'authFilter']);
$routes->get('kelompok-tani/edit/(:any)', 'KelompokTani::edit/$1', ['filter' => 'authFilter']);
$routes->get('kelompok-tani/delete/(:any)', 'KelompokTani::delete/$1', ['filter' => 'authFilter']);


// untuk petani
$routes->get('petani/props/(:any)', 'Petani::props/$1', ['filter' => 'authFilter']);
$routes->get('petani', 'Petani::index', ['filter' => 'authFilter']);
$routes->post('petani/datatablesource', 'Petani::datatablesource', ['filter' => 'authFilter']);
$routes->get('petani/add_ajax_kota/(:any)', 'Petani::add_ajax_kota/$1', ['filter' => 'authFilter']);
$routes->get('petani/add_ajax_kecamatan/(:any)', 'Petani::add_ajax_kecamatan/$1', ['filter' => 'authFilter']);
$routes->get('petani/add_ajax_kelurahan/(:any)', 'Petani::add_ajax_kelurahan/$1', ['filter' => 'authFilter']);
$routes->get('petani/tambah', 'Petani::tambah', ['filter' => 'authFilter']);
$routes->post('petani/simpan', 'Petani::simpan', ['filter' => 'authFilter']);
$routes->get('petani/edit/(:any)', 'Petani::edit/$1', ['filter' => 'authFilter']);
$routes->get('petani/delete/(:any)', 'Petani::delete/$1', ['filter' => 'authFilter']);
$routes->post('petani/ceklokasi', 'Petani::cekLokasi', ['filter' => 'authFilter']);
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
