<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title><?= $title ?> - SIAD Navigasi</title>
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
                <div class="size-10 rounded-lg bg-white flex items-center justify-center shrink-0 shadow-lg overflow-hidden">
    <img src="<?= base_url('assets/img/logo.JPEG') ?>" 
         alt="Logo Distrik Navigasi" 
         class="h-8 w-auto object-contain">
</div>
                <div><h2 class="text-lg font-bold leading-tight text-white">SIAD</h2><p class="text-xs text-blue-200">Navigasi Tanjungpinang</p></div>
            </div>
            <nav class="hidden items-center gap-1 md:flex">
                <a class="rounded-lg px-3 py-2 text-sm font-medium text-blue-100 hover:bg-white/10 hover:text-white transition-colors" href="<?= base_url('staf/dashboard') ?>">Dashboard</a>
                <a class="rounded-lg px-3 py-2 text-sm font-medium text-blue-100 hover:bg-white/10 hover:text-white transition-colors" href="<?= base_url('staf/arsip-masuk') ?>">Arsip Masuk</a>
                <a class="rounded-lg px-3 py-2 text-sm font-medium text-blue-100 hover:bg-white/10 hover:text-white transition-colors" href="<?= base_url('staf/arsip-keluar') ?>">Arsip Keluar</a>
                <a class="rounded-lg px-3 py-2 text-sm font-medium text-blue-100 hover:bg-white/10 hover:text-white transition-colors <?= (url_is('staf/nota-dinas')) ? 'bg-white/20 text-white shadow-sm' : '' ?>" href="<?= base_url('staf/nota-dinas') ?>">Nota Dinas</a>
                <a class="rounded-lg bg-white/20 px-3 py-2 text-sm font-medium text-white shadow-sm" href="<?= base_url('staf/laporan') ?>">Laporan</a>
            </nav>
        </div>
        <div class="flex items-center gap-4">
            
            
            <div class="relative">
                <?php 
                    // Trik Pintar: Tarik 5 data notifikasi langsung dari View
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
<button class="relative flex size-10 ml-3 items-center justify-center overflow-hidden rounded-full border-2 border-blue-400/30 bg-white text-primary font-bold ring-2 ring-white/10 transition-all hover:ring-white/30">
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