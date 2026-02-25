<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>User Management - Distrik Navigasi Tanjungpinang</title>
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
        <div class="h-8 w-px bg-slate-200 dark:bg-slate-700 mx-2 hidden md:block"></div>
    </div>
    <div class="flex items-center gap-4">
        <div class="relative hidden sm:block">
            <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <span class="material-symbols-outlined text-slate-400 text-lg">search</span>
            </span>
            <input class="pl-9 pr-4 py-1.5 text-sm bg-slate-100 dark:bg-slate-800 border-none rounded-full w-64 focus:ring-2 focus:ring-primary/20 placeholder-slate-400 text-slate-700 dark:text-slate-200" placeholder="Global Search..." type="text"/>
        </div>
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
                <span class="material-symbols-outlined group-hover:text-primary transition-colors">dashboard</span>
                <span class="text-sm font-medium">Dashboard</span>
            </a>
            <a class="flex items-center gap-3 px-3 py-2 rounded-lg text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800 hover:text-primary dark:hover:text-white transition-colors group" href="<?= base_url('admin/arsip/search') ?>">
                <span class="material-symbols-outlined group-hover:text-primary transition-colors">search</span>
                <span class="text-sm font-medium">Search Archives</span>
            </a>
            <a class="flex items-center gap-3 px-3 py-2 rounded-lg text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800 hover:text-primary dark:hover:text-white transition-colors group" href="<?= base_url('admin/arsip/create') ?>">
                <span class="material-symbols-outlined group-hover:text-primary transition-colors">input</span>
                <span class="text-sm font-medium">Data Entry</span>
            </a>
            <div class="mt-6 mb-2 px-3 text-xs font-semibold text-slate-400 uppercase tracking-wider">Administrative</div>
            <a class="flex items-center gap-3 px-3 py-2 rounded-lg text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800 hover:text-primary dark:hover:text-white transition-colors group" href="<?= base_url('admin/lemari') ?>">
                <span class="material-symbols-outlined group-hover:text-primary transition-colors">folder_managed</span>
                <span class="text-sm font-medium">Archive Manager</span>
            </a>
            <a class="flex items-center gap-3 px-3 py-2 rounded-lg bg-primary text-white font-medium shadow-md shadow-primary/20 transition-all group" href="<?= base_url('admin/user') ?>">
                <span class="material-symbols-outlined filled">people</span>
                <span class="text-sm">User Management</span>
            </a>
            <a class="flex items-center gap-3 px-3 py-2 rounded-lg text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800 hover:text-primary dark:hover:text-white transition-colors group" 
   href="<?= base_url('admin/settings') ?>">
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
            <div class="max-w-6xl mx-auto space-y-6">
                
                <div class="flex justify-between items-end pb-2">
                    <div>
                        <nav class="flex text-sm text-slate-500 dark:text-slate-400 mb-1">
                            <a class="hover:text-primary" href="<?= base_url('admin/dashboard') ?>">Home</a>
                            <span class="mx-2">/</span>
                            <span class="text-slate-800 dark:text-white font-medium">User Management</span>
                        </nav>
                        <h2 class="text-2xl font-bold text-slate-900 dark:text-white">Staff & Administrators</h2>
                    </div>
                    <div class="flex gap-3">
                        <button class="flex items-center gap-2 bg-primary hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow-md shadow-blue-500/20 transition-all font-medium text-sm">
                            <span class="material-symbols-outlined text-lg">person_add</span>
                            Add New User
                        </button>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-white dark:bg-surface-dark rounded-xl p-6 shadow-soft border border-slate-100 dark:border-slate-700 flex flex-col justify-between group hover:border-blue-200 transition-all">
                        <div class="flex justify-between items-start mb-4">
                            <div class="p-3 bg-blue-50 dark:bg-blue-900/30 rounded-lg text-primary dark:text-blue-400">
                                <span class="material-symbols-outlined text-2xl">group</span>
                            </div>
                            <span class="text-xs font-medium text-slate-500 bg-slate-100 dark:bg-slate-800 px-2 py-1 rounded-full">Total</span>
                        </div>
                        <div>
                            <h3 class="text-3xl font-bold text-slate-900 dark:text-white mb-1"><?= $total_users ?? 0 ?></h3>
                            <p class="text-sm text-slate-500 dark:text-slate-400 font-medium">Active Accounts</p>
                        </div>
                    </div>
                    <div class="bg-white dark:bg-surface-dark rounded-xl p-6 shadow-soft border border-slate-100 dark:border-slate-700 flex flex-col justify-between group hover:border-secondary/50 transition-all">
                        <div class="flex justify-between items-start mb-4">
                            <div class="p-3 bg-amber-50 dark:bg-amber-900/30 rounded-lg text-secondary dark:text-amber-400">
                                <span class="material-symbols-outlined text-2xl">shield_person</span>
                            </div>
                            <span class="text-xs font-medium text-slate-500 bg-slate-100 dark:bg-slate-800 px-2 py-1 rounded-full">Privileged</span>
                        </div>
                        <div>
                            <h3 class="text-3xl font-bold text-slate-900 dark:text-white mb-1"><?= $total_admins ?? 0 ?></h3>
                            <p class="text-sm text-slate-500 dark:text-slate-400 font-medium">Administrators</p>
                        </div>
                    </div>
                    <div class="bg-white dark:bg-surface-dark rounded-xl p-6 shadow-soft border border-slate-100 dark:border-slate-700 flex flex-col justify-between group hover:border-emerald-200 transition-all">
                        <div class="flex justify-between items-start mb-4">
                            <div class="p-3 bg-emerald-50 dark:bg-emerald-900/30 rounded-lg text-emerald-500 dark:text-emerald-400">
                                <span class="material-symbols-outlined text-2xl">login</span>
                            </div>
                            <span class="text-xs font-medium text-emerald-600 bg-emerald-50 dark:bg-emerald-900/20 px-2 py-1 rounded-full">Active Status</span>
                        </div>
                        <div>
                            <h3 class="text-3xl font-bold text-slate-900 dark:text-white mb-1"><?= $total_active ?? 0 ?></h3>
                            <p class="text-sm text-slate-500 dark:text-slate-400 font-medium">Currently Active</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-surface-dark rounded-xl border border-slate-200 dark:border-slate-700 shadow-sm overflow-hidden">
                    <div class="p-5 border-b border-slate-200 dark:border-slate-700 bg-slate-50/50 dark:bg-slate-800/20">
                        <div class="flex flex-col lg:flex-row gap-4 justify-between items-center">
                            <div class="flex items-center gap-2 w-full lg:w-auto">
                                <h3 class="font-bold text-slate-900 dark:text-white whitespace-nowrap">User Directory</h3>
                                <div class="h-4 w-px bg-slate-300 dark:bg-slate-600 mx-2 hidden lg:block"></div>
                                <div class="flex gap-2 overflow-x-auto pb-1 lg:pb-0 w-full lg:w-auto">
                                    <a href="<?= base_url('admin/user') ?>" class="px-3 py-1.5 text-xs font-medium bg-white dark:bg-slate-700 border border-slate-200 dark:border-slate-600 rounded-full text-slate-700 dark:text-slate-200 shadow-sm hover:border-primary transition-colors whitespace-nowrap">All Users</a>
                                </div>
                            </div>
                            
                            <form action="<?= base_url('admin/user') ?>" method="GET" class="flex items-center gap-2 w-full lg:w-auto">
                                <div class="relative flex-1 lg:flex-none lg:w-64">
                                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="material-symbols-outlined text-slate-400 text-sm">search</span>
                                    </span>
                                    <input name="keyword" value="<?= esc($keyword ?? '') ?>" class="block w-full pl-9 pr-3 py-2 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-600 rounded-lg text-sm focus:ring-1 focus:ring-primary focus:border-primary placeholder-slate-400" placeholder="Find user by name..." type="text"/>
                                </div>
                                <button type="submit" class="p-2 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-600 rounded-lg text-slate-500 hover:text-primary hover:border-primary transition-colors">
                                    <span class="material-symbols-outlined text-xl">filter_list</span>
                                </button>
                            </form>
                        </div>
                    </div>
                    
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left">
                            <thead class="text-xs text-slate-500 dark:text-slate-400 uppercase bg-slate-50 dark:bg-slate-800/50 border-b border-slate-200 dark:border-slate-700">
                                <tr>
                                    <th class="px-6 py-4 font-semibold w-12"><input class="rounded border-slate-300 text-primary" type="checkbox"/></th>
                                    <th class="px-6 py-4 font-semibold">User Identity</th>
                                    <th class="px-6 py-4 font-semibold">Role & Department</th>
                                    <th class="px-6 py-4 font-semibold">Status</th>
                                    <th class="px-6 py-4 font-semibold">Last Login</th>
                                    <th class="px-6 py-4 font-semibold text-right">Management</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-200 dark:divide-slate-700">
                                
                                <?php if(empty($users)): ?>
                                    <tr>
                                        <td colspan="6" class="px-6 py-4 text-center text-slate-500">Tidak ada user ditemukan.</td>
                                    </tr>
                                <?php else: ?>
                                    <?php foreach($users as $u): 
                                        // Logic inisial nama (Misal "Budi Santoso" -> "BS")
                                        $initials = '';
                                        $parts = explode(' ', $u['nama_lengkap']);
                                        foreach($parts as $part) { $initials .= strtoupper(substr($part, 0, 1)); }
                                        $initials = substr($initials, 0, 2);
                                        
                                        // Logic Warna Badge Role
                                        $roleColor = ($u['role'] == 'admin') ? 'bg-primary/10 text-primary border-primary/20' : 'bg-slate-100 text-slate-600 border-slate-200';
                                        
                                        // Logic Warna Badge Status
                                        $statusClass = ($u['status'] == 'active') 
                                            ? 'text-emerald-600 bg-emerald-50 dark:bg-emerald-900/20' 
                                            : 'text-red-600 bg-red-50 dark:bg-red-900/20';
                                        $statusDot = ($u['status'] == 'active') ? 'bg-emerald-500' : 'bg-red-500';
                                    ?>
                                    <tr class="group hover:bg-blue-50/50 dark:hover:bg-blue-900/10 transition-colors">
                                        <td class="px-6 py-4">
                                            <input class="rounded border-slate-300 text-primary" type="checkbox"/>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-3">
                                                <div class="size-9 rounded-full bg-primary/10 text-primary flex items-center justify-center font-bold text-xs">
                                                    <?= $initials ?>
                                                </div>
                                                <div class="flex flex-col">
                                                    <span class="font-medium text-slate-900 dark:text-white group-hover:text-primary transition-colors"><?= esc($u['nama_lengkap']) ?></span>
                                                    <span class="text-xs text-slate-500 dark:text-slate-400"><?= esc($u['email']) ?></span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex flex-col">
                                                <div class="flex items-center gap-1.5 mb-1">
                                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wide border <?= $roleColor ?>">
                                                        <?= esc($u['role']) ?>
                                                    </span>
                                                </div>
                                                <span class="text-xs text-slate-500 dark:text-slate-400"><?= esc($u['divisi'] ?? '-') ?></span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="inline-flex items-center gap-1.5 text-xs font-medium <?= $statusClass ?> px-2 py-1 rounded-full">
                                                <span class="w-1.5 h-1.5 rounded-full <?= $statusDot ?>"></span>
                                                <?= ucfirst(esc($u['status'])) ?>
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-slate-500 dark:text-slate-400 text-xs">
                                            <div class="flex flex-col">
                                                <span><?= $u['last_login'] ? date('M d, Y H:i', strtotime($u['last_login'])) : 'Never' ?></span>
                                                <span class="text-[10px] text-slate-400">IP: <?= esc($u['ip_address'] ?? '-') ?></span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            <div class="flex items-center justify-end gap-2">
                                                <button class="px-2 py-1 text-xs font-medium text-slate-600 bg-white border border-slate-200 rounded hover:bg-slate-50 hover:text-primary transition-colors">
                                                    Edit
                                                </button>
                                                <button class="p-1.5 text-slate-400 hover:text-red-500 rounded transition-colors" title="Suspend">
                                                    <span class="material-symbols-outlined text-lg">block</span>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="px-5 py-3 border-t border-slate-200 dark:border-slate-700 flex items-center justify-between">
                        <span class="text-xs text-slate-500 dark:text-slate-400">Total Users: <strong><?= $total_users ?></strong></span>
                        <div class="flex gap-1 text-sm">
                            <?php if(isset($pager)): ?>
                                <?= $pager->links('users', 'default_full') ?>
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