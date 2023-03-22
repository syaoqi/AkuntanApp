<?= $this->extend("layouts/main_layout"); ?>

<?= $this->section("content"); ?>
<div class="content-wrapper">
    <div class="card">
        <div class="card-body">
            <div class="container">
                <form class="forms-sample" action="<?= base_url("data-pengguna/simpan"); ?>" method="POST" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" class="form-control <?= ($validation->hasError("name")) ? "is-invalid" : ""; ?>" id="name" name="name" placeholder="Nama Lengkap" value="<?= old("name") ?>">
                        <div class="invalid-feedback" role="alert">
                            <?= $validation->getError("name") ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control <?= ($validation->hasError("email")) ? "is-invalid" : ""; ?>" id="email" name="email" placeholder="Masukkan E-mail" value="<?= old("email") ?>">
                        <div class="invalid-feedback" role="alert">
                            <?= $validation->getError("email") ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="phone">Nomor HP</label>
                        <input type="number" class="form-control <?= ($validation->hasError("phone")) ? "is-invalid" : ""; ?>" id="phone" name="phone" placeholder="Masukkan Nomor HP" value="<?= old("phone") ?>">
                        <div class="invalid-feedback" role="alert">
                            <?= $validation->getError("phone") ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="avatar">Foto Profil</label>
                        <input type="file" class="form-control" id="avatar" name="avatar">
                    </div>
                    <div class="form-group">
                        <label for="address">Alamat</label>
                        <input type="text" class="form-control" id="address" name="address" placeholder="Alamat Lengkap" value="<?= old("address") ?>">
                    </div>
                    <div class="form-group">
                        <label for="role">Hak Akses</label>
                        <select name="role" id="role" class="form-control <?= ($validation->hasError("role")) ? "is-invalid" : ""; ?>">
                            <option value="" disabled selected>Pilih</option>
                            <option value="director" <?= old("role") == "director" ? "selected" : "" ?>>Direktur</option>
                            <option value="hrd" <?= old("role") == "hrd" ? "selected" : "" ?>>HRD</option>
                            <option value="accountant" <?= old("role") == "accountant" ? "selected" : "" ?>>Akuntan</option>
                            <option value="warehouse" <?= old("role") == "warehouse" ? "selected" : "" ?>>Gudang</option>
                            <option value="workshop" <?= old("role") == "workshop" ? "selected" : "" ?>>Bengkel</option>
                        </select>
                        <div class="invalid-feedback" role="alert">
                            <?= $validation->getError("role") ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control <?= ($validation->hasError("password")) ? "is-invalid" : ""; ?>" id="password" name="password" placeholder="Buat Password">
                        <div class="invalid-feedback" role="alert">
                            <?= $validation->getError("password") ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password_confirm">Konfirmasi Password</label>
                        <input type="password" class="form-control <?= ($validation->hasError("password_confirm")) ? "is-invalid" : ""; ?>" id="password_confirm" name="password_confirm" placeholder="Konfirmasi Password">
                        <div class="invalid-feedback" role="alert">
                            <?= $validation->getError("password_confirm") ?>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary me-2">Simpan Data</button>
                    <a href="<?= base_url("data-pengguna") ?>" class="btn btn-light">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>