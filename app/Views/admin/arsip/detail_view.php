<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title><?= $title ?> - Admin SIAD</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        primary: "#0e4c92",
                        "background-light": "#f8fafc",
                        "background-dark": "#0f172a",
                        "surface-dark": "#1e293b",
                        "sidebar-bg": "#ffffff",
                    },
                    fontFamily: { display: ["Public Sans", "sans-serif"] },
                },
            },
        }
    </script>
</head>
<body class="bg-background-light dark:bg-background-dark font-display text-slate-900 dark:text-slate-100 antialiased h-screen flex flex-col overflow-hidden">

<header class="h-16 bg-white dark:bg-surface-dark border-b border-slate-200 dark:border-slate-800 flex items-center justify-between px-6 z-20 shadow-sm flex-shrink-0">
    <div class="flex items-center gap-4">
        <div class="flex items-center gap-3">
           <div class="size-10 rounded-lg bg-white flex items-center justify-center shrink-0 shadow-lg overflow-hidden">
    <img src="<?= base_url('assets/img/logo.JPEG') ?>" 
         alt="Logo Distrik Navigasi" 
         class="h-8 w-auto object-contain">
</div>
            <div class="flex flex-col">
                <h1 class="text-slate-900 dark:text-white text-sm font-bold leading-tight">Distrik Navigasi</h1>
                <p class="text-slate-500 dark:text-slate-400 text-xs font-medium">Tanjungpinang - Kelas I</p>
            </div>
        </div>
        <div class="h-8 w-px bg-slate-200 dark:bg-slate-700 mx-2 hidden md:block"></div>
        
    </div>
    <div class="flex items-center gap-4">
        

       
        <div class="flex items-center gap-3 pl-4 border-l border-slate-200 dark:border-slate-700">
            <div class="text-right hidden sm:block">
    <p class="text-sm font-semibold text-slate-900 dark:text-white leading-none">
        <?= esc(session()->get('nama_lengkap') ?? 'Administrator') ?>
    </p>
    <div class="flex items-center justify-end gap-2 mt-1">
        
        <?php 
            // Ambil data NIP langsung dari session
            $nipPegawai = session()->get('nip');
            
            // Logika Pintar: Tampilkan tulisan NIP HANYA kalau datanya ada (bukan NULL atau kosong)
            if (!empty($nipPegawai)) : 
        ?>
            <span class="text-[10px] font-medium text-slate-500 dark:text-slate-400 tracking-wider">
                NIP: <?= esc($nipPegawai) ?>
            </span>
        <?php endif; ?>
        
        <span class="inline-flex items-center gap-1 px-1.5 py-0.5 rounded text-[10px] font-bold bg-primary/10 text-primary dark:text-blue-300 uppercase tracking-wide">
            <?= esc(session()->get('role') ?? 'Admin') ?>
        </span>
    </div>
</div>

            <a href="<?= base_url('login/logout') ?>" class="text-slate-400 hover:text-red-500 ml-1 transition-colors" title="Logout">
                <span class="material-symbols-outlined text-2xl">logout</span>
            </a>
        </div>
    </div>
</header>
<div class="flex flex-1 overflow-hidden">
    <aside class="w-64 bg-sidebar-bg dark:bg-surface-dark border-r border-slate-200 dark:border-slate-800 flex flex-col flex-shrink-0 z-10">
        <div class="p-4 border-b border-slate-100 dark:border-slate-800/50">
            <button class="w-full flex items-center justify-between px-3 py-2 bg-slate-50 dark:bg-slate-800/50 rounded-lg border border-slate-200 dark:border-slate-700 hover:border-primary/30 transition-colors group">
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary text-xl">admin_panel_settings</span>
                    <span class="text-sm font-medium text-slate-700 dark:text-slate-200">Admin View</span>
                </div>
                <span class="material-symbols-outlined text-slate-400 text-sm group-hover:text-primary transition-colors">expand_more</span>
            </button>
        </div>
        <nav class="flex-1 overflow-y-auto py-4 px-3 space-y-1">
            <div class="px-3 mb-2 text-xs font-semibold text-slate-400 uppercase tracking-wider">Main Menu</div>
            <a class="flex items-center gap-3 px-3 py-2 rounded-lg text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800 hover:text-primary dark:hover:text-white transition-colors group" href="<?= base_url('admin/dashboard') ?>">
                <span class="material-symbols-outlined group-hover:text-primary dark:group-hover:text-blue-400 transition-colors">dashboard</span>
                <span class="text-sm font-medium">Dashboard</span>
            </a>
            <a class="flex items-center gap-3 px-3 py-2 rounded-lg bg-primary text-white font-medium shadow-md shadow-primary/20 transition-all group" href="<?= base_url('admin/arsip/search') ?>">
                <span class="material-symbols-outlined filled">search</span>
                <span class="text-sm">Search Archives</span>
            </a>
            <a class="flex items-center gap-3 px-3 py-2 rounded-lg text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800 hover:text-primary dark:hover:text-white transition-colors group" href="<?= base_url('admin/arsip/create') ?>">
                <span class="material-symbols-outlined group-hover:text-primary dark:group-hover:text-blue-400 transition-colors">input</span>
                <span class="text-sm font-medium">Data Entry</span>
            </a>
            <div class="mt-6 mb-2 px-3 text-xs font-semibold text-slate-400 uppercase tracking-wider">Administrative</div>
            <a class="flex items-center gap-3 px-3 py-2 rounded-lg text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800 hover:text-primary dark:hover:text-white transition-colors group" href="<?= base_url('admin/lemari') ?>">
                <span class="material-symbols-outlined group-hover:text-primary dark:group-hover:text-blue-400 transition-colors">folder_managed</span>
                <span class="text-sm font-medium">Archive Manager</span>
            </a>
            <a class="flex items-center gap-3 px-3 py-2 rounded-lg text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800 hover:text-primary dark:hover:text-white transition-colors group" href="<?= base_url('admin/user') ?>">
                <span class="material-symbols-outlined group-hover:text-primary dark:group-hover:text-blue-400 transition-colors">people</span>
                <span class="text-sm font-medium">User Management</span>
            </a>
           <a class="flex items-center gap-3 px-3 py-2 rounded-lg text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800 hover:text-primary dark:hover:text-white transition-colors group" 
   href="<?= base_url('admin/settings') ?>">  <span class="material-symbols-outlined group-hover:text-primary dark:group-hover:text-blue-400 transition-colors">settings_applications</span>
    <span class="text-sm font-medium">System Settings</span>
</a>
        </nav>
        <div class="p-4 border-t border-slate-200 dark:border-slate-800">
            
        </div>
    </aside>

    <main class="flex-1 flex flex-col overflow-hidden bg-slate-50/50 dark:bg-background-dark relative">
        <div class="flex-1 overflow-y-auto p-6 lg:p-8 scroll-smooth">
            
            <div class="max-w-5xl mx-auto w-full">
                
                <div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-4 pb-4 border-b border-slate-200 dark:border-slate-700 mb-6">
                    <div>
                        <nav class="flex text-sm text-slate-500 dark:text-slate-400 mb-1">
                            <a class="hover:text-primary" href="<?= base_url('admin/dashboard') ?>">Home</a>
                            <span class="mx-2">/</span>
                            <a class="hover:text-primary" href="<?= base_url('admin/arsip/search') ?>">Pencarian</a>
                            <span class="mx-2">/</span>
                            <span class="text-slate-800 dark:text-white font-medium">Detail Naskah</span>
                        </nav>
                        <h2 class="text-2xl font-bold text-slate-900 dark:text-white flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary">description</span> 
                            Rincian Arsip Surat
                        </h2>
                    </div>
                    <div class="flex gap-2">
                        <a href="<?= base_url('admin/arsip/search') ?>" class="flex items-center gap-2 px-4 py-2 bg-white dark:bg-surface-dark border border-slate-200 dark:border-slate-700 rounded-lg text-sm font-medium text-slate-700 dark:text-slate-200 hover:bg-slate-50 dark:hover:bg-slate-800 shadow-sm transition-all">
                            <span class="material-symbols-outlined text-lg">arrow_back</span> Kembali
                        </a>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    
                    <div class="lg:col-span-2 space-y-6">
                        
                        <div class="bg-white dark:bg-surface-dark rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 overflow-hidden">
                            <div class="p-5 border-b border-slate-100 dark:border-slate-800 flex justify-between items-center bg-slate-50 dark:bg-slate-800/50">
                                <h3 class="font-bold text-slate-800 dark:text-white flex items-center gap-2">
                                    <span class="material-symbols-outlined text-primary">info</span> Identitas Surat
                                </h3>
                                <span class="px-3 py-1 bg-blue-100 text-blue-700 text-xs font-bold rounded-full border border-blue-200">
                                    <?= esc($arsip['jenis_arsip']) ?>
                                </span>
                            </div>
                            <div class="p-6">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-y-6 gap-x-4">
                                    <div>
                                        <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Nomor Surat</p>
                                        <p class="text-base font-bold text-slate-900 dark:text-white bg-slate-50 dark:bg-slate-800 p-2 rounded border border-slate-100 dark:border-slate-700 inline-block">
                                            <?= esc($arsip['nomor_surat']) ?>
                                        </p>
                                    </div>
                                    <div>
                                        <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Klasifikasi</p>
                                        <p class="text-sm text-slate-800 dark:text-slate-200 font-medium">
                                            <?= esc($arsip['kode_klasifikasi'] ?? '-') ?> <br>
                                            <span class="text-xs text-slate-500 font-normal"><?= esc($arsip['nama_klasifikasi'] ?? 'Belum ada klasifikasi') ?></span>
                                        </p>
                                    </div>
                                    <div>
                                        <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Tgl. Surat</p>
                                        <p class="text-sm text-slate-800 dark:text-slate-200 font-medium flex items-center gap-1">
                                            <span class="material-symbols-outlined text-[16px] text-slate-400">calendar_month</span> 
                                            <?= date('d F Y', strtotime($arsip['tanggal_surat'])) ?>
                                        </p>
                                    </div>
                                    <div>
                                        <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Tgl. Diterima / Direkam</p>
                                        <p class="text-sm text-slate-800 dark:text-slate-200 font-medium flex items-center gap-1">
                                            <span class="material-symbols-outlined text-[16px] text-slate-400">event_available</span> 
                                            <?= date('d F Y', strtotime($arsip['tanggal_terima'])) ?>
                                        </p>
                                    </div>
                                    <div class="md:col-span-2">
                                        <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Pengirim / Tujuan</p>
                                        <p class="text-sm text-slate-800 dark:text-slate-200 font-medium border-l-4 border-primary pl-3 py-1 bg-blue-50/50 dark:bg-blue-900/10">
                                            <?= esc($arsip['pengirim_tujuan']) ?>
                                        </p>
                                    </div>
                                    <div class="md:col-span-2">
                                        <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Perihal / Isi Ringkas</p>
                                        <p class="text-sm text-slate-800 dark:text-slate-200 leading-relaxed bg-slate-50 dark:bg-slate-800 p-3 rounded-lg border border-slate-100 dark:border-slate-700">
                                            <?= nl2br(esc($arsip['perihal'])) ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="space-y-6">
                        
                        <div class="bg-white dark:bg-surface-dark rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 overflow-hidden">
                            <div class="p-5 border-b border-slate-100 dark:border-slate-800 flex justify-between items-center bg-emerald-50 dark:bg-emerald-900/20">
                                <h3 class="font-bold text-emerald-800 dark:text-emerald-400 flex items-center gap-2">
                                    <span class="material-symbols-outlined">inventory_2</span> Lokasi Fisik
                                </h3>
                            </div>
                            <div class="p-6">
                                <?php if(!empty($arsip['nama_rak'])): ?>
                                    <div class="relative pl-6 space-y-4 before:absolute before:inset-y-2 before:left-[11px] before:w-0.5 before:bg-slate-200 dark:before:bg-slate-700">
                                        
                                        <div class="relative">
                                            <div class="absolute -left-[29px] top-1 h-3 w-3 rounded-full bg-slate-300 ring-4 ring-white dark:ring-slate-900"></div>
                                            <p class="text-xs text-slate-500 uppercase font-semibold">Gedung</p>
                                            <p class="text-sm font-bold text-slate-800 dark:text-slate-200"><?= esc($arsip['nama_gedung'] ?? '-') ?></p>
                                        </div>
                                        
                                        <div class="relative">
                                            <div class="absolute -left-[29px] top-1 h-3 w-3 rounded-full bg-slate-300 ring-4 ring-white dark:ring-slate-900"></div>
                                            <p class="text-xs text-slate-500 uppercase font-semibold">Ruangan</p>
                                            <p class="text-sm font-bold text-slate-800 dark:text-slate-200"><?= esc($arsip['nama_ruangan'] ?? '-') ?></p>
                                        </div>
                                        
                                        <div class="relative">
                                            <div class="absolute -left-[29px] top-1 h-3 w-3 rounded-full bg-slate-400 ring-4 ring-white dark:ring-slate-900"></div>
                                            <p class="text-xs text-slate-500 uppercase font-semibold">Lemari</p>
                                            <p class="text-sm font-bold text-slate-800 dark:text-slate-200"><?= esc($arsip['nama_lemari'] ?? '-') ?></p>
                                        </div>
                                        
                                        <div class="relative">
                                            <div class="absolute -left-[31px] top-0 h-4 w-4 rounded-full bg-emerald-500 ring-4 ring-emerald-100 dark:ring-emerald-900/30 flex items-center justify-center"></div>
                                            <p class="text-xs text-emerald-600 dark:text-emerald-400 uppercase font-bold">Rak / Box Target</p>
                                            <p class="text-lg font-black text-emerald-700 dark:text-emerald-300 bg-emerald-50 dark:bg-emerald-900/30 inline-block px-2 py-0.5 rounded border border-emerald-200 mt-1">
                                                <?= esc($arsip['nama_rak']) ?>
                                            </p>
                                        </div>
                                    </div>
                                <?php else: ?>
                                    <div class="text-center py-4">
                                        <span class="material-symbols-outlined text-4xl text-slate-300 mb-2">help_center</span>
                                        <p class="text-sm font-semibold text-slate-500">Lokasi belum diatur.</p>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="bg-white dark:bg-surface-dark rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 overflow-hidden">
                            <div class="p-5 border-b border-slate-100 dark:border-slate-800 flex justify-between items-center bg-rose-50 dark:bg-rose-900/20">
                                <h3 class="font-bold text-rose-800 dark:text-rose-400 flex items-center gap-2">
                                    <span class="material-symbols-outlined">picture_as_pdf</span> File Scan PDF
                                </h3>
                            </div>
                            <div class="p-6 text-center">
                                <?php if(!empty($arsip['file_scan'])): ?>
                                    <span class="material-symbols-outlined text-5xl text-rose-500 mb-3 block">task</span>
                                    <p class="text-sm font-bold text-slate-800 dark:text-slate-200 mb-4 truncate" title="<?= esc($arsip['file_scan']) ?>">
                                        <?= esc($arsip['file_scan']) ?>
                                    </p>
                                    <a href="<?= base_url('uploads/arsip/' . $arsip['file_scan']) ?>" target="_blank" class="w-full inline-flex items-center justify-center gap-2 bg-rose-600 hover:bg-rose-700 text-white font-bold py-2.5 px-4 rounded-lg shadow-sm transition-colors text-sm">
                                        <span class="material-symbols-outlined text-[18px]">visibility</span> Lihat Dokumen
                                    </a>
                                <?php else: ?>
                                    <span class="material-symbols-outlined text-5xl text-slate-300 mb-3 block">scan_delete</span>
                                    <p class="text-sm font-semibold text-slate-500">Tidak ada file digital yang dilampirkan.</p>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="bg-white dark:bg-surface-dark rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 p-5 text-center">
                            <p class="text-xs text-slate-500">
                                Direkam oleh: <br>
                                <span class="font-bold text-slate-800 dark:text-slate-200"><?= esc($arsip['nama_petugas'] ?? 'Staf / Admin') ?></span>
                            </p>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </main>
</div>

</body>
</html>