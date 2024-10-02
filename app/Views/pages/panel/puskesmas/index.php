<?php
/** @var \CodeIgniter\View\View $this */
?>

<?=$this->extend('layouts/panel/main')?>
<?=$this->section('main')?>
<!-- Page Heading -->



<div class="container-xl">
    <div class="row g-3 mb-4 align-items-center justify-content-between">
        <div class="col-auto">
            <h1 class="app-page-title mb-0">Master Data Puskesmas</h1>
        </div>
        <div class="col-auto">
            <div class="page-utilities">
                <div class="row g-2 justify-content-start justify-content-md-end align-items-center">

                </div>
                <div class="col-auto">
                    <a class="btn app-btn-primary" href="<?= route_to('puskesmas-add') ?>">
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
            <table class="table table-striped" id="table-data" width="100%">
            </table>
        </div>
    </div>
</div>
</div>
<!--//tab-content-->
<?= $this->endSection() ?>

<?=$this->section('script')?>
<script src="<?=base_url('js/pages/panel/puskesmas-index.js')?>"></script>
<?=$this->endSection()?>