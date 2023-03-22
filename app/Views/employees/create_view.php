<?= $this->extend("layouts/main_layout"); ?>

<?= $this->section("content"); ?>
<div class="content-wrapper">
  <div class="card">
    <div class="card-body">
      <div class="container">
        <form class="forms-sample" action="<?= base_url("data-karyawan/simpan"); ?>" method="POST">
          <?= csrf_field(); ?>
          <div class="form-group">
            <label for="position_id">Jabatan</label>
            <select name="position_id" id="position_id" class="form-control <?= ($validation->hasError("position_id")) ? "is-invalid" : ""; ?>">
              <option value="" disabled selected>Pilih</option>
              <?php foreach ($positions as $position) : ?>
                <option value="<?= $position["id"] ?>"><?= $position["name"] ?></option>
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
              <option value="contract">Karyawan Tetap</option>
              <option value="temporary">Karyawan Tidak Tetap</option>
            </select>
            <div class="invalid-feedback" role="alert">
              <?= $validation->getError("type") ?>
            </div>
          </div>
          <div class="form-group">
            <label for="nik">NIK</label>
            <input type="text" class="form-control <?= ($validation->hasError("nik")) ? "is-invalid" : ""; ?>" id="nik" name="nik" placeholder="Masukkan Nomor Induk Kependudukan" value="<?= old("nik") ?>">
            <div class="invalid-feedback" role="alert">
              <?= $validation->getError("nik") ?>
            </div>
          </div>

          <div class="form-group">
            <label for="full_name">Nama Karyawan</label>
            <input type="text" class="form-control <?= ($validation->hasError("full_name")) ? "is-invalid" : ""; ?>" id="full_name" name="full_name" placeholder="Nama Karyawan" value="<?= old("full_name") ?>">
            <div class="invalid-feedback" role="alert">
              <?= $validation->getError("full_name") ?>
            </div>
          </div>

          <div class="form-group" id="statusNpwp">
            <label for="npwp_status">Status NPWP</label>
            <div>
              <input type="radio" name="npwp_status" id="yes" value="yes"><label for="yes">Punya</label>
              <span class="px-1"></span>
              <input type="radio" name="npwp_status" id="no" value="no"><label for="no">Tidak Punya</label>
            </div>
            <div class="text-danger text-small">
              <?= $validation->getError("npwp_status") ?>
            </div>
          </div>

          <div class="form-group" id="npwp">
            <label for="npwp">Nomor NPWP</label>
            <input type="number" class="form-control <?= ($validation->hasError("npwp")) ? "is-invalid" : ""; ?>" id="npwp" name="npwp" placeholder="NPWP" value="<?= old("npwp") ?>">
            <div class="invalid-feedback" role="alert">
              <?= $validation->getError("npwp") ?>
            </div>
          </div>

          <div class="form-group">
            <label for="ptkp">PTKP</label>
            <select name="ptkp" id="ptkp" class="form-control <?= ($validation->hasError("ptkp")) ? "is-invalid" : "" ?>">
              <option value="" disabled selected>Pilih Status PTKP</option>
              <option value="TK/0">TK/0</option>
              <option value="TK/1">TK/1</option>
              <option value="TK/2">TK/2</option>
              <option value="TK/3">TK/3</option>
              <option value="K/0">K/0</option>
              <option value="K/1">K/1</option>
              <option value="K/2">K/2</option>
              <option value="K/3">K/3</option>
            </select>
            <div class="invalid-feedback" role="alert">
              <?= $validation->getError("ptkp") ?>
            </div>
          </div>

          <div class="form-group">
            <label for="gender">Jenis Kelamin</label>
            <div>
              <input type="radio" name="gender" id="male" value="male"><label for="male">Laki-laki</label>
              <span class="px-1"></span>
              <input type="radio" name="gender" id="female" value="female"><label for="female">Perempuan</label>
            </div>
            <div class="text-danger text-small">
              <?= $validation->getError("gender") ?>
            </div>
          </div>

          <div class="form-group">
            <label for="address">Alamat</label>
            <input type="text" class="form-control <?= ($validation->hasError("address")) ? "is-invalid" : ""; ?>" id="address" name="address" placeholder="Alamat" value="<?= old("address") ?>">
            <div class="invalid-feedback" role="alert">
              <?= $validation->getError("address") ?>
            </div>
          </div>

          <div class="form-group">
            <label for="start_working_at">Tanggal Mulai Bekerja</label>
            <input type="date" class="form-control" id="start_working_at" name="start_working_at" value="<?= old("start_working_at") ?>">
          </div>

          <div class="form-group">
            <label for="status">Status Karyawan</label>
            <div>
              <input type="radio" name="status" id="active" value="active"><label for="active">Aktif</label>
              <span class="px-1"></span>
              <input type="radio" name="status" id="inactive" value="inactive"><label for="inactive">Tidak Aktif</label>
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