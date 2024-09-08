<?php
/** @var \CodeIgniter\View\View $this */
?>

<?=$this->extend('layouts/panel/main')?>
<?=$this->section('main')?>
<h1 class="app-page-title">Dashboard</h1>
<div class="row g-4 mb-4">
    <div class="col-6 col-lg-3">
        <div class="app-card app-card-stat shadow-sm h-100">
            <div class="app-card-body p-3 p-lg-4">
                <h4 class="stats-type mb-1">Total Puskesmas</h4>
                <div class="stats-figure" id="count-puskesmas">0</div>

            </div>
            <a class="app-card-link-mask" href="#"></a>
        </div>
    </div>

    <div class="col-6 col-lg-3">
        <div class="app-card app-card-stat shadow-sm h-100">
            <div class="app-card-body p-3 p-lg-4">
                <h4 class="stats-type mb-1">Total Pasien</h4>
                <div class="stats-figure" id="count-pasien">0</div>
            </div>
            <a class="app-card-link-mask" href="#"></a>
        </div>
    </div>
</div>

<div class="row g-4 mb-4">
    <div class="col-12 col-md-12 text-center">
        <div id="map" style="height: 400px;"></div>
    </div>
</div>


<!-- Tambahkan modul/modal Bootstrap -->
<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalLabel">Detail</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p id="detailContent"></p>
            </div>
        </div>
    </div>
</div>
<?=$this->endSection()?>

<?=$this->section('script')?>
<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalLabel">Detail</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p id="detailContent"></p>
            </div>
        </div>
    </div>
</div>
<script src="<?=base_url('js/pages/panel/dashboard.js')?>"></script>
<?=$this->endSection()?>