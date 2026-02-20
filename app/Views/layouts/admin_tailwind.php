<!DOCTYPE html>
<html class="light" lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title><?= $title ?? 'Admin Dashboard' ?> | SIAD Navigasi</title>
    
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"/>
    
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#135bec",
                        "accent-gold": "#d4af37",
                        "background-light": "#f6f6f8",
                        "background-dark": "#101622",
                        "navy-dark": "#0a2e7a",
                    },
                    fontFamily: {
                        "display": ["Public Sans", "sans-serif"]
                    }
                },
            },
        }
    </script>
    <style>
        body { font-family: 'Public Sans', sans-serif; }
        .sidebar-active { background-color: rgba(255, 255, 255, 0.1); border-left: 4px solid #d4af37; }
        .data-table-row:hover { background-color: rgba(19, 91, 236, 0.03); }
    </style>
</head>
<body class="bg-background-light text-slate-800">
<div class="flex min-h-screen">

    <aside class="w-72 bg-navy-dark text-white flex flex-col shadow-xl fixed inset-y-0 z-50">
        <div class="p-6 border-b border-white/10 flex flex-col items-center">
            <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center mb-4 overflow-hidden border-2 border-accent-gold">
                <i class="material-icons text-navy-dark text-3xl">anchor</i>
            </div>
            <h1 class="text-sm font-bold text-center tracking-wide leading-tight">DISTRIK NAVIGASI<br/>TIPE A KELAS I</h1>
            <p class="text-[10px] text-white/60 mt-2 uppercase tracking-widest font-medium">Administrator System</p>
        </div>
        
        <nav class="flex-1 px-4 py-6 space-y-2">
            <a class="flex items-center px-4 py-3 text-sm sidebar-active rounded-sm group transition-all" href="<?= base_url('admin/dashboard') ?>">
                <span class="material-icons mr-3 text-accent-gold">dashboard</span>
                <span class="font-medium">Dashboard Overview</span>
            </a>
            
            <div class="pt-4 pb-2 px-4 text-[11px] font-bold text-white/40 uppercase tracking-widest">Master Data</div>
            <a class="flex items-center px-4 py-3 text-sm text-white/70 hover:bg-white/5 hover:text-white rounded-sm transition-all" href="#">
                <span class="material-icons mr-3 opacity-70">corporate_fare</span>
                <span>Manajemen Gedung</span>
            </a>
            <a class="flex items-center px-4 py-3 text-sm text-white/70 hover:bg-white/5 hover:text-white rounded-sm transition-all" href="#">
                <span class="material-icons mr-3 opacity-70">inventory_2</span>
                <span>Manajemen Lemari</span>
            </a>
            
            <div class="pt-4 pb-2 px-4 text-[11px] font-bold text-white/40 uppercase tracking-widest">System Settings</div>
            <a class="flex items-center px-4 py-3 text-sm text-white/70 hover:bg-white/5 hover:text-white rounded-sm transition-all" href="#">
                <span class="material-icons mr-3 opacity-70">people_alt</span>
                <span>User Management</span>
            </a>
        </nav>
        
        <div class="p-4 border-t border-white/10">
            <div class="flex items-center p-3 bg-white/5 rounded-lg">
                <div class="w-10 h-10 rounded-full bg-primary flex items-center justify-center font-bold text-sm">
                    <?= substr(session()->get('nama_user'), 0, 2) ?>
                </div>
                <div class="ml-3 overflow-hidden">
                    <p class="text-xs font-bold truncate"><?= session()->get('nama_user') ?></p>
                    <p class="text-[10px] text-white/50 truncate">Super Admin</p>
                </div>
                <a href="<?= base_url('logout') ?>" class="ml-auto text-white/40 hover:text-red-400 transition-colors">
                    <span class="material-icons text-sm">logout</span>
                </a>
            </div>
        </div>
    </aside>

    <main class="flex-1 ml-72">
        <header class="bg-white border-b border-slate-200 h-16 flex items-center justify-between px-8 sticky top-0 z-40">
            <div class="flex items-center space-x-4">
                <nav aria-label="Breadcrumb" class="flex text-xs font-medium text-slate-500">
                    <ol class="inline-flex items-center space-x-1 md:space-x-3">
                        <li class="inline-flex items-center">Admin Console</li>
                        <li><span class="material-icons text-xs mx-1">chevron_right</span></li>
                        <li class="text-primary font-bold"><?= $title ?? 'Dashboard' ?></li>
                    </ol>
                </nav>
            </div>
            <div class="flex items-center space-x-6">
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-400">
                        <span class="material-icons text-sm">search</span>
                    </span>
                    <input class="block w-64 pl-10 pr-3 py-1.5 border border-slate-200 rounded-lg text-xs focus:ring-primary focus:border-primary bg-slate-50 transition-all" placeholder="Cari NIP / Lokasi..." type="text"/>
                </div>
                <div class="h-8 w-px bg-slate-200"></div>
                <span class="text-xs font-bold text-slate-600"><?= date('l, d F Y') ?></span>
            </div>
        </header>

        <div class="p-8 space-y-8">
            <?= $this->renderSection('content') ?>
        </div>

        <footer class="px-8 py-6 text-center border-t border-slate-200 mt-12">
            <p class="text-[10px] font-medium text-slate-400 uppercase tracking-[0.2em]">© <?= date('Y') ?> Distrik Navigasi Tipe A Kelas I - Kementerian Perhubungan</p>
        </footer>
    </main>
</div>
</body>
</html>