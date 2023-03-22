<?= $this->extend("layouts/main_layout"); ?>

<?= $this->section("content"); ?>
<div class="content-wrapper">
    <div class="card">
        <div class="card-body">
            <div class="container">
                <form class="forms-sample" action="<?= base_url("data-pembayaran-beban/simpan"); ?>" method="POST">
                    <?= csrf_field(); ?>
                    <div class="form-group">
                        <label for="trx_date">Tanggal</label>
                        <input type="date" class="form-control <?= ($validation->hasError("trx_date")) ? "is-invalid" : ""; ?>" id="trx_date" name="trx_date" placeholder="Tanggal" value="">
                        <div class="invalid-feedback" role="alert">
                            <?= $validation->getError("trx_date") ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="trx_code">kode_transaksi Transaksi</label>
                        <input type="text" class="form-control <?= ($validation->hasError("trx_code")) ? "is-invalid" : ""; ?>" id="trx_code" name="trx_code" placeholder="kode_transaksi Kategori" value="<?= $load_payment_code ?>" readonly>
                        <div class="invalid-feedback" role="alert">
                            <?= $validation->getError("trx_code") ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="load_category_id">Pilih Kategori Beban</label>
                        <select name="load_category_id" id="load_category_id" class="form-control <?= ($validation->hasError("load_category_id")) ? "is-invalid" : ""; ?>">
                            <option disabled selected>Pilih</option>
                            <?php foreach ($load_categories as $load_category) : ?>
                                <option value="<?= $load_category["id"] ?>"><?= $load_category["category_name"] ?> | <?= $load_category["category_code"] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="total_payment">Nomimal Pembayaran</label>
                        <input type="number" class="form-control <?= ($validation->hasError("total_payment")) ? "is-invalid" : ""; ?>" id="total_payment" name="total_payment" placeholder="Total Pembayaran Beban" value="<?= old("total_payment") ?>">
                        <div class="invalid-feedback" role="alert">
                            <?= $validation->getError("total_payment") ?>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary me-2">Simpan Data</button>
                    <a href="<?= base_url("data-pembayaran-beban") ?>" class="btn btn-light">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section("script"); ?>
<script>
    $(document).ready(function() {
        $("#trx_date").val(new Date().toISOString().substr(0, 10));
    });
</script>
<?php $this->endSection(); ?>