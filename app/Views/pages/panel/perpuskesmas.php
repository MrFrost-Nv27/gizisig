<?php
/** @var \CodeIgniter\View\View $this */
?>

<?=$this->extend('layouts/panel/main')?>
<?=$this->section('main')?>



<div class="container-xl">
    <div class="row g-3 mb-4 align-items-center justify-content-between">
        <div class="col-auto">
            <h1 class="app-page-title mb-0">Ringkasan Data Pasien Perpuskesmas</h1>
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

<div class="row g-4 mb-4 perpuskesmas-wrapper">
</div>

<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script src="<?= base_url('js/pages/panel/perpuskesmas.js') ?>",></script>
<?= $this->endSection() ?>