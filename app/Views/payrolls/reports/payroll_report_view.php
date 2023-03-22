<?= $this->extend("layouts/main_layout"); ?>

<?= $this->section("content"); ?>
<div class="content-wrapper">
    <div class="card">
        <div class="card-body">

            <div class="text-center py-4">
                <h4>Laporan Penggajian</h4>
                <p>PT Indocipta Karya Pradana</p>
            </div>

            <table class="table">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Nama Pegawai</th>
                        <th>Jabatan</th>
                        <th>Gaji Pokok</th>
                        <th>Insentif</th>
                        <th>Bonus Lembur</th>
                        <th>Potongan</th>
                        <th>Gaji Bersih</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($payrolls as $payroll) : ?>
                        <tr>
                            <td><?= $payroll["date"] ?></td>
                            <td><?= $payroll["employee_name"] ?></td>
                            <td><?= $payroll["position_name"] ?></td>
                            <td>Rp. <?= number_format($payroll["basic_salary"]) ?></td>
                            <td>Rp. <?= number_format($payroll["incentive"]) ?></td>
                            <td>Rp. <?= number_format($payroll["overtime_pay"]) ?></td>
                            <td>Rp. <?= number_format($payroll["salary_cuts"]) ?></td>
                            <td>Rp. <?= number_format($payroll["net_salary"]) ?></td>
                        </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td colspan="7">
                            <b>Total Gaji Bersih</b>
                        </td>
                        <td>
                            <?php
                            $total_salary = 0;
                            foreach ($payrolls as $payroll) {
                                $total_salary += $payroll["net_salary"];
                            }
                            ?>
                            Rp. <?= number_format($total_salary) ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>