<?= $this->extend('layouts/admin_layout') ?>

<?= $this->section('content') ?>

<div class="row mb-4">
    <div class="col-12">
        <div class="card bg-gradient-primary shadow-lg" style="border-radius: 15px; overflow: hidden; background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);">
            <div class="card-body p-4">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h2 class="font-weight-bold text-white mb-2">
                            Selamat Datang, <?= session()->get('nama_user') ?>! 👋
                        </h2>
                        <p class="text-white-50 mb-0" style="font-size: 1.1rem;">
                            Sistem Informasi Arsip Dinamis (SIAD) Kantor Distrik Navigasi.
                            <br>Kelola surat dan dokumen fisik dengan mudah, cepat, dan terukur.
                        </p>
                    </div>
                    <div class="col-md-4 text-right d-none d-md-block">
                        <i class="fas fa-ship fa-5x" style="opacity: 0.2; color: white;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-3 col-6">
        <div class="small-box bg-white shadow-sm p-3">
            <div class="inner">
                <h3 class="font-weight-bold text-primary"><?= $total_arsip ?></h3>
                <p class="text-muted font-weight-bold text-uppercase" style="font-size: 0.8rem; letter-spacing: 1px;">Total Dokumen</p>
            </div>
            <div class="icon">
                <i class="fas fa-folder text-primary" style="opacity: 0.15;"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-white shadow-sm p-3">
            <div class="inner">
                <h3 class="font-weight-bold text-success"><?= $surat_masuk ?></h3>
                <p class="text-muted font-weight-bold text-uppercase" style="font-size: 0.8rem; letter-spacing: 1px;">Surat Masuk</p>
            </div>
            <div class="icon">
                <i class="fas fa-inbox text-success" style="opacity: 0.15;"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-white shadow-sm p-3">
            <div class="inner">
                <h3 class="font-weight-bold text-warning"><?= $surat_keluar ?></h3>
                <p class="text-muted font-weight-bold text-uppercase" style="font-size: 0.8rem; letter-spacing: 1px;">Surat Keluar</p>
            </div>
            <div class="icon">
                <i class="fas fa-paper-plane text-warning" style="opacity: 0.15;"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-white shadow-sm p-3">
            <div class="inner">
                <h3 class="font-weight-bold text-danger"><?= $berkas_proyek ?></h3>
                <p class="text-muted font-weight-bold text-uppercase" style="font-size: 0.8rem; letter-spacing: 1px;">Berkas Proyek</p>
            </div>
            <div class="icon">
                <i class="fas fa-project-diagram text-danger" style="opacity: 0.15;"></i>
            </div>
        </div>
    </div>
</div>

<div class="row mt-2">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title font-weight-bold">Akses Cepat</h3>
            </div>
            <div class="card-body">
                <a href="<?= base_url('staf/arsip/baru') ?>" class="btn btn-primary btn-block mb-3 py-3 shadow-sm text-left">
                    <i class="fas fa-plus-circle mr-2 bg-white text-primary p-1 rounded-circle"></i> Input Arsip Baru
                </a>
                <a href="<?= base_url('staf/arsip') ?>" class="btn btn-outline-secondary btn-block mb-2 py-2 text-left">
                    <i class="fas fa-search mr-2"></i> Cari Dokumen
                </a>
                <a href="<?= base_url('staf/arsip') ?>" class="btn btn-outline-secondary btn-block mb-2 py-2 text-left">
                    <i class="fas fa-print mr-2"></i> Cetak Label Rak
                </a>
            </div>
        </div>
    </div>

    <div class="col-lg-8">
        <div class="card">
            <div class="card-header border-0 d-flex justify-content-between align-items-center">
                <h3 class="card-title font-weight-bold">📝 Aktivitas Terbaru</h3>
                <a href="<?= base_url('staf/arsip') ?>" class="text-muted text-sm">Lihat Semua</a>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead class="bg-light">
                    <tr>
                        <th class="border-top-0">No. Surat</th>
                        <th class="border-top-0">Perihal</th>
                        <th class="border-top-0">Tgl Input</th>
                        <th class="border-top-0">Lokasi</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if(!empty($terbaru)): ?>
                        <?php foreach($terbaru as $row): ?>
                        <tr>
                            <td class="font-weight-bold text-primary"><?= $row['nomor_surat'] ?></td>
                            <td>
                                <span class="d-block text-truncate" style="max-width: 250px;">
                                    <?= $row['perihal'] ?>
                                </span>
                            </td>
                            <td class="text-muted text-sm">
                                <i class="far fa-clock mr-1"></i> <?= date('d M Y', strtotime($row['created_at'])) ?>
                            </td>
                            <td>
                                <span class="badge badge-light border text-dark">
                                    <i class="fas fa-map-marker-alt text-danger mr-1"></i> <?= $row['lokasi_penyimpanan'] ?>
                                </span>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="text-center py-4 text-muted">Belum ada data arsip terbaru.</td>
                        </tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>