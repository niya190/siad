<?= $this->extend('layouts/admin_layout') ?>

<?= $this->section('content') ?>
<div class="row">
    
    <div class="col-md-8">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Detail Nota Dinas: <?= $arsip['nomor_surat'] ?></h3>
            </div>
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-4">Dari Bagian</dt>
                    <dd class="col-sm-8"><?= $arsip['kode_bagian'] ?></dd>

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

</div>
<?= $this->endSection() ?>