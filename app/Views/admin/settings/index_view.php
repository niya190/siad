<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>System Settings - Distrik Navigasi Tanjungpinang</title>
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
        .toggle-checkbox:checked {
            right: 0;
            border-color: #0e4c92;
        }
        .toggle-checkbox:checked + .toggle-label {
            background-color: #0e4c92;
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
            <div class="mt-6 mb-2 px-3 text-xs font-semibold text-slate-400 uppercase tracking-wider">Administrative</div>
            <a class="flex items-center gap-3 px-3 py-2 rounded-lg text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800 hover:text-primary dark:hover:text-white transition-colors group" href="<?= base_url('admin/lemari') ?>">
                <span class="material-symbols-outlined group-hover:text-primary dark:group-hover:text-blue-400 transition-colors">folder_managed</span>
                <span class="text-sm font-medium">Archive Manager</span>
            </a>
            <a class="flex items-center gap-3 px-3 py-2 rounded-lg text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800 hover:text-primary dark:hover:text-white transition-colors group" href="<?= base_url('admin/user') ?>">
                <span class="material-symbols-outlined group-hover:text-primary dark:group-hover:text-blue-400 transition-colors">people</span>
                <span class="text-sm font-medium">User Management</span>
            </a>
            <a class="flex items-center gap-3 px-3 py-2 rounded-lg bg-primary text-white font-medium shadow-md shadow-primary/20 transition-all group" href="<?= base_url('admin/settings') ?>">
                <span class="material-symbols-outlined filled">settings_applications</span>
                <span class="text-sm">System Settings</span>
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
            
            <form action="<?= base_url('admin/settings/save') ?>" method="POST" class="max-w-5xl mx-auto space-y-8">
                <?= csrf_field() ?>
                
                <div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-4 pb-4 border-b border-slate-200 dark:border-slate-700">
                    <div>
                        <nav class="flex text-sm text-slate-500 dark:text-slate-400 mb-1">
                            <a class="hover:text-primary" href="<?= base_url('admin/dashboard') ?>">Home</a>
                            <span class="mx-2">/</span>
                            <span class="text-slate-800 dark:text-white font-medium">System Configuration</span>
                        </nav>
                        <h2 class="text-2xl font-bold text-slate-900 dark:text-white">General Settings</h2>
                        <p class="text-sm text-slate-500 mt-1">Manage application-wide configurations and system health.</p>
                    </div>
                    <div class="flex gap-3">
                        <button type="button" class="flex items-center gap-2 px-4 py-2 bg-white dark:bg-surface-dark border border-slate-200 dark:border-slate-700 rounded-lg text-sm font-medium text-slate-700 dark:text-slate-200 hover:bg-slate-50 dark:hover:bg-slate-800 shadow-sm transition-all">
                            <span class="material-symbols-outlined text-lg">history</span>
                            View Logs
                        </button>
                        <button type="submit" class="flex items-center gap-2 bg-primary hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow-md shadow-blue-500/20 transition-all font-medium text-sm">
                            <span class="material-symbols-outlined text-lg">save</span>
                            Save Changes
                        </button>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-white dark:bg-surface-dark rounded-xl p-5 shadow-soft border border-slate-200 dark:border-slate-700 flex flex-col">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="p-2 bg-emerald-100 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400 rounded-lg">
                                <span class="material-symbols-outlined">dns</span>
                            </div>
                            <h3 class="font-semibold text-slate-800 dark:text-white">Database Status</h3>
                        </div>
                        <div class="flex items-end justify-between mt-auto">
                            <div>
                                <div class="text-2xl font-bold text-slate-900 dark:text-white">Healthy</div>
                                <div class="text-xs text-slate-500">Last check: Just now</div>
                            </div>
                            <div class="h-2 w-2 rounded-full bg-emerald-500 animate-pulse"></div>
                        </div>
                    </div>
                    <div class="bg-white dark:bg-surface-dark rounded-xl p-5 shadow-soft border border-slate-200 dark:border-slate-700 flex flex-col">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="p-2 bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 rounded-lg">
                                <span class="material-symbols-outlined">hard_drive</span>
                            </div>
                            <h3 class="font-semibold text-slate-800 dark:text-white">Storage Usage</h3>
                        </div>
                        <div class="mt-auto">
                            <div class="flex justify-between text-xs font-medium text-slate-600 dark:text-slate-300 mb-1">
                                <span>245 GB Used</span>
                                <span>1 TB Total</span>
                            </div>
                            <div class="w-full bg-slate-100 dark:bg-slate-700 rounded-full h-2">
                                <div class="bg-blue-600 h-2 rounded-full" style="width: 24%"></div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white dark:bg-surface-dark rounded-xl p-5 shadow-soft border border-slate-200 dark:border-slate-700 flex flex-col">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="p-2 bg-amber-100 dark:bg-amber-900/30 text-amber-600 dark:text-amber-400 rounded-lg">
                                <span class="material-symbols-outlined">memory</span>
                            </div>
                            <h3 class="font-semibold text-slate-800 dark:text-white">Server Load</h3>
                        </div>
                        <div class="mt-auto">
                            <div class="text-2xl font-bold text-slate-900 dark:text-white">12%</div>
                            <div class="text-xs text-slate-500">Optimal performance</div>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <div class="lg:col-span-2 space-y-6">
                        
                        <div class="bg-white dark:bg-surface-dark rounded-xl shadow-soft border border-slate-200 dark:border-slate-700">
                            <div class="p-6 border-b border-slate-100 dark:border-slate-800">
                                <h3 class="text-lg font-bold text-slate-900 dark:text-white flex items-center gap-2">
                                    <span class="material-symbols-outlined text-primary">badge</span> Office Identity
                                </h3>
                                <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Configure the official naming and address details.</p>
                            </div>
                            <div class="p-6 space-y-4">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Office Name</label>
                                        <input name="office_name" class="w-full rounded-lg border-slate-300 dark:border-slate-600 bg-slate-50 dark:bg-slate-800/50 text-slate-900 dark:text-white focus:ring-primary focus:border-primary text-sm" type="text" value="<?= esc($office_name ?? '') ?>"/>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Classification</label>
                                        <input name="classification" class="w-full rounded-lg border-slate-300 dark:border-slate-600 bg-slate-50 dark:bg-slate-800/50 text-slate-900 dark:text-white focus:ring-primary focus:border-primary text-sm" type="text" value="<?= esc($classification ?? '') ?>"/>
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Full Address</label>
                                    <textarea name="address" class="w-full rounded-lg border-slate-300 dark:border-slate-600 bg-slate-50 dark:bg-slate-800/50 text-slate-900 dark:text-white focus:ring-primary focus:border-primary text-sm h-24"><?= esc($address ?? '') ?></textarea>
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Email Contact</label>
                                        <input name="email" class="w-full rounded-lg border-slate-300 dark:border-slate-600 bg-slate-50 dark:bg-slate-800/50 text-slate-900 dark:text-white focus:ring-primary focus:border-primary text-sm" type="email" value="<?= esc($email ?? '') ?>"/>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Phone Number</label>
                                        <input name="phone" class="w-full rounded-lg border-slate-300 dark:border-slate-600 bg-slate-50 dark:bg-slate-800/50 text-slate-900 dark:text-white focus:ring-primary focus:border-primary text-sm" type="tel" value="<?= esc($phone ?? '') ?>"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="bg-white dark:bg-surface-dark rounded-xl shadow-soft border border-slate-200 dark:border-slate-700">
                            <div class="p-6 border-b border-slate-100 dark:border-slate-800">
                                <h3 class="text-lg font-bold text-slate-900 dark:text-white flex items-center gap-2">
                                    <span class="material-symbols-outlined text-primary">notifications_active</span> Notification Preferences
                                </h3>
                                <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Manage system alerts and email notifications.</p>
                            </div>
                            <div class="p-6 space-y-4">
                                <div class="flex items-center justify-between py-2">
                                    <div>
                                        <h4 class="text-sm font-medium text-slate-900 dark:text-white">Email Notifications</h4>
                                        <p class="text-xs text-slate-500">Receive daily digest of new archives.</p>
                                    </div>
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input name="notif_email" type="checkbox" value="1" class="sr-only peer"/>
                                        <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer dark:bg-slate-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary"></div>
                                    </label>
                                </div>
                                <div class="flex items-center justify-between py-2 border-t border-slate-100 dark:border-slate-700/50">
                                    <div>
                                        <h4 class="text-sm font-medium text-slate-900 dark:text-white">System Alerts</h4>
                                        <p class="text-xs text-slate-500">Popup notifications for critical errors.</p>
                                    </div>
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input name="notif_alerts" type="checkbox" value="1" checked class="sr-only peer"/>
                                        <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer dark:bg-slate-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary"></div>
                                    </label>
                                </div>
                                <div class="flex items-center justify-between py-2 border-t border-slate-100 dark:border-slate-700/50">
                                    <div>
                                        <h4 class="text-sm font-medium text-slate-900 dark:text-white">Expiring Document Alerts</h4>
                                        <p class="text-xs text-slate-500">Notify admin 7 days before document expiry.</p>
                                    </div>
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input name="notif_expiring" type="checkbox" value="1" checked class="sr-only peer"/>
                                        <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer dark:bg-slate-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary"></div>
                                    </label>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="space-y-6">
                        
                        <div class="bg-white dark:bg-surface-dark rounded-xl shadow-soft border border-slate-200 dark:border-slate-700">
                            <div class="p-6 border-b border-slate-100 dark:border-slate-800">
                                <h3 class="text-lg font-bold text-slate-900 dark:text-white flex items-center gap-2">
                                    <span class="material-symbols-outlined text-primary">palette</span> Appearance
                                </h3>
                            </div>
                            <div class="p-6">
                                <div class="grid grid-cols-2 gap-4">
                                    <label class="cursor-pointer group">
                                        <input class="peer sr-only" name="theme" type="radio" value="light" checked/>
                                        <div class="relative overflow-hidden rounded-lg border-2 border-slate-200 peer-checked:border-primary peer-checked:ring-2 peer-checked:ring-primary/20 dark:border-slate-700 bg-slate-50 p-2 group-hover:bg-slate-100 transition-all">
                                            <div class="space-y-2">
                                                <div class="h-2 w-full bg-white rounded"></div>
                                                <div class="h-2 w-3/4 bg-white rounded"></div>
                                                <div class="flex gap-2">
                                                    <div class="h-4 w-4 bg-primary rounded-full"></div>
                                                    <div class="h-4 w-full bg-white rounded"></div>
                                                </div>
                                            </div>
                                            <div class="mt-3 text-center text-sm font-medium text-slate-700">Light</div>
                                            <div class="absolute right-2 top-2 hidden text-primary peer-checked:block">
                                                <span class="material-symbols-outlined text-lg">check_circle</span>
                                            </div>
                                        </div>
                                    </label>
                                    <label class="cursor-pointer group">
                                        <input class="peer sr-only" name="theme" type="radio" value="dark"/>
                                        <div class="relative overflow-hidden rounded-lg border-2 border-slate-200 peer-checked:border-primary peer-checked:ring-2 peer-checked:ring-primary/20 dark:border-slate-700 bg-slate-900 p-2 group-hover:bg-slate-800 transition-all">
                                            <div class="space-y-2">
                                                <div class="h-2 w-full bg-slate-800 rounded"></div>
                                                <div class="h-2 w-3/4 bg-slate-800 rounded"></div>
                                                <div class="flex gap-2">
                                                    <div class="h-4 w-4 bg-primary rounded-full"></div>
                                                    <div class="h-4 w-full bg-slate-800 rounded"></div>
                                                </div>
                                            </div>
                                            <div class="mt-3 text-center text-sm font-medium text-slate-300">Dark</div>
                                            <div class="absolute right-2 top-2 hidden text-primary peer-checked:block">
                                                <span class="material-symbols-outlined text-lg">check_circle</span>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="bg-white dark:bg-surface-dark rounded-xl shadow-soft border border-slate-200 dark:border-slate-700">
                            <div class="p-6 border-b border-slate-100 dark:border-slate-800">
                                <h3 class="text-lg font-bold text-slate-900 dark:text-white flex items-center gap-2">
                                    <span class="material-symbols-outlined text-primary">database</span> Database Management
                                </h3>
                            </div>
                            <div class="p-6 space-y-4">
                                <div class="p-4 rounded-lg bg-slate-50 dark:bg-slate-800/50 border border-slate-200 dark:border-slate-700">
                                    <h4 class="text-sm font-semibold text-slate-900 dark:text-white mb-1">Last Backup</h4>
                                    <p class="text-xs text-slate-500 mb-3">Feb 25, 2026 at 03:00 AM (Automated)</p>
                                    <div class="flex gap-2">
                                        <button type="button" class="flex-1 py-2 px-3 bg-white dark:bg-slate-700 border border-slate-300 dark:border-slate-600 rounded-lg text-xs font-medium text-slate-700 dark:text-slate-200 hover:bg-slate-50 dark:hover:bg-slate-600 transition-colors">Download SQL</button>
                                        <button type="button" class="flex-1 py-2 px-3 bg-white dark:bg-slate-700 border border-slate-300 dark:border-slate-600 rounded-lg text-xs font-medium text-slate-700 dark:text-slate-200 hover:bg-slate-50 dark:hover:bg-slate-600 transition-colors">Restore</button>
                                    </div>
                                </div>
                                <button type="button" class="w-full py-2.5 bg-primary text-white rounded-lg text-sm font-medium hover:bg-blue-700 transition-colors shadow-sm flex items-center justify-center gap-2">
                                    <span class="material-symbols-outlined text-lg">backup</span> Create New Backup
                                </button>
                                <div class="pt-2 border-t border-slate-100 dark:border-slate-700/50">
                                    <button type="button" class="w-full py-2 text-red-600 dark:text-red-400 text-xs font-medium hover:bg-red-50 dark:hover:bg-red-900/10 rounded-lg transition-colors flex items-center justify-center gap-1">
                                        <span class="material-symbols-outlined text-sm">delete_forever</span> Reset Database (Danger Zone)
                                    </button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </form>
            </div>
    </main>
</div>

</body>
</html>