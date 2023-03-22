<?= $this->extend("layouts/main_layout"); ?>

<?= $this->section("content"); ?>
<div class="content-wrapper">
    <div class="card">
        <div class="card-body">
            <div class="container">
                <form class="forms-sample" action="<?= base_url("data-kategori-beban/simpan"); ?>" method="POST">
                    <?= csrf_field(); ?>
                    <div class="form-group">
                        <label for="category_code">Kode Kategori</label>
                        <input type="text" class="form-control <?= ($validation->hasError("category_code")) ? "is-invalid" : ""; ?>" id="category_code" name="category_code" placeholder="Kode Kategori" value="<?= $category_code ?>" readonly>
                        <div class="invalid-feedback" role="alert">
                            <?= $validation->getError("category_code") ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="category_name">Nama Kategori</label>
                        <select name="category_name" id="category_name" class="form-control <?= ($validation->hasError("category_name")) ? "is-invalid" : ""; ?>">
                            <option disabled selected>Pilih</option>
                            <?php foreach ($coa_dependents as $coa_dependent) : ?>
                                <option value="<?= $coa_dependent["coa_name"] ?>"><?= $coa_dependent["coa_name"] ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback" role="alert">
                            <?= $validation->getError("category_name") ?>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary me-2">Simpan Data</button>
                    <a href="<?= base_url("data-kategori-beban") ?>" class="btn btn-light">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>