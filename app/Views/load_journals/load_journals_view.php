<?= $this->extend("layouts/main_layout"); ?>

<?= $this->section("content"); ?>
<div class="content-wrapper">
    <div class="card">
        <div class="card-body">

            <div class="text-center py-4">
                <h3 class="fw-bold text-primary">PT. Indocipta Karya Pradana</h3>
            </div>

            <table class="table">
                <thead>
                    <tr>
                        <th>Kode Transaksi</th>
                        <th>Tanggal</th>
                        <th>Keterangan</th>
                        <th>Ref</th>
                        <th>Debit</th>
                        <th>Kredit</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($load_journals as $load_journal) : ?>
                        <tr>
                            <td><?= $load_journal["trx_date"]; ?></td>
                            <td><?= $load_journal["trx_code"]; ?></td>
                            <td><?= $load_journal["description"]; ?></td>
                            <td><?= $load_journal["ref"]; ?></td>
                            <td>
                                <?php if ($load_journal["journal_type"] == "debit") : ?>
                                    Rp. <?= number_format($load_journal["total_price"]); ?>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if ($load_journal["journal_type"] == "credit") : ?>
                                    Rp. <?= number_format($load_journal["total_price"]); ?>
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