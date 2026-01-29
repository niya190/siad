<?= $this->extend('layouts/admin_layout') ?>

<?= $this->section('content') ?>
<div class="card card-warning">
    <div class="card-header">
        <h3 class="card-title">Edit Data Arsip</h3>
    </div>
    
    <form action="<?= base_url('staf/arsip/update/'.$arsip['id_arsip']) ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>
        
        <input type="hidden" name="file_lama" value="<?= $arsip['file_scan'] ?>">

        <div class="card-body">
            <div class="form-group">
                <label>Tanggal Terima</label>
                <input type="date" name="tanggal_terima" class="form-control" value="<?= $arsip['tanggal_terima'] ?>" required>
            </div>

            <div class="form-group">
                <label>Jenis Arsip</label>
                <select name="jenis_arsip" class="form-control">
                    <?php foreach($opsi_jenis as $opsi): ?>
                        <option value="<?= $opsi ?>" <?= ($arsip['jenis_arsip'] == $opsi) ? 'selected' : '' ?>>
                            <?= $opsi ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label>Nomor Surat</label>
                <input type="text" name="nomor_surat" class="form-control" value="<?= esc($arsip['nomor_surat']) ?>" required>
            </div>

            <div class="form-group">
                <label>Tanggal Surat</label>
                <input type="date" name="tanggal_surat" class="form-control" value="<?= $arsip['tanggal_surat'] ?>" required>
            </div>

            <div class="form-group">
                <label>Pengirim / Tujuan</label>
                <input type="text" name="pengirim_tujuan" class="form-control" value="<?= esc($arsip['pengirim_tujuan']) ?>" required>
            </div>

            <div class="form-group">
                <label>Perihal</label>
                <textarea name="perihal" class="form-control" rows="3"><?= esc($arsip['perihal']) ?></textarea>
            </div>
            
            <div class="form-group">
                <label>Status / Keterangan</label>
                <select name="keterangan" class="form-control">
                    <option value="Asli" <?= $arsip['keterangan']=='Asli'?'selected':'' ?>>Dokumen Asli</option>
                    <option value="Fotokopi" <?= $arsip['keterangan']=='Fotokopi'?'selected':'' ?>>Fotokopi</option>
                    <option value="Segera" <?= $arsip['keterangan']=='Segera'?'selected':'' ?>>Segera</option>
                    <option value="Arsip Biasa" <?= $arsip['keterangan']=='Arsip Biasa'?'selected':'' ?>>Arsip Biasa</option>
                </select>
            </div>

            <div class="form-group">
                <label>Update File (Biarkan kosong jika tidak diganti)</label>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" name="file_scan">
                    <label class="custom-file-label">Pilih file baru...</label>
                </div>
                <small>File saat ini: <a href="<?= base_url('uploads/arsip/'.$arsip['file_scan']) ?>" target="_blank"><?= $arsip['file_scan'] ?></a></small>
            </div>
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-warning">Update Perubahan</button>
            <a href="<?= base_url('staf/arsip') ?>" class="btn btn-default">Batal</a>
        </div>
    </form>
</div>
<?= $this->endSection() ?>