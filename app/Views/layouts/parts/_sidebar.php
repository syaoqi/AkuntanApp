 <!-- partial:partials/_sidebar.html -->
 <nav class="sidebar sidebar-offcanvas" id="sidebar">
     <ul class="nav">
         <li class="nav-item <?= service("uri")->getSegment(1) == "" ? "active" : "" ?>">
             <a class="nav-link" href="<?= base_url("/"); ?>">
                 <i class="mdi mdi-grid-large menu-icon"></i>
                 <span class="menu-title">Dashboard</span>
             </a>
         </li>

         <?php if (session()->get("role") == "director") : ?>
             <li class="nav-item nav-category">Master Data</li>
             <li class="nav-item <?= service("uri")->getSegment(1) == "/data-pengguna" ? "active" : "" ?>">
                 <a class="nav-link" href="<?= base_url("/data-pengguna"); ?>">
                     <i class="menu-icon mdi mdi-account-circle"></i>
                     <span class="menu-title">Kelola Pengguna</span>
                 </a>
             </li>
         <?php endif; ?>

         <?php if (session()->get("role") == "warehouse") : ?>

             <li class="nav-item nav-category">Inventory</li>
             <li class="nav-item <?= service("uri")->getSegment(1) == "/data-akun-transaksi" ? "active" : "" ?>">
                 <a class="nav-link" href="<?= base_url("/data-akun-transaksi"); ?>">
                     <i class="menu-icon mdi mdi-file"></i>
                     <span class="menu-title">Data Akun Transaksi</span>
                 </a>
             </li>
             <li class="nav-item <?= service("uri")->getSegment(1) == "/data-pelanggan" ? "active" : "" ?>">
                 <a class="nav-link" href="<?= base_url("/data-pelanggan"); ?>">
                     <i class="menu-icon mdi mdi-account-card-details"></i>
                     <span class="menu-title">Data Pelanggan</span>
                 </a>
             </li>
             <li class="nav-item <?= service("uri")->getSegment(1) == "/data-supplier" ? "active" : "" ?>">
                 <a class="nav-link" href="<?= base_url("/data-supplier"); ?>">
                     <i class="menu-icon mdi mdi-account-card-details"></i>
                     <span class="menu-title">Data Supplier</span>
                 </a>
             </li>
             <li class="nav-item <?= service("uri")->getSegment(1) == "/data-kurir" ? "active" : "" ?>">
                 <a class="nav-link" href="<?= base_url("/data-kurir"); ?>">
                     <i class="menu-icon mdi mdi-truck"></i>
                     <span class="menu-title">Data Kurir</span>
                 </a>
             </li>
             <li class="nav-item <?= service("uri")->getSegment(1) == "/data-kategori" || service("uri")->getSegment(1) == "/data-sparepart" ? "show" : "" ?>">
                 <a class="nav-link" data-bs-toggle="collapse" href="#data_barang" aria-expanded="false" aria-controls="data_barang">
                     <i class="menu-icon mdi mdi-shopping"></i>
                     <span class="menu-title">Data Barang</span>
                     <i class="menu-arrow"></i>
                 </a>
                 <div class="collapse <?= service("uri")->getSegment(1) == "/data-kategori" || service("uri")->getSegment(1) == "/data-sparepart" ? "show" : "" ?>" id="data_barang">
                     <ul class="nav flex-column sub-menu">
                         <li class="nav-item"> <a class="nav-link" href="<?= base_url("data-kategori") ?>">Kategori</a></li>
                         <li class="nav-item"> <a class="nav-link" href="<?= base_url("data-sparepart") ?>">Sparepart</a></li>
                     </ul>
                 </div>
             </li>
             <li class="nav-item <?= service("uri")->getSegment(1) == "/data-penjualan" || service("uri")->getSegment(1) == "/data-pembelian" ? "show" : "" ?>">
                 <a class="nav-link" data-bs-toggle="collapse" href="#data_transaksi" aria-expanded="false" aria-controls="data_transaksi">
                     <i class="menu-icon mdi mdi mdi-credit-card-multiple"></i>
                     <span class="menu-title">Data Transaksi</span>
                     <i class="menu-arrow"></i>
                 </a>
                 <div class="collapse <?= service("uri")->getSegment(1) == "/data-penjualan" || service("uri")->getSegment(1) == "/data-pembelian" ? "show" : "" ?>" id="data_transaksi">
                     <ul class="nav flex-column sub-menu">
                         <li class="nav-item"> <a class="nav-link" href="<?= base_url("data-penjualan") ?>">Penjualan</a></li>
                         <li class="nav-item"> <a class="nav-link" href="<?= base_url("data-pembelian") ?>">Pembelian</a></li>
                     </ul>
                 </div>
             </li>
             <li class="nav-item <?= service("uri")->getSegment(1) == "/jurnal-penjualan" || service("uri")->getSegment(1) == "/jurnal-pembelian" || service("uri")->getSegment(1) == "/laporan-persediaan" ? "show" : "" ?>">
                 <a class="nav-link" data-bs-toggle="collapse" href="#laporan_inventory" aria-expanded="false" aria-controls="laporan_inventory">
                     <i class="menu-icon mdi mdi mdi-file-multiple"></i>
                     <span class="menu-title">Laporan</span>
                     <i class="menu-arrow"></i>
                 </a>
                 <div class="collapse <?= service("uri")->getSegment(1) == "/jurnal-penjualan" || service("uri")->getSegment(1) == "/jurnal-pembelian" || service("uri")->getSegment(1) == "/laporan-persediaan" ? "show" : "" ?>" id="laporan_inventory">
                     <ul class="nav flex-column sub-menu">
                         <li class="nav-item"> <a class="nav-link" href="<?= base_url("jurnal-penjualan") ?>">Jurnal Penjualan</a></li>
                         <li class="nav-item"> <a class="nav-link" href="<?= base_url("jurnal-pembelian") ?>">Jurnal Pembelian</a></li>
                         <li class="nav-item"> <a class="nav-link" href="<?= base_url("laporan-persediaan") ?>">Laporan Persediaan</a></li>
                     </ul>
                 </div>
             </li>

         <?php endif; ?>


         <?php if (session()->get("role") == "hrd") : ?>
             <li class="nav-item nav-category">Penggajian</li>
             <li class="nav-item <?= service("uri")->getSegment(1) == "/data-penggajian" ? "active" : "" ?>">
                 <a class="nav-link" href="<?= base_url("/data-akun-penggajian"); ?>">
                     <i class="menu-icon mdi mdi-file"></i>
                     <span class="menu-title">Data Akun Gaji</span>
                 </a>
             </li>
             <li class="nav-item <?= service("uri")->getSegment(1) == "/data-jabatan" || service("uri")->getSegment(1) == "/data-karyawan" ? "show" : "" ?>">
                 <a class="nav-link" data-bs-toggle="collapse" href="#data_karyawan" aria-expanded="false" aria-controls="data_karyawan">
                     <i class="menu-icon mdi mdi-account-multiple"></i>
                     <span class="menu-title">Data Karyawan</span>
                     <i class="menu-arrow"></i>
                 </a>
                 <div class="collapse <?= service("uri")->getSegment(1) == "/data-jabatan" || service("uri")->getSegment(1) == "/data-karyawan" ? "show" : "" ?>" id="data_karyawan">
                     <ul class="nav flex-column sub-menu">
                         <li class="nav-item"> <a class="nav-link" href="<?= base_url("data-jabatan") ?>">Jabatan</a></li>
                         <li class="nav-item"> <a class="nav-link" href="<?= base_url("data-karyawan"); ?>">Karyawan</a></li>
                     </ul>
                 </div>
             </li>
             <li class="nav-item <?= service("uri")->getSegment(1) == "/data-penggajian" ? "active" : "" ?>">
                 <a class="nav-link" href="<?= base_url("/data-penggajian"); ?>">
                     <i class="menu-icon mdi mdi-credit-card"></i>
                     <span class="menu-title">Data Penggajian</span>
                 </a>
             </li>
             <li class="nav-item <?= service("uri")->getSegment(1) == "/jurnal-penggajian" || service("uri")->getSegment(1) == "/laporan-penggajian" ? "show" : "" ?>">
                 <a class="nav-link" data-bs-toggle="collapse" href="#laporan_payroll" aria-expanded="false" aria-controls="laporan_payroll">
                     <i class="menu-icon mdi mdi mdi-file-multiple"></i>
                     <span class="menu-title">Laporan</span>
                     <i class="menu-arrow"></i>
                 </a>
                 <div class="collapse <?= service("uri")->getSegment(1) == "/jurnal-penggajian" || service("uri")->getSegment(1) == "/laporan-penggajian" ? "show" : "" ?>" id="laporan_payroll">
                     <ul class="nav flex-column sub-menu">
                         <li class="nav-item"> <a class="nav-link" href="<?= base_url("jurnal-penggajian") ?>">Jurnal penggajian</a></li>
                         <li class="nav-item"> <a class="nav-link" href="<?= base_url("laporan-penggajian") ?>">Laporan Penggajian</a></li>
                     </ul>
                 </div>
             </li>
         <?php endif; ?>

         <?php if (session()->get("role") == "accountant") : ?>
             <li class="nav-item nav-category">Pembayaran Beban</li>
             <li class="nav-item <?= service("uri")->getSegment(1) == "/data-akun-tanggungan" ? "active" : "" ?>">
                 <a class="nav-link" href="<?= base_url("/data-akun-tanggungan"); ?>">
                     <i class="menu-icon mdi mdi-file"></i>
                     <span class="menu-title">Akun Beban</span>
                 </a>
             </li>
             <li class="nav-item <?= service("uri")->getSegment(1) == "/data-kategori-beban" ? "active" : "" ?>">
                 <a class="nav-link" href="<?= base_url("/data-kategori-beban"); ?>">
                     <i class="menu-icon mdi mdi-apps"></i>
                     <span class="menu-title">Data Kategori Beban</span>
                 </a>
             </li>
             <li class="nav-item <?= service("uri")->getSegment(1) == "/data-pembayaran-beban" ? "active" : "" ?>">
                 <a class="nav-link" href="<?= base_url("/data-pembayaran-beban"); ?>">
                     <i class="menu-icon mdi mdi-credit-card"></i>
                     <span class="menu-title">Data Pembayaran Beban</span>
                 </a>
             </li>
             <li class="nav-item <?= service("uri")->getSegment(1) == "/jurnal-pembayaran-beban" || service("uri")->getSegment(1) == "/buku-besar" || service("uri")->getSegment(1) == "/laporan-laba-rugi" ? "show" : "" ?>">
                 <a class="nav-link" data-bs-toggle="collapse" href="#laporan_load_payment" aria-expanded="false" aria-controls="laporan_load_payment">
                     <i class="menu-icon mdi mdi mdi-file-multiple"></i>
                     <span class="menu-title">Laporan</span>
                     <i class="menu-arrow"></i>
                 </a>
                 <div class="collapse <?= service("uri")->getSegment(1) == "/jurnal-pembayaran-beban" || service("uri")->getSegment(1) == "/buku-besar" || service("uri")->getSegment(1) == "/laporan-laba-rugi" ? "show" : "" ?>" id="laporan_load_payment">
                     <ul class="nav flex-column sub-menu">
                         <li class="nav-item"> <a class="nav-link" href="<?= base_url("jurnal-pembayaran-beban") ?>">Jurnal Umum</a></li>
                         <li class="nav-item"> <a class="nav-link" href="<?= base_url("laporan-buku-besar") ?>">Buku Besar</a></li>
                         <li class="nav-item"> <a class="nav-link" href="<?= base_url("laporan-laba-rugi") ?>">Laporan Laba Rugi</a></li>
                     </ul>
                 </div>
             </li>
         <?php endif; ?>
     </ul>
 </nav>