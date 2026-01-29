<?= $this->extend('layouts/admin_layout') ?>

<?= $this->section('content') ?>
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-archive"></i> DATA ARSIP KANTOR NAVIGASI</h3>
        <div class="card-tools">
            <a href="<?= base_url('staf/arsip/create') ?>" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Input Arsip Baru
            </a>
        </div>
    </div>

    <div class="card-body bg-light">
        <form action="" method="get">
            <div class="row">
                <div class="col-md-3">
                    <select name="jenis" class="form-control">
                        <option value="">-- Semua Jenis --</option>
                        <option value="Surat Masuk" <?= $filter_jenis=='Surat Masuk'?'selected':'' ?>>Surat Masuk</option>
                        <option value="Surat Keluar" <?= $filter_jenis=='Surat Keluar'?'selected':'' ?>>Surat Keluar</option>
                        <option value="SK (Surat Keputusan)" <?= $filter_jenis=='SK (Surat Keputusan)'?'selected':'' ?>>SK (Keputusan)</option>
                        <option value="Berkas Proyek" <?= $filter_jenis=='Berkas Proyek'?'selected':'' ?>>Berkas Proyek</option>
                    </select>
                </div>
                <div class="col-md-7">
                    <input type="text" name="q" class="form-control" placeholder="Cari Nomor Surat / Perihal / Pengirim..." value="<?= esc($keyword) ?>">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary btn-block">Cari</button>
                </div>
            </div>
        </form>
    </div>

    <div class="card-body table-responsive p-0">
        <table class="table table-bordered table-hover text-nowrap table-sm">
            <thead class="bg-navy color-palette">
                <tr class="text-center">
                    <th style="width: 5%">No</th>
                    <th>Tgl Terima</th>
                    <th>No. Surat / Pengirim</th>
                    <th>Perihal</th>
                    <th class="bg-warning text-dark">LOKASI SIMPAN</th>
                    <th style="width: 15%">File Arsip</th>
                    <th style="width: 5%">Aksi</th>
                </tr>
            </thead>
       <tbody>
                <?php if(empty($arsip)): ?>
                    <tr><td colspan="7" class="text-center p-3">Data arsip tidak ditemukan.</td></tr>
                <?php else: ?>
                    <?php foreach($arsip as $i => $row): ?>
                    <tr>
                        <td class="text-center"><?= $i + 1 ?></td>
                        <td class="text-center"><?= date('d/m/y', strtotime($row['tanggal_terima'])) ?></td>
                        
                        <td>
                            <span class="badge badge-secondary"><?= esc($row['jenis_arsip']) ?></span>
                            
                            <?php 
                                $ket = strtolower($row['keterangan']);
                                $badgeColor = 'info';
                                if(strpos($ket, 'asli') !== false) $badgeColor = 'success';
                                if(strpos($ket, 'segera') !== false) $badgeColor = 'danger';
                                if(strpos($ket, 'copy') !== false) $badgeColor = 'warning';
                            ?>
                            <span class="badge badge-<?= $badgeColor ?>"><?= esc($row['keterangan'] ?: 'Umum') ?></span>
                            
                            <br>
                            <b><?= esc($row['nomor_surat']) ?></b><br>
                            <small class="text-muted">Dari/Ke: <?= esc($row['pengirim_tujuan']) ?></small>
                        </td>
                        
                        <td style="white-space: normal;"><?= esc($row['perihal']) ?></td>
                        
                        <td class="bg-warning text-center text-bold" style="vertical-align: middle;">
                            <?= esc($row['lokasi_penyimpanan']) ?>
                        </td>

                        <td class="text-center">
                            <?php if($row['file_scan']): ?>
                                <a href="<?= base_url('uploads/arsip/'.$row['file_scan']) ?>" target="_blank" class="btn btn-xs btn-default">
                                    <i class="fas fa-paperclip"></i> Lihat
                                </a>
                            <?php else: ?> - <?php endif; ?>
                        </td>

                        <td class="text-center" style="vertical-align: middle;">
                            <div class="btn-group-vertical">
                                <a href="<?= base_url('staf/arsip/cetak/'.$row['id_arsip']) ?>" target="_blank" class="btn btn-danger btn-xs mb-1" title="Cetak Kartu">
                                    <i class="fas fa-file-pdf"></i> Export PDF
                                </a>
                                <a href="<?= base_url('staf/arsip/delete/'.$row['id_arsip']) ?>" onclick="return confirm('Hapus arsip ini?')" class="btn btn-default btn-xs text-danger">
                                    <i class="fas fa-trash"></i> Hapus
                                </a>
                                <a href="<?= base_url('staf/arsip/edit/'.$row['id_arsip']) ?>" class="btn btn-warning btn-xs mb-1" title="Edit Data">
    <i class="fas fa-edit"></i> Edit
</a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>