<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title><?= $title ?? 'Arsip Keluar' ?> - SiArsip Navigasi</title>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@400;500;700;900&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet" />
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
        <nav class="mb-6 flex items-center text-sm text-slate-500 dark:text-slate-400">
            <a class="hover:text-primary" href="<?= base_url('staf/dashboard') ?>">Dashboard</a>
            <span class="mx-2 material-symbols-outlined text-[16px]">chevron_right</span>
            <span class="font-medium text-slate-900 dark:text-slate-100">Arsip Keluar</span>
        </nav>

        <div class="mb-8 flex flex-col justify-between gap-4 md:flex-row md:items-center">
            <div>
                <h1 class="text-3xl font-black tracking-tight text-slate-900 dark:text-white md:text-4xl">Arsip Keluar</h1>
                <p class="mt-2 text-lg text-slate-500 dark:text-slate-400">Daftar dokumen dan surat keluar Kantor Distrik Navigasi.</p>
            </div>
            <a href="<?= base_url('staf/arsip/create') ?>" class="flex items-center gap-2 rounded-lg bg-primary px-4 py-2.5 text-sm font-medium text-white hover:bg-primary/90 shadow-lg shadow-primary/20 transition-all">
                <span class="material-symbols-outlined text-[20px]">add</span> Rekam Arsip Keluar
            </a>
        </div>

        <div class="rounded-xl border border-slate-200 bg-white shadow-sm dark:border-slate-800 dark:bg-slate-900">
            <form method="GET" action="" class="border-b border-slate-100 p-4 dark:border-slate-800 flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div class="flex items-center gap-2 w-full md:w-auto">
                    <button type="submit" class="flex items-center gap-2 rounded-lg border border-slate-200 bg-white px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-50 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-300">
                        <span class="material-symbols-outlined text-[18px]">filter_list</span> Terapkan
                    </button>
                    <div class="relative w-full md:w-auto">
                        <select name="status" class="w-full md:w-48 appearance-none rounded-lg border border-slate-200 bg-white px-3 py-2 pr-8 text-sm font-medium text-slate-700 hover:bg-slate-50 focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary dark:border-slate-700 dark:bg-slate-800 dark:text-slate-300">
                            <option value="">Semua Status</option>
                            <option value="Terkirim" <?= ($filter_status == 'Terkirim') ? 'selected' : '' ?>>Terkirim</option>
                            <option value="Dalam Proses" <?= ($filter_status == 'Dalam Proses') ? 'selected' : '' ?>>Dalam Proses</option>
                            <option value="Gagal" <?= ($filter_status == 'Gagal') ? 'selected' : '' ?>>Gagal</option>
                        </select>
                        <span class="material-symbols-outlined absolute right-2 top-2.5 pointer-events-none text-slate-500 text-[18px]">expand_more</span>
                    </div>
                </div>
                <div class="relative w-full md:w-72">
                    <span class="material-symbols-outlined absolute left-3 top-2.5 text-[18px] text-slate-400">search</span>
                    <input name="keyword" value="<?= esc($filter_keyword) ?>" class="w-full rounded-lg border border-slate-200 bg-slate-50 py-2 pl-9 pr-4 text-sm text-slate-900 placeholder-slate-400 focus:border-primary focus:bg-white focus:outline-none focus:ring-1 focus:ring-primary dark:border-slate-700 dark:bg-slate-800/50 dark:text-white dark:placeholder-slate-500" placeholder="Cari nomor, perihal, atau tujuan..." type="text"/>
                </div>
            </form>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="bg-slate-50 text-xs uppercase text-slate-500 dark:bg-slate-800/50 dark:text-slate-400">
                        <tr>
                            <th class="px-6 py-4 font-semibold">Nomor Referensi</th>
                            <th class="px-6 py-4 font-semibold">Tujuan</th>
                            <th class="px-6 py-4 font-semibold">Perihal</th>
                            <th class="px-6 py-4 font-semibold">Tgl. Surat</th>
                            <th class="px-6 py-4 font-semibold">Lokasi Fisik</th>
                            <th class="px-6 py-4 font-semibold">Status</th>
                            <th class="px-6 py-4 text-right font-semibold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                        <?php if(empty($arsip)): ?>
                            <tr>
                                <td colspan="7" class="px-6 py-8 text-center text-slate-500">
                                    <div class="flex flex-col items-center justify-center">
                                        <span class="material-symbols-outlined text-4xl text-slate-300 mb-2">outbox</span>
                                        <p>Tidak ada data arsip keluar ditemukan.</p>
                                    </div>
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach($arsip as $a): 
                                // Logic warna inisial (randomizer warna pastel)
                                $colors = ['bg-blue-100 text-blue-700', 'bg-orange-100 text-orange-700', 'bg-purple-100 text-purple-700', 'bg-teal-100 text-teal-700', 'bg-indigo-100 text-indigo-700'];
                                $randColor = $colors[array_rand($colors)];
                                
                                // Bikin inisial instansi tujuan (Misal: "Dinas Perhubungan" -> "DP")
                                $tujuan = $a['pengirim_tujuan'] ?? 'Unknown';
                                $words = explode(' ', $tujuan);
                                $inisialTujuan = strtoupper(substr($words[0], 0, 1) . (isset($words[1]) ? substr($words[1], 0, 1) : ''));

                                // Tentukan Status dan Warnanya (Asumsi status di DB pakai kata yang sama)
                                $status = $a['status'] ?? 'Dalam Proses';
                                if(strtolower($status) == 'terkirim' || strtolower($status) == 'filed') {
                                    $badge = 'bg-green-50 text-green-700 ring-green-600/20'; $textStatus = 'Terkirim';
                                } elseif(strtolower($status) == 'gagal') {
                                    $badge = 'bg-red-50 text-red-700 ring-red-600/20'; $textStatus = 'Gagal';
                                } else {
                                    $badge = 'bg-yellow-50 text-yellow-700 ring-yellow-600/20'; $textStatus = 'Dalam Proses';
                                }
                            ?>
                            <tr class="group hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors">
                                <td class="px-6 py-4">
                                    <span class="font-medium text-slate-900 dark:text-white"><?= esc($a['nomor_surat']) ?></span>
                                    <div class="mt-0.5 text-xs text-slate-500">Arsip Keluar</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="flex size-8 shrink-0 items-center justify-center rounded-full <?= $randColor ?> text-xs font-bold">
                                            <?= $inisialTujuan ?>
                                        </div>
                                        <span class="text-slate-700 dark:text-slate-300 font-medium"><?= esc($tujuan) ?></span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <p class="w-64 truncate font-medium text-slate-900 dark:text-white" title="<?= esc($a['perihal']) ?>">
                                        <?= esc($a['perihal']) ?>
                                    </p>
                                </td>
                                <td class="px-6 py-4 text-slate-600 dark:text-slate-400">
                                    <?= date('d M Y', strtotime($a['tanggal_surat'])) ?>
                                </td>
                                <td class="px-6 py-4 text-slate-600 dark:text-slate-400">
                                    <?= esc($a['nama_lemari'] ?? '-') ?> / <?= esc($a['nama_rak'] ?? '-') ?>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center rounded-full px-2 py-1 text-xs font-medium ring-1 ring-inset <?= $badge ?>">
                                        <?= $textStatus ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex justify-end gap-1">
                                        <a href="<?= base_url('staf/arsip/detail/' . $a['id_arsip']) ?>" class="rounded p-1 text-slate-400 hover:text-primary dark:hover:text-white transition-colors" title="Detail">
                                            <span class="material-symbols-outlined text-[20px]">visibility</span>
                                        </a>
                                        <a href="<?= base_url('staf/arsip/edit/' . $a['id_arsip']) ?>" class="rounded p-1 text-slate-400 hover:text-primary dark:hover:text-white transition-colors" title="Edit">
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
                    <p class="text-sm text-slate-500 dark:text-slate-400">
                        Menampilkan data arsip keluar
                    </p>
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