<?= $this->extend("layouts/main_layout"); ?>

<?= $this->section("content"); ?>
<div class="content-wrapper">
    <div class="card">
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Kode Part</th>
                        <th>Nama</th>
                        <th>Unit</th>
                        <th>Harga Pokok</th>
                        <th>Unit Terjual</th>
                        <th>Harga Jual</th>
                        <th>Sisa Unit</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($spareparts as $sparepart) : ?>
                        <tr>
                            <td><?= $sparepart["part_code"]; ?></td>
                            <td><?= $sparepart["name"]; ?></td>
                            <td><?= $sparepart["stock"]; ?></td>
                            <td>Rp. <?= number_format($sparepart["initial_price"]); ?></td>
                            <td><?= $sparepart["sale_transaction_quantity"]; ?></td>
                            <td>Rp. <?= number_format($sparepart["selling_price"]); ?></td>
                            <td><?= $sparepart["stock"] - $sparepart["sale_transaction_quantity"]; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>