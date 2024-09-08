<?php
/** @var \CodeIgniter\View\View $this */
?>

<?=$this->extend('layouts/panel/main')?>
<?=$this->section('main')?>



<div class="container-xl">
    <div class="row g-3 mb-4 align-items-center justify-content-between">
        <div class="col-auto">
            <h1 class="app-page-title mb-0">Tambah Data Puskesmas</h1>
        </div>
        <div class="col-auto">
            <div class="page-utilities">
                <div class="row g-2 justify-content-start justify-content-md-end align-items-center">

                </div>
            </div>
            <!--//row-->
        </div>
        <!--//table-utilities-->
    </div>
    <!--//col-auto-->
</div>
<!--//row-->

<div class="row g-4 settings-section">
    <div class="col-12 col-md-4 text-center">
        <div id="map" style="height: 400px;"></div>
        <button class="btn app-btn-secondary" onclick="getCurrentLocation()">Gunakan Lokasi Saat Ini</button>
    </div>

    <div class="col-12 col-md-4">
        <div class="app-card app-card-settings shadow-sm p-4">
            <div class="app-card-body">
                <form action="<?= base_url('api/puskesmas/' . $item->id) ?>" method="put">
                    <?= csrf_field() ?>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Puskesmas</label>
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Puskesmas"
                            value="<?= $item->nama ?>" required>
                        <div class="error-message"></div>
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea class="form-control" id="alamat" name="alamat" rows="3" placeholder="Alamat"
                            required><?= $item->alamat ?></textarea>
                        <div class="error-message"></div>
                    </div>
                    <div class="mb-3">
                        <label for="latitude" class="form-label">Latitude</label>
                        <input type="text" class="form-control" id="latitude" name="latitude" placeholder="Latitude"
                            value="<?= $item->latitude ?>" required>
                        <div class="error-message"></div>
                    </div>
                    <div class="mb-3">
                        <label for="longitude" class="form-label">Longitude</label>
                        <input type="text" class="form-control" id="longitude" name="longitude" placeholder="Longitude"
                            value="<?= $item->longitude ?>" required>
                        <div class="error-message"></div>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn app-btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
            <!--//app-card-body-->
        </div>
    </div>

</div>




<?= $this->endSection() ?>



<?= $this->section('script') ?>
<script src="<?= base_url('js/pages/panel/puskesmas.js') ?>"></></script>
<?= $this->endSection() ?>