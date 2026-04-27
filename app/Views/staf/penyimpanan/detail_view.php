<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title><?= esc($title) ?> - SIAD Navigasi</title>
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
        <div class="flex items-center gap-3">
            <div class="size-10 rounded-lg bg-white flex items-center justify-center shrink-0 shadow-lg overflow-hidden">
    <img src="<?= base_url('assets/img/logo.JPEG') ?>" 
         alt="Logo Distrik Navigasi" 
         class="h-8 w-auto object-contain">
</div>
            <div><h2 class="text-lg font-bold leading-tight text-white">SIAD</h2><p class="text-xs text-blue-200">Navigasi Tanjungpinang</p></div>
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
</header>

<main class="flex-1 overflow-x-hidden px-4 py-8 md:px-8">
    <div class="mx-auto max-w-[1280px]">
        <nav class="mb-6 flex items-center text-sm text-slate-500">
            <a class="hover:text-primary" href="<?= base_url('staf/dashboard') ?>">Dashboard</a>
            <span class="mx-2 material-symbols-outlined text-[16px]">chevron_right</span>
            <a class="hover:text-primary" href="<?= base_url('staf/penyimpanan') ?>">Kelola Penyimpanan</a>
            <span class="mx-2 material-symbols-outlined text-[16px]">chevron_right</span>
            <span class="font-medium text-slate-900">Detail Ruangan</span>
        </nav>
        
        <div class="mb-8 flex flex-col justify-between gap-4 md:flex-row md:items-end">
            <div class="flex flex-col gap-1">
                <h1 class="text-3xl font-black tracking-tight text-slate-900 md:text-4xl"><?= esc($ruangan['nama_ruangan']) ?></h1>
                <p class="text-slate-500 text-base font-normal flex items-center gap-1">
                    <span class="material-symbols-outlined text-[18px]">domain</span> <?= esc($ruangan['nama_gedung'] ?? 'Gedung Navigasi') ?> (<?= esc($ruangan['lantai']) ?>)
                </p>
            </div>
            
            <a href="<?= base_url('staf/penyimpanan') ?>" class="flex items-center justify-center rounded-lg h-10 px-5 bg-white text-slate-700 text-sm font-bold border border-slate-200 hover:bg-slate-50 hover:text-primary transition-colors shadow-sm">
                <span class="material-symbols-outlined text-[20px] mr-2">arrow_back</span> Kembali
            </a>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="p-5 border-b border-slate-200 bg-slate-50 flex items-center gap-2">
                <span class="material-symbols-outlined text-primary">inventory_2</span>
                <h3 class="font-bold text-slate-800">Daftar Arsip Tersimpan (<?= count($arsip) ?> Berkas)</h3>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="bg-slate-50/50 text-xs uppercase text-slate-500 border-b border-slate-200">
                        <tr>
                            <th class="px-6 py-4 font-bold">No</th>
                            <th class="px-6 py-4 font-bold">Nomor & Perihal</th>
                            <th class="px-6 py-4 font-bold">Klasifikasi</th>
                            <th class="px-6 py-4 font-bold">Lokasi Detail (Lemari/Rak)</th>
                            <th class="px-6 py-4 font-bold">Tgl Simpan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        <?php if(empty($arsip)): ?>
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-slate-500">
                                <span class="material-symbols-outlined text-4xl text-slate-300 block mb-2">folder_off</span>
                                Belum ada arsip yang tersimpan di ruangan ini.
                            </td>
                        </tr>
                        <?php else: $no=1; foreach($arsip as $a): ?>
                        <tr class="hover:bg-blue-50/30 transition-colors">
                            <td class="px-6 py-4 font-medium"><?= $no++ ?></td>
                            <td class="px-6 py-4">
                                <p class="font-bold text-slate-800"><?= esc($a['nomor_surat']) ?></p>
                                <p class="text-xs text-slate-500 mt-1 line-clamp-1"><?= esc($a['perihal']) ?></p>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center gap-1 rounded bg-slate-100 px-2 py-1 text-xs font-semibold text-slate-600 border border-slate-200">
                                    <?= esc($a['kode_klasifikasi'] ?? 'UMUM') ?>
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex flex-col gap-1">
                                    <span class="text-xs font-bold text-primary"><?= esc($a['nama_lemari'] ?? 'Tanpa Lemari') ?></span>
                                    <span class="text-xs text-slate-500">▶ <?= esc($a['nama_rak'] ?? 'Tanpa Rak') ?></span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-xs text-slate-500">
                                <?= date('d M Y', strtotime($a['created_at'])) ?>
                            </td>
                        </tr>
                        <?php endforeach; endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</main>
</body>
</html>