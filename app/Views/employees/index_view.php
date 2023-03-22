<?= $this->extend("layouts/main_layout"); ?>
<?= $this->section("content"); ?>
<div class="content-wrapper">
    <div class="card">
        <div class="card-body">
            <a href="<?= base_url("/data-karyawan/tambah"); ?>" class="btn btn-primary btn-rounded align-self-center mb-4">Tambah Data Jabatan</a>
            <div class="table-responsive">

                <?php if (session()->getFlashdata("success")) : ?>
                    <div class="alert alert-success">
                        <?= session()->getFlashdata("success"); ?>
                    </div>
                <?php endif; ?>

                <table id="datatables" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>Jabatan</th>
                            <th>Jenis</th>
                            <th>NIK</th>
                            <th>Nama Lengkap</th>
                            <th>Jenis Kelamin</th>
                            <th>Alamat</th>
                            <th>Tanggal Mulai Bekerja</th>
                            <th>Status NPWP</th>
                            <th>NPWP</th>
                            <th>PTKP</th>
                            <th>Status Karyawan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($employees as $employee) : ?>
                            <tr>
                                <td><?= $employee["position_name"]; ?></td>
                                <td>
                                    <?php if ($employee["type"] == "contract") : ?>
                                        Pegawai Tetap
                                    <?php else : ?>
                                        Pegawai Tidak Tetap
                                    <?php endif; ?>
                                </td>
                                <td><?= $employee["nik"]; ?></td>
                                <td><?= $employee["full_name"]; ?></td>
                                <td>
                                    <?php if ($employee["gender"] == "male") : ?>
                                        Laki-laki
                                    <?php else : ?>
                                        Perempuan
                                    <?php endif; ?>
                                </td>
                                <td><?= $employee["address"] ?></td>
                                <td><?= $employee["start_working_at"] ?></td>
                                <td>
                                    <?php if ($employee["npwp_status"] == "no") : ?>
                                        Tidak Punya
                                    <?php else : ?>
                                        Punya
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if (!$employee["npwp"]) : ?>
                                        -
                                    <?php else : ?>
                                        <?= $employee["npwp"] ?>
                                    <?php endif; ?>
                                </td>
                                <td><?= $employee["ptkp"] ?></td>
                                <td>
                                    <?php if ($employee["status"] == "active") : ?>
                                        <span class="badge badge-success">Aktif</span>
                                    <?php else : ?>
                                        <span class="badge badge-danger">Nonaktif</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="<?= base_url("/data-karyawan/edit/" . $employee["id"]) ?>" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="<?= base_url("/data-karyawan/hapus/" . $employee["id"]); ?>" method="POST" onsubmit="return confirm('Hapus data karyawan ini dari sistem?')" class="d-inline">
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