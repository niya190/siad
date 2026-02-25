<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Admin Archive Manager Console - Distrik Navigasi Tanjungpinang</title>
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
    </div>
    <div class="flex items-center gap-4">
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
            </button>
        </div>
        <nav class="flex-1 overflow-y-auto py-4 px-3 space-y-1">
            <div class="px-3 mb-2 text-xs font-semibold text-slate-400 uppercase tracking-wider">Main Menu</div>
            <a class="flex items-center gap-3 px-3 py-2 rounded-lg text-slate-600 dark:text-slate-300 hover:bg-slate-50 hover:text-primary transition-colors group" href="<?= base_url('admin/dashboard') ?>">
                <span class="material-symbols-outlined group-hover:text-primary transition-colors">dashboard</span>
                <span class="text-sm font-medium">Dashboard</span>
            </a>
            <a class="flex items-center gap-3 px-3 py-2 rounded-lg text-slate-600 dark:text-slate-300 hover:bg-slate-50 hover:text-primary transition-colors group" href="<?= base_url('admin/arsip/search') ?>">
                <span class="material-symbols-outlined group-hover:text-primary transition-colors">search</span>
                <span class="text-sm font-medium">Search Archives</span>
            </a>
            <a class="flex items-center gap-3 px-3 py-2 rounded-lg text-slate-600 dark:text-slate-300 hover:bg-slate-50 hover:text-primary transition-colors group" href="<?= base_url('admin/arsip/create') ?>">
                <span class="material-symbols-outlined group-hover:text-primary transition-colors">input</span>
                <span class="text-sm font-medium">Data Entry</span>
            </a>
            
            <div class="mt-6 mb-2 px-3 text-xs font-semibold text-slate-400 uppercase tracking-wider">Administrative</div>
            
            <a class="flex items-center gap-3 px-3 py-2 rounded-lg bg-primary text-white font-medium shadow-md shadow-primary/20 transition-all group" href="<?= base_url('admin/lemari') ?>">
                <span class="material-symbols-outlined filled">folder_managed</span>
                <span class="text-sm">Archive Manager</span>
            </a>
            
            <a class="flex items-center gap-3 px-3 py-2 rounded-lg text-slate-600 dark:text-slate-300 hover:bg-slate-50 hover:text-primary transition-colors group" href="<?= base_url('admin/user') ?>">
                <span class="material-symbols-outlined group-hover:text-primary transition-colors">people</span>
                <span class="text-sm font-medium">User Management</span>
            </a>
            
            <a class="flex items-center gap-3 px-3 py-2 rounded-lg text-slate-600 dark:text-slate-300 hover:bg-slate-50 hover:text-primary transition-colors group" href="<?= base_url('admin/settings') ?>">
                <span class="material-symbols-outlined group-hover:text-primary transition-colors">settings_applications</span>
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
            <div class="max-w-7xl mx-auto space-y-6">
                
                <div class="flex justify-between items-end pb-2">
                    <div>
                        <nav class="flex text-sm text-slate-500 dark:text-slate-400 mb-1">
                            <a class="hover:text-primary" href="<?= base_url('admin/dashboard') ?>">Admin</a>
                            <span class="mx-2">/</span>
                            <span class="text-slate-800 dark:text-white font-medium">Archive Structure</span>
                        </nav>
                        <h2 class="text-2xl font-bold text-slate-900 dark:text-white">Archive Management Console</h2>
                        <p class="text-slate-500 text-sm mt-1">Manage physical locations and logical categories for archive storage.</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div class="bg-white rounded-xl p-4 shadow-soft border border-slate-100 flex items-center gap-4">
                        <div class="p-3 bg-blue-50 rounded-lg text-primary">
                            <span class="material-symbols-outlined text-xl">meeting_room</span>
                        </div>
                        <div>
                            <p class="text-xs text-slate-500 font-medium uppercase tracking-wide">Rooms</p>
                            <h3 class="text-xl font-bold text-slate-900"><?= $total_rooms ?? 0 ?></h3>
                        </div>
                    </div>
                    <div class="bg-white rounded-xl p-4 shadow-soft border border-slate-100 flex items-center gap-4">
                        <div class="p-3 bg-indigo-50 rounded-lg text-indigo-600">
                            <span class="material-symbols-outlined text-xl">shelves</span>
                        </div>
                        <div>
                            <p class="text-xs text-slate-500 font-medium uppercase tracking-wide">Cabinets</p>
                            <h3 class="text-xl font-bold text-slate-900"><?= $total_cabinets ?? 0 ?></h3>
                        </div>
                    </div>
                    <div class="bg-white rounded-xl p-4 shadow-soft border border-slate-100 flex items-center gap-4">
                        <div class="p-3 bg-amber-50 rounded-lg text-amber-600">
                            <span class="material-symbols-outlined text-xl">layers</span>
                        </div>
                        <div>
                            <p class="text-xs text-slate-500 font-medium uppercase tracking-wide">Total Shelves</p>
                            <h3 class="text-xl font-bold text-slate-900"><?= $total_shelves ?? 0 ?></h3>
                        </div>
                    </div>
                    <div class="bg-white rounded-xl p-4 shadow-soft border border-slate-100 flex items-center gap-4">
                        <div class="p-3 bg-emerald-50 rounded-lg text-emerald-600">
                            <span class="material-symbols-outlined text-xl">category</span>
                        </div>
                        <div>
                            <p class="text-xs text-slate-500 font-medium uppercase tracking-wide">Categories</p>
                            <h3 class="text-xl font-bold text-slate-900"><?= $total_categories ?? 0 ?></h3>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    
                    <div class="lg:col-span-2 space-y-6">
                        <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden flex flex-col h-full">
                            <div class="p-5 border-b border-slate-200 bg-slate-50/50 flex justify-between items-center">
                                <h3 class="font-bold text-slate-900 flex items-center gap-2">
                                    <span class="material-symbols-outlined text-slate-500">domain</span>
                                    Physical Storage Structure
                                </h3>
                                <button class="px-3 py-1.5 text-xs font-medium bg-white border border-slate-200 rounded-md text-slate-700 shadow-sm hover:text-primary transition-colors flex items-center gap-1">
                                    <span class="material-symbols-outlined text-sm">add</span> Add Room
                                </button>
                            </div>
                            
                            <div class="p-0 overflow-hidden">
                                <?php if(empty($ruangan_tree)): ?>
                                    <div class="p-6 text-center text-slate-500">Belum ada data Ruangan.</div>
                                <?php else: ?>
                                    <?php foreach($ruangan_tree as $room): ?>
                                    <div class="border-b border-slate-100 last:border-0">
                                        
                                        <div class="p-4 bg-slate-50 flex items-center justify-between cursor-pointer hover:bg-slate-100 transition-colors group">
                                            <div class="flex items-center gap-3">
                                                <div class="p-2 bg-white rounded border border-slate-200 shadow-sm">
                                                    <span class="material-symbols-outlined text-primary text-lg">meeting_room</span>
                                                </div>
                                                <div>
                                                    <h4 class="text-sm font-bold text-slate-900"><?= esc($room['nama_ruangan']) ?></h4>
                                                    <p class="text-xs text-slate-500"><?= count($room['cabinets']) ?> Cabinets Registered</p>
                                                </div>
                                            </div>
                                            <div class="flex items-center gap-3">
                                                <button class="text-slate-400 hover:text-primary transition-colors" title="Add Cabinet">
                                                    <span class="material-symbols-outlined">add_box</span>
                                                </button>
                                                <button class="text-slate-400 hover:text-primary transition-colors">
                                                    <span class="material-symbols-outlined">expand_more</span>
                                                </button>
                                            </div>
                                        </div>

                                        <?php if(!empty($room['cabinets'])): ?>
                                        <div class="bg-white px-4 py-2 border-t border-slate-100">
                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3 py-3">
                                                <?php foreach($room['cabinets'] as $cabinet): ?>
                                                <div class="border border-slate-200 rounded-lg p-3 hover:border-primary/50 transition-colors group/cab">
                                                    <div class="flex justify-between items-start mb-2">
                                                        <div class="flex items-center gap-2">
                                                            <span class="material-symbols-outlined text-slate-400 text-lg">shelves</span>
                                                            <span class="text-sm font-semibold text-slate-800"><?= esc($cabinet['nama_lemari']) ?></span>
                                                        </div>
                                                        <button class="text-slate-300 hover:text-primary opacity-0 group-hover/cab:opacity-100 transition-opacity">
                                                            <span class="material-symbols-outlined text-sm">more_vert</span>
                                                        </button>
                                                    </div>
                                                    
                                                    <div class="space-y-1">
                                                        <?php if(empty($cabinet['shelves'])): ?>
                                                            <div class="text-xs text-slate-400 italic">Belum ada rak/box</div>
                                                        <?php else: ?>
                                                            <?php foreach($cabinet['shelves'] as $shelf): ?>
                                                            <div class="flex items-center justify-between text-xs text-slate-500 mt-2">
                                                                <span><?= esc($shelf['nama_rak']) ?></span>
                                                                <span class="text-emerald-600 font-medium">Ready</span>
                                                            </div>
                                                            <div class="w-full bg-slate-100 rounded-full h-1.5">
                                                                <div class="bg-emerald-500 h-1.5 rounded-full" style="width: 100%"></div>
                                                            </div>
                                                            <?php endforeach; ?>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <div class="lg:col-span-1 space-y-6">
                        <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
                            <div class="p-5 border-b border-slate-200 bg-slate-50/50 flex justify-between items-center">
                                <h3 class="font-bold text-slate-900 flex items-center gap-2">
                                    <span class="material-symbols-outlined text-slate-500">category</span>
                                    Classifications
                                </h3>
                                <button class="p-1 rounded text-slate-400 hover:text-primary hover:bg-slate-100 transition-colors">
                                    <span class="material-symbols-outlined">add</span>
                                </button>
                            </div>
                            <div class="p-4">
                                <div class="space-y-3">
                                    
                                    <?php if(!empty($klasifikasi)): ?>
                                        <?php foreach($klasifikasi as $k): 
                                            // Ambil 2 huruf depan (Misal: dari UM.002 ambil "UM")
                                            $prefix = substr($k['kode_klasifikasi'], 0, 2);
                                        ?>
                                        <div class="flex items-start gap-3 group border-b border-slate-100 pb-3 mb-3 last:border-0 last:pb-0 last:mb-0">
                                            <div class="mt-0.5">
                                                <span class="flex items-center justify-center size-8 rounded bg-primary/10 text-primary text-xs font-bold uppercase"><?= esc($prefix) ?></span>
                                            </div>
                                            <div class="flex-1">
                                                <div class="flex justify-between items-start">
                                                    <h4 class="text-sm font-semibold text-slate-800 group-hover:text-primary transition-colors cursor-pointer"><?= esc($k['nama_klasifikasi']) ?></h4>
                                                    <div class="flex gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                                        <button class="text-slate-400 hover:text-primary"><span class="material-symbols-outlined text-base">edit</span></button>
                                                        <button class="text-slate-400 hover:text-red-500"><span class="material-symbols-outlined text-base">delete</span></button>
                                                    </div>
                                                </div>
                                                <p class="text-xs text-slate-500 mt-0.5">Kode: <span class="font-semibold text-slate-700"><?= esc($k['kode_klasifikasi']) ?></span></p>
                                            </div>
                                        </div>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <p class="text-xs text-slate-500 text-center">Belum ada data klasifikasi.</p>
                                    <?php endif; ?>
                                    
                                    <div class="pt-3">
                                        <button class="w-full py-2 border border-dashed border-slate-300 rounded-lg text-xs text-slate-500 hover:text-primary hover:border-primary hover:bg-slate-50 transition-all flex items-center justify-center gap-1">
                                            <span class="material-symbols-outlined text-sm">add_circle</span> Add New Category
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-blue-50 rounded-xl p-5 border border-blue-100">
                            <h4 class="text-sm font-bold text-primary mb-2">Need Help?</h4>
                            <p class="text-xs text-slate-600 mb-3 leading-relaxed">Refer to the official Ministry of Transportation decree regarding archive classification codes before adding new categories.</p>
                            <a class="text-xs font-semibold text-primary hover:underline flex items-center gap-1" href="#">
                                Download Regulation PDF <span class="material-symbols-outlined text-sm">open_in_new</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

</body>
</html>