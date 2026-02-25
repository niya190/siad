<!DOCTYPE html>
<html lang="en">
<head>
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
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 3px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
        .compact-table th, .compact-table td {
            padding-top: 0.5rem; padding-bottom: 0.5rem;
            padding-left: 0.75rem; padding-right: 0.75rem;
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
            <a class="px-3 py-1.5 text-sm font-medium text-slate-600 dark:text-slate-300 hover:text-primary dark:hover:text-white hover:bg-slate-50 dark:hover:bg-slate-800 rounded-md transition-colors" href="#">Help Center</a>
            <a class="px-3 py-1.5 text-sm font-medium text-slate-600 dark:text-slate-300 hover:text-primary dark:hover:text-white hover:bg-slate-50 dark:hover:bg-slate-800 rounded-md transition-colors" href="#">Documentation</a>
        </nav>
    </div>
    <div class="flex items-center gap-4">
        <div class="relative hidden sm:block">
            <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <span class="material-symbols-outlined text-slate-400 text-lg">search</span>
            </span>
            <input class="pl-9 pr-4 py-1.5 text-sm bg-slate-100 dark:bg-slate-800 border-none rounded-full w-64 focus:ring-2 focus:ring-primary/20 placeholder-slate-400 text-slate-700 dark:text-slate-200" placeholder="Global search..." type="text"/>
        </div>
        <button class="relative p-2 rounded-full text-slate-500 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors">
            <span class="material-symbols-outlined">notifications</span>
            <span class="absolute top-2 right-2 w-2 h-2 bg-red-500 rounded-full border-2 border-white dark:border-surface-dark"></span>
        </button>
        <div class="flex items-center gap-3 pl-4 border-l border-slate-200 dark:border-slate-700">
            <div class="text-right hidden sm:block">
                <p class="text-sm font-semibold text-slate-900 dark:text-white leading-none">Administrator</p>
                <span class="inline-flex items-center gap-1 mt-1 px-1.5 py-0.5 rounded text-[10px] font-bold bg-primary/10 text-primary dark:text-blue-300 uppercase tracking-wide">
                    Admin Role
                </span>
            </div>
            <div class="size-9 rounded-full bg-slate-200 dark:bg-slate-700 bg-center bg-cover border-2 border-white dark:border-slate-600 shadow-sm cursor-pointer" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuCntFHYm9aQxI9nbHCyyFKqtGy4gspqrYtEl-CzhPd5HNJuyxdEDtLLKaUAemZt91bE9KWYtTg0pYTF9gDk2X3YND_ZZK63HGuayaKRg0BesXtTDwIeiMcRgoowqL_ZbdwbDYFJibUggj7t6025M_PiNm7Z9HrF7pPWYnp7vhe3o_A9fNl-lpnPA9HSZZiKmQhbfWvR4mzV4KUpRxYErCON6Q62pK0Y6fpajgxEcg-5gAVgBuUa0IvMByqgi9kH99jdHG_5zzBBjHU');"></div>
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
            <a class="flex items-center gap-3 px-3 py-2 rounded-lg text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800 hover:text-primary dark:hover:text-white transition-colors group" href="#">
                <span class="material-symbols-outlined group-hover:text-primary dark:group-hover:text-blue-400 transition-colors">settings_applications</span>
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
            <div class="max-w-[1600px] mx-auto space-y-4">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-end gap-4 pb-2">
                    <div>
                        <nav class="flex text-sm text-slate-500 dark:text-slate-400 mb-1">
                            <a class="hover:text-primary" href="<?= base_url('admin/dashboard') ?>">Home</a>
                            <span class="mx-2">/</span>
                            <a class="hover:text-primary" href="<?= base_url('admin/arsip/search') ?>">Archives</a>
                            <span class="mx-2">/</span>
                            <span class="text-slate-800 dark:text-white font-medium">Advanced Search</span>
                        </nav>
                        <h2 class="text-2xl font-bold text-slate-900 dark:text-white">Archive Search</h2>
                        <p class="text-slate-500 text-sm mt-1">Advanced filtering and retrieval of physical and digital records.</p>
                    </div>
                    <div class="flex gap-2">
                        <button class="flex items-center gap-2 px-3 py-2 bg-white dark:bg-surface-dark border border-slate-200 dark:border-slate-700 rounded-lg text-sm font-medium text-slate-700 dark:text-slate-200 hover:bg-slate-50 dark:hover:bg-slate-800 shadow-sm transition-all">
                            <span class="material-symbols-outlined text-lg">history</span>
                            Recent Searches
                        </button>
                        <button class="flex items-center gap-2 px-3 py-2 bg-white dark:bg-surface-dark border border-slate-200 dark:border-slate-700 rounded-lg text-sm font-medium text-slate-700 dark:text-slate-200 hover:bg-slate-50 dark:hover:bg-slate-800 shadow-sm transition-all">
                            <span class="material-symbols-outlined text-lg">save</span>
                            Save Filter
                        </button>
                    </div>
                </div>
                <div class="bg-white dark:bg-surface-dark rounded-xl border border-slate-200 dark:border-slate-700 shadow-soft p-5">
                    <div class="flex items-center justify-between mb-4 border-b border-slate-100 dark:border-slate-800 pb-3">
                        <h3 class="font-semibold text-slate-900 dark:text-white flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary">manage_search</span>
                            Search Criteria
                        </h3>
                        <a href="<?= base_url('admin/arsip/search') ?>" class="text-xs font-medium text-primary hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-300">Reset All Filters</a>
                    </div>
                    
                    <form action="<?= base_url('admin/arsip/search') ?>" method="GET" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-x-8 gap-y-6">
                        <div class="col-span-1 md:col-span-2 lg:col-span-2">
                            <label class="block text-xs font-medium text-slate-700 dark:text-slate-300 mb-1.5">Document Name / Subject</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="material-symbols-outlined text-slate-400 text-sm">article</span>
                                </span>
                                <input name="keyword" value="<?= esc($filters['keyword'] ?? '') ?>" class="block w-full pl-9 pr-3 py-2 bg-slate-50 dark:bg-slate-800 border border-slate-300 dark:border-slate-600 rounded-lg text-sm focus:ring-1 focus:ring-primary focus:border-primary placeholder-slate-400" placeholder="Search by title, keywords or subject..." type="text"/>
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-slate-700 dark:text-slate-300 mb-1.5">Kemenhub Number Format</label>
                            <input name="nomor_surat" value="<?= esc($filters['nomor_surat'] ?? '') ?>" class="block w-full px-3 py-2 bg-slate-50 dark:bg-slate-800 border border-slate-300 dark:border-slate-600 rounded-lg text-sm focus:ring-1 focus:ring-primary focus:border-primary" placeholder="e.g. IM.101/1/1/DJPL-2023" type="text"/>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-slate-700 dark:text-slate-300 mb-1.5">Classification Code</label>
                            <select name="id_klasifikasi" class="block w-full px-3 py-2 bg-slate-50 dark:bg-slate-800 border border-slate-300 dark:border-slate-600 rounded-lg text-sm focus:ring-1 focus:ring-primary focus:border-primary">
                                <option value="">All Classifications</option>
                                <?php if(isset($klasifikasi) && is_array($klasifikasi)): ?>
                                    <?php foreach($klasifikasi as $k): ?>
                                        <option value="<?= $k['id_klasifikasi'] ?>" <?= (isset($filters['id_klasifikasi']) && $filters['id_klasifikasi'] == $k['id_klasifikasi']) ? 'selected' : '' ?>>
                                            <?= $k['kode_klasifikasi'] ?> - <?= $k['nama_klasifikasi'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                        
                        <div>
                            <label class="block text-xs font-medium text-slate-700 dark:text-slate-300 mb-1.5">Date Range (Creation)</label>
                            <div class="flex items-center gap-3">
                                <input name="start_date" value="<?= esc($filters['start_date'] ?? '') ?>" class="block w-1/2 px-2 py-2 bg-slate-50 dark:bg-slate-800 border border-slate-300 dark:border-slate-600 rounded-lg text-sm text-slate-500" type="date"/>
                                <span class="text-slate-400 self-center">-</span>
                                <input name="end_date" value="<?= esc($filters['end_date'] ?? '') ?>" class="block w-1/2 px-2 py-2 bg-slate-50 dark:bg-slate-800 border border-slate-300 dark:border-slate-600 rounded-lg text-sm text-slate-500" type="date"/>
                            </div>
                        </div>
                        
                        <div>
                            <label class="block text-xs font-medium text-slate-700 dark:text-slate-300 mb-1.5">Year</label>
                            <select name="tahun" class="block w-full px-3 py-2 bg-slate-50 dark:bg-slate-800 border border-slate-300 dark:border-slate-600 rounded-lg text-sm focus:ring-1 focus:ring-primary focus:border-primary">
                                <option value="">All Years</option>
                                <option <?= (isset($filters['tahun']) && $filters['tahun'] == '2026') ? 'selected' : '' ?>>2026</option>
                                <option <?= (isset($filters['tahun']) && $filters['tahun'] == '2025') ? 'selected' : '' ?>>2025</option>
                                <option <?= (isset($filters['tahun']) && $filters['tahun'] == '2024') ? 'selected' : '' ?>>2024</option>
                                <option <?= (isset($filters['tahun']) && $filters['tahun'] == '2023') ? 'selected' : '' ?>>2023</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-slate-700 dark:text-slate-300 mb-1.5">Sender</label>
                            <input name="pengirim" value="<?= esc($filters['pengirim'] ?? '') ?>" class="block w-full px-3 py-2 bg-slate-50 dark:bg-slate-800 border border-slate-300 dark:border-slate-600 rounded-lg text-sm focus:ring-1 focus:ring-primary focus:border-primary" placeholder="Originating Agency/Person" type="text"/>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-slate-700 dark:text-slate-300 mb-1.5">Recipient</label>
                            <input name="tujuan" value="<?= esc($filters['tujuan'] ?? '') ?>" class="block w-full px-3 py-2 bg-slate-50 dark:bg-slate-800 border border-slate-300 dark:border-slate-600 rounded-lg text-sm focus:ring-1 focus:ring-primary focus:border-primary" placeholder="Internal Department/Person" type="text"/>
                        </div>
                        <div class="col-span-1 md:col-span-2 lg:col-span-4 pt-2 border-t border-slate-100 dark:border-slate-800/50 mt-2">
                            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-2 flex items-center gap-1">
                                <span class="material-symbols-outlined text-sm text-slate-400">inventory_2</span> 
                                Physical Archive Location
                            </label>
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                                <div>
                                    <input name="ruangan" value="<?= esc($filters['ruangan'] ?? '') ?>" class="block w-full px-3 py-2 bg-slate-50 dark:bg-slate-800 border border-slate-300 dark:border-slate-600 rounded-lg text-sm focus:ring-1 focus:ring-primary focus:border-primary" placeholder="Room Number / Name" type="text"/>
                                </div>
                                <div>
                                    <input name="lemari" value="<?= esc($filters['lemari'] ?? '') ?>" class="block w-full px-3 py-2 bg-slate-50 dark:bg-slate-800 border border-slate-300 dark:border-slate-600 rounded-lg text-sm focus:ring-1 focus:ring-primary focus:border-primary" placeholder="Cabinet / Lemari" type="text"/>
                                </div>
                                <div>
                                    <input name="rak" value="<?= esc($filters['rak'] ?? '') ?>" class="block w-full px-3 py-2 bg-slate-50 dark:bg-slate-800 border border-slate-300 dark:border-slate-600 rounded-lg text-sm focus:ring-1 focus:ring-primary focus:border-primary" placeholder="Shelf / Rak / Box" type="text"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-1 md:col-span-2 lg:col-span-4 flex justify-end gap-3 mt-2">
                            <a href="<?= base_url('admin/arsip/search') ?>" class="px-6 py-2 bg-white dark:bg-surface-dark border border-slate-300 dark:border-slate-600 rounded-lg text-sm font-medium text-slate-700 dark:text-slate-200 hover:bg-slate-50 dark:hover:bg-slate-800 transition-all text-center">Clear</a>
                            <button type="submit" class="px-6 py-2 bg-primary hover:bg-blue-700 text-white rounded-lg shadow-md shadow-blue-500/20 transition-all font-medium text-sm flex items-center gap-2">
                                <span class="material-symbols-outlined text-lg">search</span>
                                Search Archives
                            </button>
                        </div>
                    </form>
                </div>
                <div class="bg-white dark:bg-surface-dark rounded-xl border border-slate-200 dark:border-slate-700 shadow-sm overflow-hidden flex flex-col flex-1 min-h-[500px]">
                    <div class="p-4 border-b border-slate-200 dark:border-slate-700 bg-slate-50/50 dark:bg-slate-800/20 flex flex-col sm:flex-row justify-between items-center gap-4">
                        <div class="flex items-center gap-2">
                            <h3 class="font-bold text-slate-900 dark:text-white">Search Results</h3>
                            <span class="px-2 py-0.5 rounded-full bg-slate-100 dark:bg-slate-700 text-xs font-semibold text-slate-600 dark:text-slate-300"><?= $total_data ?? 0 ?> Found</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <button class="p-1.5 text-slate-500 hover:text-primary hover:bg-slate-100 rounded transition-colors" title="Column Settings">
                                <span class="material-symbols-outlined text-xl">view_column</span>
                            </button>
                            <button class="p-1.5 text-slate-500 hover:text-primary hover:bg-slate-100 rounded transition-colors" title="Export CSV">
                                <span class="material-symbols-outlined text-xl">download</span>
                            </button>
                            <button class="p-1.5 text-slate-500 hover:text-primary hover:bg-slate-100 rounded transition-colors" title="Print List">
                                <span class="material-symbols-outlined text-xl">print</span>
                            </button>
                        </div>
                    </div>
                    <div class="overflow-x-auto flex-1">
                        <table class="w-full text-xs text-left compact-table border-collapse">
                            <thead class="text-xs text-slate-500 dark:text-slate-400 uppercase bg-slate-100 dark:bg-slate-800 border-b border-slate-200 dark:border-slate-700 sticky top-0 z-10">
                                <tr>
                                    <th class="w-10 text-center bg-slate-100 dark:bg-slate-800">
                                        <input class="rounded border-slate-300 text-primary focus:ring-primary/50" type="checkbox"/>
                                    </th>
                                    <th class="font-bold text-slate-700 dark:text-slate-200 cursor-pointer hover:text-primary bg-slate-100 dark:bg-slate-800">
                                        <div class="flex items-center gap-1">Archive No. <span class="material-symbols-outlined text-[10px]">unfold_more</span></div>
                                    </th>
                                    <th class="font-bold text-slate-700 dark:text-slate-200 cursor-pointer hover:text-primary bg-slate-100 dark:bg-slate-800">
                                        <div class="flex items-center gap-1">Doc Date <span class="material-symbols-outlined text-[10px]">unfold_more</span></div>
                                    </th>
                                    <th class="font-bold text-slate-700 dark:text-slate-200 min-w-[200px] bg-slate-100 dark:bg-slate-800">Subject</th>
                                    <th class="font-bold text-slate-700 dark:text-slate-200 bg-slate-100 dark:bg-slate-800">Class</th>
                                    <th class="font-bold text-slate-700 dark:text-slate-200 bg-slate-100 dark:bg-slate-800">From / To</th>
                                    <th class="font-bold text-slate-700 dark:text-slate-200 bg-slate-100 dark:bg-slate-800">Location</th>
                                    <th class="font-bold text-slate-700 dark:text-slate-200 text-center bg-slate-100 dark:bg-slate-800">Status</th>
                                    <th class="font-bold text-slate-700 dark:text-slate-200 text-right bg-slate-100 dark:bg-slate-800">Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-200 dark:divide-slate-700 font-medium">
                                <?php if(empty($arsip)): ?>
                                    <tr>
                                        <td colspan="9" class="text-center py-6 text-slate-500">Tidak ada arsip yang cocok dengan pencarian.</td>
                                    </tr>
                                <?php else: ?>
                                    <?php foreach($arsip as $a): ?>
                                    <tr class="group hover:bg-blue-50 dark:hover:bg-blue-900/10 transition-colors odd:bg-white even:bg-slate-50/30 dark:odd:bg-surface-dark dark:even:bg-surface-dark/50">
                                        <td class="text-center">
                                            <input class="rounded border-slate-300 text-primary focus:ring-primary/50" type="checkbox"/>
                                        </td>
                                        <td class="text-primary font-semibold whitespace-nowrap"><?= esc($a['nomor_surat']) ?></td>
                                        <td class="text-slate-600 dark:text-slate-400 whitespace-nowrap"><?= date('d M Y', strtotime($a['tanggal_surat'])) ?></td>
                                        <td class="text-slate-800 dark:text-slate-200">
                                            <div class="line-clamp-1" title="<?= esc($a['perihal']) ?>"><?= esc($a['perihal']) ?></div>
                                            <span class="text-[10px] text-slate-400"><?= esc($a['jenis_arsip']) ?></span>
                                        </td>
                                        <td><span class="bg-slate-200 dark:bg-slate-700 text-slate-600 dark:text-slate-300 px-1.5 py-0.5 rounded text-[10px] font-bold"><?= esc($a['kode_klasifikasi'] ?? '-') ?></span></td>
                                        <td>
                                            <div class="flex flex-col text-[11px] leading-tight">
                                                <span class="text-slate-900 dark:text-white" title="<?= esc($a['pengirim_tujuan']) ?>"><?= esc($a['pengirim_tujuan']) ?></span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="flex items-center gap-1 text-slate-500 dark:text-slate-400" title="<?= esc($a['nama_ruangan'] ?? '-') ?>, <?= esc($a['nama_lemari'] ?? '-') ?>, <?= esc($a['nama_rak'] ?? '-') ?>">
                                                <span class="material-symbols-outlined text-[14px]">meeting_room</span> 
                                                <?= esc($a['nama_lemari'] ?? '-') ?> - <?= esc($a['nama_rak'] ?? '-') ?>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-medium bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-800">
                                                <?= esc($a['status'] ?? 'Active') ?>
                                            </span>
                                        </td>
                                        <td class="text-right whitespace-nowrap">
                                            <div class="opacity-0 group-hover:opacity-100 transition-opacity flex justify-end gap-1">
                                                <a href="<?= base_url('admin/arsip/detail/'.$a['id_arsip']) ?>" class="p-1 hover:bg-white dark:hover:bg-slate-700 rounded text-slate-500 hover:text-primary"><span class="material-symbols-outlined text-base">visibility</span></a>
                                                <a href="<?= base_url('admin/arsip/edit/'.$a['id_arsip']) ?>" class="p-1 hover:bg-white dark:hover:bg-slate-700 rounded text-slate-500 hover:text-primary"><span class="material-symbols-outlined text-base">edit</span></a>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="px-5 py-3 border-t border-slate-200 dark:border-slate-700 flex flex-col sm:flex-row items-center justify-between gap-4 bg-slate-50 dark:bg-slate-800/20">
                        <div class="flex items-center gap-2">
                            <span class="text-xs text-slate-500 dark:text-slate-400">Total Data: <strong><?= $total_data ?? 0 ?></strong> arsip</span>
                        </div>
                        <div class="flex gap-1 text-sm">
                            <?php if(isset($pager)): ?>
                                <?= $pager->links('arsip', 'default_full') ?> 
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
</body>
</html>