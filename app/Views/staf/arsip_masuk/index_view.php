<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title><?= $title ?? 'Arsip Masuk' ?> - SiArsip Navigasi</title>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@400;500;700;900&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script>
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
            fontFamily: { "display": ["Public Sans", "sans-serif"] },
          },
        },
      }
    </script>
    <style> body { font-family: "Public Sans", sans-serif; } </style>
</head>
<body class="bg-background-light dark:bg-background-dark text-slate-900 dark:text-slate-100 min-h-screen flex flex-col font-display">

<header class="sticky top-0 z-50 w-full bg-nav-blue shadow-lg">
    <div class="mx-auto flex max-w-[1440px] items-center justify-between px-6 py-3">
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
    <div class="mx-auto max-w-[1440px]">
        <nav class="mb-6 flex items-center text-sm text-slate-500 dark:text-slate-400">
            <a class="hover:text-primary" href="<?= base_url('staf/dashboard') ?>">Dashboard</a>
            <span class="mx-2 material-symbols-outlined text-[16px]">chevron_right</span>
            <span class="font-medium text-slate-900 dark:text-slate-100">Arsip Masuk</span>
        </nav>

        <div class="mb-8 flex flex-col justify-between gap-4 md:flex-row md:items-end">
            <div>
                <h1 class="text-3xl font-black tracking-tight text-slate-900 dark:text-white md:text-4xl">Arsip Masuk</h1>
                <p class="mt-2 text-lg text-slate-500 dark:text-slate-400">Daftar semua surat dan dokumen eksternal yang masuk.</p>
            </div>
            <a href="<?= base_url('staf/arsip/create') ?>" class="flex items-center gap-2 rounded-lg bg-primary px-5 py-2.5 text-sm font-medium text-white hover:bg-primary/90 shadow-lg shadow-primary/20 transition-all">
                <span class="material-symbols-outlined text-[20px]">add</span> Registrasi Surat Masuk
            </a>
        </div>

        <form action="" method="GET" class="mb-8 rounded-xl border border-slate-200 bg-white p-5 shadow-sm dark:border-slate-800 dark:bg-slate-900">
            <div class="grid grid-cols-1 gap-4 md:grid-cols-4 lg:grid-cols-6">
                <div class="lg:col-span-2">
                    <label class="mb-1.5 block text-xs font-semibold text-slate-500 dark:text-slate-400">Pencarian Kata Kunci</label>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-3 top-2.5 text-slate-400">search</span>
                        <input name="keyword" value="<?= esc($filter_keyword) ?>" class="w-full rounded-lg border-slate-300 bg-slate-50 py-2 pl-10 pr-4 text-sm focus:border-primary focus:ring-primary dark:border-slate-700 dark:bg-slate-800 dark:text-white" placeholder="No. Agenda, Perihal..." type="text"/>
                    </div>
                </div>
                <div class="md:col-span-2 lg:col-span-1">
                    <label class="mb-1.5 block text-xs font-semibold text-slate-500 dark:text-slate-400">Tanggal (Dari)</label>
                    <input name="tgl_dari" value="<?= esc($filter_tgl_dari) ?>" class="w-full rounded-lg border-slate-300 bg-slate-50 py-2 px-3 text-sm focus:border-primary focus:ring-primary dark:border-slate-700 dark:bg-slate-800 dark:text-white" type="date"/>
                </div>
                <div class="md:col-span-2 lg:col-span-1">
                    <label class="mb-1.5 block text-xs font-semibold text-slate-500 dark:text-slate-400">Tanggal (Sampai)</label>
                    <input name="tgl_sampai" value="<?= esc($filter_tgl_sampai) ?>" class="w-full rounded-lg border-slate-300 bg-slate-50 py-2 px-3 text-sm focus:border-primary focus:ring-primary dark:border-slate-700 dark:bg-slate-800 dark:text-white" type="date"/>
                </div>
                <div class="md:col-span-2 lg:col-span-1">
                    <label class="mb-1.5 block text-xs font-semibold text-slate-500 dark:text-slate-400">Status</label>
                    <select name="status" class="w-full rounded-lg border-slate-300 bg-slate-50 py-2 px-3 text-sm focus:border-primary focus:ring-primary dark:border-slate-700 dark:bg-slate-800 dark:text-white">
                        <option value="">Semua Status</option>
                        <option value="Filed" <?= ($filter_status == 'Filed') ? 'selected' : '' ?>>Filed</option>
                        <option value="Pending" <?= ($filter_status == 'Pending') ? 'selected' : '' ?>>Pending</option>
                    </select>
                </div>
                <div class="flex items-end md:col-span-2 lg:col-span-1">
                    <button type="submit" class="w-full rounded-lg border border-slate-200 bg-white py-2 px-4 text-sm font-medium text-slate-700 hover:bg-slate-50 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-300 dark:hover:bg-slate-700 transition-colors">
                        Terapkan Filter
                    </button>
                </div>
            </div>
        </form>

        <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm dark:border-slate-800 dark:bg-slate-900">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-slate-500 dark:text-slate-400">
                    <thead class="bg-slate-50 text-xs uppercase text-slate-700 dark:bg-slate-800 dark:text-slate-300">
                        <tr>
                            <th class="px-6 py-4 font-bold tracking-wider">No. Agenda</th>
                            <th class="px-6 py-4 font-bold tracking-wider">Asal Surat</th>
                            <th class="px-6 py-4 font-bold tracking-wider">Perihal</th>
                            <th class="px-6 py-4 font-bold tracking-wider">Tanggal Terima</th>
                            <th class="px-6 py-4 font-bold tracking-wider">Lokasi Fisik</th>
                            <th class="px-6 py-4 font-bold tracking-wider">Status</th> <th class="px-6 py-4 text-right font-bold tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 border-t border-slate-100 dark:divide-slate-800 dark:border-slate-800">
                        <?php if(empty($arsip)): ?>
                            <tr>
                                <td colspan="7" class="px-6 py-8 text-center text-slate-500">
                                    <div class="flex flex-col items-center justify-center">
                                        <span class="material-symbols-outlined text-4xl text-slate-300 mb-2">inbox</span>
                                        <p>Tidak ada data arsip masuk ditemukan.</p>
                                    </div>
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach($arsip as $a): ?>
                            <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors">
                                <td class="whitespace-nowrap px-6 py-4 font-medium text-slate-900 dark:text-white">
                                    <div class="flex items-center gap-2">
                                        <span class="material-symbols-outlined text-lg text-blue-500">mail</span>
                                        <?= esc($a['nomor_surat']) ?> </div>
                                </td>
                                <td class="px-6 py-4">
             <div class="font-medium text-slate-900 dark:text-slate-100"><?= esc($a['pengirim_tujuan'] ?? '-') ?></div>
                                </td>
                                <td class="px-6 py-4">
                                    <p class="line-clamp-2 max-w-xs"><?= esc($a['perihal']) ?></p>
                                </td>
                                <td class="whitespace-nowrap px-6 py-4">
                                    <?= date('d M Y', strtotime($a['tanggal_terima'] ?? $a['created_at'])) ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-xs">
                                    <div class="font-medium text-slate-900 dark:text-slate-100"><?= esc($a['nama_lemari'] ?? '-') ?></div>
                                    <div class="text-slate-500"><?= esc($a['nama_rak'] ?? '-') ?></div>
                                </td>
                                
                                <td class="whitespace-nowrap px-6 py-4">
                                    <?php 
                                        // Contoh logika status sederhana (misal jika file PDF ada = Filed, jika tidak = Pending)
                                        // Atau ambil dari kolom 'status' di DB jika ada
                                        $status = !empty($a['file_path']) ? 'Filed' : 'Pending'; 
                                        $badgeColor = ($status == 'Filed') 
                                            ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400' 
                                            : 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400';
                                    ?>
                                    <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium <?= $badgeColor ?>">
                                        <?= $status ?>
                                    </span>
                                </td>

                                <td class="whitespace-nowrap px-6 py-4 text-right">
                                    <div class="flex justify-end gap-2">
                                        <a href="<?= base_url('staf/arsip/detail/' . $a['id_arsip']) ?>" class="rounded p-1.5 text-slate-400 hover:bg-blue-50 hover:text-blue-600 dark:hover:bg-slate-800" title="Lihat Detail">
                                            <span class="material-symbols-outlined text-[20px]">visibility</span>
                                        </a>
                                        <a href="<?= base_url('staf/arsip/edit/' . $a['id_arsip']) ?>" class="rounded p-1.5 text-slate-400 hover:bg-blue-50 hover:text-blue-600 dark:hover:bg-slate-800" title="Edit Arsip">
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
            
            <div class="flex items-center justify-between border-t border-slate-100 bg-slate-50 px-6 py-3 dark:border-slate-800 dark:bg-slate-800/50">
                 <div class="text-xs text-slate-500 dark:text-slate-400">
                    Menampilkan data arsip
                </div>
                <div class="flex gap-1">
                    <?= $pager->links('arsip', 'default_full') ?>
                </div>
            </div>
        </div>
    </div>
</main>
</body>
</html>