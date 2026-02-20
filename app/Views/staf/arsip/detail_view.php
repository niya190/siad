<?= $this->extend('layouts/admin_layout') ?>

<?= $this->section('content') ?>
<div class="row">
    
    <div class="col-md-8">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Detail Nota Dinas: <?= $arsip['nomor_surat'] ?></h3>
            </div>
            <div class="col-md-12 mt-4">
    <div class="card">
        <div class="card-header bg-navy">
            <h3 class="card-title"><i class="fas fa-route"></i> Riwayat Perjalanan Surat (Tracking)</h3>
        </div>
        <div class="card-body">
            <div class="timeline timeline-inverse">
                
                <div>
                    <i class="fas fa-envelope bg-primary"></i>
                    <div class="timeline-item">
                        <span class="time"><i class="far fa-clock"></i> <?= date('d M Y H:i', strtotime($arsip['created_at'])) ?></span>
                        <h3 class="timeline-header"><a href="#">Staf Tata Usaha</a> menginput surat</h3>
                        <div class="timeline-body">
                            Surat masuk ke sistem. Status: Konsep.
                        </div>
                    </div>
                </div>

                <div>
                    <i class="fas fa-map-marker-alt bg-danger"></i>
                    <div class="timeline-item">
                        <span class="time"><i class="far fa-clock"></i> Sekarang</span>
                        <h3 class="timeline-header border-0">
                            <strong>Posisi Saat Ini:</strong> <?= $arsip['lokasi_penyimpanan'] ?>
                        </h3>
                    </div>
                </div>
                
                <div>
                    <i class="far fa-clock bg-gray"></i>
                </div>
            </div>
        </div>
    </div>
</div>
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-4">Dari Bagian</dt>
                    <dd class="col-sm-8"><?= $arsip['pengirim_tujuan'] ?></dd>

                    <dt class="col-sm-4">Perihal</dt>
                    <dd class="col-sm-8"><?= $arsip['perihal'] ?></dd>

                    <dt class="col-sm-4">Posisi Sekarang</dt>
                    <dd class="col-sm-8"><span class="badge badge-warning"><?= $arsip['lokasi_penyimpanan'] ?></span></dd>
                    
                    <dt class="col-sm-4">File Dokumen</dt>
                    <dd class="col-sm-8">
                        <a href="<?= base_url('uploads/arsip/'.$arsip['file_scan']) ?>" target="_blank" class="btn btn-sm btn-info"><i class="fas fa-download"></i> Lihat File</a>
                    </dd>
                </dl>
                
                <hr>
                
                <h4>Teruskan Surat Ini (Disposisi)</h4>
                <form action="<?= base_url('staf/arsip/disposisi') ?>" method="post" class="bg-light p-3 rounded border">
                    <?= csrf_field() ?>
                    <input type="hidden" name="id_arsip" value="<?= $arsip['id_arsip'] ?>">
                    
                    <div class="form-group">
                        <label>Kirim Ke Bagian:</label>
                        <select name="tujuan_bagian" class="form-control" required>
                            <option value="">-- Pilih Tujuan --</option>
                            <option value="SBNP-I">SBNPARD I</option>
                            <option value="SBNP-II">SBNPARD II</option>
                            <option value="SDMH">SDMH (Tata Usaha)</option>
                            <option value="KEUANGAN">Keuangan</option>
                            <option value="KABID">Kepala Bidang (Pimpinan)</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label>Pesan / Catatan:</label>
                        <input type="text" name="catatan" class="form-control" placeholder="Cth: Mohon dicek dan diproses..." required>
                    </div>
                    
                    <button type="submit" class="btn btn-success"><i class="fas fa-paper-plane"></i> Kirim / Teruskan</button>
                </form>
                <hr>
                <h4>Preview Dokumen Fisik</h4>
                
                <?php 
                $file = $arsip['file_scan'];
                $ext  = pathinfo($file, PATHINFO_EXTENSION); // Cek tipe file (pdf/jpg/docx)
                ?>

                <div class="text-center bg-light p-3 border">
                    
                    <?php if(strtolower($ext) == 'pdf'): ?>
                        <iframe src="<?= base_url('uploads/arsip/'.$file) ?>" width="100%" height="600px" style="border:none;">
                            Browser kamu tidak mendukung preview PDF. 
                            <a href="<?= base_url('uploads/arsip/'.$file) ?>">Klik disini untuk download.</a>
                        </iframe>

                    <?php elseif(in_array(strtolower($ext), ['jpg', 'jpeg', 'png'])): ?>
                        <img src="<?= base_url('uploads/arsip/'.$file) ?>" class="img-fluid" style="max-height: 500px;" alt="Preview Arsip">

                    <?php else: ?>
                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-triangle"></i> 
                            File berbentuk <b>.<?= $ext ?></b> tidak dapat dipreview langsung di browser.<br>
                            Silakan download untuk membukanya.
                        </div>
                        <a href="<?= base_url('uploads/arsip/'.$file) ?>" class="btn btn-primary btn-lg mt-2" download>
                            <i class="fas fa-download"></i> Download File (<?= strtoupper($ext) ?>)
                        </a>
                    <?php endif; ?>

                </div>

            </div>
        </div>
    </div>

    <div class="col-md-4">
        <h4 class="text-center mb-3">Jejak Alur Surat</h4>
        
        <div class="timeline">
            <?php foreach($riwayat as $log): ?>
            <div>
                <i class="fas fa-envelope bg-blue"></i>
                <div class="timeline-item">
                    <span class="time"><i class="fas fa-clock"></i> <?= date('d M H:i', strtotime($log['created_at'])) ?></span>
                    <h3 class="timeline-header">
                        <a href="#"><?= $log['pengirim'] ?></a> mengirim ke <b><?= $log['penerima'] ?></b>
                    </h3>
                    <div class="timeline-body">
                        "<?= $log['catatan'] ?>"
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
            
            <div>
                <i class="fas fa-clock bg-gray"></i>
            </div>
        </div>
    </div>
    <div class="card card-outline <?= ($arsip['status'] == 'Disetujui') ? 'card-success' : 'card-danger' ?> mt-3">
    <div class="card-header">
        <h3 class="card-title">Status Validasi (TTE)</h3>
    </div>
    <div class="card-body text-center">
        
        <?php if($arsip['status'] == 'Konsep'): ?>
            <div class="alert alert-light">
                <i class="fas fa-file-signature fa-3x text-secondary mb-2"></i><br>
                Status: <b>Konsep / Draft</b>
            </div>
            <a href="<?= base_url('staf/arsip/setujui/'.$arsip['id_arsip']) ?>" class="btn btn-primary btn-block" onclick="return confirm('Yakin setujui dokumen ini? QR Code akan dibuat.')">
                <i class="fas fa-pen-nib"></i> Setujui & TTD Elektronik
            </a>

        <?php else: ?>
            <?php 
                // 1. Buat Link Validasi
                $link = base_url('validasi/cek/' . $arsip['token_validasi']);
                // 2. Ubah Link jadi Gambar QR pakai API Google/QRServer
                $qrImage = "https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=" . urlencode($link);
            ?>
            
            <img src="<?= $qrImage ?>" alt="QR Code" class="img-thumbnail mb-2" style="width: 150px;">
            <br>
            <span class="badge badge-success p-2">SAH / DISETUJUI</span>
            <p class="small text-muted mt-2">Scan untuk cek keaslian.</p>
        <?php endif; ?>

    </div>
</div>

</div>
<div class="row mt-3 mb-4">
    <div class="col-12 text-center">
        <a href="<?= base_url('staf/arsip') ?>" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali ke Daftar Arsip
        </a>
    </div>
</div>
<?= $this->endSection() ?>