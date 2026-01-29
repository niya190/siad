<?= $this->extend('layouts/admin_layout') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-lg-4 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3><?= $total_user ?? 0 ?></h3>
                <p>Total Akun Pegawai</p>
            </div>
            <div class="icon">
                <i class="fas fa-id-card"></i>
            </div>
            <a href="<?= base_url('admin/user') ?>" class="small-box-footer">Lihat Detail <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    
    <div class="col-lg-4 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3><?= $total_staf ?? 0 ?></h3>
                <p>Jumlah Staf (Pembuat Nota)</p>
            </div>
            <div class="icon">
                <i class="fas fa-user-tie"></i>
            </div>
        </div>
    </div>
    
    <div class="col-lg-4 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3><?= $total_pimpinan ?? 0 ?></h3>
                <p>Jumlah Pimpinan (Acc Nota)</p>
            </div>
            <div class="icon">
                <i class="fas fa-user-shield"></i>
            </div>
        </div>
    </div>
</div>

<div class="callout callout-info">
    <h5><i class="fas fa-info"></i> Info Admin</h5>
    <p>Gunakan menu <b>"Kelola Pegawai"</b> untuk menambah akun Staf atau Pimpinan baru, serta mereset password jika ada pegawai yang lupa.</p>
</div>
<?= $this->endSection() ?>