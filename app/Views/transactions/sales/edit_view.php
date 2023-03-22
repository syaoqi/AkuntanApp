<?= $this->extend("layouts/main_layout"); ?>

<?= $this->section("content"); ?>
<div class="content-wrapper">
    <div class="card">
        <div class="card-body">
            <div class="container">
                <form class="forms-sample" action="<?= base_url("data-penjualan/update/" . $sale_transaction["id"]); ?>" method="POST">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="_method" value="PUT">
                    <div class="form-group">
                        <label for="trx_code">Kode Transaksi</label>
                        <input type="text" class="form-control <?= ($validation->hasError("trx_code")) ? "is-invalid" : ""; ?>" id="trx_code" name="trx_code" placeholder="Kode Transaksi" value="<?= $sale_transaction["trx_code"] ?>" readonly>
                        <div class="invalid-feedback" role="alert">
                            <?= $validation->getError("trx_code") ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="trx_date">Tanggal Transaksi</label>
                        <input type="date" class="form-control <?= ($validation->hasError("trx_date")) ? "is-invalid" : ""; ?>" id="trx_date" name="trx_date" placeholder="Tanggal Transaksi" value="<?= $sale_transaction["trx_date"] ?>">
                        <div class="invalid-feedback" role="alert">
                            <?= $validation->getError("trx_date") ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="customer_id">Pilih Customer</label>
                        <select name="customer_id" id="customer_id" class="form-control <?= ($validation->hasError("customer_id")) ? "is-invalid" : ""; ?>">
                            <option value="" disabled selected>Pilih</option>
                            <?php foreach ($customers as $customer) : ?>
                                <!-- selected customer if customer id same with customer -->
                                <option value="<?= $customer["id"]; ?>" <?= ($customer["id"] == $sale_transaction["customer_id"]) ? "selected" : ""; ?>><?= $customer["name"]; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback" role="alert">
                            <?= $validation->getError("customer_id") ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="sparepart_id">Pilih Sparepart</label>
                        <select name="sparepart_id" id="sparepart_id" class="form-control <?= ($validation->hasError("sparepart_id")) ? "is-invalid" : ""; ?>">
                            <option value="" disabled selected>Pilih</option>
                            <?php foreach ($spareparts as $sparepart) : ?>
                                <!-- select sparepart if sparepart id same with sparepart -->
                                <option value="<?= $sparepart["id"]; ?>" <?= ($sparepart["id"] == $sale_transaction["sparepart_id"]) ? "selected" : ""; ?>><?= $sparepart["name"]; ?></option>
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
                        <label for="quantity">Jumlah Jual</label>
                        <input type="number" class="form-control <?= ($validation->hasError("quantity")) ? "is-invalid" : ""; ?>" id="quantity" name="quantity" placeholder="Nama Supplier" value="<?= $sale_transaction["quantity"] ?>">
                        <div class="invalid-feedback" role="alert">
                            <?= $validation->getError("quantity") ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="total_amount">Jumlah Pembayaran</label>
                        <input type="number" class="form-control <?= ($validation->hasError("total_amount")) ? "is-invalid" : ""; ?>" id="total_amount" name="total_amount" placeholder="Nama Supplier" value="<?= $sale_transaction["total_amount"] ?>" readonly>
                        <div class="invalid-feedback" role="alert">
                            <?= $validation->getError("total_amount") ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="courier_id">Pilih Kurir</label>
                        <select name="courier_id" id="courier_id" class="form-control <?= ($validation->hasError("courier_id")) ? "is-invalid" : ""; ?>">
                            <option value="" disabled selected>Pilih</option>
                            <?php foreach ($couriers as $courier) : ?>
                                <!-- select courier if coureir id same with courier -->
                                <option value="<?= $courier["id"]; ?>" <?= ($courier["id"] == $sale_transaction["courier_id"]) ? "selected" : ""; ?>><?= $courier["name"]; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback" role="alert">
                            <?= $validation->getError("courier_id") ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="note">Catatan</label>
                        <input type="text" class="form-control" id="note" name="note" placeholder="Nama Supplier" value="<?= $sale_transaction["note"] ?>">
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
        // get selling_price when select spareparts
        $("#sparepart_id").click(function() {
            let idSparepart = $(this).val();
            $.ajax({
                type: "GET",
                url: "<?= base_url("sparepart/getdetail"); ?>" + "/" + idSparepart,
                success: function(response) {
                    let data = JSON.parse(response);
                    console.log(data);
                    $("#sparepart_price").val(data.selling_price);
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
        // check if quantity is greater than ready_stock show alert
        $("#quantity").keyup(function() {
            let quantity = $(this).val();
            let readyStock = $("#ready_stock").val();
            if (quantity > readyStock) {
                alert("Jumlah beli melebihi stok tersedia");
                $("#quantity").val(readyStock);
            }
        });
    });
</script>
<?= $this->endSection(); ?>