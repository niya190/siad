<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title><?= esc($title) ?> - SiArsip Navigasi</title>
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
            fontFamily: { "display": ["Public Sans", "sans-serif"] }
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
                <a class="rounded-lg px-3 py-2 text-sm font-medium text-blue-100 hover:bg-white/10 hover:text-white transition-colors" href="<?= base_url('staf/dashboard') ?>">Dashboard</a>
                <a class="rounded-lg px-3 py-2 text-sm font-medium text-blue-100 hover:bg-white/10 hover:text-white transition-colors" href="<?= base_url('staf/arsip-masuk') ?>">Arsip Masuk</a>
                <a class="rounded-lg px-3 py-2 text-sm font-medium text-blue-100 hover:bg-white/10 hover:text-white transition-colors" href="<?= base_url('staf/arsip-keluar') ?>">Arsip Keluar</a>
                <a class="rounded-lg px-3 py-2 text-sm font-medium text-blue-100 hover:bg-white/10 hover:text-white transition-colors <?= (url_is('staf/nota-dinas')) ? 'bg-white/20 text-white shadow-sm' : '' ?>" href="<?= base_url('staf/nota-dinas') ?>">Nota Dinas</a>
                <a class="rounded-lg px-3 py-2 text-sm font-medium text-blue-100 hover:bg-white/10 hover:text-white transition-colors <?= (url_is('staf/laporan')) ? 'bg-white/20 text-white shadow-sm' : '' ?>" href="<?= base_url('staf/laporan') ?>">Laporan</a>
            </nav>
        </div>
        
        <div class="flex items-center gap-4">
            <div class="flex items-center gap-3 border-l border-blue-800 pl-4">
                <div class="hidden text-right md:block">
                    <p class="text-sm font-semibold text-white"><?= esc(session()->get('nama_lengkap') ?? 'Staf') ?></p>
                    <p class="text-xs text-blue-200"><?= esc(session()->get('divisi') ?? 'Staff') ?></p>
                </div>
                <?php 
                    $parts = explode(' ', session()->get('nama_lengkap') ?? 'User');
                    $initials = strtoupper(substr($parts[0], 0, 1) . (isset($parts[1]) ? substr($parts[1], 0, 1) : ''));
                ?>
                <button class="flex size-10 items-center justify-center rounded-full bg-white text-primary font-bold ring-2 ring-white/10"><?= $initials ?></button>
                <a href="<?= base_url('login/logout') ?>" class="text-blue-200 hover:text-red-400 ml-2"><span class="material-symbols-outlined">logout</span></a>
            </div>
        </div>
    </div>
</header>

<main class="flex-1 overflow-x-hidden px-4 py-8 md:px-8">
    <div class="mx-auto max-w-[1280px]">
        
        <nav class="mb-6 flex items-center text-sm text-slate-500 dark:text-slate-400">
            <a class="hover:text-primary" href="<?= base_url('staf/dashboard') ?>">Dashboard</a>
            <span class="mx-2 material-symbols-outlined text-[16px]">chevron_right</span>
            <span class="font-medium text-slate-900 dark:text-slate-100">Detail <?= esc($arsip['jenis_arsip']) ?></span>
        </nav>

        <div class="mb-8 flex flex-col justify-between gap-4 md:flex-row md:items-end">
            <div>
                <div class="mb-2 flex items-center gap-2">
                    <?php 
                        // Atur warna badge berdasarkan status arsip
                        $statusClass = (strtolower($arsip['status']) == 'pending') ? 'bg-yellow-100 text-yellow-700' : 'bg-green-100 text-green-700'; 
                    ?>
                    <span class="rounded <?= $statusClass ?> px-2 py-0.5 text-xs font-semibold uppercase"><?= esc($arsip['status'] ?? 'TERSEDIA') ?></span>
                    <span class="rounded bg-slate-100 px-2 py-0.5 text-xs font-semibold text-slate-600 dark:bg-slate-800 dark:text-slate-400"><?= esc($arsip['jenis_arsip']) ?></span>
                </div>
                <h1 class="text-3xl font-black tracking-tight text-slate-900 dark:text-white md:text-4xl"><?= esc($arsip['perihal']) ?></h1>
                <p class="mt-2 text-lg text-slate-500 dark:text-slate-400">Nomor: <?= esc($arsip['nomor_surat']) ?></p>
            </div>
            <div class="flex gap-3">
                <button class="flex items-center gap-2 rounded-lg border border-slate-200 bg-white px-4 py-2 text-sm font-medium text-slate-700 hover:bg-slate-50 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-300">
                    <span class="material-symbols-outlined text-[20px]">print</span> Cetak Label
                </button>
                <a href="<?= base_url('staf/arsip/edit/' . $arsip['id_arsip']) ?>" class="flex items-center gap-2 rounded-lg bg-primary px-4 py-2 text-sm font-medium text-white hover:bg-primary/90 shadow-sm shadow-primary/20">
                    <span class="material-symbols-outlined text-[20px]">edit</span> Edit Data
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
            <div class="lg:col-span-2">
                <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm dark:border-slate-800 dark:bg-slate-900">
                    <div class="border-b border-slate-100 px-6 py-4 dark:border-slate-800">
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white">Informasi Dokumen</h3>
                    </div>
                    <div class="divide-y divide-slate-100 px-6 dark:divide-slate-800">
                        <div class="grid grid-cols-1 gap-4 py-5 sm:grid-cols-3">
                            <dt class="text-sm font-medium text-slate-500 dark:text-slate-400">Nomor Dokumen</dt>
                            <dd class="text-sm font-medium text-slate-900 dark:text-slate-100 sm:col-span-2"><?= esc($arsip['nomor_surat']) ?></dd>
                        </div>
                        <div class="grid grid-cols-1 gap-4 py-5 sm:grid-cols-3">
                            <dt class="text-sm font-medium text-slate-500 dark:text-slate-400">Klasifikasi</dt>
                            <dd class="text-sm font-medium text-slate-900 dark:text-slate-100 sm:col-span-2"><?= esc($arsip['nama_klasifikasi'] ?? '-') ?></dd>
                        </div>
                        <div class="grid grid-cols-1 gap-4 py-5 sm:grid-cols-3">
                            <dt class="text-sm font-medium text-slate-500 dark:text-slate-400">Tanggal Dokumen</dt>
                            <dd class="text-sm text-slate-900 dark:text-slate-100 sm:col-span-2"><?= date('d F Y', strtotime($arsip['tanggal_surat'])) ?></dd>
                        </div>
                        <div class="grid grid-cols-1 gap-4 py-5 sm:grid-cols-3">
                            <dt class="text-sm font-medium text-slate-500 dark:text-slate-400">Instansi / Tujuan</dt>
                            <dd class="flex items-center gap-3 text-sm text-slate-900 dark:text-slate-100 sm:col-span-2">
                                <?php $inisial = strtoupper(substr($arsip['pengirim_tujuan'], 0, 2)); ?>
                                <span class="flex size-8 items-center justify-center rounded-full bg-blue-100 text-xs font-bold text-blue-700"><?= esc($inisial) ?></span>
                                <div>
                                    <p class="font-medium"><?= esc($arsip['pengirim_tujuan']) ?></p>
                                </div>
                            </dd>
                        </div>
                        <div class="grid grid-cols-1 gap-4 py-5 sm:grid-cols-3">
                            <dt class="text-sm font-medium text-slate-500 dark:text-slate-400">Keterangan / Ringkasan</dt>
                            <dd class="text-sm text-slate-900 dark:text-slate-100 sm:col-span-2">
                                <?= esc($arsip['keterangan'] ?? 'Tidak ada keterangan tambahan.') ?>
                            </dd>
                        </div>
                    </div>
                </div>

                <div class="mt-6 rounded-xl border border-slate-200 bg-slate-50 p-6 dark:border-slate-800 dark:bg-slate-900/50">
                    <h4 class="mb-4 text-sm font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400">Lampiran Digital</h4>
                    <div class="flex items-center justify-between rounded-lg border border-slate-200 bg-white p-4 shadow-sm dark:border-slate-700 dark:bg-slate-800">
                        <div class="flex items-center gap-4">
                            <div class="flex size-12 items-center justify-center rounded bg-red-50 text-red-500 dark:bg-red-900/20">
                                <span class="material-symbols-outlined text-[28px]">picture_as_pdf</span>
                            </div>
                            <div>
                                <?php if (!empty($arsip['file_scan'])): ?>
                                    <p class="font-bold text-slate-900 dark:text-white">Dokumen_Scan.pdf</p>
                                    <p class="text-xs text-slate-500">File Tersedia • Terenkripsi</p>
                                <?php else: ?>
                                    <p class="font-bold text-slate-500 dark:text-slate-400">Belum ada lampiran diunggah</p>
                                    <p class="text-xs text-slate-400">Silakan edit data untuk menambahkan file.</p>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php if (!empty($arsip['file_scan'])): ?>
                            <a href="<?= base_url('uploads/arsip/' . $arsip['file_scan']) ?>" target="_blank" class="flex size-9 items-center justify-center rounded-full text-slate-400 hover:bg-slate-100 hover:text-primary dark:hover:bg-slate-700" title="Unduh File">
                                <span class="material-symbols-outlined text-[20px]">download</span>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-1">
                <div class="sticky top-24 rounded-xl border border-slate-200 bg-white shadow-lg dark:border-slate-800 dark:bg-slate-900">
                    <div class="relative h-48 w-full overflow-hidden rounded-t-xl bg-slate-100 dark:bg-slate-800">
                        <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1497366216548-37526070297c?q=80&w=2301&auto=format&fit=crop')] bg-cover bg-center opacity-50 mix-blend-multiply"></div>
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                        <div class="absolute bottom-4 left-4 text-white">
                            <div class="flex items-center gap-2">
                                <span class="material-symbols-outlined text-[20px]">location_on</span>
                                <span class="font-bold"><?= esc($arsip['nama_ruangan'] ?? 'Ruangan Belum Diatur') ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="mb-6 flex items-start justify-between">
                            <div>
                                <h3 class="text-xl font-bold text-slate-900 dark:text-white">Penyimpanan Fisik</h3>
                                <p class="text-sm text-slate-500 dark:text-slate-400">Lokasi arsip saat ini</p>
                            </div>
                            <div class="flex size-10 items-center justify-center rounded-full bg-green-100 text-green-600 dark:bg-green-900/30 dark:text-green-400">
                                <span class="material-symbols-outlined text-[24px]">inventory_2</span>
                            </div>
                        </div>
                        <div class="space-y-4">
                            <div class="flex items-center gap-4 rounded-lg border border-slate-100 bg-slate-50 p-3 dark:border-slate-800 dark:bg-slate-800/50">
                                <div class="flex size-10 shrink-0 items-center justify-center rounded-full bg-white text-primary shadow-sm dark:bg-slate-700 dark:text-white">
                                    <span class="material-symbols-outlined text-[20px]">door_open</span>
                                </div>
                                <div>
                                    <p class="text-xs font-medium uppercase tracking-wide text-slate-500 dark:text-slate-400">Ruangan</p>
                                    <p class="font-semibold text-slate-900 dark:text-white"><?= esc($arsip['nama_ruangan'] ?? 'Tidak Diketahui') ?></p>
                                </div>
                            </div>
                            <div class="flex items-center gap-4 rounded-lg border border-slate-100 bg-slate-50 p-3 dark:border-slate-800 dark:bg-slate-800/50">
                                <div class="flex size-10 shrink-0 items-center justify-center rounded-full bg-white text-primary shadow-sm dark:bg-slate-700 dark:text-white">
                                    <span class="material-symbols-outlined text-[20px]">shelves</span>
                                </div>
                                <div>
                                    <p class="text-xs font-medium uppercase tracking-wide text-slate-500 dark:text-slate-400">Lemari</p>
                                    <p class="font-semibold text-slate-900 dark:text-white"><?= esc($arsip['nama_lemari'] ?? 'Tidak Diketahui') ?></p>
                                </div>
                            </div>
                            <div class="flex items-center gap-4 rounded-lg border border-primary/20 bg-primary/5 p-3 dark:border-primary/30 dark:bg-primary/10">
                                <div class="flex size-10 shrink-0 items-center justify-center rounded-full bg-primary text-white shadow-sm shadow-primary/30">
                                    <span class="material-symbols-outlined text-[20px]">layers</span>
                                </div>
                                <div>
                                    <p class="text-xs font-medium uppercase tracking-wide text-primary/80 dark:text-primary/70">Posisi Rak</p>
                                    <p class="font-bold text-primary dark:text-white"><?= esc($arsip['nama_rak'] ?? 'Belum Dialokasikan') ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

</body>
</html>