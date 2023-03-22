<?= $this->extend("layouts/main_layout"); ?>

<?= $this->section("content"); ?>
<div class="content-wrapper">
    <div class="card">
        <div class="card-body">
            <a href="<?= base_url("/data-kurir/tambah"); ?>" class="btn btn-primary btn-rounded align-self-center mb-4">Tambah Data Kurir</a>
            <div class="table-responsive">

                <?php if (session()->getFlashdata("success")) : ?>
                    <div class="alert alert-success">
                        <?= session()->getFlashdata("success"); ?>
                    </div>
                <?php endif; ?>

                <table id="datatables" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Nomor Ponsel</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($couriers as $courier) : ?>
                            <tr>
                                <td><?= $courier["name"]; ?></td>
                                <td><?= $courier["address"]; ?></td>
                                <td><?= $courier["phone"]; ?></td>
                                <td>
                                    <a href="<?= base_url("/data-kurir/edit/" . $courier["id"]) ?>" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="<?= base_url("/data-kurir/hapus/" . $courier["id"]); ?>" method="POST" onsubmit="return confirm('Hapus data kurir ini dari sistem?')" class="d-inline">
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