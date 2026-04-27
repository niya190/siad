<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title><?= $title ?> - SIAD Navigasi</title>
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
                <a class="rounded-lg px-3 py-2 text-sm font-medium text-blue-100 hover:bg-white/10 hover:text-white transition-colors" href="<?= base_url('staf/nota-dinas') ?>">Nota Dinas</a>
                <a class="rounded-lg px-3 py-2 text-sm font-medium text-blue-100 hover:bg-white/10 hover:text-white transition-colors <?= (url_is('staf/laporan')) ? 'bg-white/20 text-white shadow-sm' : '' ?>" href="<?= base_url('staf/laporan') ?>">Laporan</a>
            </nav>
        </div>
        <div class="flex items-center gap-4">
           
            
            <div class="relative">
                <button onclick="document.getElementById('dropdownNotif').classList.toggle('hidden')" class="relative flex size-9 items-center justify-center rounded-full text-blue-100 hover:bg-white/20 focus:bg-white/20 focus:outline-none transition-colors">
                    <span class="material-symbols-outlined text-[20px]">notifications</span>
                    <?php if(!empty($aktivitas)): ?>
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
                        <?php if(empty($aktivitas)): ?>
                            <div class="p-6 text-center text-sm text-slate-500 flex flex-col items-center">
                                <span class="material-symbols-outlined text-4xl text-slate-300 mb-2">notifications_off</span>
                                Belum ada notifikasi baru.
                            </div>
                        <?php else: ?>
                            <?php foreach($aktivitas as $notif): 
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
</header>

<main class="flex-1 overflow-x-hidden px-4 py-8 md:px-8">
    <div class="mx-auto max-w-[1280px]">
        <nav class="mb-6 flex items-center text-sm text-slate-500">
            <a class="hover:text-primary" href="<?= base_url('staf/dashboard') ?>">Dashboard</a>
            <span class="mx-2 material-symbols-outlined text-[16px]">chevron_right</span>
            <span class="font-medium text-slate-900">Kelola Penyimpanan</span>
        </nav>
        
        <div class="mb-8 flex flex-col justify-between gap-4 md:flex-row md:items-end">
    <div class="flex flex-col gap-1">
        <h1 class="text-3xl font-black tracking-tight text-slate-900 md:text-4xl">Storage Grid (Ruangan)</h1>
        <p class="text-slate-500 text-base font-normal">Pantau kapasitas unit penyimpanan fisik, lemari, dan rak.</p>
    </div>
    
    <div class="flex gap-3">
        <a href="<?= base_url('staf/dashboard') ?>" class="flex items-center justify-center rounded-lg h-10 px-5 bg-white text-slate-700 text-sm font-bold border border-slate-200 hover:bg-slate-50 hover:text-primary transition-colors shadow-sm">
            <span class="material-symbols-outlined text-[20px] mr-2">arrow_back</span> Kembali ke Dashboard
        </a>
    </div>
</div>

        <div class="border-b border-slate-200 mb-6 flex gap-8">
            <a class="flex flex-col items-center justify-center border-b-2 border-primary text-primary pb-3" href="#">
                <p class="text-sm font-bold">Semua Ruangan</p>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            
            <?php if(empty($ruangan)): ?>
                <div class="col-span-full p-8 text-center text-slate-500 bg-white rounded-xl border border-slate-200">Belum ada master data ruangan.</div>
            <?php else: ?>
                <?php foreach($ruangan as $r): 
    // Menghitung persentase kapasitas beneran
    // Asumsinya 1 ruangan muat maksimal 500 arsip (bisa disesuaikan angkanya)
    $maksimal_arsip = 500; 
    $total_arsip = $r['total_arsip'] ?? 0;
    
    // Cegah error bagi nol atau melebihi 100%
    $percent = ($total_arsip > 0) ? round(($total_arsip / $maksimal_arsip) * 100) : 0;
    if ($percent > 100) $percent = 100; 
    
    // Tentukan warna bar
    $color_class = $percent > 80 ? 'bg-red-500' : ($percent > 50 ? 'bg-amber-500' : 'bg-primary');
    $text_class = $percent > 80 ? 'text-red-500' : 'text-primary';
?>
                <div class="bg-white rounded-xl border border-slate-200 overflow-hidden shadow-sm flex flex-col hover:shadow-md transition-shadow">
                    <div class="p-5 border-b border-slate-100 flex justify-between items-start bg-slate-50/50">
                        <div>
                            <span class="bg-primary/10 text-primary text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 rounded mb-2 inline-block">Room ID: <?= esc($r['id_ruangan']) ?></span>
                            <h3 class="text-lg font-bold text-slate-900"><?= esc($r['nama_ruangan']) ?></h3>
                            <p class="text-slate-500 text-sm flex items-center gap-1 mt-1">
                                <span class="material-symbols-outlined text-[14px]">location_on</span> Gedung Navigasi
                            </p>
                        </div>
                        <span class="p-2 text-slate-400 bg-slate-100 rounded-lg material-symbols-outlined">meeting_room</span>
                    </div>
                    <div class="p-5 space-y-4 flex-1">
                        <div>
                            <div class="flex justify-between text-sm mb-1.5">
                                <span class="font-medium text-slate-600">Estimasi Kapasitas</span>
                                <span class="<?= $text_class ?> font-bold"><?= $percent ?>% Terisi</span>
                            </div>
                            <div class="w-full bg-slate-100 rounded-full h-2 overflow-hidden">
                                <div class="<?= $color_class ?> h-full rounded-full transition-all duration-1000" style="width: <?= $percent ?>%"></div>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-3 pt-2">
                            <div class="bg-slate-50 p-3 rounded-lg border border-slate-100">
                                <p class="text-[10px] text-slate-500 uppercase font-bold">Total Lemari</p>
                                <p class="text-xl font-black text-slate-800"><?= $r['total_lemari'] ?> <span class="text-sm font-normal text-slate-500">Unit</span></p>
                            </div>
                            <div class="bg-slate-50 p-3 rounded-lg border border-slate-100">
                                <p class="text-[10px] text-slate-500 uppercase font-bold">Total Rak</p>
                                <p class="text-xl font-black text-slate-800"><?= $r['total_rak'] ?> <span class="text-sm font-normal text-slate-500">Item</span></p>
                            </div>
                            <div class="bg-slate-50 p-3 rounded-lg border border-slate-100 col-span-2">
    <p class="text-[10px] text-slate-500 uppercase font-bold">Total Arsip Tersimpan</p>
    <p class="text-xl font-black text-slate-800"><?= $total_arsip ?> <span class="text-sm font-normal text-slate-500">Berkas</span></p>
</div>
                        </div>
                    </div>
                    <div class="px-5 py-3 bg-slate-50 flex justify-end border-t border-slate-100">
                        <div class="px-5 py-3 bg-slate-50 flex justify-end border-t border-slate-100">
    <a href="<?= base_url('staf/penyimpanan/detail/' . $r['id_ruangan']) ?>" class="text-primary text-sm font-bold hover:underline flex items-center gap-1">
        View Details <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
    </a>
</div>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php endif; ?>


        </div>
    </div>
</main>
</body>
</html>