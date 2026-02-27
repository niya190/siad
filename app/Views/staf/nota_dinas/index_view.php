<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title><?= $title ?? 'Nota Dinas' ?> - SiArsip Navigasi</title>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@400;500;700;900&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script>
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            colors: { "primary": "#135bec", "background-light": "#f6f6f8", "background-dark": "#101622", "nav-blue": "#1e40af" },
            fontFamily: { "display": ["Public Sans", "sans-serif"] },
          }
        }
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
    <form action="<?= base_url('staf/arsip') ?>" method="GET" class="relative flex items-center">
        <span class="material-symbols-outlined absolute left-3 text-[20px] text-blue-300">search</span>
        <input name="keyword" class="w-full rounded-lg border-none bg-blue-900/50 py-2 pl-10 pr-4 text-sm text-white placeholder-blue-300 focus:bg-blue-900 focus:ring-2 focus:ring-white/20" placeholder="Cari arsip..." type="text"/>
    </form>
</div>
            
            <a href="<?= base_url('staf/notifications') ?>" class="relative flex size-9 items-center justify-center rounded-full text-blue-100 hover:bg-white/10 hover:text-white transition-colors">
    <span class="material-symbols-outlined text-[20px]">notifications</span>
    <span class="absolute right-1.5 top-1.5 size-2 rounded-full bg-red-500 ring-2 ring-nav-blue"></span>
</a>

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
        <nav class="mb-6 flex items-center text-sm text-slate-500 dark:text-slate-400">
            <a class="hover:text-primary" href="<?= base_url('staf/dashboard') ?>">Dashboard</a>
            <span class="mx-2 material-symbols-outlined text-[16px]">chevron_right</span>
            <span class="font-medium text-slate-900 dark:text-slate-100">Nota Dinas</span>
        </nav>

        <div class="mb-8 flex flex-col justify-between gap-4 md:flex-row md:items-center">
            <div>
                <h1 class="text-3xl font-black tracking-tight text-slate-900 dark:text-white md:text-4xl">Daftar Nota Dinas</h1>
                <p class="mt-2 text-lg text-slate-500 dark:text-slate-400">Arsip komunikasi internal antar divisi di Distrik Navigasi.</p>
            </div>
            <a href="<?= base_url('staf/arsip/create') ?>" class="flex items-center gap-2 rounded-lg bg-primary px-4 py-2.5 text-sm font-medium text-white hover:bg-primary/90 shadow-lg shadow-primary/20">
                <span class="material-symbols-outlined text-[20px]">add</span> Buat Nota Dinas Baru
            </a>
        </div>

        <div class="rounded-xl border border-slate-200 bg-white shadow-sm dark:border-slate-800 dark:bg-slate-900">
            <form method="GET" action="" class="border-b border-slate-100 p-4 dark:border-slate-800 flex justify-end">
                <div class="relative w-full md:w-72">
                    <span class="material-symbols-outlined absolute left-3 top-2.5 text-[18px] text-slate-400">search</span>
                    <input name="keyword" value="<?= esc($filter_keyword) ?>" class="w-full rounded-lg border border-slate-200 bg-slate-50 py-2 pl-9 pr-4 text-sm text-slate-900 placeholder-slate-400 focus:border-primary focus:bg-white focus:outline-none focus:ring-1 focus:ring-primary" placeholder="Cari nomor atau perihal..." type="text"/>
                </div>
            </form>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="bg-slate-50 text-xs uppercase text-slate-500 dark:bg-slate-800/50 dark:text-slate-400">
                        <tr>
                            <th class="px-6 py-4 font-semibold">Nomor Nota</th>
                            <th class="px-6 py-4 font-semibold">Perihal</th>
                            <th class="px-6 py-4 font-semibold">Tanggal</th>
                            <th class="px-6 py-4 font-semibold">Lokasi Fisik</th>
                            <th class="px-6 py-4 text-right font-semibold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                        <?php if(empty($arsip)): ?>
                            <tr>
                                <td colspan="5" class="px-6 py-8 text-center text-slate-500">
                                    <div class="flex flex-col items-center justify-center">
                                        <span class="material-symbols-outlined text-4xl text-slate-300 mb-2">description</span>
                                        <p>Tidak ada data Nota Dinas ditemukan.</p>
                                    </div>
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach($arsip as $a): ?>
                            <tr class="group hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors">
                                <td class="px-6 py-4">
                                    <span class="font-medium text-slate-900 dark:text-white"><?= esc($a['nomor_surat']) ?></span>
                                </td>
                                <td class="px-6 py-4">
                                    <p class="w-64 truncate font-medium text-slate-900 dark:text-white" title="<?= esc($a['perihal']) ?>"><?= esc($a['perihal']) ?></p>
                                </td>
                                <td class="px-6 py-4 text-slate-600 dark:text-slate-400">
                                    <?= date('d M Y', strtotime($a['tanggal_surat'])) ?>
                                </td>
                                <td class="px-6 py-4 text-slate-600 dark:text-slate-400">
                                    <?= esc($a['nama_lemari'] ?? '-') ?> / <?= esc($a['nama_rak'] ?? '-') ?>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex justify-end gap-1">
                                        <a href="<?= base_url('staf/arsip/detail/' . $a['id_arsip']) ?>" class="rounded p-1 text-slate-400 hover:text-primary dark:hover:text-white" title="Detail">
                                            <span class="material-symbols-outlined text-[20px]">visibility</span>
                                        </a>
                                        <a href="<?= base_url('staf/arsip/edit/' . $a['id_arsip']) ?>" class="rounded p-1 text-slate-400 hover:text-primary dark:hover:text-white" title="Edit">
                                            <span class="material-symbols-outlined text-[20px]">edit</span>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <div class="border-t border-slate-100 p-4 dark:border-slate-800">
                <div class="flex flex-col items-center justify-between gap-4 sm:flex-row">
                    <p class="text-sm text-slate-500 dark:text-slate-400">Menampilkan Nota Dinas</p>
                    <nav class="flex items-center gap-1">
                        <?= $pager->links('arsip', 'default_full') ?>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</main>
</body>
</html>