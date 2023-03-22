<?= $this->extend("layouts/main_layout"); ?>

<?= $this->section("content"); ?>
<div class="content-wrapper">
    <div class="card">
        <div class="card-body">
            <div class="container">
                <form class="forms-sample" action="<?= base_url("data-karyawan/update/" . $employee["id"]); ?>" method="POST">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="_method" value="PUT">
                    <div class="form-group">
                        <label for="position_id">Jabatan</label>
                        <select name="position_id" id="position_id" class="form-control <?= ($validation->hasError("position_id")) ? "is-invalid" : ""; ?>">
                            <option value="" disabled selected>Pilih</option>
                            <?php foreach ($positions as $position) : ?>
                                <option value="<?= $position["id"] ?>" <?= $position["id"] == $employee["id"] ? "selected" : "" ?>><?= $position["name"] ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback" role="alert">
                            <?= $validation->getError("position_id") ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="type">Jenis Karyawan</label>
                        <select name="type" id="type" class="form-control <?= ($validation->hasError("type")) ? "is-invalid" : ""; ?>">
                            <option value="" disabled selected>Pilih</option>
                            <option value="contract" <?= $employee["type"] == "contract" ? "selected" : "" ?>>Karyawan Tetap</option>
                            <option value="temporary" <?= $employee["type"] == "temporary" ? "selected"  : "" ?>>Karyawan Tidak Tetap</option>
                        </select>
                        <div class="invalid-feedback" role="alert">
                            <?= $validation->getError("type") ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nik">NIK</label>
                        <input type="text" class="form-control <?= ($validation->hasError("nik")) ? "is-invalid" : ""; ?>" id="nik" name="nik" placeholder="Masukkan Nomor Induk Kependudukan" value="<?= (old("nik")) ? old("nik") : $employee["nik"] ?>">
                        <div class="invalid-feedback" role="alert">
                            <?= $validation->getError("nik") ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="full_name">Nama Karyawan</label>
                        <input type="text" class="form-control <?= ($validation->hasError("full_name")) ? "is-invalid" : ""; ?>" id="full_name" name="full_name" placeholder="Nama Karyawan" value="<?= (old("full_name")) ? old("full_name") : $employee["full_name"] ?>">
                        <div class="invalid-feedback" role="alert">
                            <?= $validation->getError("full_name") ?>
                        </div>
                    </div>

                    <div class="form-group" id="statusNpwp">
                        <label for="npwp_status">Status NPWP</label>
                        <div>
                            <input type="radio" name="npwp_status" id="yes" value="yes" <?= $employee["npwp_status"] == "yes" ? "checked" : "" ?>><label for="yes">Punya</label>
                            <span class="px-1"></span>
                            <input type="radio" name="npwp_status" id="no" value="no" <?= $employee["npwp_status"] == "no" ? "checked" : "" ?>><label for="no">Tidak Punya</label>
                        </div>
                        <div class="text-danger text-small">
                            <?= $validation->getError("npwp_status") ?>
                        </div>
                    </div>

                    <div class="form-group" id="npwp">
                        <label for="npwp">Nomor NPWP</label>
                        <input type="number" class="form-control <?= ($validation->hasError("npwp")) ? "is-invalid" : ""; ?>" id="npwp" name="npwp" placeholder="NPWP" value="<?= (old("npwp")) ? old("npwp") : $employee["npwp"] ?>">
                        <div class="invalid-feedback" role="alert">
                            <?= $validation->getError("npwp") ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="ptkp">PTKP</label>
                        <select name="ptkp" id="ptkp" class="form-control <?= ($validation->hasError("ptkp")) ? "is-invalid" : "" ?>">
                            <option value="" disabled selected>Pilih Status PTKP</option>
                            <option value="TK/0" <?= $employee["ptkp"] == "TK/0" ? "selected" : "" ?>>TK/0</option>
                            <option value="TK/1" <?= $employee["ptkp"] == "TK/1" ? "selected" : "" ?>>TK/1</option>
                            <option value="TK/2" <?= $employee["ptkp"] == "TK/2" ? "selected" : "" ?>>TK/2</option>
                            <option value="TK/3" <?= $employee["ptkp"] == "TK/3" ? "selected" : "" ?>>TK/3</option>
                            <option value="K/0" <?= $employee["ptkp"] == "K/0" ? "selected" : "" ?>>K/0</option>
                            <option value="K/1" <?= $employee["ptkp"] == "K/1" ? "selected" : "" ?>>K/1</option>
                            <option value="K/2" <?= $employee["ptkp"] == "K/2" ? "selected" : "" ?>>K/2</option>
                            <option value="K/3" <?= $employee["ptkp"] == "K/3" ? "selected" : "" ?>>K/3</option>
                        </select>
                        <div class="invalid-feedback" role="alert">
                            <?= $validation->getError("ptkp") ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="gender">Jenis Kelamin</label>
                        <div>
                            <input type="radio" name="gender" id="male" value="male" <?= $employee["gender"] == "male" ? "checked" : "" ?>><label for="male">Laki-laki</label>
                            <span class="px-1"></span>
                            <input type="radio" name="gender" id="female" value="female" <?= $employee["gender"] == "female" ? "checked" : "" ?>><label for="female">Perempuan</label>
                        </div>
                        <div class="text-danger text-small">
                            <?= $validation->getError("gender") ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="address">Alamat</label>
                        <input type="text" class="form-control <?= ($validation->hasError("address")) ? "is-invalid" : ""; ?>" id="address" name="address" placeholder="Alamat" value="<?= (old("address")) ? old("address") : $employee["address"] ?>">
                        <div class="invalid-feedback" role="alert">
                            <?= $validation->getError("address") ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="start_working_at">Tanggal Mulai Bekerja</label>
                        <input type="date" class="form-control" id="start_working_at" name="start_working_at" value="<?= $employee["start_working_at"] ?>">
                    </div>

                    <div class="form-group">
                        <label for="status">Status Karyawan</label>
                        <div>
                            <input type="radio" name="status" id="active" value="active" <?= $employee["status"] == "active" ? "checked" : "" ?>><label for="active">Aktif</label>
                            <span class="px-1"></span>
                            <input type="radio" name="status" id="inactive" value="inactive" <?= $employee["status"] == "inactive" ? "checked" : "" ?>><label for="inactive">Tidak Aktif</label>
                        </div>
                        <div class="text-danger text-small">
                            <?= $validation->getError("status") ?>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary me-2">Simpan Data</button>
                    <a href="<?= base_url("data-karyawan") ?>" class="btn btn-light">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section("script"); ?>

<script>
    // show status npwp and npwp number if employee type is contract
    $("#type").change(function() {
        if ($(this).val() == "contract") {
            $("#statusNpwp").show();
            $("#npwp").show();
        } else {
            $("#statusNpwp").hide();
            $("#npwp").hide();
        }
    });

    // hide npwp field when status npwp checked "Tidak Punya"

    $("#no").click(function() {
        $("#npwp").hide();
    });
    // show npwp field when status npwp checked "Punya"
    $("#yes").click(function() {
        $("#npwp").show();
    });
</script>

<?= $this->endSection(); ?>