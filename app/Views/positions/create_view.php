<?= $this->extend("layouts/main_layout"); ?>

<?= $this->section("content"); ?>
<div class="content-wrapper">
    <div class="card">
        <div class="card-body">
            <div class="container">
                <form class="forms-sample" action="<?= base_url("data-jabatan/simpan"); ?>" method="POST">
                    <?= csrf_field(); ?>
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" class="form-control <?= ($validation->hasError("name")) ? "is-invalid" : ""; ?>" id="name" name="name" placeholder="Nama Jabatan" value="<?= old("name") ?>">
                        <div class="invalid-feedback" role="alert">
                            <?= $validation->getError("name") ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="basic_salary">Gaji Pokok (Rp)</label>
                        <input type="number" class="form-control <?= ($validation->hasError("basic_salary")) ? "is-invalid" : ""; ?>" id="basic_salary" name="basic_salary" placeholder="Gaji Pokok" value="<?= old("basic_salary") ?>">
                        <div class="invalid-feedback" role="alert">
                            <?= $validation->getError("basic_salary") ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="transport_allowance">Tunjangan Transport (Rp)</label>
                        <input type="number" class="form-control <?= ($validation->hasError("transport_allowance")) ? "is-invalid" : ""; ?>" id="transport_allowance" name="transport_allowance" placeholder="Tunjangan Transportasi" value="<?= old("transport_allowance") ?>">
                        <div class="invalid-feedback" role="alert">
                            <?= $validation->getError("transport_allowance") ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="meal_allowance">Uang Makan (Rp)</label>
                        <input type="number" class="form-control <?= ($validation->hasError("meal_allowance")) ? "is-invalid" : ""; ?>" id="meal_allowance" name="meal_allowance" placeholder="Uang Makan" value="<?= old("meal_allowance") ?>">
                        <div class="invalid-feedback" role="alert">
                            <?= $validation->getError("meal_allowance") ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="total_salary">Total Gaji (Rp)</label>
                        <input type="number" class="form-control <?= ($validation->hasError("total_salary")) ? "is-invalid" : ""; ?>" id="total_salary" name="total_salary" placeholder="Total Gaji" value="<?= old("total_salary") ?>" readonly>
                        <div class="invalid-feedback" role="alert">
                            <?= $validation->getError("total_salary") ?>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary me-2">Simpan Data</button>
                    <a href="<?= base_url("data-jabatan") ?>" class="btn btn-light">Kembali</a>
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
        $("#basic_salary").on("keyup", function() {
            let basic_salary = parseInt($("#basic_salary").val());
            let transport_allowance = parseInt($("#transport_allowance").val());
            let meal_allowance = parseInt($("#meal_allowance").val());
            let total_salary = basic_salary + transport_allowance + meal_allowance;
            $("#total_salary").val(total_salary);
        });
        $("#transport_allowance").on("keyup", function() {
            let basic_salary = parseInt($("#basic_salary").val());
            let transport_allowance = parseInt($("#transport_allowance").val());
            let meal_allowance = parseInt($("#meal_allowance").val());
            let total_salary = basic_salary + transport_allowance + meal_allowance;
            $("#total_salary").val(total_salary);
        });
        $("#meal_allowance").on("keyup", function() {
            let basic_salary = parseInt($("#basic_salary").val());
            let transport_allowance = parseInt($("#transport_allowance").val());
            let meal_allowance = parseInt($("#meal_allowance").val());
            let total_salary = basic_salary + transport_allowance + meal_allowance;
            $("#total_salary").val(total_salary);
        });
    });
</script>
<?= $this->endSection(); ?>