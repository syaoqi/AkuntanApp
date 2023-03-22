<?= $this->extend("layouts/main_layout"); ?>

<?= $this->section("content"); ?>
<div class="content-wrapper">
    <div class="card">
        <div class="card-body">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 mx-auto">

                        <!-- if error session set alert -->
                        <?php if (session()->getFlashdata("error")) : ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <?= session()->getFlashdata("error"); ?>
                            </div>
                        <?php endif; ?>

                        <form action="<?= base_url("laporan-laba-rugi/filter"); ?>" method="POST">
                            <?= csrf_field(); ?>
                            <div class="form-group">
                                <label for="start_date">Tanggal Awal</label>
                                <div class="input-group">
                                    <input type="date" class="form-control <?= ($validation->hasError("start_date")) ? "is-invalid" : ""; ?>" id="datepicker" name="start_date">
                                    <div class="invalid-feedback" role="alert">
                                        <?= $validation->getError("start_date") ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="end_date">Tanggal Akhir</label>
                                <div class="input-group">
                                    <input type="date" class="form-control <?= ($validation->hasError("end_date")) ? "is-invalid" : ""; ?>" id="datepicker" name="end_date">
                                    <div class="invalid-feedback" role="alert">
                                        <?= $validation->getError("end_date") ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary" id="btn-filter">Tampilkan Laporan Laba Rugi</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section("script"); ?>
<script>
    // datepicker
    $(function() {
        $("#datepicker").datepicker({
            format: "yyyy-mm-dd",
            autoclose: true,
            todayHighlight: true,
        });
    });
</script>
<?= $this->endSection(); ?>