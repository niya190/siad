<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title><?= $title ?> - SiArsip Navigasi</title>
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
                <div class="flex size-10 items-center justify-center rounded-lg bg-white/10 text-white backdrop-blur-sm"><span class="material-symbols-outlined text-2xl">folder_managed</span></div>
                <div><h2 class="text-lg font-bold leading-tight text-white">SiArsip</h2><p class="text-xs text-blue-200">Navigasi Tanjungpinang</p></div>
            </div>
            <nav class="hidden items-center gap-1 md:flex">
                <a class="rounded-lg px-3 py-2 text-sm font-medium text-blue-100 hover:bg-white/10 hover:text-white transition-colors" href="<?= base_url('staf/dashboard') ?>">Dashboard</a>
                <a class="rounded-lg px-3 py-2 text-sm font-medium text-blue-100 hover:bg-white/10 hover:text-white transition-colors" href="<?= base_url('staf/arsip-masuk') ?>">Arsip Masuk</a>
                <a class="rounded-lg px-3 py-2 text-sm font-medium text-blue-100 hover:bg-white/10 hover:text-white transition-colors" href="<?= base_url('staf/arsip-keluar') ?>">Arsip Keluar</a>
                <a class="rounded-lg px-3 py-2 text-sm font-medium text-blue-100 hover:bg-white/10 hover:text-white transition-colors" href="<?= base_url('staf/nota-dinas') ?>">Nota Dinas</a>
            </nav>
        </div>
        <div class="flex items-center gap-4">
            <div class="flex items-center gap-3 border-l border-blue-800 pl-4">
                <div class="hidden text-right md:block">
                    <p class="text-sm font-semibold text-white"><?= esc(session()->get('nama_lengkap') ?? 'Staf') ?></p>
                    <p class="text-xs text-blue-200">Staff Tata Usaha</p>
                </div>
                <div class="flex size-10 items-center justify-center rounded-full bg-blue-700 border-2 border-blue-400 text-white font-bold">ST</div>
            </div>
        </div>
    </div>
</header>

<?php 
    // LOGIKA PERHITUNGAN CHART DINAMIS
    $total_semua = array_sum(array_column($klasifikasi, 'total_akses'));
    $max_akses = !empty($klasifikasi) ? max(array_column($klasifikasi, 'total_akses')) : 1;
    $max_akses = $max_akses == 0 ? 1 : $max_akses; // Hindari error pembagian 0
    
    // Ambil yang peringkat 1 untuk ditampilkan di kotak highlight
    $top_klasifikasi = !empty($klasifikasi) ? $klasifikasi[0] : ['kode_klasifikasi' => '-', 'nama_klasifikasi' => 'Belum ada data'];
?>

<main class="flex-1 overflow-x-hidden px-4 py-8 md:px-8">
    <div class="mx-auto max-w-[1280px]">
        <nav class="mb-6 flex items-center text-sm text-slate-500">
            <a class="hover:text-primary" href="<?= base_url('staf/dashboard') ?>">Dashboard</a>
            <span class="mx-2 material-symbols-outlined text-[16px]">chevron_right</span>
            <span class="font-medium text-slate-900">Klasifikasi Populer</span>
        </nav>
        
        <div class="mb-8 flex flex-wrap justify-between items-end gap-4">
            <div class="max-w-2xl">
                <h2 class="text-3xl font-black tracking-tight text-slate-900 mb-2">Klasifikasi Sering Diakses</h2>
                <p class="text-slate-500 text-lg">Statistik penggunaan klasifikasi arsip paling populer di lingkungan Navigasi berdasarkan intensitas input/akses.</p>
            </div>
            <div class="flex gap-2">
                <button class="flex items-center gap-2 px-4 py-2 bg-primary text-white rounded-lg text-sm font-semibold hover:bg-primary/90 transition-colors">
                    <span class="material-symbols-outlined text-lg">download</span>Export Data
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            
            <div class="lg:col-span-2 bg-white p-6 rounded-xl border border-slate-200 shadow-sm"> 
                <div class="flex items-center justify-between mb-8"> 
                    <div> 
                        <h3 class="text-lg font-bold text-slate-900">Intensitas Akses Per Klasifikasi</h3> 
                        <div class="flex items-center gap-2 mt-1"> 
                            <span class="text-3xl font-bold text-primary"><?= number_format($total_semua) ?></span> 
                            <span class="text-sm font-medium text-emerald-500 flex items-center bg-emerald-50 px-2 py-0.5 rounded-full"> 
                                Total Dokumen 
                            </span> 
                        </div> 
                    </div> 
                </div> 
                
                <div class="space-y-6"> 
                    <?php if(empty($klasifikasi)): ?>
                        <p class="text-slate-500 text-center py-4">Belum ada data arsip.</p>
                    <?php else: ?>
                        <?php foreach($klasifikasi as $row): 
                            // Hitung persentase lebar bar (maksimal 100%)
                            $persen = ($row['total_akses'] / $max_akses) * 100;
                        ?>
                        <div class="group"> 
                            <div class="flex justify-between items-center mb-2"> 
                                <span class="text-sm font-bold text-slate-700"><?= esc($row['nama_klasifikasi']) ?> (<?= esc($row['kode_klasifikasi']) ?>)</span> 
                                <span class="text-sm font-semibold text-slate-900"><?= esc($row['total_akses']) ?> Akses</span> 
                            </div> 
                            <div class="w-full h-3 bg-slate-100 rounded-full overflow-hidden"> 
                                <div class="h-full bg-primary rounded-full transition-all duration-1000" style="width: <?= $persen ?>%"></div> 
                            </div> 
                        </div> 
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>

            <div class="flex flex-col gap-6">
                <div class="bg-primary p-6 rounded-xl text-white shadow-lg shadow-primary/20 relative overflow-hidden">
                    <div class="relative z-10">
                        <h4 class="text-sm font-medium opacity-80 mb-1">Klasifikasi Terpopuler</h4>
                        <p class="text-2xl font-bold mb-4"><?= esc($top_klasifikasi['kode_klasifikasi']) ?> - <?= esc($top_klasifikasi['nama_klasifikasi']) ?></p>
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined">analytics</span>
                            <span class="text-sm">Mendominasi penyimpanan</span>
                        </div>
                    </div>
                    <div class="absolute -right-4 -bottom-4 opacity-20">
                        <span class="material-symbols-outlined text-[120px]">sell</span>
                    </div>
                </div>
                
                <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm flex-1">
                    <h4 class="text-sm font-bold text-slate-900 mb-4 uppercase tracking-widest flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary">lightbulb</span> Insight AI
                    </h4>
                    <p class="text-sm text-slate-600 leading-relaxed mb-4">
                        Berdasarkan data saat ini, klasifikasi <strong><?= esc($top_klasifikasi['nama_klasifikasi']) ?></strong> adalah yang paling sering ditambahkan ke dalam sistem. 
                    </p>
                    <p class="text-sm text-slate-600 leading-relaxed">
                        Pastikan alokasi ruang penyimpanan fisik (Lemari & Rak) untuk kategori ini selalu tersedia.
                    </p>
                </div>
            </div>
        </div>
    </div>
</main>
</body>
</html>