<?= $this->extend("layouts/main_layout"); ?>

<?= $this->section("content"); ?>
<div class="content-wrapper">
    <div class="card">
        <div class="card-body">
            <a href="<?= base_url("/data-pembelian/tambah"); ?>" class="btn btn-primary btn-rounded align-self-center mb-4">Tambah Data Pembelian</a>
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
                            <th>Nama Supplier</th>
                            <th>Sparepart</th>
                            <th>Kurir</th>
                            <th>Quantity</th>
                            <th>Total Tagihan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($purchase_transactions as $purchase_transaction) : ?>
                            <tr>
                                <td><?= $purchase_transaction["trx_date"]; ?></td>
                                <td><?= $purchase_transaction["trx_code"]; ?></td>
                                <td><?= $purchase_transaction["supplier_name"] ?></td>
                                <td><?= $purchase_transaction["sparepart_name"] ?></td>
                                <td><?= $purchase_transaction["courier_name"] ?></td>
                                <td><?= $purchase_transaction["quantity"] ?></td>
                                <td>Rp. <?= number_format($purchase_transaction["total_amount"]); ?></td>
                                <td>
                                    <?php if ($purchase_transaction["status"] == "pending") : ?>
                                        <span class="badge badge-warning">Pending</span>
                                    <?php else : ?>
                                        <span class="badge badge-success">Selesai</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($purchase_transaction["status"] == "pending") : ?>
                                        <a href="<?= base_url("/data-pembelian/konfirmasi/" . $purchase_transaction["id"]) ?>" class="btn btn-info btn-sm" onclick="return confirm('Konfirmasi Pembelian ini?')">Konfirmasi</a>
                                    <?php endif; ?>
                                    <a href="<?= base_url("/data-pembelian/edit/" . $purchase_transaction["id"]) ?>" class="btn btn-warning btn-sm">Edit</a>
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