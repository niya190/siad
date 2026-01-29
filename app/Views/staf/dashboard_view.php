<?= $this->extend('layouts/admin_layout') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    
    <div class="row mb-3">
        <div class="col-12">
            <h3 class="m-0 text-dark">Ringkasan Arsip Navigasi</h3>
            <p class="text-muted">Sistem Informasi Arsip Digital (SIAD)</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3><?= $total_arsip ?></h3>
                    <p>Total Semua Dokumen</p>
                </div>
                <div class="icon">
                    <i class="fas fa-archive"></i>
                </div>
                <a href="<?= base_url('staf/arsip') ?>" class="small-box-footer">Lihat Detail <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3><?= $surat_masuk ?></h3>
                    <p>Surat Masuk</p>
                </div>
                <div class="icon">
                    <i class="fas fa-inbox"></i>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3><?= $surat_keluar ?></h3>
                    <p>Surat Keluar</p>
                </div>
                <div class="icon">
                    <i class="fas fa-paper-plane"></i>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3><?= $berkas_proyek ?></h3>
                    <p>Berkas Proyek</p>
                </div>
                <div class="icon">
                    <i class="fas fa-project-diagram"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="card card-outline card-primary">
        <div class="card-header border-0">
            <h3 class="card-title">5 Arsip Terbaru Ditambahkan</h3>
        </div>
        <div class="card-body table-responsive p-0">
            <table class="table table-striped table-valign-middle">
                <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Nomor Surat</th>
                    <th>Perihal</th>
                    <th>Lokasi</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($terbaru as $row): ?>
                <tr>
                    <td><?= date('d/m/Y', strtotime($row['created_at'])) ?></td>
                    <td><?= $row['nomor_surat'] ?></td>
                    <td><?= substr($row['perihal'], 0, 40) ?>...</td>
                    <td><span class="badge badge-warning"><?= $row['lokasi_penyimpanan'] ?></span></td>
                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
<?= $this->endSection() ?>