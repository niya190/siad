<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SIAD | Distrik Navigasi</title>

  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">

  <style>
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #f4f6f9;
    }
    
    /* Navbar Putih Bersih */
    .main-header {
        border-bottom: none;
        box-shadow: 0 2px 15px rgba(0,0,0,0.05);
    }

    /* Sidebar Biru Gelap Navigasi */
    .main-sidebar {
        background: #0f172a; /* Biru Laut Gelap */
    }
    .brand-link {
        border-bottom: 1px solid rgba(255,255,255,0.1);
        background-color: #0f172a;
    }

    /* Card Modern (Rounded & Soft Shadow) */
    .card {
        border-radius: 12px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
        border: none;
    }
    .card-header {
        background-color: transparent;
        border-bottom: 1px solid #f0f0f0;
        padding: 1.5rem;
    }

    /* Tombol-tombol */
    .btn {
        border-radius: 8px;
        font-weight: 500;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 0.5px;
    }
    
    /* Aksen Emas (Khas Pejabat/Pemerintah) */
    .accent-gold {
        color: #d97706;
    }
    
    /* Nav Link Active yang lebih modern */
    .nav-pills .nav-link.active, .nav-pills .show>.nav-link {
        background-color: #3b82f6; /* Biru Cerah */
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(59, 130, 246, 0.4);
    }
  </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <span class="nav-link font-weight-bold text-dark">SISTEM INFORMASI ARSIP DINAMIS (SIAD)</span>
      </li>
    </ul>

    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
         <div class="user-panel d-flex align-items-center mt-1">
            <div class="image mr-2">
              <img src="https://ui-avatars.com/api/?name=<?= urlencode(session()->get('nama_user')) ?>&background=0D8ABC&color=fff&size=128" class="img-circle elevation-1" alt="User Image">
            </div>
            <div class="info lh-1">
              <a href="#" class="d-block text-dark font-weight-bold"><?= session()->get('nama_user') ?></a>
              <small class="text-muted badge badge-light border"><?= strtoupper(session()->get('role')) ?></small>
            </div>
        </div>
      </li>
      <li class="nav-item ml-3">
        <a class="nav-link text-danger" href="<?= base_url('logout') ?>" role="button" title="Keluar Aplikasi">
          <i class="fas fa-power-off"></i>
        </a>
      </li>
    </ul>
  </nav>

  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="#" class="brand-link">
      <span class="brand-image img-circle elevation-3" style="opacity: .8; display:flex; justify-content:center; align-items:center; width:33px; height:33px; background:#fff; color:#0f172a">
        <i class="fas fa-anchor"></i>
      </span>
      <span class="brand-text font-weight-bold pl-2" style="letter-spacing: 1px;">NAVIGASI</span>
    </a>

    <div class="sidebar">
      <nav class="mt-4">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          
          <?php if(session()->get('role') == 'staf'): ?>
            <li class="nav-header text-muted font-weight-bold">MENU UTAMA</li>
            
            <li class="nav-item mb-1">
                <a href="<?= base_url('staf/dashboard') ?>" class="nav-link <?= (uri_string() == 'staf/dashboard') ? 'active' : '' ?>">
                <i class="nav-icon fas fa-home"></i>
                <p>Dashboard</p>
                </a>
            </li>

            <li class="nav-item mb-1">
                <a href="<?= base_url('staf/arsip') ?>" class="nav-link <?= (strpos(uri_string(), 'staf/arsip') !== false) ? 'active' : '' ?>">
                    <i class="nav-icon fas fa-folder-open"></i>
                    <p>Arsip Digital</p>
                </a>
            </li>
          <?php endif; ?>

          <?php if(session()->get('role') == 'pimpinan'): ?>
             <?php endif; ?>

          <li class="nav-header mt-3 text-muted font-weight-bold">PENGATURAN</li>
          <li class="nav-item">
            <a href="<?= base_url('logout') ?>" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>Logout</p>
            </a>
          </li>

        </ul>
      </nav>
    </div>
  </aside>

  <div class="content-wrapper">
    <?php if(!empty($title)): ?>
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="font-weight-bold text-dark" style="font-size: 1.5rem;"><?= $title ?></h1>
          </div>
        </div>
      </div>
    </section>
    <?php endif; ?>

    <section class="content">
      <div class="container-fluid">
        <?php if(session()->getFlashdata('success')): ?>
            <div class="alert alert-success border-0 shadow-sm" style="background-color: #d1fae5; color: #065f46;">
                <i class="fas fa-check-circle mr-2"></i> <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <?= $this->renderSection('content') ?>
      </div>
    </section>
  </div>

  <footer class="main-footer text-sm">
    <div class="float-right d-none d-sm-block">
      <b>Versi</b> 2.0 (Pro)
    </div>
    <strong>Copyright &copy; <?= date('Y') ?> <span style="color: #0f172a;">Kantor Distrik Navigasi</span>.</strong> All rights reserved.
  </footer>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

<script>
  $(".custom-file-input").on("change", function() {
    var fileName = $(this).val().split("\\").pop();
    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
  });
</script>
</body>
</html>