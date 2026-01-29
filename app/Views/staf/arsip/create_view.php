<?= $this->extend('layouts/admin_layout') ?>

<?= $this->section('content') ?>
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-file-import"></i> Input Data Arsip Baru</h3>
    </div>
    <form action="<?= base_url('staf/arsip/simpan') ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>
        <div class="card-body">
            
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Tanggal Terima / Input</label>
                        <input type="date" name="tanggal_terima" class="form-control" value="<?= date('Y-m-d') ?>" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Jenis Arsip</label>
                        <select name="jenis_arsip" class="form-control" id="jenisArsip">
                            <?php foreach($opsi_jenis as $jenis): ?>
                                <option value="<?= $jenis ?>"><?= $jenis ?></option>
                            <?php endforeach; ?>
                        </select>
                        <small class="text-info">*Lokasi penyimpanan akan ditentukan otomatis berdasarkan ini.</small>
                    </div>
                </div>
                <div class="form-group">
                <label>Klasifikasi Surat (Kemenhub)</label>
                <select name="kode_klasifikasi" class="form-control" id="klasifikasiSelect">
                    <option value="">-- Pilih Klasifikasi --</option>
                    <option value="UM">UM - Umum & Rumah Tangga</option>
                    <option value="KP">KP - Kepegawaian</option>
                    <option value="KU">KU - Keuangan</option>
                    <option value="HK">HK - Hukum</option>
                    <option value="OT">OT - Organisasi</option>
                    <option value="PL">PL - Perlengkapan & Aset</option>
                    <option value="PR">PR - Perencanaan</option>
                    <option value="NV">NV - Operasional Navigasi (Teknis)</option>
                </select>
                <small class="text-muted">Kode akan otomatis ditambahkan ke Nomor Surat.</small>
            </div>
                <div class="col-md-5">
                    <div class="form-group">
                        <label>Nomor Surat</label>
                        <input type="text" name="nomor_surat" class="form-control" placeholder="Contoh: UM.002/1/14/DNV" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Tanggal Surat</label>
                        <input type="date" name="tanggal_surat" class="form-control" required>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="form-group">
                        <label>Pengirim / Tujuan</label>
                        <input type="text" name="pengirim_tujuan" class="form-control" placeholder="Contoh: Dirjen Perhubungan Laut" required>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>Perihal / Isi Ringkas</label>
                <textarea name="perihal" class="form-control" rows="3" placeholder="Ringkasan isi surat..." required></textarea>
            </div>

            <div class="row">
                <div class="col-md-6">
                     <div class="form-group">
                        <label>Keterangan (Opsional)</label>
                        <input type="text" name="keterangan" class="form-control" placeholder="Cth: Segera ditindaklanjuti / Asli">
                    </div>
                </div>
                <div class="col-md-6">
    <div class="form-group">
        <label>Upload File (PDF / Word / Excel / Gambar)</label> <div class="custom-file">
            <input type="file" class="custom-file-input" name="file_scan" id="fileInput">
            <label class="custom-file-label" for="fileInput">Pilih dokumen...</label>
        </div>
        <small class="text-muted">Bisa upload .docx, .xlsx, .pdf, .jpg, dll (Max 10MB)</small>
    </div>
</div>
            </div>

        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan ke Arsip</button>
            <a href="<?= base_url('staf/arsip') ?>" class="btn btn-default">Kembali</a>
        </div>
    </form>
</div>
<script>
    // Script Sederhana: Saat Klasifikasi dipilih, Kode masuk ke kotak Nomor Surat
    document.getElementById('klasifikasiSelect').addEventListener('change', function() {
        var kode = this.value;
        var inputNo = document.getElementsByName('nomor_surat')[0];
        
        // Contoh Format Otomatis: [KODE]. ...
        if(kode != "") {
            inputNo.value = kode + ". ... / ... / DNV-TPI / " + new Date().getFullYear();
        }
    });
</script>
<?= $this->endSection() ?>