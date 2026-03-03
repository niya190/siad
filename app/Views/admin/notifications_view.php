<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title><?= $title ?> - Admin SiArsip</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script>
        tailwind.config = { darkMode: "class", theme: { extend: { colors: { primary: "#0e4c92", "background-light": "#f8fafc", "background-dark": "#0f172a", "surface-dark": "#1e293b", "sidebar-bg": "#ffffff" }, fontFamily: { display: ["Public Sans", "sans-serif"] } } } }
    </script>
</head>
<body class="bg-background-light font-display text-slate-900 antialiased h-screen flex flex-col overflow-hidden">

<header class="h-16 bg-white border-b border-slate-200 flex items-center justify-between px-6 z-20 shadow-sm flex-shrink-0">
    <div class="flex items-center gap-3">
        <div class="size-10 rounded-lg bg-primary flex items-center justify-center text-white shadow-lg"><span class="material-symbols-outlined text-2xl">anchor</span></div>
        <div><h1 class="text-sm font-bold leading-tight">Distrik Navigasi</h1><p class="text-slate-500 text-xs font-medium">Tanjungpinang - Kelas I</p></div>
    </div>
    <div class="flex items-center gap-4">
        <a href="<?= base_url('admin/dashboard') ?>" class="text-sm font-bold text-primary hover:underline flex items-center gap-1"><span class="material-symbols-outlined text-lg">arrow_back</span> Kembali ke Dashboard</a>
    </div>
</header>

<div class="flex flex-1 overflow-hidden">
    <main class="flex-1 flex flex-col overflow-y-auto bg-slate-50 relative p-6 lg:p-8 scroll-smooth">
        <div class="max-w-4xl mx-auto w-full">
            
            <div class="mb-8 border-b border-slate-200 pb-4">
                <h2 class="text-2xl font-bold text-slate-900 flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary">history</span> Riwayat Aktivitas Sistem
                </h2>
                <p class="text-sm text-slate-500 mt-1">Pantau 50 log pergerakan arsip terakhir yang direkam oleh sistem.</p>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 md:p-8">
                <div class="space-y-6 relative before:absolute before:inset-0 before:ml-5 before:-translate-x-px md:before:mx-auto md:before:translate-x-0 before:h-full before:w-0.5 before:bg-gradient-to-b before:from-transparent before:via-slate-300 before:to-transparent">
                    
                    <?php if(empty($logs)): ?>
                        <div class="text-center text-slate-500 py-10 relative z-10 bg-white">Belum ada aktivitas yang direkam.</div>
                    <?php else: ?>
                        <?php foreach($logs as $log): ?>
                        
                        <div class="relative flex items-center justify-between md:justify-normal md:odd:flex-row-reverse group is-active">
                            <div class="flex items-center justify-center w-10 h-10 rounded-full border-4 border-white bg-blue-100 text-blue-600 shadow shrink-0 md:order-1 md:group-odd:-translate-x-1/2 md:group-even:translate-x-1/2">
                                <span class="material-symbols-outlined text-[18px]">post_add</span>
                            </div>
                            
                            <div class="w-[calc(100%-4rem)] md:w-[calc(50%-2.5rem)] p-4 rounded-xl border border-slate-200 bg-slate-50 shadow-sm hover:border-primary transition-colors">
                                <div class="flex items-center justify-between mb-1">
                                    <span class="font-bold text-slate-900 text-sm"><?= esc($log['nama_lengkap'] ?? 'Sistem') ?></span>
                                    <span class="text-[10px] font-semibold text-slate-500 bg-white px-2 py-0.5 rounded border"><?= date('d/m/Y H:i', strtotime($log['created_at'])) ?></span>
                                </div>
                                <p class="text-xs text-slate-600 mb-3 leading-relaxed">
                                    Menambahkan arsip <span class="font-semibold text-primary"><?= esc($log['jenis_arsip']) ?></span> baru.
                                </p>
                                
                                <div class="bg-white p-3 rounded-lg border border-slate-200">
                                    <p class="text-xs text-slate-400 mb-0.5">Nomor Surat:</p>
                                    <p class="text-sm font-bold text-slate-800"><?= esc($log['nomor_surat']) ?></p>
                                    
                                    <a href="<?= base_url('admin/arsip/detail/' . $log['id_arsip']) ?>" class="mt-3 inline-flex items-center gap-1 text-[11px] font-bold text-white bg-slate-800 hover:bg-primary px-3 py-1.5 rounded transition-colors w-max">
                                        Lihat Detail <span class="material-symbols-outlined text-[14px]">visibility</span>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <?php endforeach; ?>
                    <?php endif; ?>

                </div>
            </div>
            
        </div>
    </main>
</div>
</body>
</html>