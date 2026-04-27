<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title><?= $title ?? 'Nota Dinas' ?> - SIAD Navigasi</title>
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
               <div class="size-10 rounded-lg bg-white flex items-center justify-center shrink-0 shadow-lg overflow-hidden">
    <img src="<?= base_url('assets/img/logo.JPEG') ?>" 
         alt="Logo Distrik Navigasi" 
         class="h-8 w-auto object-contain">
</div>
                <div><h2 class="text-lg font-bold leading-tight text-white">SIAD</h2><p class="text-xs text-blue-200">Navigasi Tanjungpinang</p></div>
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
            
            <div class="relative">
                <?php 
                    $db_notif = new \App\Models\ArsipModel();
                    $aktivitas_notif = $db_notif->orderBy('updated_at', 'DESC')->findAll(5);
                ?>
                <button onclick="document.getElementById('dropdownNotif').classList.toggle('hidden')" class="relative flex size-9 items-center justify-center rounded-full text-blue-100 hover:bg-white/20 focus:bg-white/20 focus:outline-none transition-colors">
                    <span class="material-symbols-outlined text-[20px]">notifications</span>
                    <?php if(!empty($aktivitas_notif)): ?>
                        <span class="absolute right-1.5 top-1.5 size-2 rounded-full bg-red-500 ring-2 ring-nav-blue animate-pulse"></span>
                    <?php endif; ?>
                </button>
                
                <div id="dropdownNotif" class="absolute right-0 mt-2 w-80 bg-white rounded-xl shadow-xl border border-slate-200 hidden z-50 overflow-hidden">
                    <div class="p-3 bg-slate-50 border-b border-slate-200 font-bold text-slate-700 text-sm flex justify-between items-center">
                        <span>Notifikasi Terbaru</span>
                        <button onclick="document.getElementById('dropdownNotif').classList.add('hidden')" class="text-slate-400 hover:text-red-500 p-1 rounded-md hover:bg-slate-200 transition-colors">
                            <span class="material-symbols-outlined text-[16px] block">close</span>
                        </button>
                    </div>
                    <div class="max-h-64 overflow-y-auto">
                        <?php if(empty($aktivitas_notif)): ?>
                            <div class="p-6 text-center text-sm text-slate-500 flex flex-col items-center">
                                <span class="material-symbols-outlined text-4xl text-slate-300 mb-2">notifications_off</span>
                                Belum ada notifikasi baru.
                            </div>
                        <?php else: ?>
                            <?php foreach($aktivitas_notif as $notif): 
                                $is_new = ($notif['created_at'] === $notif['updated_at']);
                                $pesan = $is_new ? 'Arsip baru ditambahkan.' : 'Data arsip diperbarui.';
                                $icon = $is_new ? 'add_circle' : 'edit_document';
                                $color = $is_new ? 'text-green-500' : 'text-blue-500';
                            ?>
                            <a href="<?= base_url('staf/arsip/detail/' . $notif['id_arsip']) ?>" class="flex gap-3 p-4 border-b border-slate-100 hover:bg-blue-50 transition-colors">
                                <span class="material-symbols-outlined <?= $color ?> text-[20px] mt-0.5"><?= $icon ?></span>
                                <div>
                                    <p class="text-sm font-bold text-slate-800 leading-tight"><?= esc($notif['nomor_surat']) ?></p>
                                    <p class="text-xs text-slate-500 mt-1"><?= $pesan ?></p>
                                    <p class="text-[10px] text-slate-400 mt-1"><?= date('d M Y, H:i', strtotime($notif['updated_at'])) ?></p>
                                </div>
                            </a>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                    <div class="p-2 bg-slate-50 border-t border-slate-200 text-center">
                        <a href="<?= base_url('staf/aktivitas') ?>" class="text-xs font-bold text-primary hover:underline">Lihat Semua Aktivitas</a>
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-3 border-l border-blue-800 pl-4">
                <div class="hidden text-right md:block">
                    <p class="text-sm font-semibold text-white leading-tight mb-1">
                        <?= esc(session()->get('nama_lengkap') ?? 'User Staff') ?>
                    </p>
                    <div class="flex items-center justify-end gap-2">
                        <?php 
                            $nipPegawai = session()->get('nip');
                            if (!empty($nipPegawai)) : 
                        ?>
                            <span class="text-[10px] font-medium text-blue-200 tracking-wider">
                                NIP: <?= esc($nipPegawai) ?>
                            </span>
                        <?php endif; ?>
                        <span class="inline-flex items-center px-1.5 py-0.5 rounded text-[10px] font-bold bg-white/20 text-white uppercase tracking-wide border border-white/10">
                            <?= esc(session()->get('divisi') ?? 'Staff') ?>
                        </span>
                    </div>
                </div>

                <?php 
                    $nama = session()->get('nama_lengkap') ?? 'Staf';
                    $parts = explode(' ', $nama);
                    $initials = strtoupper(substr($parts[0], 0, 1) . (isset($parts[1]) ? substr($parts[1], 0, 1) : ''));
                ?>
                <button class="relative flex size-10 ml-1 items-center justify-center overflow-hidden rounded-full border-2 border-blue-400/30 bg-white text-nav-blue font-bold ring-2 ring-white/10 transition-all hover:ring-white/30">
                    <?= $initials ?>
                </button>
                
                <a href="<?= base_url('login/logout') ?>" class="text-blue-200 hover:text-red-400 ml-1 transition-colors" title="Logout">
                    <span class="material-symbols-outlined text-[24px]">logout</span>
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
                <span class="material-symbols-outlined text-[20px]">add</span> Rekam Nota Dinas 
            </a>
        </div>

        <div class="rounded-xl border border-slate-200 bg-white shadow-sm dark:border-slate-800 dark:bg-slate-900">
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
                
                <div class="flex items-end md:col-span-2 lg:col-span-1">
                    <button type="submit" class="w-full rounded-lg border border-slate-200 bg-white py-2 px-4 text-sm font-medium text-slate-700 hover:bg-slate-50 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-300 dark:hover:bg-slate-700 transition-colors">
                        Terapkan Filter
                    </button>
                </div>
            </div>
        </form>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="bg-slate-50 text-xs uppercase text-slate-500 dark:bg-slate-800/50 dark:text-slate-400">
                        <tr>
                            <th class="px-6 py-4 font-semibold">Nomor Nota</th>
                            <th class="px-6 py-4 font-semibold">Tujuan</th>
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
                            <?php foreach($arsip as $a):  
                                // Logic warna inisial (randomizer warna pastel)
                                $colors = ['bg-blue-100 text-blue-700', 'bg-orange-100 text-orange-700', 'bg-purple-100 text-purple-700', 'bg-teal-100 text-teal-700', 'bg-indigo-100 text-indigo-700'];
                                $randColor = $colors[array_rand($colors)];
                                
                                // Bikin inisial instansi tujuan (Misal: "Dinas Perhubungan" -> "DP")
                                $tujuan = $a['pengirim_tujuan'] ?? 'Unknown';
                                $words = explode(' ', $tujuan);
                                $inisialTujuan = strtoupper(substr($words[0], 0, 1) . (isset($words[1]) ? substr($words[1], 0, 1) : ''));

                                
                            ?>
                            <tr class="group hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors">
                                <td class="px-6 py-4">
                                    <span class="font-medium text-slate-900 dark:text-white"><?= esc($a['nomor_surat']) ?></span>
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
                                        <div class="flex justify-end gap-1">
    <a href="<?= base_url('staf/arsip/detail/' . $a['id_arsip']) ?>" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Lihat Detail">
        <span class="material-symbols-outlined text-xl">visibility</span>
    </a>
    
    <a href="<?= base_url('staf/arsip/edit/' . $a['id_arsip']) ?>" class="p-2 text-amber-500 hover:bg-amber-50 rounded-lg transition-colors" title="Edit">
        <span class="material-symbols-outlined text-xl">edit</span>
    </a>

    <form action="<?= base_url('staf/arsip/delete/' . $a['id_arsip']) ?>" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus arsip ini secara permanen? Data dan file yang diunggah akan hilang.');">
        <?= csrf_field() ?>
        <button type="submit" class="p-2 text-red-500 hover:bg-red-50 rounded-lg transition-colors" title="Hapus Data">
            <span class="material-symbols-outlined text-xl">delete</span>
        </button>
    </form>

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