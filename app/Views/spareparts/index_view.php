<?= $this->extend("layouts/main_layout"); ?>

<?= $this->section("content"); ?>
<div class="content-wrapper">
    <div class="card">
        <div class="card-body">
            <a href="<?= base_url("/data-sparepart/tambah"); ?>" class="btn btn-primary btn-rounded align-self-center mb-4">Tambah Data Onderdil</a>
            <div class="table-responsive">

                <?php if (session()->getFlashdata("success")) : ?>
                    <div class="alert alert-success">
                        <?= session()->getFlashdata("success"); ?>
                    </div>
                <?php endif; ?>

                <table id="datatables" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>Kategori</th>
                            <th>Nama</th>
                            <th>Persediaan</th>
                            <th>Harga Awal</th>
                            <th>Harga Penjualan</th>
                            <th>Gambar</th>
                            <th>Warna</th>
                            <th>Deskripsi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($spareparts as $sparepart) : ?>
                            <tr>
                                <td><?= $sparepart["categories_name"]; ?></td>
                                <td><?= $sparepart["name"]; ?></td>
                                <td><?= $sparepart["stock"]; ?></td>
                                <td><?= $sparepart["initial_price"]; ?></td>
                                <td><?= $sparepart["selling_price"]; ?></td>
                                <td> <img src="<?= base_url("uploads/spareparts/" . $sparepart["image"]); ?>" alt=""></td>
                                <td><?= $sparepart["color"]; ?></td>
                                <td><?= $sparepart["description"]; ?></td>
                                <td>
                                    <a href="<?= base_url("/data-sparepart/edit/" . $sparepart["id"]) ?>" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="<?= base_url("/data-sparepart/hapus/" . $sparepart["id"]); ?>" method="POST" onsubmit="return confirm('Hapus data onderdil ini dari sistem?')" class="d-inline">
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