<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title><?= $title ?? 'Laporan & Analitik' ?> - SiArsip Navigasi</title>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@400;500;700;900&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script>
      tailwind.config = {
        darkMode: "class",
        theme: { extend: { colors: { "primary": "#135bec", "background-light": "#f6f6f8", "background-dark": "#101622", "nav-blue": "#1e40af" }, fontFamily: { "display": ["Public Sans", "sans-serif"] } } }
      }
    </script>
    <style> body { font-family: "Public Sans", sans-serif; } </style>
</head>
<body class="bg-background-light dark:bg-background-dark text-slate-900 dark:text-slate-100 min-h-screen flex flex-col font-display">

<header class="sticky top-0 z-50 w-full bg-nav-blue shadow-lg">
    <div class="mx-auto flex max-w-[1280px] items-center justify-between px-6 py-3">
        <div class="flex items-center gap-8">
            <div class="flex items-center gap-3">
                <div class="flex size-10 items-center justify-center rounded-lg bg-white/10 text-white backdrop-blur-sm">
                    <span class="material-symbols-outlined text-2xl">folder_managed</span>
                </div>
                <div>
                    <h2 class="text-lg font-bold leading-tight text-white">SiArsip</h2>
                    <p class="text-xs text-blue-200">Navigasi Tanjungpinang</p>
                </div>
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
                <div class="relative flex items-center">
                    <span class="material-symbols-outlined absolute left-3 text-[20px] text-blue-300">search</span>
                    <input class="w-full rounded-lg border-none bg-blue-900/50 py-2 pl-10 pr-4 text-sm text-white placeholder-blue-300 focus:bg-blue-900 focus:ring-2 focus:ring-white/20" placeholder="Cari arsip..." type="text"/>
                </div>
            </div>
            
            <button class="relative flex size-9 items-center justify-center rounded-full text-blue-100 hover:bg-white/10 hover:text-white">
                <span class="material-symbols-outlined text-[20px]">notifications</span>
                <span class="absolute right-1.5 top-1.5 size-2 rounded-full bg-red-500 ring-2 ring-nav-blue"></span>
            </button>

            <div class="flex items-center gap-3 border-l border-blue-800 pl-4">
                <div class="hidden text-right md:block">
                    <p class="text-sm font-semibold text-white"><?= esc(session()->get('nama_lengkap') ?? 'User Staff') ?></p>
                    <p class="text-xs text-blue-200"><?= esc(session()->get('divisi') ?? 'Staff') ?></p>
                </div>
                
                <?php 
                    $nama = session()->get('nama_lengkap') ?? 'Staf';
                    $parts = explode(' ', $nama);
                    $initials = strtoupper(substr($parts[0], 0, 1) . (isset($parts[1]) ? substr($parts[1], 0, 1) : ''));
                ?>
                <button class="relative flex size-10 items-center justify-center overflow-hidden rounded-full border-2 border-blue-400/30 bg-white text-primary font-bold ring-2 ring-white/10 transition-all hover:ring-white/30">
                    <?= $initials ?>
                </button>
                <a href="<?= base_url('login/logout') ?>" class="text-blue-200 hover:text-red-400 ml-2 transition-colors" title="Logout">
                    <span class="material-symbols-outlined">logout</span>
                </a>
            </div>
        </div>
    </div>
</header>

<main class="flex-1 overflow-x-hidden px-4 py-8 md:px-8">
    <div class="mx-auto max-w-[1280px]">
        <div class="mb-8">
            <nav class="mb-4 flex items-center text-sm text-slate-500 dark:text-slate-400">
                <a class="hover:text-primary" href="<?= base_url('staf/dashboard') ?>">Dashboard</a>
                <span class="mx-2 material-symbols-outlined text-[16px]">chevron_right</span>
                <span class="font-medium text-slate-900 dark:text-slate-100">Laporan & Analitik</span>
            </nav>
            <h1 class="text-3xl font-black tracking-tight text-slate-900 dark:text-white md:text-4xl">Laporan & Statistik Arsip</h1>
            <p class="mt-2 text-lg text-slate-500 dark:text-slate-400">Buat laporan aktivitas, ringkasan arsip, dan ekspor data.</p>
        </div>

        <div class="grid grid-cols-1 gap-8 lg:grid-cols-12">
            
            <div class="lg:col-span-4">
                <div class="rounded-xl border border-slate-200 bg-white shadow-sm dark:border-slate-800 dark:bg-slate-900">
                    <div class="border-b border-slate-100 px-6 py-4 dark:border-slate-800">
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary">tune</span> Konfigurasi Laporan
                        </h3>
                    </div>
                    <form method="GET" action="" class="p-6 space-y-6">
                        <div class="space-y-3">
                            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300">Jenis Laporan</label>
                            <div class="grid gap-3">
                                <label class="relative flex cursor-pointer rounded-lg border border-primary bg-primary/5 p-4 ring-1 ring-primary">
                                    <input checked class="sr-only" name="report-type" type="radio" value="inventory"/>
                                    <span class="flex flex-1 flex-col">
                                        <span class="block text-sm font-medium text-slate-900 dark:text-white">Inventaris Keseluruhan</span>
                                        <span class="mt-1 flex items-center text-xs text-slate-500 dark:text-slate-400">Seluruh jenis arsip di sistem</span>
                                    </span>
                                    <span class="material-symbols-outlined text-primary">check_circle</span>
                                </label>
                            </div>
                        </div>
                        <div class="space-y-3">
                            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300">Rentang Waktu</label>
                            <div class="grid grid-cols-2 gap-2">
                                <div>
                                    <label class="text-xs text-slate-500 mb-1 block">Dari</label>
                                    <input name="start_date" value="<?= esc($start_date) ?>" class="block w-full rounded-lg border-slate-200 text-sm focus:border-primary focus:ring-primary" type="date"/>
                                </div>
                                <div>
                                    <label class="text-xs text-slate-500 mb-1 block">Sampai</label>
                                    <input name="end_date" value="<?= esc($end_date) ?>" class="block w-full rounded-lg border-slate-200 text-sm focus:border-primary focus:ring-primary" type="date"/>
                                </div>
                            </div>
                        </div>
                        
                        <div class="pt-4 border-t border-slate-100 flex gap-3">
                            <button type="submit" class="flex-1 flex items-center justify-center gap-2 rounded-lg bg-primary px-4 py-2.5 text-sm font-semibold text-white hover:bg-primary/90 shadow-md shadow-primary/20 transition-all">
                                <span class="material-symbols-outlined text-[20px]">preview</span> Terapkan Filter
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="lg:col-span-8 space-y-6">
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div class="rounded-xl bg-white p-5 shadow-sm border border-slate-200 dark:bg-slate-900 dark:border-slate-800">
                        <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Total Arsip Tersaring</p>
                        <p class="mt-2 text-3xl font-bold text-slate-900 dark:text-white"><?= number_format($total_arsip) ?></p>
                        <div class="mt-2 flex items-center text-xs text-slate-500">
                            <span class="material-symbols-outlined text-sm mr-1">folder</span> Dokumen tercatat
                        </div>
                    </div>
                    <div class="rounded-xl bg-white p-5 shadow-sm border border-slate-200 dark:bg-slate-900 dark:border-slate-800">
                        <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Arsip Digital</p>
                        <p class="mt-2 text-3xl font-bold text-slate-900 dark:text-white"><?= number_format($arsip_digital) ?></p>
                        <div class="mt-2 flex items-center text-xs text-green-600">
                            <span class="material-symbols-outlined text-sm mr-1">cloud_done</span> <?= $persen_digital ?>% terdigitalisasi
                        </div>
                    </div>
                    <div class="rounded-xl bg-white p-5 shadow-sm border border-slate-200 dark:bg-slate-900 dark:border-slate-800">
                        <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Kapasitas Penyimpanan</p>
                        <p class="mt-2 text-3xl font-bold text-slate-900 dark:text-white">85%</p> <div class="mt-2 flex items-center text-xs text-orange-600 dark:text-orange-400">
                            <span class="material-symbols-outlined text-sm mr-1">warning</span> Hampir Penuh
                        </div>
                    </div>
                </div>

                <div class="rounded-xl border border-slate-200 bg-white shadow-sm dark:border-slate-800 dark:bg-slate-900">
                    <div class="flex items-center justify-between border-b border-slate-100 px-6 py-4 dark:border-slate-800">
                        <div class="flex items-center gap-3">
                            <h3 class="text-lg font-bold text-slate-900 dark:text-white">Preview Laporan</h3>
                            <span class="rounded bg-slate-100 px-2.5 py-0.5 text-xs font-medium text-slate-600">Inventaris Lokasi</span>
                        </div>
                        <div class="flex gap-2">
                            <button onclick="window.print()" class="flex items-center gap-2 rounded-lg border border-slate-200 bg-white px-3 py-1.5 text-sm font-medium text-slate-700 hover:bg-slate-50">
                                <span class="material-symbols-outlined text-[18px] text-red-500">picture_as_pdf</span> Cetak PDF
                            </button>
                        </div>
                    </div>
                    
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm">
                            <thead class="bg-slate-50 text-slate-500 dark:bg-slate-800/50 dark:text-slate-400">
                                <tr>
                                    <th class="px-6 py-3 font-medium">No. Dokumen</th>
                                    <th class="px-6 py-3 font-medium">Perihal & Jenis</th>
                                    <th class="px-6 py-3 font-medium">Tanggal</th>
                                    <th class="px-6 py-3 font-medium">Lokasi Fisik</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                                <?php if(empty($arsip)): ?>
                                    <tr>
                                        <td colspan="4" class="px-6 py-8 text-center text-slate-500">Tidak ada data untuk rentang waktu tersebut.</td>
                                    </tr>
                                <?php else: ?>
                                    <?php foreach($arsip as $a): ?>
                                    <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/50">
                                        <td class="whitespace-nowrap px-6 py-4 font-medium text-slate-900 dark:text-white">
                                            <?= esc($a['nomor_surat']) ?>
                                        </td>
                                        <td class="px-6 py-4 text-slate-600 dark:text-slate-300">
                                            <p class="truncate w-48 font-medium text-slate-900"><?= esc($a['perihal']) ?></p>
                                            <span class="text-xs text-blue-600 bg-blue-50 px-2 py-0.5 rounded mt-1 inline-block"><?= esc($a['jenis_arsip']) ?></span>
                                        </td>
                                        <td class="whitespace-nowrap px-6 py-4 text-slate-500">
                                            <?= date('d M Y', strtotime($a['tanggal_surat'])) ?>
                                        </td>
                                        <td class="px-6 py-4 text-slate-500">
                                            <div class="flex items-center gap-1.5">
                                                <span class="material-symbols-outlined text-[16px]">shelves</span>
                                                <?= esc($a['nama_lemari'] ?? '-') ?>, <?= esc($a['nama_rak'] ?? '-') ?>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="flex items-center justify-between border-t border-slate-100 px-6 py-4 dark:border-slate-800">
                        <p class="text-sm text-slate-500 dark:text-slate-400">Navigasi Halaman Laporan</p>
                        <div class="flex gap-2">
                            <?= $pager->links('arsip', 'default_full') ?>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                    <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">
                        <h3 class="text-base font-bold text-slate-900 dark:text-white mb-4">Distribusi per Divisi</h3>
                        <div class="flex items-center justify-center h-48 bg-slate-50 rounded-lg dark:bg-slate-800/50">
                            <div class="flex items-end gap-3 h-32">
                                <div class="w-8 bg-blue-500 rounded-t-sm h-[60%]"></div>
                                <div class="w-8 bg-purple-500 rounded-t-sm h-[80%]"></div>
                                <div class="w-8 bg-teal-500 rounded-t-sm h-[40%]"></div>
                                <div class="w-8 bg-orange-500 rounded-t-sm h-[55%]"></div>
                            </div>
                        </div>
                    </div>
                    <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">
                        <h3 class="text-base font-bold text-slate-900 dark:text-white mb-4">Tren Arsip Masuk</h3>
                        <div class="flex items-center justify-center h-48 bg-slate-50 rounded-lg dark:bg-slate-800/50 relative overflow-hidden">
                            <svg class="w-full h-full text-primary" preserveAspectRatio="none" viewBox="0 0 100 50">
                                <path d="M0 40 Q 10 35, 20 38 T 40 25 T 60 30 T 80 15 T 100 20" fill="none" stroke="currentColor" stroke-width="2"></path>
                                <path d="M0 40 Q 10 35, 20 38 T 40 25 T 60 30 T 80 15 T 100 20 V 50 H 0 Z" fill="currentColor" fill-opacity="0.1" stroke="none"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
</body>
</html>