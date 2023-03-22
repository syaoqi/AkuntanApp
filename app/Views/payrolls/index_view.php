<?= $this->extend("layouts/main_layout"); ?>

<?= $this->section("content"); ?>
<div class="content-wrapper">
    <div class="card">
        <div class="card-body">
            <a href="<?= base_url("/data-penggajian/tambah"); ?>" class="btn btn-primary btn-rounded align-self-center mb-4">Tambah Data Penggajian</a>
            <div class="table-responsive">

                <?php if (session()->getFlashdata("success")) : ?>
                    <div class="alert alert-success">
                        <?= session()->getFlashdata("success"); ?>
                    </div>
                <?php endif; ?>

                <table id="datatables" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>NIK</th>
                            <th>Jabatan</th>
                            <th>Gaji Pokok</th>
                            <th>Insentif</th>
                            <th>Uang Lembur</th>
                            <th>Potongan</th>
                            <th>Total Pendapatan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($payrolls as $payroll) : ?>
                            <tr>
                                <td><?= $payroll["employee_name"]; ?></td>
                                <td><?= $payroll["employee_nik"] ?></td>
                                <td><?= $payroll["position_name"] ?></td>
                                <td>Rp. <?= number_format($payroll["basic_salary"]) ?></td>
                                <td>Rp. <?= number_format($payroll["incentive"]) ?></td>
                                <td>Rp. <?= number_format($payroll["overtime_pay"]) ?></td>
                                <td>Rp. <?= number_format($payroll["salary_cuts"]) ?></td>
                                <td>Rp. <?= number_format($payroll["net_salary"]) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>