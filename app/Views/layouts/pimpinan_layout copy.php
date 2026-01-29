<li class="nav-header">MENU PIMPINAN</li>

<li class="nav-item">
    <a href="<?= base_url('pimpinan/dashboard') ?>" class="nav-link">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>Dashboard</p>
    </a>
</li>

<li class="nav-item">
    <a href="<?= base_url('pimpinan/surat-masuk') ?>" class="nav-link">
        <i class="nav-icon fas fa-inbox"></i>
        <p>
            Surat Masuk
            <span class="right badge badge-warning">Cek</span> 
        </p>
    </a>
</li>

<li class="nav-item">
    <a href="<?= base_url('pimpinan/laporan') ?>" class="nav-link">
        <i class="nav-icon fas fa-file-alt"></i>
        <p>Laporan / Arsip</p>
    </a>
</li>

<li class="nav-header">AKUN</li>
<li class="nav-item">
    <a href="<?= base_url('logout') ?>" class="nav-link">
        <i class="nav-icon fas fa-sign-out-alt"></i>
        <p>Logout</p>
    </a>
</li>