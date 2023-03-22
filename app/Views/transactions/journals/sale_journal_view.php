<?= $this->extend("layouts/main_layout"); ?>

<?= $this->section("content"); ?>
<div class="content-wrapper">
    <div class="card">
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Kode Transaksi</th>
                        <th>Keterangan</th>
                        <th>Ref</th>
                        <th>Debit</th>
                        <th>Kredit</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($sale_journals as $sale_journal) : ?>
                        <tr>
                            <td><?= $sale_journal["trx_date"]; ?></td>
                            <td><?= $sale_journal["trx_code"]; ?></td>
                            <td><?= $sale_journal["description"]; ?></td>
                            <td><?= $sale_journal["ref"]; ?></td>
                            <td>
                                <?php if ($sale_journal["journal_type"] == "debit") : ?>
                                    Rp. <?= number_format($sale_journal["total_price"]); ?>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if ($sale_journal["journal_type"] == "credit") : ?>
                                    Rp. <?= number_format($sale_journal["total_price"]); ?>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>