<!DOCTYPE html>
<html class="light" lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title><?= $title ?? 'Admin Dashboard' ?> | SIAD Navigasi</title>
    
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    
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
                        "navy-dark": "#0a2369",
                    },
                    fontFamily: {
                        "display": ["Public Sans", "sans-serif"]
                    }
                },
            },
        }
    </script>
    <style>
        body { font-family: 'Public Sans', sans-serif; background-color: #f6f6f8; }
        .sidebar-active { background-color: rgba(255, 255, 255, 0.1); border-left: 4px solid #d4af37; }
    </style>
</head>
<body class="text-slate-800 bg-[#f6f6f8]">
<div class="flex min-h-screen">

    <aside class="w-64 bg-navy-dark text-white flex flex-col shadow-xl fixed inset-y-0 z-50">
        <div class="p-6 border-b border-white/10 flex flex-col items-center">
            <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center mb-4 overflow-hidden border-2 border-accent-gold">
                <i class="material-icons text-navy-dark text-2xl">anchor</i>
            </div>
            <h1 class="text-xs font-bold text-center tracking-wide leading-tight uppercase">Distrik Navigasi<br/>Tipe A Kelas I</h1>
            <p class="text-[10px] text-white/60 mt-2 uppercase tracking-widest font-medium">Administrator System</p>
        </div>
        
        <nav class="flex-1 px-4 py-6 space-y-1">
            <div class="pt-2 pb-2 px-4 text-[10px] font-bold text-white/40 uppercase tracking-widest">Main Menu</div>
            
            <a class="flex items-center px-4 py-3 text-sm rounded-lg transition-all <?= (uri_string() == 'admin/dashboard') ? 'sidebar-active text-white font-bold' : 'text-white/70 hover:bg-white/10 hover:text-white' ?>" 
               href="<?= base_url('admin/dashboard') ?>">
                <span class="material-symbols-outlined mr-3 <?= (uri_string() == 'admin/dashboard') ? 'text-accent-gold' : 'opacity-70' ?>">grid_view</span>
                <span>Dashboard Overview</span>
            </a>
            
            <div class="pt-6 pb-2 px-4 text-[10px] font-bold text-white/40 uppercase tracking-widest">Master Data</div>
            
            <a class="flex items-center px-4 py-3 text-sm rounded-lg transition-all <?= (uri_string() == 'admin/gedung') ? 'sidebar-active text-white font-bold' : 'text-white/70 hover:bg-white/10 hover:text-white' ?>" 
               href="<?= base_url('admin/gedung') ?>">
                <span class="material-symbols-outlined mr-3 <?= (uri_string() == 'admin/gedung') ? 'text-accent-gold' : 'opacity-70' ?>">corporate_fare</span>
                <span>Manajemen Gedung</span>
            </a>
            
            <a class="flex items-center px-4 py-3 text-sm text-white/70 hover:bg-white/10 hover:text-white rounded-lg transition-all" href="#">
                <span class="material-symbols-outlined mr-3 opacity-70">meeting_room</span>
                <span>Manajemen Ruang</span>
            </a>
            
            <a class="flex items-center px-4 py-3 text-sm rounded-lg transition-all <?= (uri_string() == 'admin/lemari') ? 'sidebar-active text-white font-bold' : 'text-white/70 hover:bg-white/10 hover:text-white' ?>" 
   href="<?= base_url('admin/lemari') ?>">
    <span class="material-symbols-outlined mr-3 <?= (uri_string() == 'admin/lemari') ? 'text-accent-gold' : 'opacity-70' ?>">archive</span>
    <span>Manajemen Lemari</span>
</a>
            
            <div class="pt-6 pb-2 px-4 text-[10px] font-bold text-white/40 uppercase tracking-widest">System Settings</div>
            
            <a class="flex items-center px-4 py-3 text-sm rounded-lg transition-all <?= (uri_string() == 'admin/user') ? 'sidebar-active text-white font-bold' : 'text-white/70 hover:bg-white/10 hover:text-white' ?>" 
               href="<?= base_url('admin/user') ?>">
                <span class="material-symbols-outlined mr-3 <?= (uri_string() == 'admin/user') ? 'text-accent-gold' : 'opacity-70' ?>">group</span>
                <span>User Management</span>
            </a>
        </nav>
        
        <div class="p-4 border-t border-white/10">
            <div class="flex items-center p-3 bg-white/10 rounded-xl">
                <div class="w-10 h-10 rounded-full bg-primary flex items-center justify-center font-bold text-sm">
                    <?= session()->get('nama_user') ? substr(session()->get('nama_user'), 0, 2) : 'AD' ?>
                </div>
                <div class="ml-3 overflow-hidden flex-1">
                    <p class="text-xs font-bold truncate"><?= session()->get('nama_user') ?? 'Administrator' ?></p>
                    <p class="text-[10px] text-white/50 truncate">Super Admin</p>
                </div>
                <a href="<?= base_url('logout') ?>" class="text-white/40 hover:text-red-400 transition-colors">
                    <span class="material-symbols-outlined text-lg">logout</span>
                </a>
            </div>
        </div>
    </aside>

    <main class="flex-1 ml-64 bg-[#f6f6f8]">
        <header class="bg-white border-b border-slate-200 px-8 py-4 flex items-center justify-between sticky top-0 z-40">
            <div class="flex items-center gap-4 text-xs font-medium">
                <span class="text-slate-400">Admin Console</span>
                <span class="material-symbols-outlined text-slate-300 text-sm">chevron_right</span>
                <span class="text-primary font-bold"><?= $title ?? 'System & Master Data' ?></span>
            </div>
            <div class="flex items-center gap-6">
                <div class="relative hidden md:block">
                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-[18px]">search</span>
                    <input class="pl-10 pr-4 py-1.5 bg-[#f6f6f8] border-none rounded-lg text-xs w-64 focus:ring-1 focus:ring-primary text-slate-600" placeholder="Cari NIP atau Lokasi..." type="text"/>
                </div>
                <div class="flex items-center gap-4 border-l border-slate-100 pl-6">
                    <button class="relative text-slate-400 hover:text-primary">
                        <span class="material-symbols-outlined text-[22px]">notifications</span>
                        <span class="absolute -top-0.5 -right-0.5 w-2 h-2 bg-red-500 rounded-full border-2 border-white"></span>
                    </button>
                    <div class="text-xs font-bold text-slate-700"><?= date('l, d F Y') ?></div>
                </div>
            </div>
        </header>

        <div class="p-8">
            <?= $this->renderSection('content') ?>
        </div>
        
    </main>
</div>
</body>
</html>