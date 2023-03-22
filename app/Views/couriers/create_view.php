<?= $this->extend("layouts/main_layout"); ?>

<?= $this->section("content"); ?>
<div class="content-wrapper">
    <div class="card">
        <div class="card-body">
            <div class="container">
                <form class="forms-sample" action="<?= base_url("data-kurir/simpan"); ?>" method="POST">
                    <?= csrf_field(); ?>
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" class="form-control <?= ($validation->hasError("name")) ? "is-invalid" : ""; ?>" id="name" name="name" placeholder="Nama kurir" value="<?= old("name") ?>">
                        <div class="invalid-feedback" role="alert">
                            <?= $validation->getError("name") ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="address">Alamat</label>
                        <input type="text" class="form-control <?= ($validation->hasError("address")) ? "is-invalid" : ""; ?>" id="address" name="address" placeholder="Alamat" value="<?= old("address") ?>">
                        <div class="invalid-feedback" role="alert">
                            <?= $validation->getError("address") ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="phone">Nomor Ponsel</label>
                        <input type="number" class="form-control <?= ($validation->hasError("phone")) ? "is-invalid" : ""; ?>" id="phone" name="phone" placeholder="Nomor Ponsel" value="<?= old("phone") ?>">
                        <div class="invalid-feedback" role="alert">
                            <?= $validation->getError("phone") ?>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary me-2">Simpan Data</button>
                    <a href="<?= base_url("data-kurir") ?>" class="btn btn-light">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>