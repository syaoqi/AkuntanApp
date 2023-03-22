<?= $this->extend("layouts/main_layout"); ?>

<?= $this->section("content"); ?>
<div class="content-wrapper">
    <div class="card">
        <div class="card-body">
            <a href="<?= base_url("/data-akun-tanggungan/tambah"); ?>" class="btn btn-primary btn-rounded align-self-center mb-4">Tambah Data Akun Tanggungan</a>
            <div class="table-responsive">

                <?php if (session()->getFlashdata("success")) : ?>
                    <div class="alert alert-success">
                        <?= session()->getFlashdata("success"); ?>
                    </div>
                <?php endif; ?>

                <table id="datatables" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>Kode Akun</th>
                            <th>Nama Akun</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($coa_dependents as $coa_dependent) : ?>
                            <tr>
                                <td><?= $coa_dependent["coa_code"]; ?></td>
                                <td><?= $coa_dependent["coa_name"]; ?></td>
                                <td>
                                    <a href="<?= base_url("/data-akun-tanggungan/edit/" . $coa_dependent["id"]) ?>" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="<?= base_url("/data-akun-tanggungan/hapus/" . $coa_dependent["id"]); ?>" method="POST" onsubmit="return confirm('Hapus data akun tanggungan ini dari sistem?')" class="d-inline">
                                        <?= csrf_field(); ?>
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>