<?= $this->extend("layouts/main_layout"); ?>

<?= $this->section("content"); ?>
<div class="content-wrapper">
    <div class="card">
        <div class="card-body">
            <a href="<?= base_url("/data-jabatan/tambah"); ?>" class="btn btn-primary btn-rounded align-self-center mb-4">Tambah Data Jabatan</a>
            <div class="table-responsive">

                <?php if (session()->getFlashdata("success")) : ?>
                    <div class="alert alert-success">
                        <?= session()->getFlashdata("success"); ?>
                    </div>
                <?php endif; ?>

                <table id="datatables" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>Nama Jabatan</th>
                            <th>Gaji Pokok</th>
                            <th>Tunjangan Transport</th>
                            <th>Uang Makan</th>
                            <th>Total Gaji</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($positions as $position) : ?>
                            <tr>
                                <td><?= $position["name"]; ?></td>
                                <td>Rp. <?= number_format($position["basic_salary"]); ?></td>
                                <td>Rp. <?= number_format($position["transport_allowance"]); ?></td>
                                <td>Rp. <?= number_format($position["meal_allowance"]); ?></td>
                                <td>Rp. <?= number_format($position["total_salary"]) ?></td>
                                <td>
                                    <a href="<?= base_url("/data-jabatan/edit/" . $position["id"]) ?>" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="<?= base_url("/data-jabatan/hapus/" . $position["id"]); ?>" method="POST" onsubmit="return confirm('Hapus data jabatan ini dari sistem?')" class="d-inline">
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