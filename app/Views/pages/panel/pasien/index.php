<?php
/** @var \CodeIgniter\View\View $this */
?>

<?=$this->extend('layouts/panel/main')?>
<?=$this->section('main')?>


<div class="container-xl">
    <div class="row g-3 mb-4 align-items-center justify-content-between">
        <div class="col-auto">
            <h1 class="app-page-title mb-0">Master Data Pasien</h1>
        </div>
        <div class="col-auto">
            <div class="page-utilities">
                <div class="row g-2 justify-content-start justify-content-md-end align-items-center">

                </div>
                <div class="col-auto">
                    <a class="btn app-btn-primary" href="<?= route_to('pasien-add') ?>">
                        <i class="fas fa-plus"></i>Tambah Data</a>
                </div>
            </div>
            <!--//row-->
        </div>
        <!--//table-utilities-->
    </div>
    <!--//col-auto-->
</div>
<!--//row-->


<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped datatable-init" width="100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Usia</th>
                        <th>Berat Badan</th>
                        <th>Tinggi Badan</th>
                        <th>Jenis Kelamin</th>
                        <th>Alamat</th>
                        <th>Status Gizi</th>
                        <!-- <th>Latitude</th>
                        <th>Longitude</th> -->
                        <th>Aksi</th>

                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($items as $key => $item) : ?>
                    <tr>
                        <td><?= $key + 1 ?></td>
                        <td><?= $item->nama ?></td>
                        <td><?= $item->usia ?></td>
                        <td><?= $item->bb ?></td>
                        <td><?= $item->tb ?></td>
                        <td><?= $item->jenis_kelamin == "L" ? "Laki-laki" : "Perempuan" ?></td>
                        <td><?= $item->alamat ?></td>
                        <td><?= $item->bb_tb ?></td>
                        <!-- <td><?= $item->latitude ?></td>
                            <td><?= $item->longitude ?></td> -->
                        <td>
                            <a href="<?= route_to('pasien-edit', $item->id) ?>" class="btn app-btn-primary"><i
                                    class="fas fa-edit"></i></a>
                            <a href="<?= base_url('api/pasien/' . $item->id) ?>"
                                class="btn app-btn-secondary btn-delete"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
<!--//tab-content-->
<?= $this->endSection() ?>