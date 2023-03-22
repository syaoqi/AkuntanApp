<?= $this->extend("layouts/main_layout"); ?>

<?= $this->section("content"); ?>
<div class="content-wrapper">
    <div class="card">
        <div class="card-body">
            <a href="<?= base_url("/data-pengguna/tambah"); ?>" class="btn btn-primary btn-rounded align-self-center mb-4">Tambah Pengguna</a>
            <div class="table-responsive">

                <?php if (session()->getFlashdata("success")) : ?>
                    <div class="alert alert-success">
                        <?= session()->getFlashdata("success"); ?>
                    </div>
                <?php endif; ?>

                <table id="datatables" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>Avatar</th>
                            <th>Nama</th>
                            <th>E-mail</th>
                            <th>No. HP</th>
                            <th>Alamat</th>
                            <th>Hak Akses</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user) : ?>
                            <tr>
                                <td>
                                    <img src="<?= base_url("uploads/avatars/" . $user["avatar"]); ?>" alt="">
                                </td>
                                <td><?= $user["name"]; ?></td>
                                <td><?= $user["email"]; ?></td>
                                <td><?= $user["phone"]; ?></td>
                                <td><?= $user["address"]; ?></td>
                                <td><?= $user["role"]; ?></td>
                                <td>
                                    <a href="<?= base_url("/data-pengguna/edit/" . $user["id"]) ?>" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="<?= base_url("/data-pengguna/hapus/" . $user["id"]); ?>" method="POST" onsubmit="return confirm('Hapus pengguna ini dari sistem?')" class="d-inline">
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