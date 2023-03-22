<?= $this->extend("layouts/main_layout"); ?>

<?= $this->section("content"); ?>
<div class="content-wrapper">
    <div class="card">
        <div class="card-body">
            <div class="container">
                <form class="forms-sample" action="<?= base_url("data-kategori/simpan"); ?>" method="POST">
                    <?= csrf_field(); ?>
                    <div class="form-group">
                        <label for="name">Nama Kategori</label>
                        <input type="text" class="form-control <?= ($validation->hasError("name")) ? "is-invalid" : ""; ?>" id="name" name="name" placeholder="Masukkan Nama Kategori" value="<?= old("name") ?>">
                        <div class="invalid-feedback" role="alert">
                            <?= $validation->getError("name") ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description">Deskripsi</label>
                        <input type="text" class="form-control" id="description" name="description" placeholder="Deskripsi" value="<?= old("description") ?>">
                    </div>
                    <button type="submit" class="btn btn-primary me-2">Simpan Data</button>
                    <a href="<?= base_url("data-kategori") ?>" class="btn btn-light">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>