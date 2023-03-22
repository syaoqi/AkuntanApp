<?= $this->extend("layouts/main_layout"); ?>

<?= $this->section("content"); ?>
<div class="content-wrapper">
    <div class="card">
        <div class="card-body">
            <a href="<?= base_url("/data-pembayaran-beban/tambah"); ?>" class="btn btn-primary btn-rounded align-self-center mb-4">Tambah Data Pembayaran Beban</a>
            <div class="table-responsive">

                <?php if (session()->getFlashdata("success")) : ?>
                    <div class="alert alert-success">
                        <?= session()->getFlashdata("success"); ?>
                    </div>
                <?php endif; ?>

                <table id="datatables" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Kode Transaksi</th>
                            <th>Kategori Beban</th>
                            <th>Nomimal Pembayaran</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($load_payments as $load_payment) : ?>
                            <tr>
                                <td><?= $load_payment["trx_date"]; ?></td>
                                <td><?= $load_payment["trx_code"]; ?></td>
                                <td><?= $load_payment["load_category_name"] ?></td>
                                <td>Rp. <?= number_format($load_payment["total_payment"]) ?></td>
                                <td>
                                    <?php if ($load_payment["status"] == "pending") : ?>
                                        <span class="badge badge-success">Pending</span>
                                    <?php else : ?>
                                        <span class="badge badge-success">Berhasil</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <!-- if pending, confirm -->
                                    <?php if ($load_payment["status"] == "pending") : ?>
                                        <a href="<?= base_url("/data-pembayaran-beban/konfirmasi/" . $load_payment["id"]); ?>" class="btn btn-info btn-sm" onclick="return confirm('Konfirmasi Pembayaran Beban?')">Konfirmasi</a>
                                    <?php else : ?>
                                        -
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>