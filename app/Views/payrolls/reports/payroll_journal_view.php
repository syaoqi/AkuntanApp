<?= $this->extend("layouts/main_layout"); ?>

<?= $this->section("content"); ?>
<div class="content-wrapper">
    <div class="card">
        <div class="card-body">

            <div class="text-center py-4">
                <h4>Jurnal Umum</h4>
                <p>PT Indocipta Karya Pradana</p>
            </div>

            <table class="table">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Keterangan</th>
                        <th>Ref</th>
                        <th>Debet</th>
                        <th>Kredit</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($payroll_journals as $payroll_journal) : ?>
                        <tr>
                            <td><?= $payroll_journal["date"]; ?></td>
                            <td><?= $payroll_journal["description"]; ?></td>
                            <td><?= $payroll_journal["ref"]; ?></td>
                            <td>
                                <?php if ($payroll_journal["journal_type"] == "debit") : ?>
                                    Rp. <?= number_format($payroll_journal["total_price"]); ?>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if ($payroll_journal["journal_type"] == "credit") : ?>
                                    Rp. <?= number_format($payroll_journal["total_price"]); ?>
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