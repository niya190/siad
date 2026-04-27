<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title><?= $title ?> - SIAD</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script>
        tailwind.config = { darkMode: "class", theme: { extend: { colors: { primary: "#135bec", "background-light": "#f6f6f8", "nav-blue": "#1e40af" }, fontFamily: { display: ["Public Sans", "sans-serif"] } } } }
    </script>
</head>
<body class="bg-background-light font-display text-slate-900 min-h-screen flex flex-col">

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
                <a class="rounded-lg bg-white/20 px-3 py-2 text-sm font-medium text-white shadow-sm" href="<?= base_url('staf/dashboard') ?>">Dashboard</a>
                <a class="rounded-lg px-3 py-2 text-sm font-medium text-blue-100 hover:bg-white/10 hover:text-white transition-colors" href="<?= base_url('staf/arsip-masuk') ?>">Arsip Masuk</a>
                <a class="rounded-lg px-3 py-2 text-sm font-medium text-blue-100 hover:bg-white/10 hover:text-white transition-colors" href="<?= base_url('staf/arsip-keluar') ?>">Arsip Keluar</a>
                <a class="rounded-lg px-3 py-2 text-sm font-medium text-blue-100 hover:bg-white/10 hover:text-white transition-colors" href="<?= base_url('staf/nota-dinas') ?>">Nota Dinas</a>
                <a class="rounded-lg px-3 py-2 text-sm font-medium text-blue-100 hover:bg-white/10 hover:text-white transition-colors" href="<?= base_url('staf/laporan') ?>">Laporan</a>
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

<main class="flex-1 px-4 py-8 md:px-8">
    <div class="mx-auto max-w-[1280px]">
        
        <div class="mb-8 flex flex-col justify-between gap-4 md:flex-row md:items-end">
            <div>
                <h1 class="text-3xl font-black tracking-tight text-slate-900 md:text-4xl">Dashboard Staf</h1>
                <p class="mt-2 text-lg text-slate-500">Selamat datang kembali! Berikut adalah ringkasan pengelolaan arsip Navigasi saat ini.</p>
            </div>
            <div class="flex gap-3">
                
            </div>
        </div>

        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4 mb-8">
            <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
                <div class="flex items-center justify-between">
                    <div><p class="text-sm font-medium text-slate-500">Total Surat Masuk</p><p class="mt-2 text-3xl font-black text-slate-900"><?= $total_masuk ?></p></div>
                    <div class="flex size-12 items-center justify-center rounded-full bg-blue-50 text-blue-600"><span class="material-symbols-outlined text-2xl">move_to_inbox</span></div>
                </div>
            </div>
            <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
                <div class="flex items-center justify-between">
                    <div><p class="text-sm font-medium text-slate-500">Total Surat Keluar</p><p class="mt-2 text-3xl font-black text-slate-900"><?= $total_keluar ?></p></div>
                    <div class="flex size-12 items-center justify-center rounded-full bg-emerald-50 text-emerald-600"><span class="material-symbols-outlined text-2xl">outbox</span></div>
                </div>
            </div>
            <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
                <div class="flex items-center justify-between">
                    <div><p class="text-sm font-medium text-slate-500">Nota Dinas / Internal</p><p class="mt-2 text-3xl font-black text-slate-900"><?= $total_nota ?></p></div>
                    <div class="flex size-12 items-center justify-center rounded-full bg-amber-50 text-amber-600"><span class="material-symbols-outlined text-2xl">description</span></div>
                </div>
            </div>
            <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
                <div class="flex items-center justify-between">
                    <div><p class="text-sm font-medium text-slate-500">Total Keseluruhan</p><p class="mt-2 text-3xl font-black text-slate-900"><?= $total_arsip ?></p></div>
                    <div class="flex size-12 items-center justify-center rounded-full bg-purple-50 text-purple-600"><span class="material-symbols-outlined text-2xl">inventory_2</span></div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-8">
            
    <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm flex flex-col w-full">
                <div class="mb-6 flex items-center justify-between">
                    <h3 class="text-lg font-bold text-slate-900">Tren Arsip Bulanan (<?= date('Y') ?>)</h3>
                </div>
                <div class="relative flex-1 min-h-[250px] w-full mt-4">
                    <div class="absolute inset-0 flex flex-col justify-between text-xs text-slate-400">
                        <div class="flex items-center border-t border-slate-100 w-full"><span class="absolute -translate-y-1/2 bg-white pr-2"><?= $max_grafik ?></span></div>
                        <div class="flex items-center border-t border-slate-100 w-full"><span class="absolute -translate-y-1/2 bg-white pr-2"><?= round($max_grafik * 0.75) ?></span></div>
                        <div class="flex items-center border-t border-slate-100 w-full"><span class="absolute -translate-y-1/2 bg-white pr-2"><?= round($max_grafik * 0.5) ?></span></div>
                        <div class="flex items-center border-t border-slate-100 w-full"><span class="absolute -translate-y-1/2 bg-white pr-2"><?= round($max_grafik * 0.25) ?></span></div>
                        <div class="flex items-center border-t border-slate-100 w-full"><span class="absolute -translate-y-1/2 bg-white pr-2">0</span></div>
                    </div>
                    <div class="absolute inset-y-0 left-8 right-0 flex items-end justify-between px-2 pb-6">
                        <?php foreach($grafik as $g): 
                            // Hitung persentase tinggi bar (Max 100%)
                            $tinggi_bar = ($g['jumlah'] / $max_grafik) * 100;
                        ?>
                        <div class="group relative flex w-full flex-col items-center justify-end h-full">
                            <div class="absolute -top-10 hidden rounded bg-slate-900 px-2 py-1 text-xs text-white group-hover:block z-10">
                                <?= $g['jumlah'] ?> Surat
                            </div>
                            <div class="w-full max-w-[2rem] rounded-t-sm bg-primary/20 transition-all group-hover:bg-primary" style="height: <?= $tinggi_bar ?>%"></div>
                            <span class="absolute -bottom-6 text-xs font-medium text-slate-500"><?= $g['bulan'] ?></span>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            
                <div class="p-6 pt-0 mt-auto">
                    <a href="<?= base_url('staf/penyimpanan') ?>" class="block text-center w-full rounded-lg border border-slate-200 bg-slate-50 text-slate-700 py-2.5 text-sm font-bold hover:bg-slate-100 transition-colors">Lihat Status Penyimpanan</a>
                </div>
            </div>

        </div>
    </div>
</main>
</body>
</html>