<?= $this->extend('layouts/admin_layout') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Daftar Pegawai & Hak Akses</h3>
        <div class="card-tools">
            <a href="<?= base_url('admin/user/create') ?>" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Tambah Pegawai Baru
            </a>
        </div>
    </div>
    <div class="card-body p-0">
        <table class="table table-striped projects">
            <thead>
                <tr>
                    <th style="width: 5%">No</th>
                    <th style="width: 20%">Nama User / Login</th>
                    <th style="width: 20%">NIP (Nomor Induk)</th>
                    <th style="width: 15%">Jabatan (Role)</th>
                    <th style="width: 20%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if(empty($users)): ?>
                    <tr>
                        <td colspan="5" class="text-center">Belum ada data pegawai.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach($users as $key => $row): ?>
                    <tr>
                        <td><?= $key + 1 ?></td>
                        <td>
                            <a><?= esc($row['nama_user']) ?></a>
                            <br/>
                            <small>Created: <?= date('d.m.Y') ?></small>
                        </td>
                        <td><?= esc($row['kode_peran']) ?></td>
                        <td>
                            <?php 
                                $badge = 'secondary';
                                if($row['role'] == 'admin') $badge = 'danger';
                                if($row['role'] == 'pimpinan') $badge = 'warning';
                                if($row['role'] == 'staf') $badge = 'success';
                            ?>
                            <span class="badge badge-<?= $badge ?>"><?= strtoupper($row['role']) ?></span>
                        </td>
                        <td class="project-actions">
                            <a class="btn btn-info btn-sm" href="<?= base_url('admin/user/edit/'.$row['id_user']) ?>">
                                <i class="fas fa-pencil-alt"></i> Edit
                            </a>
                            <a class="btn btn-danger btn-sm" href="<?= base_url('admin/user/delete/'.$row['id_user']) ?>" onclick="return confirm('Yakin ingin menghapus pegawai ini? Data nota yang dibuat mungkin ikut terhapus.')">
                                <i class="fas fa-trash"></i> Hapus
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