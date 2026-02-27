<!DOCTYPE html>
<html lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Unified Archive Management System - Distrik Navigasi Tanjungpinang</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
<script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        primary: "#0e4c92", // Deep Ministry Blue
                        secondary: "#fbb03b", // Gold Accent
                        "background-light": "#f8fafc",
                        "background-dark": "#0f172a",
                        "surface-light": "#ffffff",
                        "surface-dark": "#1e293b",
                        "sidebar-bg": "#ffffff",
                        "sidebar-active": "#eff6ff",
                    },
                    fontFamily: {
                        display: ["Public Sans", "sans-serif"],
                    },
                    boxShadow: {
                        'soft': '0 4px 6px -1px rgba(0, 0, 0, 0.02), 0 2px 4px -1px rgba(0, 0, 0, 0.02)',
                    }
                },
            },
        }
    </script>
<style>
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        ::-webkit-scrollbar-track {
            background: transparent;
        }
        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 3px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
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
<nav class="hidden md:flex items-center gap-1">
    <a class="px-3 py-1.5 text-sm font-medium text-slate-600 dark:text-slate-300 hover:text-primary dark:hover:text-white hover:bg-slate-50 dark:hover:bg-slate-800 rounded-md transition-colors cursor-pointer" onclick="alert('Pusat Bantuan sedang dalam perbaikan.')">Help Center</a>
    <a class="px-3 py-1.5 text-sm font-medium text-slate-600 dark:text-slate-300 hover:text-primary dark:hover:text-white hover:bg-slate-50 dark:hover:bg-slate-800 rounded-md transition-colors cursor-pointer" onclick="alert('Dokumentasi Sistem v1.0 segera dirilis.')">Documentation</a>
</nav>
</div>
<div class="flex items-center gap-4">
<form action="<?= base_url('admin/arsip/search') ?>" method="GET" class="relative hidden sm:block">
    <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
        <span class="material-symbols-outlined text-slate-400 text-lg">search</span>
    </span>
    <input name="keyword" class="pl-9 pr-4 py-1.5 text-sm bg-slate-100 dark:bg-slate-800 border-none rounded-full w-64 focus:ring-2 focus:ring-primary/20 placeholder-slate-400 text-slate-700 dark:text-slate-200" placeholder="Global search..." type="text"/>
</form>
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
                // Membuat inisial dari nama
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
<a class="flex items-center gap-3 px-3 py-2 rounded-lg bg-primary text-white font-medium shadow-md shadow-primary/20 transition-all group" href="<?= base_url('admin/dashboard') ?>">
<span class="material-symbols-outlined filled">dashboard</span>
<span class="text-sm">Dashboard</span>
</a>
<a class="flex items-center gap-3 px-3 py-2 rounded-lg text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800 hover:text-primary dark:hover:text-white transition-colors group" href="<?= base_url('admin/arsip/search') ?>">
    <span class="material-symbols-outlined group-hover:text-primary dark:group-hover:text-blue-400 transition-colors">search</span>
    <span class="text-sm font-medium">Search Archives</span>
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
<div class="bg-blue-50 dark:bg-blue-900/20 rounded-lg p-3">
<div class="flex items-center gap-2 mb-2">
<span class="material-symbols-outlined text-primary dark:text-blue-400">cloud_sync</span>
<span class="text-xs font-bold text-primary dark:text-blue-400">System Status</span>
</div>
<div class="w-full bg-blue-200 dark:bg-blue-800 rounded-full h-1.5 mb-1">
<div class="bg-primary h-1.5 rounded-full" style="width: 98%"></div>
</div>
<p class="text-[10px] text-slate-500 dark:text-slate-400 text-right">Online (98%)</p>
</div>
</div>
</aside>

<main class="flex-1 flex flex-col overflow-hidden bg-slate-50/50 dark:bg-background-dark relative">
<div class="flex-1 overflow-y-auto p-6 lg:p-8 scroll-smooth">
<div class="max-w-6xl mx-auto space-y-6">
<div class="flex justify-between items-end pb-2">
<div>
<nav class="flex text-sm text-slate-500 dark:text-slate-400 mb-1">
<a class="hover:text-primary" href="<?= base_url('admin/dashboard') ?>">Home</a>
<span class="mx-2">/</span>
<span class="text-slate-800 dark:text-white font-medium">Dashboard Overview</span>
</nav>
<h2 class="text-2xl font-bold text-slate-900 dark:text-white">Archive Dashboard</h2>
</div>
<div class="flex gap-3">
<a href="<?= base_url('admin/arsip/export') ?>" class="flex items-center gap-2 px-4 py-2 bg-white dark:bg-surface-dark border border-slate-200 dark:border-slate-700 rounded-lg text-sm font-medium text-slate-700 dark:text-slate-200 hover:bg-slate-50 dark:hover:bg-slate-800 shadow-sm transition-all cursor-pointer w-fit">
    <span class="material-symbols-outlined text-lg">download</span>
    Export Report
</a>
<a href="<?= base_url('admin/arsip/create') ?>" class="flex items-center gap-2 bg-primary hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow-md shadow-blue-500/20 transition-all font-medium text-sm">
<span class="material-symbols-outlined text-lg">add</span>
                                Add New Record
                            </a>
</div>
</div>
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
<div class="bg-white dark:bg-surface-dark rounded-xl p-6 shadow-soft border border-slate-100 dark:border-slate-700 flex flex-col justify-between group hover:border-blue-200 dark:hover:border-blue-800 transition-all">
<div class="flex justify-between items-start mb-4">
<div class="p-3 bg-blue-50 dark:bg-blue-900/30 rounded-lg text-primary dark:text-blue-400">
<span class="material-symbols-outlined text-2xl">inventory_2</span>
</div>
<span class="text-xs font-medium text-emerald-600 bg-emerald-50 dark:bg-emerald-900/20 px-2 py-1 rounded-full flex items-center gap-1">
<span class="material-symbols-outlined text-sm">trending_up</span> +5.2%
                                </span>
</div>
<div>
<h3 class="text-3xl font-bold text-slate-900 dark:text-white mb-1"><?= number_format($total_archives ?? 0) ?></h3>
<p class="text-sm text-slate-500 dark:text-slate-400 font-medium">Total Archives Stored</p>
</div>
</div>
<div class="bg-white dark:bg-surface-dark rounded-xl p-6 shadow-soft border border-slate-100 dark:border-slate-700 flex flex-col justify-between group hover:border-secondary/50 dark:hover:border-secondary/30 transition-all">
<div class="flex justify-between items-start mb-4">
<div class="p-3 bg-amber-50 dark:bg-amber-900/30 rounded-lg text-secondary dark:text-amber-400">
<span class="material-symbols-outlined text-2xl">schedule</span>
</div>
<span class="text-xs font-medium text-emerald-600 bg-emerald-50 dark:bg-emerald-900/20 px-2 py-1 rounded-full flex items-center gap-1">
<span class="material-symbols-outlined text-sm">trending_up</span> +12%
                                </span>
</div>
<div>
<h3 class="text-3xl font-bold text-slate-900 dark:text-white mb-1"><?= number_format($new_entries ?? 0) ?></h3>
<p class="text-sm text-slate-500 dark:text-slate-400 font-medium">New Entries (This Week)</p>
</div>
</div>
<div class="bg-white dark:bg-surface-dark rounded-xl p-6 shadow-soft border border-slate-100 dark:border-slate-700 flex flex-col justify-between group hover:border-red-200 dark:hover:border-red-800 transition-all">
<div class="flex justify-between items-start mb-4">
<div class="p-3 bg-red-50 dark:bg-red-900/30 rounded-lg text-red-500 dark:text-red-400">
<span class="material-symbols-outlined text-2xl">hourglass_bottom</span>
</div>
<span class="text-xs font-medium text-red-600 bg-red-50 dark:bg-red-900/20 px-2 py-1 rounded-full flex items-center gap-1">
<span class="material-symbols-outlined text-sm">warning</span> Action
                                </span>
</div>
<div>
<h3 class="text-3xl font-bold text-slate-900 dark:text-white mb-1"><?= $expiring_records ?? 0 ?></h3>
<p class="text-sm text-slate-500 dark:text-slate-400 font-medium">Expiring Records</p>
</div>
</div>
</div>
<div class="bg-white dark:bg-surface-dark rounded-xl border border-slate-200 dark:border-slate-700 shadow-sm overflow-hidden">
<div class="p-5 border-b border-slate-200 dark:border-slate-700 bg-slate-50/50 dark:bg-slate-800/20">
<div class="flex flex-col lg:flex-row gap-4 justify-between items-center">
<div class="flex items-center gap-2 w-full lg:w-auto">
<h3 class="font-bold text-slate-900 dark:text-white whitespace-nowrap">Document Archives</h3>
<div class="h-4 w-px bg-slate-300 dark:bg-slate-600 mx-2 hidden lg:block"></div>
<div class="flex gap-2 overflow-x-auto pb-1 lg:pb-0 w-full lg:w-auto">
<button class="px-3 py-1.5 text-xs font-medium bg-white dark:bg-slate-700 border border-slate-200 dark:border-slate-600 rounded-full text-slate-700 dark:text-slate-200 shadow-sm hover:border-primary hover:text-primary transition-colors whitespace-nowrap">All Files</button>
</div>
</div>
<div class="flex items-center gap-2 w-full lg:w-auto">
<div class="relative flex-1 lg:flex-none lg:w-64">
<span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
<span class="material-symbols-outlined text-slate-400 text-sm">search</span>
</span>
<input class="block w-full pl-9 pr-3 py-2 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-600 rounded-lg text-sm focus:ring-1 focus:ring-primary focus:border-primary placeholder-slate-400" placeholder="Filter by keyword..." type="text"/>
</div>
</div>
</div>
</div>
<div class="overflow-x-auto">
<table class="w-full text-sm text-left">
<thead class="text-xs text-slate-500 dark:text-slate-400 uppercase bg-slate-50 dark:bg-slate-800/50 border-b border-slate-200 dark:border-slate-700">
<tr>
<th class="px-6 py-4 font-semibold w-12">No</th>
<th class="px-6 py-4 font-semibold" scope="col">Reference / Subject</th>
<th class="px-6 py-4 font-semibold" scope="col">Category</th>
<th class="px-6 py-4 font-semibold" scope="col">Date</th>
<th class="px-6 py-4 font-semibold text-right" scope="col">Actions</th>
</tr>
</thead>
<tbody class="divide-y divide-slate-200 dark:divide-slate-700">
<?php if(empty($recent_archives)): ?>
<tr>
    <td colspan="5" class="px-6 py-4 text-center text-slate-500">Belum ada data arsip.</td>
</tr>
<?php else: ?>
    <?php $no = 1; foreach($recent_archives as $arsip): ?>
    <tr class="group hover:bg-blue-50/50 dark:hover:bg-blue-900/10 transition-colors">
        <td class="px-6 py-4"><?= $no++ ?></td>
        <td class="px-6 py-4">
            <div class="flex flex-col">
                <span class="font-medium text-slate-900 dark:text-white group-hover:text-primary transition-colors">
                    <?= esc($arsip['nomor_surat']) ?>
                </span>
                <span class="text-xs text-slate-500 dark:text-slate-400 truncate max-w-xs">
                    <?= esc($arsip['perihal']) ?>
                </span>
            </div>
        </td>
        <td class="px-6 py-4">
            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-xs font-medium bg-slate-100 text-slate-700 dark:bg-slate-700 dark:text-slate-200 border border-slate-200 dark:border-slate-600">
                <?= esc($arsip['jenis_arsip']) ?>
            </span>
        </td>
        <td class="px-6 py-4 text-slate-500 dark:text-slate-400 text-xs">
            <?= date('d M Y', strtotime($arsip['tanggal_terima'])) ?>
        </td>
        <td class="px-6 py-4 text-right">
            <div class="flex items-center justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                <a href="<?= base_url('admin/arsip/edit/'.$arsip['id_arsip']) ?>" class="p-1 text-slate-400 hover:text-primary transition-colors" title="Edit">
                    <span class="material-symbols-outlined text-lg">edit</span>
                </a>
                <?php if($arsip['file_scan']): ?>
                <a href="<?= base_url('uploads/arsip/'.$arsip['file_scan']) ?>" target="_blank" class="p-1 text-slate-400 hover:text-primary transition-colors" title="Download">
                    <span class="material-symbols-outlined text-lg">download</span>
                </a>
                <?php endif; ?>
            </div>
        </td>
    </tr>
    <?php endforeach; ?>
<?php endif; ?>
</tbody>
</table>
</div>
<div class="px-5 py-3 border-t border-slate-200 dark:border-slate-700 flex items-center justify-between">
<span class="text-xs text-slate-500 dark:text-slate-400">Menampilkan 5 arsip terbaru</span>
</div>
</div>
</div>
</div>
</main>
</div>
</body></html>