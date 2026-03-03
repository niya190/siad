<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title><?= $title ?> - SiArsip</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script>
        tailwind.config = { darkMode: "class", theme: { extend: { colors: { primary: "#135bec", "background-light": "#f6f6f8", "nav-blue": "#1e40af" }, fontFamily: { display: ["Public Sans", "sans-serif"] } } } }
    </script>
</head>
<body class="bg-background-light font-display text-slate-900 min-h-screen flex flex-col">

<header class="sticky top-0 z-50 w-full bg-nav-blue shadow-lg print:hidden">
    <div class="mx-auto flex max-w-[1280px] items-center justify-between px-6 py-3">
        <div class="flex items-center gap-8">
            <div class="flex items-center gap-3">
                <div class="flex size-10 items-center justify-center rounded-lg bg-white/10 text-white"><span class="material-symbols-outlined text-2xl">folder_managed</span></div>
                <div><h2 class="text-lg font-bold leading-tight text-white">SIAD</h2><p class="text-xs text-blue-200">Navigasi Tanjungpinang</p></div>
            </div>
            <nav class="hidden items-center gap-1 md:flex">
                <a class="rounded-lg px-3 py-2 text-sm font-medium text-blue-100 hover:bg-white/10 hover:text-white transition-colors" href="<?= base_url('staf/dashboard') ?>">Dashboard</a>
                <a class="rounded-lg px-3 py-2 text-sm font-medium text-blue-100 hover:bg-white/10 hover:text-white transition-colors" href="<?= base_url('staf/arsip-masuk') ?>">Arsip Masuk</a>
                <a class="rounded-lg px-3 py-2 text-sm font-medium text-blue-100 hover:bg-white/10 hover:text-white transition-colors" href="<?= base_url('staf/arsip-keluar') ?>">Arsip Keluar</a>
                <a class="rounded-lg bg-white/20 px-3 py-2 text-sm font-medium text-white shadow-sm" href="<?= base_url('staf/laporan') ?>">Laporan</a>
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
    </div>
</header>

<main class="flex-1 px-4 py-8 md:px-8">
    <div class="mx-auto max-w-[1280px]">
        
        <div class="mb-8 flex flex-col justify-between gap-4 md:flex-row md:items-end print:hidden">
            <div>
                <h1 class="text-3xl font-black tracking-tight text-slate-900 md:text-4xl">Laporan Arsip</h1>
                <p class="mt-2 text-lg text-slate-500">Filter dan cetak laporan dokumen arsip Navigasi Tanjungpinang.</p>
            </div>
            <div class="flex gap-3">
                <button onclick="window.print()" class="flex items-center gap-2 rounded-lg bg-green-600 px-4 py-2 text-sm font-bold text-white shadow-md hover:bg-green-700 transition-colors">
                    <span class="material-symbols-outlined text-[20px]">print</span> Cetak Laporan (PDF)
                </button>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 mb-6 print:hidden">
            <form action="<?= base_url('staf/laporan') ?>" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1">Dari Tanggal</label>
                    <input type="date" name="start_date" value="<?= esc($start_date) ?>" class="w-full rounded-lg border-slate-300 focus:ring-primary focus:border-primary text-sm">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1">Sampai Tanggal</label>
                    <input type="date" name="end_date" value="<?= esc($end_date) ?>" class="w-full rounded-lg border-slate-300 focus:ring-primary focus:border-primary text-sm">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1">Jenis Arsip</label>
                    <select name="jenis_arsip" class="w-full rounded-lg border-slate-300 focus:ring-primary focus:border-primary text-sm">
                        <option value="">-- Semua Jenis --</option>
                        <option value="Surat Masuk" <?= ($jenis_arsip == 'Surat Masuk') ? 'selected' : '' ?>>Surat Masuk</option>
                        <option value="Surat Keluar" <?= ($jenis_arsip == 'Surat Keluar') ? 'selected' : '' ?>>Surat Keluar</option>
                        <option value="Nota Dinas" <?= ($jenis_arsip == 'Nota Dinas') ? 'selected' : '' ?>>Nota Dinas</option>
                    </select>
                </div>
                <div class="flex gap-2">
                    <button type="submit" class="flex-1 bg-primary text-white font-bold rounded-lg py-2 hover:bg-blue-700 transition-colors">Terapkan Filter</button>
                    <a href="<?= base_url('staf/laporan') ?>" class="px-4 py-2 bg-slate-100 text-slate-600 font-bold rounded-lg hover:bg-slate-200 transition-colors text-center" title="Reset Filter"><span class="material-symbols-outlined mt-0.5 text-[20px]">refresh</span></a>
                </div>
            </form>
        </div>

        <div class="hidden print:block text-center mb-8 border-b-2 border-slate-800 pb-4">
            <h1 class="text-2xl font-bold uppercase">Laporan Arsip Surat Navigasi</h1>
            <p class="text-sm">
                Periode: <?= $start_date ? date('d M Y', strtotime($start_date)) . ' s/d ' . date('d M Y', strtotime($end_date)) : 'Semua Waktu' ?><br>
                Jenis Arsip: <?= $jenis_arsip ? esc($jenis_arsip) : 'Semua Jenis' ?>
            </p>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden print:border-none print:shadow-none">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse text-sm">
                    <thead class="bg-slate-50 print:bg-transparent border-b-2 border-slate-200 print:border-black">
                        <tr>
                            <th class="px-4 py-3 font-bold text-slate-700">No.</th>
                            <th class="px-4 py-3 font-bold text-slate-700">Tanggal</th>
                            <th class="px-4 py-3 font-bold text-slate-700">Nomor Surat</th>
                            <th class="px-4 py-3 font-bold text-slate-700">Jenis</th>
                            <th class="px-4 py-3 font-bold text-slate-700">Pengirim/Tujuan</th>
                            <th class="px-4 py-3 font-bold text-slate-700">Perihal</th>
                            <th class="px-4 py-3 font-bold text-slate-700">Lokasi Fisik</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 print:divide-slate-300">
                        <?php if(empty($arsip)): ?>
                            <tr><td colspan="7" class="px-4 py-8 text-center text-slate-500">Tidak ada data arsip yang sesuai dengan filter.</td></tr>
                        <?php else: ?>
                            <?php $no=1; foreach($arsip as $a): ?>
                            <tr class="hover:bg-slate-50 transition-colors">
                                <td class="px-4 py-3"><?= $no++ ?>.</td>
                                <td class="px-4 py-3"><?= date('d/m/Y', strtotime($a['tanggal_surat'])) ?></td>
                                <td class="px-4 py-3 font-medium text-primary print:text-black"><?= esc($a['nomor_surat']) ?></td>
                                <td class="px-4 py-3"><?= esc($a['jenis_arsip']) ?></td>
                                <td class="px-4 py-3"><?= esc($a['pengirim_tujuan']) ?></td>
                                <td class="px-4 py-3 max-w-[200px] truncate print:whitespace-normal" title="<?= esc($a['perihal']) ?>"><?= esc($a['perihal']) ?></td>
                                <td class="px-4 py-3 text-xs leading-relaxed">
    <?php if(!empty($a['nama_rak'])): ?>
        <span class="block text-slate-500 print:text-black"><?= esc($a['nama_gedung']) ?> - <?= esc($a['nama_ruangan']) ?></span>
        <span class="font-bold text-primary print:text-black"><?= esc($a['nama_lemari']) ?> &raquo; <?= esc($a['nama_rak']) ?></span>
    <?php else: ?>
        <span class="text-slate-400 italic">Belum diatur</span>
    <?php endif; ?>
</td>
                            </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="hidden print:flex justify-end mt-12 pr-12">
            <div class="text-center">
                <p class="mb-16 text-sm">Tanjungpinang, <?= date('d M Y') ?><br>Petugas Tata Usaha,</p>
                <p class="font-bold underline text-sm"><?= esc(session()->get('nama_lengkap') ?? 'Budi Santoso') ?></p>
            </div>
        </div>

    </div>
</main>

<style>
    /* CSS Khusus Print agar halamannya rapi saat di PDF kan */
    @media print {
        @page { size: landscape; margin: 1.5cm; }
        body { background: white; -webkit-print-color-adjust: exact; }
    }
</style>
</body>
</html>