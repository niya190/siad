<?= $this->extend('layouts/admin_layout') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <div class="alert alert-warning">
            <h5><i class="icon fas fa-user-shield"></i> Login Pimpinan Berhasil!</h5>
            Selamat datang, <b><?= session()->get('nama_user') ?></b>.
            <br>Anda memiliki akses untuk <b>Menyetujui (ACC)</b> Nota Dinas.
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-4 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>0</h3>
                <p>Surat Masuk (Perlu ACC)</p>
            </div>
            <div class="icon"><i class="fas fa-inbox"></i></div>
            <a href="#" class="small-box-footer">Lihat Surat <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>
<?= $this->endSection() ?>