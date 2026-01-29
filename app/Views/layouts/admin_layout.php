<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sistem Nota Dinas | Kantor Navigasi</title>

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <span class="nav-link font-weight-bold">Sistem Manajemen Nota Dinas</span>
      </li>
    </ul>

    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link text-danger" href="<?= base_url('logout') ?>" role="button">
          <i class="fas fa-power-off"></i> Logout
        </a>
      </li>
    </ul>
  </nav>
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="#" class="brand-link">
      <span class="brand-image img-circle elevation-3" style="opacity: .8; display:flex; justify-content:center; align-items:center; width:33px; height:33px; background:#fff; color:#333">
        <i class="fas fa-anchor"></i>
      </span>
      <span class="brand-text font-weight-light pl-2">Kantor Navigasi</span>
    </a>

    <div class="sidebar">
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="https://ui-avatars.com/api/?name=<?= urlencode(session()->get('nama_user')) ?>&background=random" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?= session()->get('nama_user') ?></a>
          <small class="text-muted" style="text-transform: uppercase;"><?= session()->get('role') ?></small>
        </div>
      </div>

      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          
          <?php if(session()->get('role') == 'admin'): ?>
            <li class="nav-header">MENU ADMIN</li>
            
            <li class="nav-item">
                <a href="<?= base_url('admin/dashboard') ?>" class="nav-link <?= (uri_string() == 'admin/dashboard') ? 'active' : '' ?>">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>Dashboard</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="<?= base_url('admin/user') ?>" class="nav-link <?= (strpos(uri_string(), 'admin/user') !== false) ? 'active' : '' ?>">
                <i class="nav-icon fas fa-users-cog"></i>
                <p>Kelola Pegawai</p>
                </a>
            </li>
          <?php endif; ?>


          <?php if(session()->get('role') == 'staf'): ?>
            <li class="nav-header">MENU STAF</li>
            
            <li class="nav-item">
                <a href="<?= base_url('staf/dashboard') ?>" class="nav-link <?= (uri_string() == 'staf/dashboard') ? 'active' : '' ?>">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>Dashboard</p>
                </a>
            </li>

            <li class="nav-item">
    <a href="<?= base_url('staf/arsip') ?>" class="nav-link <?= (strpos(uri_string(), 'staf/arsip') !== false) ? 'active' : '' ?>">
        <i class="nav-icon fas fa-archive"></i>
        <p>Arsip Digital</p>
    </a>
</li>
          <?php endif; ?>


          <?php if(session()->get('role') == 'pimpinan'): ?>
            <li class="nav-header">MENU PIMPINAN</li>
            
            <li class="nav-item">
                <a href="<?= base_url('pimpinan/dashboard') ?>" class="nav-link <?= (uri_string() == 'pimpinan/dashboard') ? 'active' : '' ?>">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>Dashboard</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="<?= base_url('pimpinan/surat-masuk') ?>" class="nav-link <?= (strpos(uri_string(), 'pimpinan/surat-masuk') !== false) ? 'active' : '' ?>">
                <i class="nav-icon fas fa-inbox"></i>
                <p>Surat Masuk (ACC)</p>
                <span class="right badge badge-warning">Cek</span>
                </a>
            </li>
            <li class="nav-item">
        <a href="<?= base_url('pimpinan/arsip') ?>" class="nav-link <?= (strpos(uri_string(), 'pimpinan/arsip') !== false) ? 'active' : '' ?>">
            <i class="nav-icon fas fa-archive"></i>
            <p>Arsip Nota Keluar</p>
        </a>
    </li>
          <?php endif; ?>

          <li class="nav-header">AKUN</li>
          <li class="nav-item">
            <a href="<?= base_url('logout') ?>" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>Keluar (Logout)</p>
            </a>
          </li>

        </ul>
      </nav>
      </div>
    </aside>

  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><?= $title ?? 'Halaman Sistem' ?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active"><?= session()->get('role') ?></li>
            </ol>
          </div>
        </div>
      </div></section>

    <section class="content">
      <div class="container-fluid">
        
        <?php if(session()->getFlashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle mr-2"></i> <?= session()->getFlashdata('success') ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>

        <?php if(session()->getFlashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-triangle mr-2"></i> <?= session()->getFlashdata('error') ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>
        
        <?php if(session()->getFlashdata('info')): ?>
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                <i class="fas fa-info-circle mr-2"></i> <?= session()->getFlashdata('info') ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>

        <?= $this->renderSection('content') ?>
        
      </div>
    </section>
    </div>
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Versi</b> 1.0
    </div>
    <strong>Copyright &copy; <?= date('Y') ?> Kantor Distrik Navigasi.</strong> All rights reserved.
  </footer>

</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

<script>
  // Agar nama file muncul saat diupload
  $(".custom-file-input").on("change", function() {
    var fileName = $(this).val().split("\\").pop();
    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
  });
</script>

</body>
</html>