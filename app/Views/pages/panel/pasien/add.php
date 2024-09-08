<?php
/** @var \CodeIgniter\View\View $this */
?>

<?=$this->extend('layouts/panel/main')?>
<?=$this->section('main')?>


<div class="container-xl">
    <div class="row g-3 mb-4 align-items-center justify-content-between">
        <div class="col-auto">
            <h1 class="app-page-title mb-0">Tambah Data Pasien</h1>
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
    <div class="col-12 col-md-8">
        <div class="app-card app-card-settings shadow-sm p-4">
            <div class="app-card-body">
                <form action="<?= base_url('api/pasien') ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Pasien" required>
                        <div class="error-message"></div>
                    </div>
                    <div class="mb-3">
                        <label for="nik" class="form-label">NIK</label>
                        <input type="text" class="form-control" id="nik" name="nik" placeholder="Nik Pasien" required>
                        <div class="error-message"></div>
                    </div>
                    <div class="mb-3">
                        <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                        <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" placeholder="Tempat Lahir" required>
                        <div class="error-message"></div>
                    </div>

                    <div class="mb-3">
                        <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                        <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" placeholder="Tanggal Lahir" required>
                        <div class="error-message"></div>
                    </div>

                    <!-- jenis kelamin using option -->
                    <div class="mb-3">
                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                        <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="1">Laki - Laki</option>
                            <option value="0">Perempuan</option>
                        </select>
                        <div class="error-message"></div>
                    </div>

                    <div class="mb-3">
                        <label for="ortu" class="form-label">Nama Wali/Ortu</label>
                        <input type="text" class="form-control" id="ortu" name="ortu" placeholder="Nama Wali/Ortu" required>
                        <div class="error-message"></div>
                    </div>


                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea class="form-control" id="alamat" name="alamat" rows="3" placeholder="Alamat" required></textarea>
                        <div class="error-message"></div>
                    </div>
                    <div class="mb-3">
                        <label for="latitude" class="form-label">Latitude</label>
                        <input type="text" class="form-control" id="latitude" name="latitude" placeholder="Latitude" required>
                        <div class="error-message"></div>
                    </div>
                    <div class="mb-3">
                        <label for="longitude" class="form-label">Longitude</label>
                        <input type="text" class="form-control" id="longitude" name="longitude" placeholder="Longitude" required>
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

    <div class="col-12 col-md-4 text-center">
        <h3 class="section-title">Lokasi Pasien</h3>
        <div id="map" style="height: 400px;"></div>
        <button class="btn app-btn-secondary" onclick="getCurrentLocation()">Gunakan Lokasi Saat Ini</button>
    </div>

</div>




<?= $this->endSection() ?>