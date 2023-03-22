<?= $this->extend("layouts/main_layout"); ?>

<?= $this->section("content"); ?>
<div class="content-wrapper">
    <div class="card">
        <div class="card-body">
            <a href="<?= base_url("/data-penjualan/tambah"); ?>" class="btn btn-primary btn-rounded align-self-center mb-4">Tambah Data Penjualan</a>
            <div class="table-responsive">

                <?php if (session()->getFlashdata("success")) : ?>
                    <div class="alert alert-success">
                        <?= session()->getFlashdata("success"); ?>
                    </div>
                <?php endif; ?>

                <table id="datatables" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>Tanggal Transaksi</th>
                            <th>Kode Transaksi</th>
                            <th>Nama Customer</th>
                            <th>Sparepart</th>
                            <th>Kurir</th>
                            <th>Quantity</th>
                            <th>Jumlah Pembayaran</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($sale_transactions as $sale_transaction) : ?>
                            <tr>
                                <td><?= $sale_transaction["trx_date"]; ?></td>
                                <td><?= $sale_transaction["trx_code"]; ?></td>
                                <td><?= $sale_transaction["customer_name"]; ?></td>
                                <td><?= $sale_transaction["sparepart_name"] ?></td>
                                <td><?= $sale_transaction["courier_name"] ?></td>
                                <td><?= $sale_transaction["quantity"] ?></td>
                                <td>Rp. <?= number_format($sale_transaction["total_amount"]); ?></td>
                                <td>
                                    <?php if ($sale_transaction["status"] == "pending") : ?>
                                        <span class="badge badge-warning">Pending</span>
                                    <?php else : ?>
                                        <span class="badge badge-success">Berhasil</span>
                                    <?php endif ?>
                                </td>
                                <td>

                                    <?php if ($sale_transaction["status"] == "pending") : ?>
                                        <a href="<?= base_url("/data-penjualan/konfirmasi/" . $sale_transaction["id"]) ?>" class="btn btn-info btn-sm" onclick="return confirm('Konfirmasi Penjualan ini?')">Konfirmasi</a>
                                    <?php endif; ?>
                                    <a href="<?= base_url("/data-penjualan/edit/" . $sale_transaction["id"]) ?>" class="btn btn-warning btn-sm">Edit</a>
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