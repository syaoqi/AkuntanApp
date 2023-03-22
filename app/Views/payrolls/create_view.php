<?= $this->extend("layouts/main_layout"); ?>

<?= $this->section("content"); ?>
<div class="content-wrapper">
    <div class="card">
        <div class="card-body">
            <div class="container">
                <form class="forms-sample" action="<?= base_url("data-penggajian/simpan"); ?>" method="POST">
                    <?= csrf_field(); ?>

                    <div class="row">
                        <div class="form-group">
                            <label for="date">Tanggal</label>
                            <input type="date" class="form-control <?= ($validation->hasError("date")) ? "is-invalid" : ""; ?>" id="date" name="date" placeholder="Tanggal" value="">
                            <div class="invalid-feedback" role="alert">
                                <?= $validation->getError("date") ?>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="employee_id">Pilih Karyawan</label>
                                <select name="employee_id" id="employee_id" class="form-control <?= ($validation->hasError("employee_id")) ? "is-invalid" : ""; ?>">
                                    <option disabled selected>Pilih</option>
                                    <?php foreach ($employees as $employee) : ?>
                                        <option value="<?= $employee["id"] ?>"><?= $employee["full_name"] ?> (<?= $employee["nik"] ?>)</option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="invalid-feedback" role="alert">
                                    <?= $validation->getError("employee_id") ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="nik">NIK</label>
                                <input type="text" name="nik" id="nik" class="form-control" placeholder="NIK" disabled>
                            </div>
                            <div class="form-group">
                                <label for="position">Jabatan</label>
                                <input type="text" name="position" id="position" class="form-control" placeholder="Jabatan" disabled>
                            </div>
                            <div class="form-group">
                                <label for="basic_salary">Gaji Pokok (Rp)</label>
                                <input type="number" name="basic_salary" id="basic_salary" class="form-control <?= ($validation->hasError("basic_salary")) ? "is-invalid" : ""; ?>" placeholder="Gaji Pokok">
                                <div class="invalid-feedback" role="alert">
                                    <?= $validation->getError("basic_salary") ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="units_sold">Jumlah Unit Terjual Bulan Ini</label>
                                <input type="number" name="units_sold" id="units_sold" class="form-control <?= ($validation->hasError("units_sold")) ? "is-invalid" : ""; ?>" placeholder="Jumlah Unit Terjual">
                                <div class="invalid-feedback" role="alert">
                                    <?= $validation->getError("units_sold") ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="incentive">Insentif</label>
                                <input type="number" name="incentive" id="incentive" class="form-control <?= ($validation->hasError("incentive")) ? "is-invalid" : ""; ?>" placeholder="Insentif Penjualan">
                                <div class="invalid-feedback" role="alert">
                                    <?= $validation->getError("incentive") ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="overtime_hours">Jam Lembur</label>
                                <input type="number" name="overtime_hours" id="overtime_hours" class="form-control <?= ($validation->hasError("overtime_hours")) ? "is-invalid" : ""; ?>" placeholder="Jumlah Jam Lembur">
                                <div class="invalid-feedback" role="alert">
                                    <?= $validation->getError("overtime_hours") ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="overtime_pay">Uang Lembur (Rp)</label>
                                <input type="number" name="overtime_pay" id="overtime_pay" class="form-control <?= ($validation->hasError("overtime_pay")) ? "is-invalid" : ""; ?>" placeholder="Uang Lembur">
                                <div class="invalid-feedback" role="alert">
                                    <?= $validation->getError("overtime_pay") ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="salary_cuts">Potongan</label>
                                <input type="number" name="salary_cuts" id="salary_cuts" class="form-control" placeholder="Potongan Gaji">
                            </div>
                            <div class="form-group">
                                <label for="net_salary">Gaji Yang Diterima (Rp) <button class="btn btn-success btn-sm" id="calculateNetSalary">Hitung Gaji</button> </label>
                                <input type="number" name="net_salary" id="net_salary" class="form-control <?= ($validation->hasError("net_salary")) ? "is-invalid" : ""; ?>" placeholder="Potongan Gaji">
                                <div class="invalid-feedback" role="alert">
                                    <?= $validation->getError("net_salary") ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary me-2">Simpan Data</button>
                    <a href="<?= base_url("data-penggajian") ?>" class="btn btn-light">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>


<?= $this->section("script"); ?>
<!-- get total salary by sum basic_salary + transport_allowance + meal_allowance -->
<script>
    $(document).ready(function() {
        $("#date").val(new Date().toISOString().substr(0, 10));
        // get employee nik, position, total_salary when selected employee using GET
        $("#employee_id").change(function() {
            let employee_id = $(this).val();
            $.ajax({
                type: "GET",
                url: "<?= base_url("employee/getdetail") ?>" + "/" + employee_id,
                success: function(response) {
                    let data = JSON.parse(response);
                    console.log(data);
                    $("#nik").val(data.nik);
                    $("#position").val(data.position_name);
                    $("#basic_salary").val(data.total_salary);
                }
            });
        });

        // if units_sold < 5 and not 0, set incentive
        $("#units_sold").on("keyup", function() {
            let units_sold = $(this).val();
            if (units_sold <= 5 && units_sold != 0) {
                $("#incentive").val(units_sold * 130000);
            } else if (units_sold >= 6 && units_sold <= 11) {
                $("#incentive").val(units_sold * 150000);
            } else if (units_sold > 11) {
                $("#incentive").val(units_sold * 170000);
            } else {
                $("#incentive").val(0);
            }
        });

        // if overtime_hours not empty, set overtime_pay
        $("#overtime_hours").on("keyup", function() {
            let overtime_hours = $(this).val();
            if (overtime_hours != 0) {
                $("#overtime_pay").val(overtime_hours * 10000);
            } else {
                $("#overtime_pay").val(0);
            }
        });

        // calculate net_salary when click button
        $("#calculateNetSalary").click(function() {
            // prevent default action
            event.preventDefault();
            let basic_salary = $("#basic_salary").val();
            let incentive = $("#incentive").val();
            let overtime_pay = $("#overtime_pay").val();
            let salary_cuts = $("#salary_cuts").val();
            let net_salary = parseInt(basic_salary) + parseInt(incentive) + parseInt(overtime_pay) - parseInt(salary_cuts);
            $("#net_salary").val(net_salary);
        });

    });
</script>
<?= $this->endSection(); ?>