<?= $this->extend('layouts/admin_layout') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-6">
        <div class="card card-warning">
            <div class="card-header">
                <h3 class="card-title">Edit Data Pegawai</h3>
            </div>
            <form action="<?= base_url('admin/user/update/' . $user['id_user']) ?>" method="post">
                <?= csrf_field() ?>
                <div class="card-body">
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="nama_user" class="form-control" value="<?= esc($user['nama_user']) ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label>NIP</label>
                        <input type="text" name="nip" class="form-control" value="<?= esc($user['kode_peran']) ?>">
                    </div>

                    <div class="form-group">
                        <label>Role</label>
                        <select name="role" class="form-control">
                            <option value="staf" <?= $user['role'] == 'staf' ? 'selected' : '' ?>>Staf</option>
                            <option value="pimpinan" <?= $user['role'] == 'pimpinan' ? 'selected' : '' ?>>Pimpinan</option>
                            <option value="admin" <?= $user['role'] == 'admin' ? 'selected' : '' ?>>Admin</option>
                        </select>
                    </div>

                    <hr>
                    <div class="form-group">
                        <label class="text-danger">Reset Password (Opsional)</label>
                        <input type="password" name="password" class="form-control" placeholder="Isi HANYA jika ingin mengganti password user ini...">
                        <small class="text-muted">Kosongkan jika tidak ingin mengubah password.</small>
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-warning">Update Perubahan</button>
                    <a href="<?= base_url('admin/user') ?>" class="btn btn-default float-right">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>