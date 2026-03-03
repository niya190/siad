<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title><?= $title ?> - SiArsip Navigasi</title>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@400;500;700;900&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script>
      tailwind.config = { darkMode: "class", theme: { extend: { colors: { "primary": "#135bec", "background-light": "#f6f6f8", "nav-blue": "#1e40af" }, fontFamily: { "display": ["Public Sans", "sans-serif"] } } } }
    </script>
</head>
<body class="bg-background-light text-slate-900 min-h-screen flex flex-col font-display">

<header class="sticky top-0 z-50 w-full bg-nav-blue shadow-lg">
    <div class="mx-auto flex max-w-[1280px] items-center justify-between px-6 py-3">
        <div class="flex items-center gap-8">
            <div class="flex items-center gap-3">
                <div class="flex size-10 items-center justify-center rounded-lg bg-white/10 text-white backdrop-blur-sm"><span class="material-symbols-outlined text-2xl">folder_managed</span></div>
                <div><h2 class="text-lg font-bold leading-tight text-white">SiArsip</h2><p class="text-xs text-blue-200">Navigasi Tanjungpinang</p></div>
            </div>
           <nav class="hidden items-center gap-1 md:flex">
    <a class="rounded-lg px-3 py-2 text-sm font-medium text-blue-100 hover:bg-white/10 hover:text-white transition-colors <?= (url_is('staf/dashboard')) ? 'bg-white/20 text-white shadow-sm' : '' ?>" href="<?= base_url('staf/dashboard') ?>">Dashboard</a>
    <a class="rounded-lg px-3 py-2 text-sm font-medium text-blue-100 hover:bg-white/10 hover:text-white transition-colors <?= (url_is('staf/arsip-masuk')) ? 'bg-white/20 text-white shadow-sm' : '' ?>" href="<?= base_url('staf/arsip-masuk') ?>">Arsip Masuk</a>
    <a class="rounded-lg px-3 py-2 text-sm font-medium text-blue-100 hover:bg-white/10 hover:text-white transition-colors <?= (url_is('staf/arsip-keluar')) ? 'bg-white/20 text-white shadow-sm' : '' ?>" href="<?= base_url('staf/arsip-keluar') ?>">Arsip Keluar</a>
    <a class="rounded-lg px-3 py-2 text-sm font-medium text-blue-100 hover:bg-white/10 hover:text-white transition-colors <?= (url_is('staf/nota-dinas')) ? 'bg-white/20 text-white shadow-sm' : '' ?>" href="<?= base_url('staf/nota-dinas') ?>">Nota Dinas</a>
    <a class="rounded-lg px-3 py-2 text-sm font-medium text-blue-100 hover:bg-white/10 hover:text-white transition-colors <?= (url_is('staf/laporan')) ? 'bg-white/20 text-white shadow-sm' : '' ?>" href="<?= base_url('staf/laporan') ?>">Laporan</a>
</nav>
        </div>
        <div class="flex items-center gap-4">
            <div class="hidden w-64 md:block">
                <form action="<?= base_url('staf/arsip') ?>" method="GET" class="relative flex items-center">
                    <span class="material-symbols-outlined absolute left-3 text-[20px] text-blue-300">search</span>
                    <input name="keyword" class="w-full rounded-lg border-none bg-blue-900/50 py-2 pl-10 pr-4 text-sm text-white placeholder-blue-300 focus:bg-blue-900 focus:ring-2 focus:ring-white/20" placeholder="Cari arsip..." type="text"/>
                </form>
            </div>
            <a href="<?= base_url('staf/notifications') ?>" class="relative flex size-9 items-center justify-center rounded-full text-blue-100 hover:bg-white/10 hover:text-white transition-colors cursor-pointer">
                <span class="material-symbols-outlined text-[20px]">notifications</span>
                <span class="absolute right-1.5 top-1.5 size-2 rounded-full bg-red-500 ring-2 ring-nav-blue"></span>
            </a>
            <div class="flex items-center gap-3 border-l border-blue-800 pl-4">
                <div class="hidden text-right md:block">
                    <p class="text-sm font-semibold text-white"><?= esc(session()->get('nama_lengkap') ?? 'User Staff') ?></p>
                    <p class="text-xs text-blue-200"><?= esc(session()->get('divisi') ?? 'Staff') ?></p>
                </div>
</header>

<main class="flex-1 px-4 py-8 md:px-8">
    <div class="mx-auto max-w-[1280px]">
        <nav class="mb-6 flex items-center text-sm text-slate-500">
            <a class="hover:text-primary" href="<?= base_url('staf/dashboard') ?>">Dashboard</a>
            <span class="mx-2 material-symbols-outlined text-[16px]">chevron_right</span>
            <span class="font-medium text-slate-900">Aktivitas Terbaru</span>
        </nav>
        
        <div class="mb-8 flex flex-col justify-between gap-4 md:flex-row md:items-end">
            <div>
                <h1 class="text-3xl font-black tracking-tight text-slate-900 md:text-4xl">Aktivitas Terbaru</h1>
                <p class="mt-2 text-lg text-slate-500">Pantau log aktivitas pergerakan dokumen arsip.</p>
            </div>
            <div class="flex gap-3">
                <button class="flex items-center gap-2 rounded-lg border border-slate-200 bg-white px-4 py-2 text-sm font-medium text-slate-700 hover:bg-slate-50 transition-colors">
                    <span class="material-symbols-outlined text-[20px]">download</span> Ekspor Log
                </button>
            </div>
        </div>

        <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500">Pengguna</th>
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500">Aktivitas</th>
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500">Record Surat</th>
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500">Waktu</th>
                            <th class="px-6 py-4 text-right"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        
                        <?php if(empty($aktivitas)): ?>
                            <tr><td colspan="5" class="px-6 py-8 text-center text-slate-500">Belum ada aktivitas tercatat.</td></tr>
                        <?php else: ?>
                            <?php foreach($aktivitas as $log): 
                                // LOGIKA PINTAR: Cek apakah data baru dibuat atau sekadar diedit
                                $is_new = ($log['created_at'] === $log['updated_at']);
                                $action_text = $is_new ? 'Menambahkan arsip baru' : 'Memperbarui data arsip';
                                $icon = $is_new ? 'add_circle' : 'edit_document';
                                $icon_color = $is_new ? 'text-green-500' : 'text-blue-500';
                                
                                // Bikin inisial nama otomatis (Misal: "Budi Santoso" jadi "BS")
                                $nama = esc($log['nama_lengkap'] ?? 'System');
                                $words = explode(' ', $nama);
                                $inisial = strtoupper(substr($words[0], 0, 1) . (isset($words[1]) ? substr($words[1], 0, 1) : ''));
                                $bg_color = $is_new ? 'bg-green-100 text-green-700' : 'bg-blue-100 text-blue-700';
                            ?>
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="size-8 rounded-full <?= $bg_color ?> flex items-center justify-center font-bold text-xs">
                                            <?= $inisial ?>
                                        </div>
                                        <span class="text-sm font-semibold text-slate-900"><?= $nama ?></span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <span class="material-symbols-outlined text-[18px] <?= $icon_color ?>"><?= $icon ?></span>
                                        <span class="text-sm text-slate-600"><?= $action_text ?></span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm font-medium text-primary"><?= esc($log['nomor_surat']) ?></td>
                                <td class="px-6 py-4 text-sm text-slate-500"><?= date('d M Y, H:i', strtotime($log['updated_at'])) ?></td>
                                <td class="px-6 py-4 text-right">
                                    <a href="<?= base_url('staf/arsip/detail/' . $log['id_arsip']) ?>" class="text-sm font-bold text-primary hover:underline">Lihat Detail</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>

                    </tbody>
                </table>
            </div>
            <div class="border-t border-slate-100 p-4 bg-slate-50 flex items-center justify-between">
                <p class="text-xs text-slate-500">Menampilkan histori aktivitas terbaru</p>
            </div>
        </div>
    </div>
</main>
</body>
</html>