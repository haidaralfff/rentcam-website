<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'Home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// Auth Routes
$route['login']    = 'Auth/login';
$route['register'] = 'Auth/register';
$route['logout']   = 'Auth/logout';
$route['profile']  = 'Profile/index';

// Public Routes
$route['produk']              = 'Produk/index';
$route['produk/detail/(:num)'] = 'Produk/detail/$1';

// User Routes
$route['booking']               = 'Booking/index';
$route['booking/form/(:num)']   = 'Booking/form/$1';
$route['booking/riwayat']       = 'Booking/riwayat';
$route['pembayaran/upload/(:num)'] = 'Pembayaran/upload/$1';
$route['pembayaran/status']     = 'Pembayaran/status';
$route['review/form/(:num)']    = 'Review/form/$1';

// Admin Routes
$route['admin']                        = 'Admin/Dashboard/index';
$route['admin/produk']                 = 'Admin/Produk/index';
$route['admin/produk/tambah']          = 'Admin/Produk/tambah';
$route['admin/produk/edit/(:num)']     = 'Admin/Produk/edit/$1';
$route['admin/produk/hapus/(:num)']    = 'Admin/Produk/hapus/$1';
$route['admin/booking']                = 'Admin/Booking/index';
$route['admin/booking/detail/(:num)']  = 'Admin/Booking/detail/$1';
$route['admin/pembayaran']             = 'Admin/Pembayaran/index';
$route['admin/pembayaran/detail/(:num)'] = 'Admin/Pembayaran/detail/$1';

// Superadmin Routes
$route['superadmin']                       = 'Superadmin/Dashboard/index';
$route['superadmin/laporan']               = 'Superadmin/Laporan/index';
$route['superadmin/laporan/detail/(:num)'] = 'Superadmin/Laporan/detail/$1';
$route['superadmin/admin']                 = 'Superadmin/Admin/index';
$route['superadmin/admin/tambah']          = 'Superadmin/Admin/tambah';
$route['superadmin/user']                  = 'Admin/User/index';
$route['superadmin/user/edit/(:num)']      = 'Admin/User/edit/$1';
$route['superadmin/user/toggle_status/(:num)'] = 'Admin/User/toggle_status/$1';
$route['superadmin/user/hapus/(:num)'] = 'Admin/User/hapus/$1';
$route['superadmin/setting']               = 'Superadmin/Setting/index';
