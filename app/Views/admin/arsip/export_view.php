<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title><?= $title ?? 'Export Record' ?> - Distrik Navigasi Tanjungpinang</title>
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
                        secondary: "#fbb03b", 
                        "background-light": "#f8fafc",
                        "background-dark": "#0f172a",
                        "surface-light": "#ffffff",
                        "surface-dark": "#1e293b",
                        "sidebar-bg": "#ffffff",
                        "sidebar-active": "#eff6ff",
                    },
                    fontFamily: { display: ["Public Sans", "sans-serif"], },
                    boxShadow: { 'soft': '0 4px 6px -1px rgba(0, 0, 0, 0.02), 0 2px 4px -1px rgba(0, 0, 0, 0.02)', }
                },
            },
        }
    </script>
    <style>
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 3px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
    </style>
</head>
<body class="bg-background-light dark:bg-background-dark font-display text-slate-900 dark:text-slate-100 antialiased h-screen flex flex-col overflow-hidden">

<header class="h-16 bg-white dark:bg-surface-dark border-b border-slate-200 dark:border-slate-800 flex items-center justify-between px-6 z-20 shadow-sm flex-shrink-0">
    <div class="flex items-center gap-4">
        <div class="flex items-center gap-3">
            <div class="size-10 rounded-lg bg-primary flex items-center justify-center text-white shrink-0 shadow-lg shadow-blue-900/20">
                <span class="material-symbols-outlined text-2xl">anchor</span>
            </div>
            <div class="flex flex-col">
                <h1 class="text-slate-900 dark:text-white text-sm font-bold leading-tight">Distrik Navigasi</h1>
                <p class="text-slate-500 dark:text-slate-400 text-xs font-medium">Tanjungpinang - Kelas I</p>
            </div>
        </div>
        <div class="h-8 w-px bg-slate-200 dark:bg-slate-700 mx-2 hidden md:block"></div>
    </div>
    
    <div class="flex items-center gap-4">
        <div class="relative hidden sm:block">
            <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <span class="material-symbols-outlined text-slate-400 text-lg">search</span>
            </span>
            <input class="pl-9 pr-4 py-1.5 text-sm bg-slate-100 dark:bg-slate-800 border-none rounded-full w-64 focus:ring-2 focus:ring-primary/20 placeholder-slate-400 text-slate-700 dark:text-slate-200" placeholder="Global search..." type="text"/>
        </div>

        <a href="<?= base_url('admin/notifications') ?>" class="relative p-2 rounded-full text-slate-500 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors cursor-pointer">
    <span class="material-symbols-outlined">notifications</span>
    <span class="absolute top-2 right-2 w-2 h-2 bg-red-500 rounded-full border-2 border-white dark:border-surface-dark"></span>
</a>

        <div class="flex items-center gap-3 pl-4 border-l border-slate-200 dark:border-slate-700">
            <div class="text-right hidden sm:block">
                <p class="text-sm font-semibold text-slate-900 dark:text-white leading-none"><?= esc(session()->get('nama_lengkap') ?? 'Administrator') ?></p>
                <span class="inline-flex items-center gap-1 mt-1 px-1.5 py-0.5 rounded text-[10px] font-bold bg-primary/10 text-primary dark:text-blue-300 uppercase tracking-wide">
                    <?= esc(session()->get('role') ?? 'Admin Role') ?>
                </span>
            </div>
            <?php 
                $namaAdmin = session()->get('nama_lengkap') ?? 'Admin';
                $partsAdmin = explode(' ', $namaAdmin);
                $initialsAdmin = strtoupper(substr($partsAdmin[0], 0, 1) . (isset($partsAdmin[1]) ? substr($partsAdmin[1], 0, 1) : ''));
            ?>
            <div class="flex size-9 items-center justify-center rounded-full bg-slate-200 dark:bg-slate-700 border-2 border-white dark:border-slate-600 shadow-sm text-slate-600 dark:text-slate-300 font-bold text-xs">
                <?= $initialsAdmin ?>
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
            <a class="flex items-center gap-3 px-3 py-2 rounded-lg text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800 hover:text-primary dark:hover:text-white transition-colors group" href="<?= base_url('admin/arsip/search') ?>">
                <span class="material-symbols-outlined group-hover:text-primary dark:group-hover:text-blue-400 transition-colors">search</span>
                <span class="text-sm font-medium">Search Archives</span>
            </a>
            <a class="flex items-center gap-3 px-3 py-2 rounded-lg text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800 hover:text-primary dark:hover:text-white transition-colors group" href="<?= base_url('admin/arsip/create') ?>">
                <span class="material-symbols-outlined group-hover:text-primary dark:group-hover:text-blue-400 transition-colors">input</span>
                <span class="text-sm font-medium">Data Entry</span>
            </a>
            
            <a class="flex items-center gap-3 px-3 py-2 rounded-lg bg-primary text-white font-medium shadow-md shadow-primary/20 transition-all group" href="<?= base_url('admin/arsip/export') ?>">
                <span class="material-symbols-outlined filled">download</span>
                <span class="text-sm">Export Record</span>
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
        </nav>
    </aside>

    <main class="flex-1 flex flex-col overflow-hidden bg-slate-50/50 dark:bg-background-dark relative">
        <div class="flex-1 overflow-y-auto p-6 lg:p-8 scroll-smooth">
            <div class="max-w-5xl mx-auto">
                <div class="mb-8">
                    <nav class="flex text-sm text-slate-500 dark:text-slate-400 mb-1">
                        <a class="hover:text-primary" href="<?= base_url('admin/dashboard') ?>">Dashboard</a>
                        <span class="mx-2">/</span>
                        <span class="text-slate-800 dark:text-white font-medium">Export Record</span>
                    </nav>
                    <h2 class="text-2xl font-bold tracking-tight dark:text-white mt-2">Export Data Arsip</h2>
                    <p class="text-slate-500 dark:text-slate-400 mt-1 text-sm">Saring dan unduh data arsip Distrik Navigasi ke dalam format Excel (CSV).</p>
                </div>

                <?php if(session()->getFlashdata('error')): ?>
                    <div class="mb-6 p-4 bg-red-50 text-red-700 rounded-xl border border-red-200 text-sm font-semibold">
                        <span class="material-symbols-outlined align-middle mr-2">error</span> <?= session()->getFlashdata('error') ?>
                    </div>
                <?php endif; ?>

                <form action="<?= base_url('admin/arsip/export/process') ?>" method="POST">
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                        
                        <div class="lg:col-span-2 space-y-6">
                            <div class="bg-white dark:bg-surface-dark rounded-xl border border-slate-200 dark:border-slate-700 shadow-soft overflow-hidden">
                                <div class="px-6 py-4 border-b border-slate-200 dark:border-slate-700 bg-slate-50/50 dark:bg-slate-800/20">
                                    <h3 class="text-sm font-bold uppercase tracking-wider text-slate-600 dark:text-slate-300">Filter Parameters</h3>
                                </div>
                                <div class="p-6 space-y-6">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div class="flex flex-col gap-1.5">
                                            <label class="text-xs font-semibold text-slate-500 dark:text-slate-400 ml-1">Dari Tanggal</label>
                                            <div class="relative">
                                                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-lg">calendar_today</span>
                                                <input name="start_date" type="date" class="w-full bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-600 rounded-lg py-2 pl-10 pr-4 text-sm focus:ring-1 focus:ring-primary outline-none dark:text-white"/>
                                            </div>
                                        </div>
                                        <div class="flex flex-col gap-1.5">
                                            <label class="text-xs font-semibold text-slate-500 dark:text-slate-400 ml-1">Sampai Tanggal</label>
                                            <div class="relative">
                                                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-lg">event</span>
                                                <input name="end_date" type="date" class="w-full bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-600 rounded-lg py-2 pl-10 pr-4 text-sm focus:ring-1 focus:ring-primary outline-none dark:text-white"/>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div class="flex flex-col gap-1.5">
                                            <label class="text-xs font-semibold text-slate-500 dark:text-slate-400 ml-1">Jenis Arsip</label>
                                            <select name="jenis_arsip" class="w-full bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-600 rounded-lg py-2 px-3 text-sm focus:ring-1 focus:ring-primary outline-none dark:text-white">
                                                <option value="All Types">Semua Jenis</option>
                                                <option value="Nota Dinas">Nota Dinas</option>
                                                <option value="Surat Masuk">Surat Masuk</option>
                                                <option value="Surat Keluar">Surat Keluar</option>
                                            </select>
                                        </div>
                                        <div class="flex flex-col gap-1.5">
                                            <label class="text-xs font-semibold text-slate-500 dark:text-slate-400 ml-1">Lokasi Fisik</label>
                                            <div class="grid grid-cols-2 gap-2">
                                                <select name="ruangan" class="w-full bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-600 rounded-lg py-2 px-3 text-sm focus:ring-1 focus:ring-primary outline-none dark:text-white">
                                                    <option value="All Rooms">Semua Ruangan</option>
                                                    <?php foreach($ruangan as $r): ?>
                                                        <option value="<?= $r['nama_ruangan'] ?>"><?= $r['nama_ruangan'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <select name="lemari" class="w-full bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-600 rounded-lg py-2 px-3 text-sm focus:ring-1 focus:ring-primary outline-none dark:text-white">
                                                    <option value="All Cabinets">Semua Lemari</option>
                                                    <?php foreach($lemari as $l): ?>
                                                        <option value="<?= $l['nama_lemari'] ?>"><?= $l['nama_lemari'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-6">
                            <div class="bg-white dark:bg-surface-dark rounded-xl border border-slate-200 dark:border-slate-700 shadow-soft p-6">
                                <h3 class="text-sm font-bold uppercase tracking-wider text-slate-600 dark:text-slate-300 mb-6">Format File</h3>
                                <div class="space-y-3">
                                    <label class="relative flex items-center p-4 cursor-pointer rounded-xl border-2 border-slate-100 dark:border-slate-700 hover:border-primary/30 has-[:checked]:border-primary has-[:checked]:bg-primary/5 transition-all">
                                        <input type="radio" name="format" value="csv" checked class="sr-only"/>
                                        <div class="w-10 h-10 rounded-lg bg-green-100 dark:bg-green-900/30 text-green-600 flex items-center justify-center mr-4">
                                            <span class="material-symbols-outlined text-2xl">table_chart</span>
                                        </div>
                                        <div class="flex-1">
                                            <p class="text-sm font-bold dark:text-white">Excel (CSV)</p>
                                            <p class="text-[10px] text-slate-500 dark:text-slate-400">Cocok untuk Spreadsheet</p>
                                        </div>
                                        <div class="text-primary opacity-0 group-has-[:checked]:opacity-100"><span class="material-symbols-outlined">check_circle</span></div>
                                    </label>
                                </div>
                            </div>
                            
                            <button type="submit" class="w-full bg-primary hover:bg-blue-700 text-white font-bold py-4 rounded-xl shadow-lg shadow-primary/30 transition-all flex items-center justify-center gap-2 group mt-6">
                                <span class="material-symbols-outlined group-hover:scale-110 transition-transform">download</span>
                                Unduh Laporan
                            </button>
                        </div>
                    </div>
                </form>
                
            </div>
        </div>
    </main>
</div>
</body>
</html>