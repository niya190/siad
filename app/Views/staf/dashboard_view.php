<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title><?= $title ?? 'Dashboard' ?> - Sistem Arsip Nota Dinas</title>
    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@400;500;700;900&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script id="tailwind-config">
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            colors: {
              "primary": "#135bec",
              "background-light": "#f6f6f8",
              "background-dark": "#101622",
              "nav-blue": "#1e40af",
            },
            fontFamily: {
              "display": ["Public Sans", "sans-serif"]
            }
          },
        },
      }
    </script>
    <style>
        body { font-family: "Public Sans", sans-serif; }
        ::-webkit-scrollbar { width: 8px; height: 8px; }
        ::-webkit-scrollbar-track { background: #f1f1f1; }
        ::-webkit-scrollbar-thumb { background: #c1c1c1; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #a8a8a8; }
    </style>
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
                
                <?php 
                    // Membuat inisial dari nama di session
                    $nama = session()->get('nama_lengkap') ?? 'Staf';
                    $parts = explode(' ', $nama);
                    $initials = strtoupper(substr($parts[0], 0, 1) . (isset($parts[1]) ? substr($parts[1], 0, 1) : ''));
                ?>
                <button class="relative flex size-10 items-center justify-center overflow-hidden rounded-full border-2 border-blue-400/30 bg-white text-primary font-bold ring-2 ring-white/10 transition-all hover:ring-white/30">
                    <?= $initials ?>
                </button>
                <a href="<?= base_url('login/logout') ?>" class="text-blue-200 hover:text-white ml-2" title="Logout">
                    <span class="material-symbols-outlined">logout</span>
                </a>
            </div>
        </div>
    </div>
</header>

<main class="flex-1 overflow-x-hidden px-4 py-8 md:px-8">
    <div class="mx-auto max-w-[1280px]">
        
        <div class="mb-8 flex flex-col justify-between gap-4 md:flex-row md:items-end">
            <div>
                <?php $namaDepan = explode(' ', session()->get('nama_lengkap'))[0] ?? 'User'; ?>
                <h1 class="text-3xl font-black tracking-tight text-slate-900 dark:text-white md:text-4xl">Dashboard Ikhtisar</h1>
                <p class="mt-2 text-lg text-slate-500 dark:text-slate-400">Selamat datang kembali, <?= esc($namaDepan) ?>! Berikut adalah ringkasan aktivitas arsip hari ini.</p>
            </div>
            <div class="flex gap-3">
                <a href="<?= base_url('staf/arsip/create') ?>" class="flex items-center gap-2 rounded-lg bg-primary px-4 py-2 text-sm font-medium text-white hover:bg-primary/90 shadow-sm shadow-primary/20 w-fit cursor-pointer">
                    <span class="material-symbols-outlined text-[20px]">add</span> Arsip Baru
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4 mb-8">
            <div class="relative overflow-hidden rounded-xl bg-white p-6 shadow-sm ring-1 ring-slate-200 dark:bg-slate-800 dark:ring-slate-700">
                <dt>
                    <div class="absolute rounded-md bg-blue-500 p-3"><span class="material-symbols-outlined text-white">inbox</span></div>
                    <p class="ml-16 truncate text-sm font-medium text-slate-500 dark:text-slate-400">Total Arsip Masuk</p>
                </dt>
                <dd class="ml-16 flex items-baseline pb-1 sm:pb-2">
                    <p class="text-2xl font-semibold text-slate-900 dark:text-white"><?= number_format($total_masuk ?? 0) ?></p>
                </dd>
            </div>
            <div class="relative overflow-hidden rounded-xl bg-white p-6 shadow-sm ring-1 ring-slate-200 dark:bg-slate-800 dark:ring-slate-700">
                <dt>
                    <div class="absolute rounded-md bg-indigo-500 p-3"><span class="material-symbols-outlined text-white">outbox</span></div>
                    <p class="ml-16 truncate text-sm font-medium text-slate-500 dark:text-slate-400">Total Arsip Keluar</p>
                </dt>
                <dd class="ml-16 flex items-baseline pb-1 sm:pb-2">
                    <p class="text-2xl font-semibold text-slate-900 dark:text-white"><?= number_format($total_keluar ?? 0) ?></p>
                </dd>
            </div>
            <div class="relative overflow-hidden rounded-xl bg-white p-6 shadow-sm ring-1 ring-slate-200 dark:bg-slate-800 dark:ring-slate-700">
                <dt>
                    <div class="absolute rounded-md bg-purple-500 p-3"><span class="material-symbols-outlined text-white">description</span></div>
                    <p class="ml-16 truncate text-sm font-medium text-slate-500 dark:text-slate-400">Nota Dinas Aktif</p>
                </dt>
                <dd class="ml-16 flex items-baseline pb-1 sm:pb-2">
                    <p class="text-2xl font-semibold text-slate-900 dark:text-white"><?= number_format($total_nota ?? 0) ?></p>
                </dd>
            </div>
            <div class="relative overflow-hidden rounded-xl bg-white p-6 shadow-sm ring-1 ring-slate-200 dark:bg-slate-800 dark:ring-slate-700">
                <dt>
                    <div class="absolute rounded-md bg-orange-500 p-3"><span class="material-symbols-outlined text-white">pending_actions</span></div>
                    <p class="ml-16 truncate text-sm font-medium text-slate-500 dark:text-slate-400">Menunggu Verifikasi</p>
                </dt>
                <dd class="ml-16 flex items-baseline pb-1 sm:pb-2">
                    <p class="text-2xl font-semibold text-slate-900 dark:text-white"><?= $menunggu ?? 0 ?></p>
                </dd>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
            
            <div class="lg:col-span-2 space-y-8">
                <div class="rounded-xl border border-slate-200 bg-white shadow-sm dark:border-slate-800 dark:bg-slate-900">
                    <div class="border-b border-slate-100 px-6 py-4 dark:border-slate-800 flex justify-between items-center">
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white">Tren Arsip Bulanan</h3>
                        <select class="rounded-lg border-slate-200 text-sm text-slate-600 focus:border-primary focus:ring-primary dark:bg-slate-800 dark:border-slate-700 dark:text-slate-300">
                            <option>Tahun <?= date('Y') ?></option>
                            <option>Tahun <?= date('Y')-1 ?></option>
                        </select>
                    </div>
                    <div class="p-6">
                        <div class="flex h-64 items-end gap-4">
                            <div class="w-full flex flex-col gap-2 group cursor-pointer"><div class="relative flex h-full w-full items-end rounded-t bg-slate-50 hover:bg-slate-100 transition-colors"><div class="w-full rounded-t bg-blue-500 transition-all group-hover:bg-blue-600" style="height: 45%"></div></div><span class="text-center text-xs font-medium text-slate-500">Jan</span></div>
                            <div class="w-full flex flex-col gap-2 group cursor-pointer"><div class="relative flex h-full w-full items-end rounded-t bg-slate-50 hover:bg-slate-100 transition-colors"><div class="w-full rounded-t bg-blue-500 transition-all group-hover:bg-blue-600" style="height: 55%"></div></div><span class="text-center text-xs font-medium text-slate-500">Feb</span></div>
                            <div class="w-full flex flex-col gap-2 group cursor-pointer"><div class="relative flex h-full w-full items-end rounded-t bg-slate-50 hover:bg-slate-100 transition-colors"><div class="w-full rounded-t bg-blue-500 transition-all group-hover:bg-blue-600" style="height: 35%"></div></div><span class="text-center text-xs font-medium text-slate-500">Mar</span></div>
                            <div class="w-full flex flex-col gap-2 group cursor-pointer"><div class="relative flex h-full w-full items-end rounded-t bg-slate-50 hover:bg-slate-100 transition-colors"><div class="w-full rounded-t bg-blue-500 transition-all group-hover:bg-blue-600" style="height: 60%"></div></div><span class="text-center text-xs font-medium text-slate-500">Apr</span></div>
                            <div class="w-full flex flex-col gap-2 group cursor-pointer"><div class="relative flex h-full w-full items-end rounded-t bg-slate-50 hover:bg-slate-100 transition-colors"><div class="w-full rounded-t bg-blue-500 transition-all group-hover:bg-blue-600" style="height: 75%"></div></div><span class="text-center text-xs font-medium text-slate-500">Mei</span></div>
                            <div class="w-full flex flex-col gap-2 group cursor-pointer"><div class="relative flex h-full w-full items-end rounded-t bg-slate-50 hover:bg-slate-100 transition-colors"><div class="w-full rounded-t bg-blue-500 transition-all group-hover:bg-blue-600" style="height: 50%"></div></div><span class="text-center text-xs font-medium text-slate-500">Jun</span></div>
                            <div class="w-full flex flex-col gap-2 group cursor-pointer"><div class="relative flex h-full w-full items-end rounded-t bg-slate-50 hover:bg-slate-100 transition-colors"><div class="w-full rounded-t bg-blue-500 transition-all group-hover:bg-blue-600" style="height: 80%"></div></div><span class="text-center text-xs font-medium text-slate-500">Jul</span></div>
                            <div class="w-full flex flex-col gap-2 group cursor-pointer"><div class="relative flex h-full w-full items-end rounded-t bg-slate-50 hover:bg-slate-100 transition-colors"><div class="w-full rounded-t bg-blue-500 transition-all group-hover:bg-blue-600" style="height: 65%"></div></div><span class="text-center text-xs font-medium text-slate-500">Agu</span></div>
                            <div class="w-full flex flex-col gap-2 group cursor-pointer"><div class="relative flex h-full w-full items-end rounded-t bg-slate-50 hover:bg-slate-100 transition-colors"><div class="w-full rounded-t bg-indigo-500 transition-all group-hover:bg-indigo-600" style="height: 90%"></div></div><span class="text-center text-xs font-medium text-slate-900 font-bold">Sep</span></div>
                            <div class="w-full flex flex-col gap-2 group cursor-pointer"><div class="relative flex h-full w-full items-end rounded-t bg-slate-50 hover:bg-slate-100 transition-colors"><div class="w-full rounded-t bg-slate-200 transition-all" style="height: 0%"></div></div><span class="text-center text-xs font-medium text-slate-400">Okt</span></div>
                            <div class="w-full flex flex-col gap-2 group cursor-pointer"><div class="relative flex h-full w-full items-end rounded-t bg-slate-50 hover:bg-slate-100 transition-colors"><div class="w-full rounded-t bg-slate-200 transition-all" style="height: 0%"></div></div><span class="text-center text-xs font-medium text-slate-400">Nov</span></div>
                            <div class="w-full flex flex-col gap-2 group cursor-pointer"><div class="relative flex h-full w-full items-end rounded-t bg-slate-50 hover:bg-slate-100 transition-colors"><div class="w-full rounded-t bg-slate-200 transition-all" style="height: 0%"></div></div><span class="text-center text-xs font-medium text-slate-400">Des</span></div>
                        </div>
                    </div>
                </div>

                <div class="rounded-xl border border-slate-200 bg-white shadow-sm dark:border-slate-800 dark:bg-slate-900">
                    <div class="border-b border-slate-100 px-6 py-4 dark:border-slate-800 flex justify-between items-center">
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white">Aktivitas Terbaru</h3>
                        <a class="text-sm font-medium text-primary hover:text-primary/80" href="<?= base_url('staf/arsip') ?>">Lihat Semua</a>
                    </div>
                    <div class="divide-y divide-slate-100 dark:divide-slate-800">
                        <?php if(empty($terbaru)): ?>
                            <div class="p-6 text-center text-slate-500 text-sm">Belum ada aktivitas arsip yang tercatat.</div>
                        <?php else: ?>
                            <?php foreach($terbaru as $item): ?>
                                <div class="flex items-start gap-4 p-4 hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors">
                                    <div class="mt-1 flex size-8 shrink-0 items-center justify-center rounded-full bg-blue-100 text-blue-600 dark:bg-blue-900/30 dark:text-blue-400">
                                        <span class="material-symbols-outlined text-[18px]">add</span>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-slate-900 dark:text-white">
                                            Sistem merekam <span class="text-primary font-medium"><?= esc($item['jenis_arsip']) ?></span> baru
                                        </p>
                                        <p class="text-xs text-slate-500 mt-1">Nomor: <?= esc($item['nomor_surat']) ?></p>
                                        <p class="text-[11px] text-slate-400 mt-1"><?= date('d M Y', strtotime($item['tanggal_surat'])) ?></p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-1 space-y-8">
                <div class="rounded-xl border border-slate-200 bg-white shadow-sm dark:border-slate-800 dark:bg-slate-900">
                    <div class="border-b border-slate-100 px-6 py-4 dark:border-slate-800">
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white">Klasifikasi Sering Diakses</h3>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            <a class="flex items-center justify-between group rounded-lg border border-slate-100 bg-slate-50 p-3 hover:border-primary/30 hover:bg-blue-50/50 transition-all" href="#">
                                <div class="flex items-center gap-3">
                                    <div class="flex size-10 items-center justify-center rounded-lg bg-white text-blue-600 shadow-sm group-hover:text-primary transition-colors">
                                        <span class="material-symbols-outlined text-[20px]">folder</span>
                                    </div>
                                    <div>
                                        <p class="text-sm font-bold text-slate-900 group-hover:text-primary transition-colors">Kepegawaian</p>
                                        <p class="text-xs text-slate-500">Divisi SDM</p>
                                    </div>
                                </div>
                                <span class="material-symbols-outlined text-slate-400 group-hover:text-primary transition-colors text-[20px]">chevron_right</span>
                            </a>
                            <a class="flex items-center justify-between group rounded-lg border border-slate-100 bg-slate-50 p-3 hover:border-orange-500/30 hover:bg-orange-50/50 transition-all" href="#">
                                <div class="flex items-center gap-3">
                                    <div class="flex size-10 items-center justify-center rounded-lg bg-white text-orange-600 shadow-sm group-hover:text-orange-500 transition-colors">
                                        <span class="material-symbols-outlined text-[20px]">folder</span>
                                    </div>
                                    <div>
                                        <p class="text-sm font-bold text-slate-900 group-hover:text-orange-500 transition-colors">Keuangan</p>
                                        <p class="text-xs text-slate-500">Anggaran</p>
                                    </div>
                                </div>
                                <span class="material-symbols-outlined text-slate-400 group-hover:text-orange-500 transition-colors text-[20px]">chevron_right</span>
                            </a>
                            <a class="flex items-center justify-between group rounded-lg border border-slate-100 bg-slate-50 p-3 hover:border-green-500/30 hover:bg-green-50/50 transition-all" href="#">
                                <div class="flex items-center gap-3">
                                    <div class="flex size-10 items-center justify-center rounded-lg bg-white text-green-600 shadow-sm group-hover:text-green-500 transition-colors">
                                        <span class="material-symbols-outlined text-[20px]">folder</span>
                                    </div>
                                    <div>
                                        <p class="text-sm font-bold text-slate-900 group-hover:text-green-500 transition-colors">Operasional</p>
                                        <p class="text-xs text-slate-500">Teknik Navigasi</p>
                                    </div>
                                </div>
                                <span class="material-symbols-outlined text-slate-400 group-hover:text-green-500 transition-colors text-[20px]">chevron_right</span>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="rounded-xl bg-gradient-to-br from-primary to-blue-700 p-6 text-white shadow-lg">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-blue-100 text-sm font-medium mb-1">Status Penyimpanan</p>
                            <h3 class="text-2xl font-bold mb-4">85% Terisi</h3>
                        </div>
                        <div class="flex size-10 items-center justify-center rounded-lg bg-white/20 text-white backdrop-blur-sm">
                            <span class="material-symbols-outlined text-[24px]">cloud_done</span>
                        </div>
                    </div>
                    <div class="w-full bg-black/20 rounded-full h-2 mb-4">
                        <div class="bg-white h-2 rounded-full" style="width: 85%"></div>
                    </div>
                    <p class="text-xs text-blue-100 mb-6">Kapasitas penyimpanan fisik hampir penuh. Harap lakukan pengecekan rutin pada rak arsip lama.</p>
                    <a href="<?= base_url('staf/laporan') ?>" class="block text-center w-full rounded-lg bg-white text-primary py-2.5 text-sm font-bold hover:bg-blue-50 transition-colors">Lihat Laporan Arsip</a>
                </div>
            </div>
        </div>
    </div>
</main>

</body>
</html>