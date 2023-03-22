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
                        <th colspan="2">Pendapatan</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Penjualan</td>
                        <td>Rp. <?= number_format($penjualan); ?></td>
                    </tr>
                    <tr>
                        <td>Harga Pokok Penjualan</td>
                        <td>Rp. <?= number_format($harga_pokok_penjualan); ?></td>
                    </tr>
                    <tr>
                        <td>
                            <b>Total Pendapatan</b>
                        </td>
                        <td>
                            <?php
                            $total_pendapatan = $penjualan - $harga_pokok_penjualan;
                            ?>
                            <b>Rp. <?= number_format($total_pendapatan); ?></b>
                        </td>
                    </tr>
                </tbody>

                <thead>
                    <tr>
                        <th colspan="2">Beban-Beban</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($laba_rugi as $labarugi) : ?>
                        <tr>
                            <td><?= $labarugi["description"]; ?></td>
                            <td>Rp. <?= number_format($labarugi["total_price"]); ?></td>
                        </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td>
                            <b>Total Beban</b>
                        </td>
                        <td>
                            <?php
                            $total_beban = 0;
                            foreach ($laba_rugi as $labarugi) {
                                $total_beban += $labarugi["total_price"];
                            }
                            ?>
                            Rp. <?= number_format($total_beban); ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Total Laba</b>
                        </td>
                        <td>
                            <?php
                            $total_laba = $total_pendapatan - $total_beban;
                            ?>
                            Rp. <?= number_format($total_laba); ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>