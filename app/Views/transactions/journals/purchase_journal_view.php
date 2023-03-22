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
                    <?php foreach ($purchase_journals as $purchase_journal) : ?>
                        <tr>
                            <td><?= $purchase_journal["trx_date"]; ?></td>
                            <td><?= $purchase_journal["trx_code"]; ?></td>
                            <td><?= $purchase_journal["description"]; ?></td>
                            <td><?= $purchase_journal["ref"]; ?></td>
                            <td>
                                <?php if ($purchase_journal["journal_type"] == "debit") : ?>
                                    Rp. <?= number_format($purchase_journal["total_price"]); ?>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if ($purchase_journal["journal_type"] == "credit") : ?>
                                    Rp. <?= number_format($purchase_journal["total_price"]); ?>
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