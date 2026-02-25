<!DOCTYPE html>
<html class="light" lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title><?= $title ?? 'Staff Dashboard' ?> | SIAD Navigasi</title>
    
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700;900&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#135bec",
                        "primary-dark": "#0B2B6B",
                        "background-light": "#f6f6f8",
                        "background-dark": "#101622",
                    },
                    fontFamily: {
                        "display": ["Public Sans", "sans-serif"]
                    }
                }
            }
        }
    </script>
    <style>
        html, body {
            font-family: "Public Sans", sans-serif;
            overscroll-behavior: none !important;
            overscroll-behavior-y: none !important;
        }
        .overflow-y-auto, .overflow-auto { overscroll-behavior: none !important; }
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
        .sidebar-gradient { background: linear-gradient(180deg, #0B2B6B 0%, #135bec 100%); }
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body class="bg-background-light text-slate-900 antialiased overscroll-none">
<div class="flex min-h-screen">

    <aside class="sidebar-gradient w-72 flex-shrink-0 text-white flex flex-col fixed inset-y-0 left-0 z-50">
        <div class="p-6">
            <div class="flex items-center gap-3 mb-8">
                <div class="bg-white/10 p-2 rounded-lg backdrop-blur-sm border border-white/20">
                    <span class="material-symbols-outlined text-white text-3xl">account_balance</span>
                </div>
                <div>
                    <h1 class="text-lg font-bold leading-none uppercase">Archival HQ</h1>
                    <p class="text-white/60 text-xs font-medium uppercase tracking-wider mt-1">Staff Portal</p>
                </div>
            </div>
            
            <nav class="space-y-1 overflow-y-auto no-scrollbar">
                <a class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all <?= (uri_string() == 'staf/dashboard') ? 'bg-white/10 text-white font-medium border-l-4 border-white' : 'hover:bg-white/5 text-white/80 hover:text-white' ?>" 
                   href="<?= base_url('staf/dashboard') ?>">
                    <span class="material-symbols-outlined">dashboard</span>
                    <span>Dashboard Overview</span>
                </a>
                
                <a class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all <?= (uri_string() == 'staf/arsip') ? 'bg-white/10 text-white font-medium border-l-4 border-white' : 'hover:bg-white/5 text-white/80 hover:text-white' ?>" 
                   href="<?= base_url('staf/arsip') ?>">
                    <span class="material-symbols-outlined">inventory_2</span>
                    <span>Data Arsip (Inventory)</span>
                </a>
                
                <a class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-white/5 text-white/80 hover:text-white transition-all" href="#">
                    <span class="material-symbols-outlined">document_scanner</span>
                    <span>Scanning Queue</span>
                </a>
                
                <a class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-white/5 text-white/80 hover:text-white transition-all" href="#">
                    <span class="material-symbols-outlined">package_2</span>
                    <span>Peminjaman (Loans)</span>
                </a>
            </nav>
        </div>
        
        <div class="mt-auto p-6 space-y-4">
            <a href="<?= base_url('staf/arsip/create') ?>" class="w-full bg-white text-primary font-bold py-3 px-4 rounded-lg flex items-center justify-center gap-2 shadow-lg hover:bg-blue-50 transition-colors">
                <span class="material-symbols-outlined">add_circle</span>
                <span>Log New Archive</span>
            </a>
            <div class="pt-4 border-t border-white/10 flex flex-col gap-1">
                <a class="flex items-center gap-3 px-4 py-2 text-white/60 hover:text-white text-sm transition-colors" href="<?= base_url('logout') ?>">
                    <span class="material-symbols-outlined text-sm text-red-400">logout</span>
                    <span class="text-red-400 font-bold">Logout System</span>
                </a>
            </div>
        </div>
    </aside>

    <main class="flex-1 ml-72 overflow-auto overscroll-none h-screen flex flex-col">
        <header class="sticky top-0 z-40 bg-white/80 backdrop-blur-md border-b border-slate-200 px-8 py-4 flex items-center justify-between shrink-0">
            <div class="flex items-center gap-4 w-full max-w-xl">
                <form action="<?= base_url('staf/arsip') ?>" method="GET" class="relative w-full">
                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400">search</span>
                    <input name="keyword" class="w-full pl-10 pr-4 py-2 bg-slate-100 border-none rounded-lg focus:ring-2 focus:ring-primary text-sm" placeholder="Search records, boxes, or loans..." type="text"/>
                </form>
            </div>
            
            <div class="flex items-center gap-4">
                <div class="flex items-center gap-2 px-3 py-1.5 bg-green-50 text-green-700 rounded-full text-xs font-semibold">
                    <span class="size-2 bg-green-500 rounded-full animate-pulse"></span>
                    System: Online
                </div>
                
                <div class="flex items-center gap-3 pl-4 border-l border-slate-200">
                    <div class="text-right hidden sm:block">
                        <p class="text-sm font-bold text-slate-900"><?= session()->get('nama_user') ?? 'Staff Pegawai' ?></p>
                        <p class="text-xs text-slate-500 font-medium">Divisi <?= session()->get('kode_bagian') ?? 'Operasional' ?></p>
                    </div>
                    <div class="w-10 h-10 rounded-full bg-primary flex items-center justify-center text-white font-bold">
                        <?= session()->get('nama_user') ? substr(session()->get('nama_user'), 0, 2) : 'ST' ?>
                    </div>
                </div>
            </div>
        </header>

        <div class="p-8 pb-12 flex-1">
            <?= $this->renderSection('content') ?>
        </div>
    </main>
</div>
</body>
</html>