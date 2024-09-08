<?php
/** @var \CodeIgniter\View\View $this */
?>

<?=$this->extend('layouts/panel/main')?>
<?=$this->section('main')?>

<div class="container-xl">
    <div class="row g-3 mb-4 align-items-center justify-content-between">
        <div class="col-auto">
            <h1 class="app-page-title mb-0">Klasterisasi Data</h1>
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

<div class="row g-4 mb-4 settings-section">
    <div class="col-12">
        <div class="app-card app-card-settings shadow-sm p-4">
            <div class="app-card-body">
                <p class="text-center">Perhitungan Jarak Antar Point</p>
                <div class="table-responsive">
                    <table id="table-jarak" class="table table-bordered">
                        <thead></thead>
                        <tbody></tbody>
                        <tfoot></tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 settings-section">
    <div class="col-12 col-md-8">
        <div class="app-card app-card-settings shadow-sm p-4">
            <div class="app-card-body">
                <form id="form-klaster" action="" method="POST">
                    <div class="mb-3">
                        <label for="epsilon" class="form-label">Nilai Epsilon</label>
                        <input type="number" class="form-control" id="epsilon" name="epsilon" placeholder="Epsilon"
                            min="1" required>
                        <div class="error-message"></div>
                    </div>
                    <div class="mb-3">
                        <label for="minpts" class="form-label">Nilai MinPts</label>
                        <input type="number" class="form-control" id="minpts" name="minpts" placeholder="Minimal Points"
                            min="1" required>
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
    <div class="col-12 col-md-4">
        <div class="app-card app-card-settings shadow-sm p-4">
            <div class="app-card-body">
                <h5>Hasil Klaster</h5>
                <div class="hasil-klaster">
                    <div class="accordion accordion-flush" id="accordionFlushExample">
                    </div>
                </div>
            </div>
            <!--//app-card-body-->
        </div>
    </div>
</div>

<template id="klaster-list">
    <div class="accordion-item">
        <h2 class="accordion-header" id="flush-h1">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-1"
                aria-expanded="false" aria-controls="flush-1">
                <img
                    src="https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-green.png">
                Klaster #1
            </button>
        </h2>
        <div id="flush-1" class="accordion-collapse collapse" aria-labelledby="flush-h1"
            data-bs-parent="#accordionFlushExample">
            <div class="accordion-body">
                <div class="list-group">
                </div>
            </div>
        </div>
    </div>
</template>

<div class="row g-4 settings-section mt-4">
    <div class="col-12">
        <div class="app-card app-card-settings shadow-sm p-4">
            <div class="app-card-body">
                <div id="klastermap" style="height: 400px;"></div>
            </div>
        </div>
    </div>
</div>

<?=$this->endSection()?>

<?=$this->section('script')?>
<script src="<?=base_url('js/pages/panel/klasterisasi.js')?>"></script>
<?=$this->endSection()?>