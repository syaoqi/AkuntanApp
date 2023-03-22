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
                        <th>Tanggal</th>
                        <th>Keterangan</th>
                        <th>Ref</th>
                        <th>Debit</th>
                        <th>Kredit</th>
                        <th>Saldo Debit</th>
                        <th>Saldo Kredit</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($buku_besar as $bukubesar) : ?>
                        <tr>
                            <td><?= $bukubesar["load_payment_date"]; ?></td>
                            <td><?= $bukubesar["description"]; ?></td>
                            <td><?= $bukubesar["ref"]; ?></td>
                            <td>
                                <!-- if journal type debit -->
                                <?php if ($bukubesar["journal_type"] == "debit") : ?>
                                    Rp. <?= number_format($bukubesar["total_price"]); ?>
                                    <!-- if journal type credit -->
                                <?php elseif ($bukubesar["journal_type"] == "credit") : ?>
                                    <?= "-"; ?>
                                <?php endif; ?>
                            </td>
                            <td>
                                <!-- if journal type debit -->
                                <?php if ($bukubesar["journal_type"] == "credit") : ?>
                                    Rp. <?= number_format($bukubesar["total_price"]); ?>
                                    <!-- if journal type credit -->
                                <?php elseif ($bukubesar["journal_type"] == "debit") : ?>
                                    <?= "-"; ?>
                                <?php endif; ?>
                            </td>
                            <td>
                                <!-- if journal type debit -->
                                <?php if ($bukubesar["journal_type"] == "debit") : ?>
                                    <?= "-"; ?>
                                    <!-- if journal type credit -->
                                <?php elseif ($bukubesar["journal_type"] == "credit") : ?>
                                    Rp. <?= number_format($bukubesar["total_price"]); ?>
                                <?php endif; ?>
                            </td>
                            <td>
                                <!-- if journal type debit -->
                                <?php if ($bukubesar["journal_type"] == "credit") : ?>
                                    <?= "-"; ?>
                                    <!-- if journal type credit -->
                                <?php elseif ($bukubesar["journal_type"] == "debit") : ?>
                                    Rp. <?= number_format($bukubesar["total_price"]); ?>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach ?>
                    <tr class="fw-bold">
                        <td colspan="5">Saldo Akhir</td>
                        <td colspan="2">
                            <?php $total_price = 0; ?>
                            <?php foreach ($buku_besar as $bukubesar) : ?>
                                <?php $total_price += $bukubesar["total_price"]; ?>
                            <?php endforeach ?>
                            Rp. <?= number_format($total_price); ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>