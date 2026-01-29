<?= $this->extend('layouts/admin_layout') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-6">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Form Pegawai Baru</h3>
            </div>
            <form action="<?= base_url('admin/user/save') ?>" method="post">
                <?= csrf_field() ?>
                <div class="card-body">
                    <div class="form-group">
                        <label>Username / Nama Lengkap</label>
                        <input type="text" name="nama_user" class="form-control" placeholder="Masukkan nama untuk login..." required>
                    </div>
                    
                    <div class="form-group">
                        <label>NIP (Nomor Induk Pegawai)</label>
                        <input type="text" name="nip" class="form-control" placeholder="Contoh: 19901010 2020..." required>
                    </div>

                    <div class="form-group">
                        <label>Role / Jabatan Sistem</label>
                        <select name="role" class="form-control">
                            <option value="staf">STAF (Bisa Buat Nota)</option>
                            <option value="pimpinan">PIMPINAN (Bisa Acc Nota)</option>
                            <option value="admin">ADMIN (IT Support)</option>
                        </select>
                    </div>

                    <div class="alert alert-info">
                        <i class="icon fas fa-info"></i> Password default untuk akun baru adalah: <b>123456</b>
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan Data</button>
                    <a href="<?= base_url('admin/user') ?>" class="btn btn-default float-right">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>