<?= $this->extend('layouts/admin_layout') ?>

<?= $this->section('content') ?>
<div class="card card-outline card-warning">
    <div class="card-header">
        <h3 class="card-title">Surat Menunggu Persetujuan</h3>
    </div>
    <div class="card-body p-0">
        <table class="table table-hover text-nowrap">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Dari (Pembuat)</th>
                    <th>Perihal</th>
                    <th>Sifat</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if(empty($surat_masuk)): ?>
                    <tr><td colspan="6" class="text-center">Tidak ada surat masuk baru.</td></tr>
                <?php else: ?>
                    <?php foreach($surat_masuk as $row): ?>
                    <tr>
                        <td><?= date('d M Y', strtotime($row['created_at'])) ?></td>
                        
                        <td>
                            <b><?= esc($row['nama_user'] ?? 'User Terhapus') ?></b>
                            <br>
                            <small class="text-muted"><?= esc($row['kode_peran'] ?? '-') ?></small>
                        </td>

                        <td><?= esc($row['perihal']) ?></td>
                        
                        <td>
                            <?php
                                $badgeSifat = 'secondary';
                                if($row['sifat'] == 'Segera') $badgeSifat = 'warning';
                                if($row['sifat'] == 'Rahasia') $badgeSifat = 'danger';
                            ?>
                            <span class="badge badge-<?= $badgeSifat ?>"><?= esc($row['sifat']) ?></span>
                        </td>
                        
                        <td>
                            <span class="badge badge-warning">Menunggu ACC</span>
                        </td>
                        
                        <td>
                            <a href="<?= base_url('pimpinan/surat-masuk/detail/'.$row['id_nota']) ?>" class="btn btn-sm btn-primary">
                                <i class="fas fa-search"></i> Periksa
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>