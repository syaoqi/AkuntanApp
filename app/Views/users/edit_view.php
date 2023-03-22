<?= $this->extend("layouts/main_layout"); ?>

<?= $this->section("content"); ?>
<div class="content-wrapper">
    <div class="card">
        <div class="card-body">
            <div class="container">
                <form class="forms-sample" action="<?= base_url("data-pengguna/update/" . $user["id"]); ?>" method="POST" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="_method" value="PUT">
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" class="form-control <?= ($validation->hasError("name")) ? "is-invalid" : ""; ?>" id="name" name="name" placeholder="Nama Lengkap" value="<?= (old("name")) ? old("name") : $user["name"] ?>">
                        <div class="invalid-feedback" role="alert">
                            <?= $validation->getError("name") ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control <?= ($validation->hasError("email")) ? "is-invalid" : ""; ?>" id="email" name="email" placeholder="Masukkan E-mail" value="<?= (old("email")) ? old("email") : $user["email"] ?>">
                        <div class="invalid-feedback" role="alert">
                            <?= $validation->getError("email") ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="phone">Nomor HP</label>
                        <input type="number" class="form-control <?= ($validation->hasError("phone")) ? "is-invalid" : ""; ?>" id="phone" name="phone" placeholder="Masukkan Nomor HP" value="<?= (old("phone")) ? old("phone") : $user["phone"] ?>">
                        <div class="invalid-feedback" role="alert">
                            <?= $validation->getError("phone") ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="avatar">Foto Profil</label>
                        <div class="image-wrapper">
                            <img src="<?= base_url("uploads/avatars/" . $user["avatar"]) ?>" alt="<?= $user["name"] ?>" style="width: 200px; height: 200px; object-fit: cover; object-position: center; border-radius: 10px; margin-bottom: 10px">
                        </div>
                        <input type="file" class="form-control" id="avatar" name="avatar">
                        <small class="text-muted">Kosongkan jika tidak ingin mengganti foto profil</small>
                    </div>
                    <div class="form-group">
                        <label for="address">Alamat</label>
                        <input type="text" class="form-control" id="address" name="address" placeholder="Alamat Lengkap" value="<?= (old("address")) ? old("address") : $user["address"] ?>">
                    </div>
                    <div class="form-group">
                        <label for="role">Hak Akses</label>
                        <select name="role" id="role" class="form-control <?= ($validation->hasError("role")) ? "is-invalid" : ""; ?>">
                            <option value="" disabled selected>Pilih</option>
                            <option value="director" <?= $user["role"] == "director" ? "selected" : "" ?>>Direktur</option>
                            <option value="hrd" <?= $user["role"] == "hrd" ? "selected" : "" ?>>HRD</option>
                            <option value="accountant" <?= $user["role"] == "accountant" ? "selected" : "" ?>>Akuntan</option>
                            <option value="warehouse" <?= $user["role"] == "warehouse" ? "selected" : "" ?>>Gudang</option>
                            <option value="workshop" <?= $user["role"] == "workshop" ? "selected" : "" ?>>Bengkel</option>
                        </select>
                        <div class="invalid-feedback" role="alert">
                            <?= $validation->getError("role") ?>
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