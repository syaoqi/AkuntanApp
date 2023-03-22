<?= $this->extend("layouts/main_layout"); ?>

<?= $this->section("content"); ?>
<div class="content-wrapper">
    <div class="card">
        <div class="card-body">
            <div class="container">
                <form class="forms-sample" action="<?= base_url("data-pembelian/simpan"); ?>" method="POST">
                    <?= csrf_field(); ?>
                    <div class="form-group">
                        <label for="trx_code">Kode Transaksi</label>
                        <input type="text" class="form-control <?= ($validation->hasError("trx_code")) ? "is-invalid" : ""; ?>" id="trx_code" name="trx_code" placeholder="Kode Transaksi" value="<?= $trx_code ?>" readonly>
                        <div class="invalid-feedback" role="alert">
                            <?= $validation->getError("trx_code") ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="trx_date">Tanggal Transaksi</label>
                        <input type="date" class="form-control <?= ($validation->hasError("trx_date")) ? "is-invalid" : ""; ?>" id="trx_date" name="trx_date" placeholder="Tanggal Transaksi" value="">
                        <div class="invalid-feedback" role="alert">
                            <?= $validation->getError("trx_date") ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="supplier_id">Pilih Supplier</label>
                        <select name="supplier_id" id="supplier_id" class="form-control <?= ($validation->hasError("supplier_id")) ? "is-invalid" : ""; ?>">
                            <option value="" disabled selected>Pilih</option>
                            <?php foreach ($suppliers as $suplier) : ?>
                                <option value="<?= $suplier["id"] ?>"><?= $suplier["name"] ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback" role="alert">
                            <?= $validation->getError("supplier_id") ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="sparepart_id">Pilih Sparepart</label>
                        <select name="sparepart_id" id="sparepart_id" class="form-control <?= ($validation->hasError("sparepart_id")) ? "is-invalid" : ""; ?>">
                            <option value="" disabled selected>Pilih</option>
                            <?php foreach ($spareparts as $sparepart) : ?>
                                <option value="<?= $sparepart["id"] ?>"><?= $sparepart["name"] ?> | Rp. <?= number_format($sparepart["selling_price"]) ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback" role="alert">
                            <?= $validation->getError("sparepart_id") ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="sparepart_price">Harga Sparepart</label>
                        <input type="number" class="form-control" id="sparepart_price" name="sparepart_price" placeholder="Harga Sparepart" value="<?= old("sparepart_price") ?>" readonly>
                    </div>

                    <div class="form-group">
                        <label for="ready_stock">Stok Tersedia</label>
                        <input type="number" class="form-control <?= ($validation->hasError("ready_stock")) ? "is-invalid" : ""; ?>" id="ready_stock" name="ready_stock" placeholder="Stok Tersedia" value="<?= old("ready_stock") ?>" readonly>
                        <div class="invalid-feedback" role="alert">
                            <?= $validation->getError("ready_stock") ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="quantity">Jumlah Beli</label>
                        <input type="number" class="form-control <?= ($validation->hasError("quantity")) ? "is-invalid" : ""; ?>" id="quantity" name="quantity" placeholder="Nama Supplier" value="<?= old("quantity") ?>">
                        <div class="invalid-feedback" role="alert">
                            <?= $validation->getError("quantity") ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="total_amount">Jumlah Pembayaran</label>
                        <input type="number" class="form-control <?= ($validation->hasError("total_amount")) ? "is-invalid" : ""; ?>" id="total_amount" name="total_amount" placeholder="Nama Supplier" value="<?= old("total_amount") ?>" readonly>
                        <div class="invalid-feedback" role="alert">
                            <?= $validation->getError("total_amount") ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="courier_id">Pilih Kurir</label>
                        <select name="courier_id" id="courier_id" class="form-control <?= ($validation->hasError("courier_id")) ? "is-invalid" : ""; ?>">
                            <option value="" disabled selected>Pilih</option>
                            <?php foreach ($couriers as $courier) : ?>
                                <option value="<?= $courier["id"] ?>"><?= $courier["name"] ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback" role="alert">
                            <?= $validation->getError("courier_id") ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="note">Catatan</label>
                        <input type="text" class="form-control" id="note" name="note" placeholder="Catatan" value="<?= old("note") ?>">
                    </div>

                    <button type="submit" class="btn btn-primary me-2">Simpan Data</button>
                    <a href="<?= base_url("data-supplier") ?>" class="btn btn-light">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section("script"); ?>
<script>
    $(document).ready(function() {
        // set value trx_date to today as default value
        $("#trx_date").val(new Date().toISOString().substr(0, 10));
        // get selling_price when select spareparts
        $("#sparepart_id").change(function() {
            let idSparepart = $(this).val();
            $.ajax({
                type: "GET",
                url: "<?= base_url("sparepart/getdetail"); ?>" + "/" + idSparepart,
                success: function(response) {
                    let data = JSON.parse(response);
                    console.log(data);
                    $("#sparepart_price").val(data.initial_price);
                    $("#ready_stock").val(data.stock);
                }
            });
        });
        // calculate total_amount when change quantity based from sparepart_price
        $("#quantity").keyup(function() {
            let quantity = $(this).val();
            let sparepartPrice = $("#sparepart_price").val();
            let totalAmount = quantity * sparepartPrice;
            $("#total_amount").val(totalAmount);
        });
    });
</script>
<?= $this->endSection(); ?>