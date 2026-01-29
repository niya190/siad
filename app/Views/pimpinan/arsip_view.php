<?= $this->extend('layouts/admin_layout') ?>

<?= $this->section('content') ?>
<div class="card card-outline card-success">
    <div class="card-header">
        <h3 class="card-title">Bank Data Arsip Nota Dinas</h3>
        
        <div class="card-tools">
            <form action="" method="get">
                <div class="input-group input-group-sm" style="width: 250px;">
                    <input type="text" name="q" class="form-control float-right" placeholder="Cari Perihal / Nomor..." value="<?= esc($keyword ?? '') ?>">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
            <thead>
                <tr>
                    <th>Nomor Arsip</th>
                    <th>Tanggal Sah</th>
                    <th>Perihal</th>
                    <th>Pembuat</th>
                    <th>File</th>
                </tr>
            </thead>
            <tbody>
                <?php if(empty($arsip)): ?>
                    <tr><td colspan="5" class="text-center">Data arsip tidak ditemukan.</td></tr>
                <?php else: ?>
                    <?php foreach($arsip as $row): ?>
                    <tr>
                        <td class="text-bold text-primary"><?= esc($row['nomor_nota']) ?></td>
                        <td><?= date('d M Y', strtotime($row['updated_at'])) ?></td>
                        <td><?= esc($row['perihal']) ?></td>
                        <td><?= esc($row['pembuat']) ?></td>
                        <td>
                           <a href="<?= base_url('pimpinan/pdf/'.$row['id_nota']) ?>" target="_blank" class="btn btn-xs btn-outline-danger">
    <i class="fas fa-file-pdf"></i> PDF
</a>
                            
                            <?php if($row['file_lampiran']): ?>
                                <a href="<?= base_url('uploads/lampiran/'.$row['file_lampiran']) ?>" target="_blank" class="btn btn-xs btn-outline-info">
                                    <i class="fas fa-paperclip"></i> Att
                                </a>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>