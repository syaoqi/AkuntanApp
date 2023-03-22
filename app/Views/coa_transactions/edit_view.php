<?= $this->extend("layouts/main_layout"); ?>

<?= $this->section("content"); ?>
<div class="content-wrapper">
    <div class="card">
        <div class="card-body">
            <div class="container">
                <form class="forms-sample" action="<?= base_url("data-akun-transaksi/update/".$coa_transaction["id"]); ?>" method="POST">
                    <?= csrf_field(); ?>
                    <div class="form-group">
                        <label for="coa_code">Kode Akun</label>
                        <input type="number" class="form-control <?= ($validation->hasError("coa_code")) ? "is-invalid" : ""; ?>" id="coa_code" name="coa_code" placeholder="Kode Akun" value="<?= (old("coa_code")) ? old("coa_code") : $coa_transaction["coa_code"] ?>">
                        <div class="invalid-feedback" role="alert">
                            <?= $validation->getError("coa_code") ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="coa_name">Nama Akun</label>
                        <input type="text" class="form-control <?= ($validation->hasError("coa_name")) ? "is-invalid" : ""; ?>" id="coa_name" name="coa_name" placeholder="Kode Akun" value="<?= (old("coa_name")) ? old("coa_name") : $coa_transaction["coa_name"] ?>">
                        <div class="invalid-feedback" role="alert">
                            <?= $validation->getError("coa_name") ?>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary me-2">Simpan Data</button>
                    <a href="<?= base_url("data-akun-transaksi") ?>" class="btn btn-light">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>