<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title><?= $title ?? 'Notifications' ?> - Distrik Navigasi Tanjungpinang</title>
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

        <a href="<?= base_url('admin/notifications') ?>" class="relative p-2 rounded-full text-slate-500 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors bg-slate-100 dark:bg-slate-800">
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
            <a class="flex items-center gap-3 px-3 py-2 rounded-lg text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800 hover:text-primary dark:hover:text-white transition-colors group" href="<?= base_url('admin/arsip/export') ?>">
                <span class="material-symbols-outlined group-hover:text-primary dark:group-hover:text-blue-400 transition-colors">download</span>
                <span class="text-sm font-medium">Export Record</span>
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
            <div class="max-w-4xl mx-auto">
                
                <div class="mb-8">
                    <h2 class="text-3xl font-bold tracking-tight text-slate-900 dark:text-white mb-2">Notifications</h2>
                    <p class="text-slate-500 dark:text-slate-400">Manage and view all system alerts, security incidents, and background activities.</p>
                </div>
                
                <div class="flex items-center gap-2 mb-8 bg-slate-200/50 dark:bg-slate-800 p-1 rounded-full w-fit">
                    <button class="px-6 py-2 text-sm font-bold rounded-full bg-primary text-white shadow-sm">All</button>
                    <button class="px-6 py-2 text-sm font-bold text-slate-500 dark:text-slate-400 hover:bg-white dark:hover:bg-slate-700 hover:shadow-sm rounded-full transition-all">Unread</button>
                    <button class="px-6 py-2 text-sm font-bold text-slate-500 dark:text-slate-400 hover:bg-white dark:hover:bg-slate-700 hover:shadow-sm rounded-full transition-all">Critical</button>
                </div>

                <div class="flex flex-col gap-4">
                    <?php foreach($notifications as $notif): ?>
                        <?php 
                            // Atur class CSS berdasarkan tipe notifikasi
                            $bgClass = 'bg-white dark:bg-slate-900 border-slate-200 dark:border-slate-800';
                            $titleClass = 'text-slate-900 dark:text-white';
                            $descClass = 'text-slate-600 dark:text-slate-400';
                            $actionClass = 'text-primary';
                            $opacity = '';

                            if ($notif['type'] == 'critical') {
                                $bgClass = 'bg-red-50 dark:bg-red-950/20 border-red-200 dark:border-red-900/50';
                                $titleClass = 'text-red-900 dark:text-red-100';
                                $descClass = 'text-red-700 dark:text-red-300/80';
                                $actionClass = 'text-red-600 dark:text-red-400';
                            } else if ($notif['type'] == 'muted') {
                                $opacity = 'opacity-70';
                            }
                        ?>

                        <div class="group <?= $bgClass ?> <?= $opacity ?> p-5 rounded-2xl border shadow-sm hover:shadow-md transition-all flex items-start gap-4">
                            <div class="shrink-0 size-12 rounded-xl bg-<?= $notif['color'] ?>-100 dark:bg-<?= $notif['color'] ?>-900/30 text-<?= $notif['color'] ?>-600 dark:text-<?= $notif['color'] ?>-500 flex items-center justify-center">
                                <span class="material-symbols-outlined"><?= $notif['icon'] ?></span>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex justify-between items-start">
                                    <h3 class="text-base font-bold <?= $titleClass ?> mb-1"><?= $notif['title'] ?></h3>
                                    <?php if ($notif['time'] == 'CRITICAL'): ?>
                                        <span class="text-xs text-red-500 font-bold">CRITICAL</span>
                                    <?php else: ?>
                                        <span class="text-xs text-slate-400 font-medium"><?= $notif['time'] ?></span>
                                    <?php endif; ?>
                                </div>
                                <p class="text-sm <?= $descClass ?> leading-relaxed mb-3"><?= $notif['message'] ?></p>
                                <a class="<?= $actionClass ?> text-sm font-bold flex items-center gap-1 hover:gap-2 transition-all" href="<?= $notif['action_link'] ?>">
                                    <?= $notif['action_text'] ?> <span class="material-symbols-outlined text-sm">arrow_forward</span>
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="mt-8 flex justify-center pb-8">
                    <button class="bg-slate-200 dark:bg-slate-800 hover:bg-slate-300 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-300 px-6 py-2 rounded-xl text-sm font-bold transition-colors">
                        Load More Notifications
                    </button>
                </div>
            </div>
        </div>
    </main>
</div>
</body>
</html>