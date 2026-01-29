<?= $this->extend('layouts/admin_layout') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        
        <div class="col-md-8">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-file-alt mr-1"></i> Detail Laporan Nota Dinas
                    </h3>
                </div>
                
                <div class="card-body p-0">
                    <table class="table table-bordered table-striped">
                        <tbody>
                            <tr>
                                <td style="width: 20%" class="text-bold">Nomor Surat</td>
                                <td>
                                    <?php if($nota['nomor_nota']): ?>
                                        <span class="text-primary text-bold"><?= esc($nota['nomor_nota']) ?></span>
                                    <?php else: ?>
                                        <span class="text-muted font-italic">(Nomor akan digenerate otomatis setelah di-ACC)</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-bold">Tanggal Masuk</td>
                                <td>
                                    <i class="far fa-calendar-alt mr-1"></i> 
                                    <?= date('d F Y', strtotime($nota['created_at'])) ?> 
                                    <small class="text-muted">(Pukul <?= date('H:i', strtotime($nota['created_at'])) ?> WIB)</small>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-bold">Jenis & Sifat</td>
                                <td>
                                    <span class="badge badge-info"><?= esc($nota['jenis_surat'] ?? 'Umum') ?></span>
                                    <span class="badge badge-<?= ($nota['sifat']=='Segera')?'warning':'secondary' ?>"><?= esc($nota['sifat']) ?></span>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-bold">Pengirim (Dari)</td>
                                <td>
                                    <b><?= isset($pembuat['nama_user']) ? esc($pembuat['nama_user']) : 'Data Pegawai Terhapus' ?></b>
                                    <br>
                                    <small>NIP/Kode: <?= isset($pembuat['kode_peran']) ? esc($pembuat['kode_peran']) : '-' ?></small>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-bold">Tujuan (Kepada)</td>
                                <td><?= esc($nota['tujuan_disposisi']) ?></td>
                            </tr>
                            <tr>
                                <td class="text-bold">Perihal</td>
                                <td class="text-uppercase text-bold"><?= esc($nota['perihal']) ?></td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="p-4">
                        <h6 class="text-bold text-secondary border-bottom pb-2 mb-3">ISI LAPORAN / NOTA:</h6>
                        <div style="font-size: 1.1rem; line-height: 1.8; text-align: justify; color: #333;">
                            <?= nl2br(esc($nota['isi_nota'])) ?>
                        </div>
                    </div>

                    <?php if($nota['file_lampiran']): ?>
                    <div class="card-footer bg-light">
                        <h6 class="text-bold"><i class="fas fa-paperclip"></i> Dokumen Pendukung:</h6>
                        <a href="<?= base_url('uploads/lampiran/'.$nota['file_lampiran']) ?>" target="_blank" class="btn btn-default btn-sm mt-2">
                            <i class="fas fa-download text-primary"></i> Lihat Lampiran (<?= esc($nota['file_lampiran']) ?>)
                        </a>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            
            <div class="info-box mb-3 bg-<?= ($nota['status']=='Diajukan')?'warning':'success' ?>">
                <span class="info-box-icon"><i class="fas fa-info-circle"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Status Surat</span>
                    <span class="info-box-number"><?= strtoupper($nota['status']) ?></span>
                </div>
            </div>

            <?php if($nota['status'] == 'Diajukan'): ?>
            <div class="card card-outline card-success">
                <div class="card-header">
                    <h3 class="card-title">Tindakan Pimpinan</h3>
                </div>
                <div class="card-body">
                    <p class="text-muted text-sm">Silakan pilih tindakan untuk laporan ini:</p>
                    
                    <form action="<?= base_url('pimpinan/surat-masuk/approve') ?>" method="post" class="mb-3">
                        <?= csrf_field() ?>
                        <input type="hidden" name="id_nota" value="<?= $nota['id_nota'] ?>">
                        <button type="submit" class="btn btn-success btn-block btn-lg font-weight-bold shadow-sm" onclick="return confirm('Apakah Anda yakin menyetujui dan menandatangani surat ini?')">
                            <i class="fas fa-check-double mr-2"></i> SETUJUI & TTD
                        </button>
                    </form>

                    <div class="text-center text-muted mb-3">- ATAU -</div>

                    <button type="button" class="btn btn-danger btn-block shadow-sm" data-toggle="collapse" data-target="#formRevisi">
                        <i class="fas fa-undo mr-2"></i> Minta Perbaikan (Revisi)
                    </button>

                    <div id="formRevisi" class="collapse mt-3">
                        <div class="callout callout-danger">
                            <form action="<?= base_url('pimpinan/surat-masuk/revisi') ?>" method="post">
                                <?= csrf_field() ?>
                                <input type="hidden" name="id_nota" value="<?= $nota['id_nota'] ?>">
                                <div class="form-group">
                                    <label class="text-danger small">Catatan Kekurangan:</label>
                                    <textarea name="catatan_revisi" class="form-control form-control-sm" rows="3" placeholder="Contoh: Perihal kurang jelas, tolong diperbaiki..." required></textarea>
                                </div>
                                <button type="submit" class="btn btn-danger btn-sm float-right">Kirim Catatan</button>
                            </form>
                            <br>
                        </div>
                    </div>

                </div>
            </div>
            <?php endif; ?>

            <?php if($nota['status'] == 'Disetujui'): ?>
                <div class="callout callout-success">
                    <h5><i class="fas fa-archive"></i> Info Pengarsipan</h5>
                    <p>Surat telah disetujui dan disimpan secara fisik di:</p>
                    <div class="alert alert-light border">
                        <h4 class="text-success"><i class="fas fa-map-marker-alt"></i> <?= esc($nota['lokasi_arsip'] ?? 'Belum ditentukan') ?></h4>
                    </div>
                </div>
                <a href="<?= base_url('pimpinan/arsip') ?>" class="btn btn-default btn-block">
                    <i class="fas fa-arrow-left"></i> Kembali ke Arsip
                </a>
            <?php endif; ?>

        </div>
    </div>
</div>
<?= $this->endSection() ?>