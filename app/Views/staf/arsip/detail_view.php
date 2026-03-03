<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title><?= $title ?? 'Detail Arsip' ?> - SiArsip Navigasi</title>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@400;500;700;900&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script>
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            colors: {
              "primary": "#135bec",
              "background-light": "#f6f6f8",
              "nav-blue": "#1e40af",
            },
            fontFamily: { "display": ["Public Sans", "sans-serif"] }
          }
        }
      }
    </script>
</head>
<body class="bg-background-light text-slate-900 min-h-screen flex flex-col font-display">

<header class="sticky top-0 z-50 w-full bg-nav-blue shadow-lg">
    <div class="mx-auto flex max-w-[1280px] items-center justify-between px-6 py-3">
        <div class="flex items-center gap-8">
            <div class="flex items-center gap-3">
                <div class="flex size-10 items-center justify-center rounded-lg bg-white/10 text-white backdrop-blur-sm">
                    <span class="material-symbols-outlined text-2xl">folder_managed</span>
                </div>
                <div>
                    <h2 class="text-lg font-bold leading-tight text-white">SiArsip</h2>
                    <p class="text-xs text-blue-200">Navigasi Tanjungpinang</p>
                </div>
            </div>
            <nav class="hidden items-center gap-1 md:flex">
    <a class="rounded-lg px-3 py-2 text-sm font-medium text-blue-100 hover:bg-white/10 hover:text-white transition-colors" href="<?= base_url('staf/dashboard') ?>">Dashboard</a>
    <a class="rounded-lg px-3 py-2 text-sm font-medium text-blue-100 hover:bg-white/10 hover:text-white transition-colors" href="<?= base_url('staf/arsip-masuk') ?>">Arsip Masuk</a>
    <a class="rounded-lg px-3 py-2 text-sm font-medium text-blue-100 hover:bg-white/10 hover:text-white transition-colors" href="<?= base_url('staf/arsip-keluar') ?>">Arsip Keluar</a>
    <a class="rounded-lg px-3 py-2 text-sm font-medium text-blue-100 hover:bg-white/10 hover:text-white transition-colors" href="<?= base_url('staf/nota-dinas') ?>">Nota Dinas</a>
<a class="rounded-lg px-3 py-2 text-sm font-medium text-blue-100 hover:bg-white/10 hover:text-white transition-colors <?= (url_is('staf/laporan')) ? 'bg-white/20 text-white shadow-sm' : '' ?>" href="<?= base_url('staf/laporan') ?>">Laporan</a>
</nav>
        </div>
        
        <div class="flex items-center gap-4">
            <div class="hidden w-64 md:block">
                <div class="relative flex items-center">
                    <span class="material-symbols-outlined absolute left-3 text-[20px] text-blue-300">search</span>
                    <input class="w-full rounded-lg border-none bg-blue-900/50 py-2 pl-10 pr-4 text-sm text-white placeholder-blue-300 focus:bg-blue-900 focus:ring-2 focus:ring-white/20" placeholder="Cari arsip..." type="text"/>
                </div>
            </div>
            
            <button class="relative flex size-9 items-center justify-center rounded-full text-blue-100 hover:bg-white/10 hover:text-white">
                <span class="material-symbols-outlined text-[20px]">notifications</span>
                <span class="absolute right-1.5 top-1.5 size-2 rounded-full bg-red-500 ring-2 ring-nav-blue"></span>
            </button>

            <div class="flex items-center gap-3 border-l border-blue-800 pl-4">
                <div class="hidden text-right md:block">
                    <p class="text-sm font-semibold text-white"><?= esc(session()->get('nama_lengkap') ?? 'User Staff') ?></p>
                    <p class="text-xs text-blue-200"><?= esc(session()->get('divisi') ?? 'Staff') ?></p>
                </div>
                
                <?php 
                    $nama = session()->get('nama_lengkap') ?? 'Staf';
                    $parts = explode(' ', $nama);
                    $initials = strtoupper(substr($parts[0], 0, 1) . (isset($parts[1]) ? substr($parts[1], 0, 1) : ''));
                ?>
                <button class="relative flex size-10 items-center justify-center overflow-hidden rounded-full border-2 border-blue-400/30 bg-white text-primary font-bold ring-2 ring-white/10 transition-all hover:ring-white/30">
                    <?= $initials ?>
                </button>
                <a href="<?= base_url('login/logout') ?>" class="text-blue-200 hover:text-red-400 ml-2 transition-colors" title="Logout">
                    <span class="material-symbols-outlined">logout</span>
                </a>
            </div>
        </div>
    </div>
</header>

<?php 
    $jenis = $arsip['jenis_arsip'];
    $badge_color = 'bg-slate-100 text-slate-600';
    $label_pengirim = 'Pengirim / Tujuan';
    $icon_pengirim = 'swap_horiz';

    if ($jenis == 'Surat Masuk') {
        $badge_color = 'bg-blue-100 text-blue-700';
        $label_pengirim = 'Pengirim Surat';
        $icon_pengirim = 'login';
    } elseif ($jenis == 'Surat Keluar') {
        $badge_color = 'bg-amber-100 text-amber-700';
        $label_pengirim = 'Tujuan Surat';
        $icon_pengirim = 'logout';
    } elseif ($jenis == 'Nota Dinas') {
        $badge_color = 'bg-purple-100 text-purple-700';
    }

    // Ekstrak Angka Rak untuk Visualisasi (Cari angka di string "Rak 2", dll)
    $nama_rak = $arsip['nama_rak'] ?? '';
    preg_match('!\d+!', $nama_rak, $matches);
    $nomor_rak = !empty($matches) ? (int)$matches[0] : 1; 
?>

<main class="flex-1 overflow-x-hidden px-4 py-8 md:px-8">
    <div class="mx-auto max-w-[1280px]">
        
        <nav class="mb-6 flex items-center text-sm text-slate-500">
            <a class="hover:text-primary" href="<?= base_url('staf/dashboard') ?>">Dashboard</a>
            <span class="mx-2 material-symbols-outlined text-[16px]">chevron_right</span>
            <span class="hover:text-primary cursor-pointer"><?= esc($jenis) ?></span>
            <span class="mx-2 material-symbols-outlined text-[16px]">chevron_right</span>
            <span class="font-medium text-slate-900">Detail <?= esc($arsip['nomor_surat']) ?></span>
        </nav>

        <div class="mb-8 flex flex-col justify-between gap-4 md:flex-row md:items-end">
            <div>
                <div class="mb-2 flex items-center gap-2">
                    <span class="rounded bg-green-100 px-2 py-0.5 text-xs font-semibold text-green-700">TERSEDIA</span>
                    <span class="rounded <?= $badge_color ?> px-2 py-0.5 text-xs font-semibold uppercase tracking-wider">
                        <?= esc($jenis) ?>
                    </span>
                </div>
                <h1 class="text-3xl font-black tracking-tight text-slate-900 md:text-4xl"><?= esc($arsip['perihal']) ?></h1>
                <p class="mt-2 text-lg text-slate-500">Nomor: <?= esc($arsip['nomor_surat']) ?></p>
            </div>
            <div class="flex gap-3">
                <button onclick="window.print()" class="flex items-center gap-2 rounded-lg border border-slate-200 bg-white px-4 py-2 text-sm font-medium text-slate-700 hover:bg-slate-50 transition-colors">
                    <span class="material-symbols-outlined text-[20px]">print</span> Cetak Data
                </button>
                <a href="<?= base_url('staf/arsip/edit/' . $arsip['id_arsip']) ?>" class="flex items-center gap-2 rounded-lg bg-primary px-4 py-2 text-sm font-medium text-white hover:bg-primary/90 shadow-sm shadow-primary/20 transition-all">
                    <span class="material-symbols-outlined text-[20px]">edit</span> Edit Data
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
            
            <div class="lg:col-span-2">
                <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">
                    <div class="border-b border-slate-100 px-6 py-4 bg-slate-50/50">
                        <h3 class="text-lg font-bold text-slate-900 flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary">description</span> Informasi Dokumen
                        </h3>
                    </div>
                    <div class="divide-y divide-slate-100 px-6">
                        <div class="grid grid-cols-1 gap-4 py-5 sm:grid-cols-3">
                            <dt class="text-sm font-medium text-slate-500">Nomor Dokumen</dt>
                            <dd class="text-sm font-bold text-slate-900 sm:col-span-2"><?= esc($arsip['nomor_surat']) ?></dd>
                        </div>
                        <div class="grid grid-cols-1 gap-4 py-5 sm:grid-cols-3">
                            <dt class="text-sm font-medium text-slate-500">Tanggal Surat</dt>
                            <dd class="text-sm text-slate-900 sm:col-span-2"><?= date('d F Y', strtotime($arsip['tanggal_surat'])) ?></dd>
                        </div>
                        <div class="grid grid-cols-1 gap-4 py-5 sm:grid-cols-3">
                            <dt class="text-sm font-medium text-slate-500">Klasifikasi</dt>
                            <dd class="text-sm text-slate-900 sm:col-span-2">
                                <span class="bg-slate-100 px-2 py-1 rounded text-xs font-bold text-slate-600 mr-1 border border-slate-200">KODE</span>
                                <?= esc($arsip['nama_klasifikasi'] ?? 'Umum') ?>
                            </dd>
                        </div>
                        <div class="grid grid-cols-1 gap-4 py-5 sm:grid-cols-3">
                            <dt class="text-sm font-medium text-slate-500"><?= $label_pengirim ?></dt>
                            <dd class="flex items-center gap-3 text-sm text-slate-900 sm:col-span-2">
                                <span class="flex size-8 items-center justify-center rounded-full bg-slate-100 text-slate-600">
                                    <span class="material-symbols-outlined text-sm"><?= $icon_pengirim ?></span>
                                </span>
                                <div>
                                    <p class="font-bold"><?= esc($arsip['pengirim_tujuan']) ?></p>
                                </div>
                            </dd>
                        </div>
                        <div class="grid grid-cols-1 gap-4 py-5 sm:grid-cols-3">
                            <dt class="text-sm font-medium text-slate-500">Keterangan Tambahan</dt>
                            <dd class="text-sm text-slate-900 sm:col-span-2 italic">
                                "<?= esc($arsip['keterangan'] ?? 'Tidak ada catatan tambahan.') ?>"
                            </dd>
                        </div>
                    </div>
                </div>

                <div class="mt-6 rounded-xl border border-blue-100 bg-blue-50/50 p-6">
                    <h4 class="mb-4 text-sm font-bold uppercase tracking-wider text-slate-600">Lampiran Digital</h4>
                    
                    <?php if(!empty($arsip['file_scan'])): ?>
                        <div class="flex items-center justify-between rounded-lg border border-slate-200 bg-white p-4 shadow-sm hover:border-primary/50 transition-colors">
                            <div class="flex items-center gap-4">
                                <div class="flex size-12 items-center justify-center rounded bg-red-50 text-red-500">
                                    <span class="material-symbols-outlined text-[28px]">picture_as_pdf</span>
                                </div>
                                <div>
                                    <p class="font-bold text-slate-900 line-clamp-1"><?= esc($arsip['file_scan']) ?></p>
                                    <p class="text-xs text-slate-500 mt-0.5">Disimpan pada: <?= date('d M Y, H:i', strtotime($arsip['created_at'])) ?></p>
                                </div>
                            </div>
                            <a href="<?= base_url('uploads/arsip/' . $arsip['file_scan']) ?>" target="_blank" class="flex size-10 items-center justify-center rounded-full bg-primary text-white hover:bg-blue-700 shadow-md shadow-primary/30 transition-all" title="Unduh File">
                                <span class="material-symbols-outlined text-[20px]">download</span>
                            </a>
                        </div>
                    <?php else: ?>
                        <div class="flex flex-col items-center justify-center p-6 border-2 border-dashed border-slate-300 rounded-xl bg-white">
                            <span class="material-symbols-outlined text-4xl text-slate-300 mb-2">scan_delete</span>
                            <p class="text-sm text-slate-500 font-medium">Belum ada file digital yang diunggah.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="lg:col-span-1">
                <div class="sticky top-24 rounded-xl border border-slate-200 bg-white shadow-lg overflow-hidden">
                    <div class="relative h-40 w-full bg-slate-800">
                        <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1497366216548-37526070297c?q=80&w=800&auto=format&fit=crop')] bg-cover bg-center opacity-40 mix-blend-overlay"></div>
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-900 to-transparent"></div>
                        <div class="absolute bottom-4 left-4 text-white">
                            <div class="flex items-center gap-2">
                                <span class="material-symbols-outlined text-[20px] text-green-400">location_on</span>
                                <span class="font-bold text-lg">Gudang Navigasi</span>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="mb-6 flex items-start justify-between">
                            <div>
                                <h3 class="text-xl font-bold text-slate-900">Penyimpanan Fisik</h3>
                                <p class="text-sm text-slate-500">Lokasi arsip asli saat ini</p>
                            </div>
                            <div class="flex size-10 items-center justify-center rounded-full bg-green-100 text-green-600">
                                <span class="material-symbols-outlined text-[24px]">inventory_2</span>
                            </div>
                        </div>
                        
                        <div class="space-y-4">
                            <div class="flex items-center gap-4 rounded-lg border border-slate-100 bg-slate-50 p-3">
                                <div class="flex size-10 shrink-0 items-center justify-center rounded-full bg-white text-primary shadow-sm border border-slate-100">
                                    <span class="material-symbols-outlined text-[20px]">door_open</span>
                                </div>
                                <div>
                                    <p class="text-[10px] font-bold uppercase tracking-widest text-slate-400">Ruangan</p>
                                    <p class="font-bold text-slate-800"><?= esc($arsip['nama_ruangan'] ?? 'Belum Diatur') ?></p>
                                </div>
                            </div>
                            <div class="flex items-center gap-4 rounded-lg border border-slate-100 bg-slate-50 p-3">
                                <div class="flex size-10 shrink-0 items-center justify-center rounded-full bg-white text-primary shadow-sm border border-slate-100">
                                    <span class="material-symbols-outlined text-[20px]">shelves</span>
                                </div>
                                <div>
                                    <p class="text-[10px] font-bold uppercase tracking-widest text-slate-400">Lemari</p>
                                    <p class="font-bold text-slate-800"><?= esc($arsip['nama_lemari'] ?? 'Belum Diatur') ?></p>
                                </div>
                            </div>
                            <div class="flex items-center gap-4 rounded-lg border border-primary/20 bg-primary/5 p-3 relative overflow-hidden">
                                <div class="absolute right-0 top-0 bottom-0 w-1 bg-primary"></div>
                                <div class="flex size-10 shrink-0 items-center justify-center rounded-full bg-primary text-white shadow-md shadow-primary/30">
                                    <span class="material-symbols-outlined text-[20px]">layers</span>
                                </div>
                                <div>
                                    <p class="text-[10px] font-bold uppercase tracking-widest text-primary/80">Posisi Rak</p>
                                    <p class="font-black text-primary text-base"><?= esc($arsip['nama_rak'] ?? 'Belum Diatur') ?></p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-6 border-t border-slate-100 pt-5">
                            <h4 class="mb-3 text-sm font-bold text-slate-900 flex items-center gap-2">
                                <span class="material-symbols-outlined text-slate-400 text-lg">grid_view</span> Visualisasi Lemari
                            </h4>
                            <div class="grid grid-cols-2 gap-2 rounded-xl bg-slate-100 p-3 border border-slate-200 inset-shadow-sm">
                                <?php 
                                // Looping untuk membuat 6 kotak (Asumsi 1 lemari ada 6 rak/box)
                                for ($i = 1; $i <= 6; $i++): 
                                    if ($i == $nomor_rak): ?>
                                        <div class="relative h-10 rounded-lg bg-primary/20 border-2 border-primary shadow-inner flex items-center justify-center">
                                            <span class="text-primary font-bold text-xs opacity-50">Rak <?= $i ?></span>
                                            <div class="absolute -right-2 -top-2 flex size-5 items-center justify-center rounded-full bg-primary shadow-md shadow-primary/40 text-white">
                                                <span class="material-symbols-outlined text-[12px] font-bold">check</span>
                                            </div>
                                        </div>
                                    <?php else: ?>
                                        <div class="h-10 rounded-lg bg-slate-200 border border-slate-300/50 flex items-center justify-center">
                                            <span class="text-slate-400 font-bold text-xs opacity-50">Rak <?= $i ?></span>
                                        </div>
                                    <?php endif; 
                                endfor; 
                                ?>
                            </div>
                            <p class="mt-3 text-center text-xs font-medium text-slate-500 bg-slate-50 py-1.5 rounded-md border border-slate-100">
                                Dokumen ada di: <strong class="text-primary"><?= esc($arsip['nama_lemari'] ?? 'Lemari') ?>, <?= esc($arsip['nama_rak'] ?? 'Rak') ?></strong>
                            </p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
</body>
</html>