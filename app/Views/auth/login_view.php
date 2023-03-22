<?= $this->extend("layouts/auth_layout"); ?>

<?= $this->section("content"); ?>
<div class="content-wrapper d-flex align-items-center auth px-0">
    <div class="row w-100 mx-0">
        <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                <h3>Selamat Datang</h3>
                <h6 class="fw-light">Silahkan Login untuk melanjutkan</h6>
                <form class="pt-3" action="<?= base_url("/login") ?>" method="POST">
                    <?= csrf_field() ?>

                    <?php if (session()->getFlashdata("error")) : ?>
                        <div class="alert alert-danger">
                            <?= session()->getFlashdata("error") ?>
                        </div>
                    <?php endif; ?>

                    <div class="form-group">
                        <input type="text" class="form-control form-control-lg <?= ($validation->hasError("email")) ? "is-invalid" : "" ?>" name="email" id="email" placeholder="Masukkan Email" value="<?= old("email") ?>" autofocus>
                        <div class="invalid-feedback" role="alert">
                            <?= $validation->getError("email") ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control form-control-lg <?= ($validation->hasError("password")) ? "is-invalid" : "" ?>" name="password" id="password" placeholder="Masukkan Password">
                        <div class="invalid-feedback" role="alert">
                            <?= $validation->getError("password") ?>
                        </div>
                    </div>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">Login</button>
                    </div>
                    <div class="my-2 d-flex justify-content-between align-items-center">
                        <div class="form-check">
                            <label class="form-check-label text-muted">
                                <input type="checkbox" class="form-check-input">
                                Ingat Saya
                            </label>
                        </div>
                        <a href="#" class="auth-link text-black">Lupa Password?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>