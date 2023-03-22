<?= $this->extend("layouts/main_layout"); ?>

<?= $this->section("content"); ?>
<div class="content-wrapper">
    <div class="card">
        <div class="card-body">
            <div class="container">
                <form class="forms-sample" action="<?= base_url("data-sparepart/update/" . $sparepart["id"]); ?>" method="POST" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="_method" value="PUT">

                    <div class="form-group">
                        <label for="part_code">Kode Sparepart</label>
                        <input type="text" class="form-control <?= ($validation->hasError("part_code")) ? "is-invalid" : ""; ?>" id="part_code" name="part_code" placeholder="Masukkan Kode Sparepart" value="<?= $sparepart["part_code"]; ?>" readonly>
                        <div class="invalid-feedback" role="alert">
                            <?= $validation->getError("part_code") ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="category_id">Kategori</label>
                        <select name="category_id" id="category_id" class="form-control <?= ($validation->hasError("category_id")) ? "is-invalid" : ""; ?>">
                            <option value="" disabled selected>Pilih</option>
                            <?php foreach ($categories as $category) : ?>
                                <option value="<?= $category["id"] ?>" <?= $category["id"] == $sparepart["id"] ? "selected" : "" ?>><?= $category["name"] ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback" role="alert">
                            <?= $validation->getError("category_id") ?>
                        </div>
                        <div class="form-group">
                            <label for="name">Nama Onderdil</label>
                            <input type="text" class="form-control <?= ($validation->hasError("name")) ? "is-invalid" : ""; ?>" id="name" name="name" placeholder="Masukkan Nama Onderdil" value="<?= (old("name")) ? old("name") : $sparepart["name"] ?>">
                            <div class="invalid-feedback" role="alert">
                                <?= $validation->getError("name") ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="stock">Persediaan</label>
                            <input type="number" class="form-control <?= ($validation->hasError("stock")) ? "is-invalid" : ""; ?>" id="stock" name="stock" placeholder="Masukkan Jumlah Persediaan" value="<?= (old("stock")) ? old("stock") : $sparepart["stock"] ?>">
                            <div class="invalid-feedback" role="alert">
                                <?= $validation->getError("stock") ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="initial_price">Harga Awal</label>
                            <input type="text" class="form-control <?= ($validation->hasError("initial_price")) ? "is-invalid" : ""; ?>" id="initial_price" name="initial_price" placeholder="Masukkan Harga Awal" value="<?= (old("initial_price")) ? old("initial_price") : $sparepart["initial_price"] ?>">
                            <div class="invalid-feedback" role="alert">
                                <?= $validation->getError("initial_price") ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="selling_price">Harga Jual</label>
                            <input type="text" class="form-control <?= ($validation->hasError("selling_price")) ? "is-invalid" : ""; ?>" id="selling_price" name="selling_price" placeholder="Masukkan Harga Jual" value="<?= (old("selling_price")) ? old("selling_price") : $sparepart["selling_price"] ?>">
                            <div class="invalid-feedback" role="alert">
                                <?= $validation->getError("selling_price") ?>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="image">Gambar</label>
                            <div class="image-wrapper">
                                <img src="<?= base_url("uploads/spareparts/" . $sparepart["image"]) ?>" alt="<?= $sparepart["name"] ?>" style="width: 200px; height: 200px; object-fit: cover; object-position: center; border-radius: 10px; margin-bottom: 10px">
                            </div>
                            <input type="file" class="form-control" id="image" name="image">
                            <small class="text-muted">Kosongkan jika tidak ingin mengganti foto profil</small>
                        </div>
                        <div class="form-group">
                            <label for="color">Warna</label>
                            <input type="text" class="form-control <?= ($validation->hasError("color")) ? "is-invalid" : ""; ?>" id="color" name="color" placeholder="Masukkan Warna" value="<?= (old("color")) ? old("color") : $sparepart["color"] ?>">
                            <div class="invalid-feedback" role="alert">
                                <?= $validation->getError("color") ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="description">Deskripsi</label>
                            <input type="text" class="form-control <?= ($validation->hasError("description")) ? "is-invalid" : ""; ?>" id="description" name="description" placeholder="Masukkan Deskripsi" value="<?= (old("description")) ? old("description") : $sparepart["description"] ?>">
                            <div class="invalid-feedback" role="alert">
                                <?= $validation->getError("description") ?>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary me-2">Simpan Data</button>
                        <a href="<?= base_url("data-sparepart") ?>" class="btn btn-light">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>