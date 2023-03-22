<?php

namespace Config;

use CodeIgniter\Commands\Utilities\Routes;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

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
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

$routes->get("/login", "Auth::index");
$routes->post("/login", "Auth::authAction");
$routes->get("/logout", "Auth::logoutAction");

$routes->group("/", ["filter" => "auth"], function ($routes) {
    $routes->add('', 'Home::index');
    // user route
    $routes->add("/data-pengguna", "User::index");
    $routes->add("/data-pengguna/tambah", "User::create");
    $routes->add("/data-pengguna/simpan", "User::store");
    $routes->add("/data-pengguna/edit/(:num)", "User::edit/$1");
    $routes->add("/data-pengguna/update/(:num)", "User::update/$1");
    $routes->add("/data-pengguna/hapus/(:num)", "User::destroy/$1");

    /**
     * Route untuk modul inventory
     */
    // coa transactions route
    $routes->add("/data-akun-transaksi", "CoaTransaction::index");
    $routes->add("/data-akun-transaksi/tambah", "CoaTransaction::create");
    $routes->add("/data-akun-transaksi/simpan", "CoaTransaction::store");
    $routes->add("/data-akun-transaksi/edit/(:num)", "CoaTransaction::edit/$1");
    $routes->add("/data-akun-transaksi/update/(:num)", "CoaTransaction::update/$1");
    $routes->add("/data-akun-transaksi/hapus/(:num)", "CoaTransaction::destroy/$1");
    // customers route
    $routes->add("/data-pelanggan", "Customer::index");
    $routes->add("/data-pelanggan/tambah", "Customer::create");
    $routes->add("/data-pelanggan/simpan", "Customer::store");
    $routes->add("/data-pelanggan/edit/(:num)", "Customer::edit/$1");
    $routes->add("/data-pelanggan/update/(:num)", "Customer::update/$1");
    $routes->add("/data-pelanggan/hapus/(:num)", "Customer::destroy/$1");
    // supplier route
    $routes->add("/data-supplier", "Supplier::index");
    $routes->add("/data-supplier/tambah", "Supplier::create");
    $routes->add("/data-supplier/simpan", "Supplier::store");
    $routes->add("/data-supplier/edit/(:num)", "Supplier::edit/$1");
    $routes->add("/data-supplier/update/(:num)", "Supplier::update/$1");
    $routes->add("/data-supplier/hapus/(:num)", "Supplier::destroy/$1");
    // courier route
    $routes->add("/data-kurir", "Courier::index");
    $routes->add("/data-kurir/tambah", "Courier::create");
    $routes->add("/data-kurir/simpan", "Courier::store");
    $routes->add("/data-kurir/edit/(:num)", "Courier::edit/$1");
    $routes->add("/data-kurir/update/(:num)", "Courier::update/$1");
    $routes->add("/data-kurir/hapus/(:num)", "Courier::destroy/$1");
    // categories route
    $routes->add("/data-kategori", "Category::index");
    $routes->add("/data-kategori/tambah", "Category::create");
    $routes->add("/data-kategori/simpan", "Category::store");
    $routes->add("/data-kategori/edit/(:num)", "Category::edit/$1");
    $routes->add("/data-kategori/update/(:num)", "Category::update/$1");
    $routes->add("/data-kategori/hapus/(:num)", "Category::destroy/$1");
    // sparepart route
    $routes->add("/data-sparepart", "Sparepart::index");
    $routes->add("/data-sparepart/tambah", "Sparepart::create");
    $routes->add("/data-sparepart/simpan", "Sparepart::store");
    $routes->add("/data-sparepart/edit/(:num)", "Sparepart::edit/$1");
    $routes->add("/data-sparepart/update/(:num)", "Sparepart::update/$1");
    $routes->add("/data-sparepart/hapus/(:num)", "Sparepart::destroy/$1");
    // penjualan route
    $routes->add("/data-penjualan", "SaleTransaction::index");
    $routes->add("/data-penjualan/tambah", "SaleTransaction::create");
    $routes->add("/data-penjualan/simpan", "SaleTransaction::store");
    $routes->add("/data-penjualan/edit/(:num)", "SaleTransaction::edit/$1");
    $routes->add("/data-penjualan/update/(:num)", "SaleTransaction::update/$1");
    $routes->add("/data-penjualan/konfirmasi/(:num)", "SaleTransaction::confirm/$1");
    // pembelian route
    $routes->add("/data-pembelian", "PurchaseTransaction::index");
    $routes->add("/data-pembelian/tambah", "PurchaseTransaction::create");
    $routes->add("/data-pembelian/simpan", "PurchaseTransaction::store");
    $routes->add("/data-pembelian/edit/(:num)", "PurchaseTransaction::edit/$1");
    $routes->add("/data-pembelian/update/(:num)", "PurchaseTransaction::update/$1");
    $routes->add("/data-pembelian/konfirmasi/(:num)", "PurchaseTransaction::confirm/$1");
    // jurnal route
    $routes->add("/jurnal-penjualan", "InventoryReport::sale_journal");
    $routes->add("/jurnal-pembelian", "InventoryReport::purchase_journal");
    $routes->add("/laporan-persediaan", "InventoryReport::stock_report");
    /**
     * Route untuk modul penggajian
     */
    // coa payrol routes
    $routes->add("/data-akun-penggajian", "CoaPayroll::index");
    $routes->add("/data-akun-penggajian/tambah", "CoaPayroll::create");
    $routes->add("/data-akun-penggajian/simpan", "CoaPayroll::store");
    $routes->add("/data-akun-penggajian/edit/(:num)", "CoaPayroll::edit/$1");
    $routes->add("/data-akun-penggajian/update/(:num)", "CoaPayroll::update/$1");
    $routes->add("/data-akun-penggajian/hapus/(:num)", "CoaPayroll::destroy/$1");
    // jabatan management route
    $routes->add("/data-jabatan", "Position::index");
    $routes->add("/data-jabatan/tambah", "Position::create");
    $routes->add("/data-jabatan/simpan", "Position::store");
    $routes->add("/data-jabatan/edit/(:num)", "Position::edit/$1");
    $routes->add("/data-jabatan/update/(:num)", "Position::update/$1");
    $routes->add("/data-jabatan/hapus/(:num)", "Position::destroy/$1");
    // karyawan management route
    $routes->add("/data-karyawan", "Employee::index");
    $routes->add("/data-karyawan/tambah", "Employee::create");
    $routes->add("/data-karyawan/simpan", "Employee::store");
    $routes->add("/data-karyawan/edit/(:num)", "Employee::edit/$1");
    $routes->add("/data-karyawan/update/(:num)", "Employee::update/$1");
    $routes->add("/data-karyawan/hapus/(:num)", "Employee::destroy/$1");
    // penggajian route
    $routes->add("/data-penggajian", "Payroll::index");
    $routes->add("/data-penggajian/tambah", "Payroll::create");
    $routes->add("/data-penggajian/simpan", "Payroll::store");
    $routes->add("/data-penggajian/edit/(:num)", "Payroll::edit/$1");
    $routes->add("/data-penggajian/update/(:num)", "Payroll::update/$1");
    // jurnal penggajian route
    $routes->add("/jurnal-penggajian", "PayrollReport::payroll_journal");
    $routes->add("/laporan-penggajian", "PayrollReport::payroll_report");


    /**
     * Route untuk modul pembayaran beban
     */
    // coa payroll route
    $routes->add("/data-akun-tanggungan", "CoaDependent::index");
    $routes->add("/data-akun-tanggungan/tambah", "CoaDependent::create");
    $routes->add("/data-akun-tanggungan/simpan", "CoaDependent::store");
    $routes->add("/data-akun-tanggungan/edit/(:num)", "CoaDependent::edit/$1");
    $routes->add("/data-akun-tanggungan/update/(:num)", "CoaDependent::update/$1");
    $routes->add("/data-akun-tanggungan/hapus/(:num)", "CoaDependent::destroy/$1");
    $routes->add("/data-kategori-beban", "LoadCategory::index");
    $routes->add("/data-kategori-beban/tambah", "LoadCategory::create");
    $routes->add("/data-kategori-beban/simpan", "LoadCategory::store");
    $routes->add("/data-kategori-beban/edit/(:num)", "LoadCategory::edit/$1");
    $routes->add("/data-kategori-beban/update/(:num)", "LoadCategory::update/$1");
    $routes->add("/data-kategori-beban/hapus/(:num)", "LoadCategory::destroy/$1");
    $routes->add("/data-pembayaran-beban", "LoadPayment::index");
    $routes->add("/data-pembayaran-beban/tambah", "LoadPayment::create");
    $routes->add("/data-pembayaran-beban/simpan", "LoadPayment::store");
    $routes->add("/data-pembayaran-beban/konfirmasi/(:num)", "LoadPayment::confirm/$1");
    // jurnal dan laporan
    $routes->add("/jurnal-pembayaran-beban", "LoadJournal::index");
    $routes->add("/laporan-buku-besar", "BukuBesar::index");
    $routes->add("/laporan-buku-besar/filter", "BukuBesar::filter");
    $routes->add("/laporan-laba-rugi", "LabaRugi::index");
    $routes->add("/laporan-laba-rugi/filter", "LabaRugi::filter");
});



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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
