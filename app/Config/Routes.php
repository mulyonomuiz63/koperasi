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

$routes->get('login', 'Login::index');
$routes->post('login/cek_login', 'Login::cek_login');



$routes->get('/', 'Home::index', ['as' => 'home']);

// untuk komoditi
$routes->get('komoditi', 'Komoditi::index');
$routes->post('komoditi/datatablesource', 'Komoditi::datatablesource');
$routes->get('komoditi/tambah', 'Komoditi::tambah');
$routes->post('komoditi/simpan', 'Komoditi::simpan');
$routes->get('komoditi/edit/(:any)', 'Komoditi::edit/$1');
$routes->get('komoditi/delete/(:any)', 'Komoditi::delete/$1');



// untuk pengepul
$routes->get('pengepul', 'Pengepul::index');
$routes->post('pengepul/datatablesource', 'Pengepul::datatablesource');
$routes->get('pengepul/add_ajax_kota/(:any)', 'Pengepul::add_ajax_kota/$1');
$routes->get('pengepul/add_ajax_kecamatan/(:any)', 'Pengepul::add_ajax_kecamatan/$1');
$routes->get('pengepul/add_ajax_kelurahan/(:any)', 'Pengepul::add_ajax_kelurahan/$1');
$routes->get('pengepul/tambah', 'Pengepul::tambah');
$routes->post('pengepul/simpan', 'Pengepul::simpan');
$routes->get('pengepul/edit/(:any)', 'Pengepul::edit/$1');
$routes->get('pengepul/delete/(:any)', 'Pengepul::delete/$1');

// untuk pengirim
$routes->get('pengirim', 'Pengirim::index');
$routes->post('pengirim/datatablesource', 'Pengirim::datatablesource');
$routes->get('pengirim/delete/(:any)', 'Pengirim::delete/$1');
$routes->get('pengirim/edit/(:any)', 'Pengirim::edit/$1');

// untuk produk
$routes->get('produk', 'Produk::index');
$routes->post('produk/datatablesource', 'Produk::datatablesource');
$routes->get('produk/tambah', 'Produk::tambah');
$routes->post('produk/simpan', 'produk::simpan');
$routes->get('produk/delete/(:any)', 'Produk::delete/$1');
$routes->get('produk/edit/(:any)', 'Produk::edit/$1');

// untuk bayer
$routes->get('bayer', 'Bayer::index');
$routes->post('bayer/datatablesource', 'Bayer::datatablesource');
$routes->get('bayer/tambah', 'Bayer::tambah');
$routes->post('bayer/simpan', 'Bayer::simpan');
$routes->get('bayer/edit/(:any)', 'Bayer::edit/$1');
$routes->get('bayer/delete/(:any)', 'Bayer::delete/$1');

// untuk menu-role
$routes->get('menu-role', 'MenuRole::index');
$routes->post('menu-role/datatablesource', 'MenuRole::datatablesource');
$routes->get('menu-role/tambah', 'MenuRole::tambah');
$routes->post('menu-role/simpan', 'MenuRole::simpan');
$routes->get('menu-role/edit/(:any)', 'MenuRole::edit/$1');
$routes->get('menu-role/delete/(:any)', 'MenuRole::delete/$1');

// untuk role
$routes->get('role', 'Role::index');
$routes->post('role/datatablesource', 'Role::datatablesource');
$routes->get('role/tambah', 'Role::tambah');
$routes->post('role/simpan', 'Role::simpan');
$routes->get('role/edit/(:any)', 'Role::edit/$1');
$routes->get('role/delete/(:any)', 'Role::delete/$1');

// untuk menu
$routes->get('menu', 'Menu::index');
$routes->post('menu/datatablesource', 'Menu::datatablesource');
$routes->get('menu/tambah', 'Menu::tambah');
$routes->post('menu/simpan', 'Menu::simpan');
$routes->get('menu/edit/(:any)', 'Menu::edit/$1');
$routes->get('menu/delete/(:any)', 'Menu::delete/$1');

// untuk user
$routes->get('user', 'User::index', ['as' => 'user.index']);
$routes->post('user/datatablesource', 'User::datatablesource');
$routes->post('user/cek_status_email', 'User::cek_status_email');
$routes->post('user/cek_status_hp', 'User::cek_status_hp');
$routes->get('user/tambah', 'User::tambah', ['as' => 'user.tambah']);
$routes->post('user/simpan', 'User::simpan');
$routes->get('user/edit/(:any)', 'User::edit/$1', ['as' => 'user.edit']);
$routes->get('user/delete/(:any)', 'User::delete/$1');


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
