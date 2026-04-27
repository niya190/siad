<!DOCTYPE html>
<html lang="id" class="light">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title><?= $title ?? 'Edit Arsip' ?> - SIAD Navigasi</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        primary: "#0e4c92", "background-light": "#f8fafc", "background-dark": "#0f172a",
                        "navy-dark": "#0a2369", "sidebar-bg": "#ffffff",
                    },
                    fontFamily: { display: ["Public Sans", "sans-serif"] },
                },
            },
        }
    </script>
</head>
<body class="bg-background-light font-display text-slate-900 antialiased h-screen flex flex-col overflow-hidden">

<header class="h-16 bg-white border-b border-slate-200 flex items-center justify-between px-6 z-20 shadow-sm flex-shrink-0">
    <div class="flex items-center gap-4">
        <div class="flex items-center gap-3">
            <div class="size-10 rounded-lg bg-primary flex items-center justify-center shrink-0 shadow-lg overflow-hidden p-1">
                <img src="<?= base_url('assets/img/logo.JPEG') ?>" alt="Logo" class="h-8 w-auto object-contain bg-white rounded">
            </div>
            <div class="flex flex-col text-slate-900">
                <h1 class="text-sm font-bold leading-tight uppercase">Distrik Navigasi</h1>
                <p class="text-[10px] font-medium opacity-60 uppercase">Tanjungpinang - Kelas I</p>
            </div>
        </div>
    </div>
</header>

<div class="flex flex-1 overflow-hidden">
    <aside class="w-64 bg-sidebar-bg dark:bg-surface-dark border-r border-slate-200 dark:border-slate-800 flex flex-col flex-shrink-0 z-10">
<div class="p-4 border-b border-slate-100 dark:border-slate-800/50">
<button class="w-full flex items-center justify-between px-3 py-2 bg-slate-50 dark:bg-slate-800/50 rounded-lg border border-slate-200 dark:border-slate-700 hover:border-primary/30 transition-colors group">
<div class="flex items-center gap-2">
<span class="material-symbols-outlined text-primary text-xl">admin_panel_settings</span>
<span class="text-sm font-medium text-slate-700 dark:text-slate-200">Admin View</span>
</div>
<span class="material-symbols-outlined text-slate-400 text-sm group-hover:text-primary transition-colors">expand_more</span>
</button>
</div>
<nav class="flex-1 overflow-y-auto py-4 px-3 space-y-1">
<div class="px-3 mb-2 text-xs font-semibold text-slate-400 uppercase tracking-wider">Main Menu</div>
<a class="flex items-center gap-3 px-3 py-2 rounded-lg bg-primary text-white font-medium shadow-md shadow-primary/20 transition-all group" href="<?= base_url('admin/dashboard') ?>">
<span class="material-symbols-outlined filled">dashboard</span>
<span class="text-sm">Dashboard</span>
</a>
<a class="flex items-center gap-3 px-3 py-2 rounded-lg text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800 hover:text-primary dark:hover:text-white transition-colors group" href="<?= base_url('admin/arsip/search') ?>">
    <span class="material-symbols-outlined group-hover:text-primary dark:group-hover:text-blue-400 transition-colors">search</span>
    <span class="text-sm font-medium">Search Archives</span>
</a>
<a class="flex items-center gap-3 px-3 py-2 rounded-lg text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800 hover:text-primary dark:hover:text-white transition-colors group" href="<?= base_url('admin/arsip/create') ?>">
<span class="material-symbols-outlined group-hover:text-primary dark:group-hover:text-blue-400 transition-colors">input</span>
<span class="text-sm font-medium">Data Entry</span>
</a>
<div class="mt-6 mb-2 px-3 text-xs font-semibold text-slate-400 uppercase tracking-wider">Administrative</div>
<a class="flex items-center gap-3 px-3 py-2 rounded-lg text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800 hover:text-primary dark:hover:text-white transition-colors group" href="<?= base_url('admin/lemari') ?>">
<span class="material-symbols-outlined group-hover:text-primary dark:group-hover:text-blue-400 transition-colors">folder_managed</span>
<span class="text-sm font-medium">Archive Manager</span>
</a>
<a class="flex items-center gap-3 px-3 py-2 rounded-lg text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800 hover:text-primary dark:hover:text-white transition-colors group" href="<?= base_url('admin/user') ?>">
<span class="material-symbols-outlined group-hover:text-primary dark:group-hover:text-blue-400 transition-colors">people</span>
<span class="text-sm font-medium">User Management</span>
</a>
<a class="flex items-center gap-3 px-3 py-2 rounded-lg text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800 hover:text-primary dark:hover:text-white transition-colors group" 
   href="<?= base_url('admin/settings') ?>">  <span class="material-symbols-outlined group-hover:text-primary dark:group-hover:text-blue-400 transition-colors">settings_applications</span>
    <span class="text-sm font-medium">System Settings</span>
</a>
</nav>

</aside>

    <main class="flex-1 flex flex-col overflow-y-auto bg-slate-50 p-8">
        <div class="max-w-5xl mx-auto w-full">
            
            <div class="mb-6">
                <a href="<?= base_url('admin/arsip/search') ?>" class="flex items-center gap-2 text-primary hover:gap-3 transition-all font-bold text-sm w-fit">
                    <span class="material-symbols-outlined text-[18px]">arrow_back</span> Kembali ke Pencarian
                </a>
            </div>

            <div class="mb-8 flex justify-between items-end">
                <div>
                    <h2 class="text-3xl font-bold text-slate-900 mb-2">Edit Informasi Arsip</h2>
                    <p class="text-slate-500">Sesuaikan data arsip nomor: <strong class="text-primary"><?= esc($arsip['nomor_surat'] ?? '') ?></strong></p>
                </div>
                <div class="px-4 py-2 bg-yellow-100 text-yellow-700 rounded-lg text-xs font-bold border border-yellow-200">
                    STATUS: <?= strtoupper(esc($arsip['status'] ?? 'TERSIMPAN')) ?>
                </div>
            </div>

            <form action="<?= base_url('admin/arsip/update/' . $arsip['id_arsip']) ?>" method="POST" enctype="multipart/form-data">
                <?= csrf_field() ?>
                
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <div class="lg:col-span-2 space-y-6">
                        <div class="bg-white p-8 rounded-2xl border border-slate-200 shadow-sm">
                            <h3 class="text-lg font-bold text-slate-900 mb-6 flex items-center gap-2">
                                <span class="material-symbols-outlined text-primary">description</span> Detail Dokumen
                            </h3>
                            
                            <div class="space-y-5">
                                <div class="flex flex-col gap-1.5">
                                    <label class="text-xs font-bold text-slate-500 uppercase">Judul Arsip / Perihal</label>
                                    <input name="perihal" value="<?= esc($arsip['perihal'] ?? '') ?>" required class="w-full bg-slate-50 border-slate-200 rounded-xl p-3 text-sm focus:ring-primary focus:border-primary transition-all" type="text"/>
                                </div>

                                <div class="grid grid-cols-2 gap-4">
                                    <div class="flex flex-col gap-1.5">
                                        <label class="text-xs font-bold text-slate-500 uppercase">Nomor Arsip</label>
                                        <input name="nomor_surat" value="<?= esc($arsip['nomor_surat'] ?? '') ?>" required class="bg-slate-50 border-slate-200 rounded-xl p-3 text-sm focus:ring-primary transition-all" type="text"/>
                                    </div>
                                    <div class="flex flex-col gap-1.5">
                                        <label class="text-xs font-bold text-slate-500 uppercase">Tanggal Dokumen</label>
                                        <input name="tanggal_surat" value="<?= esc($arsip['tanggal_surat'] ?? '') ?>" required class="bg-slate-50 border-slate-200 rounded-xl p-3 text-sm focus:ring-primary transition-all" type="date"/>
                                    </div>
                                </div>

                                <div class="flex flex-col gap-1.5">
                                    <label class="text-xs font-bold text-slate-500 uppercase">Deskripsi Ringkas (Keterangan)</label>
                                    <textarea name="keterangan" rows="3" class="bg-slate-50 border-slate-200 rounded-xl p-3 text-sm focus:ring-primary transition-all"><?= esc($arsip['keterangan'] ?? '') ?></textarea>
                                </div>
                                
                                <div class="pt-4 mt-4 border-t border-slate-100 flex flex-col gap-2">
                                    <label class="text-xs font-bold text-slate-500 uppercase">File Pindai (Scan Dokumen)</label>
                                    
                                    <?php if(!empty($arsip['file_scan'])): ?>
                                        <div class="flex items-center justify-between p-3 bg-blue-50/50 border border-blue-100 rounded-xl mb-2">
                                            <div class="flex items-center gap-3">
                                                <span class="material-symbols-outlined text-blue-500 text-3xl">picture_as_pdf</span>
                                                <div>
                                                    <p class="text-xs font-bold text-blue-900">File Terlampir Saat Ini</p>
                                                    <p class="text-[10px] text-blue-600 truncate w-48"><?= esc($arsip['file_scan']) ?></p>
                                                </div>
                                            </div>
                                            <a href="<?= base_url('uploads/arsip/' . $arsip['file_scan']) ?>" target="_blank" class="px-4 py-1.5 bg-blue-600 text-white text-xs font-bold rounded-lg hover:bg-blue-700 transition-colors shadow-sm">
                                                Lihat File
                                            </a>
                                        </div>
                                    <?php endif; ?>

                                    <div class="relative">
                                        <input type="file" name="file_scan" accept=".pdf,.jpg,.jpeg,.png" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-primary/10 file:text-primary hover:file:bg-primary/20 cursor-pointer border border-slate-200 rounded-xl bg-slate-50"/>
                                        <p class="text-[10px] text-slate-400 mt-1.5">* Kosongkan bagian ini jika Anda tidak ingin mengubah/mengganti file yang sudah ada.</p>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="flex items-center justify-end gap-4">
                            <a href="<?= base_url('admin/arsip/search') ?>" class="px-6 py-3 text-slate-500 font-bold text-sm hover:text-slate-700 transition-colors">Batal</a>
                            <button type="submit" class="px-10 py-3 bg-primary text-white font-bold rounded-xl hover:shadow-lg hover:shadow-primary/30 transition-all flex items-center gap-2">
                                <span class="material-symbols-outlined text-[20px]">save</span> Simpan Perubahan
                            </button>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
                            <h3 class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-4">Klasifikasi & Kategori</h3>
                            <div class="space-y-4">
                                <div class="flex flex-col gap-1.5">
                                    <label class="text-[11px] font-bold text-slate-700">Jenis Arsip</label>
                                    <select name="jenis_arsip" class="bg-slate-50 border-slate-200 rounded-lg p-2 text-xs">
                                        <option value="masuk" <?= (isset($arsip['jenis_arsip']) && $arsip['jenis_arsip'] == 'masuk') ? 'selected' : '' ?>>Surat Masuk</option>
                                        <option value="keluar" <?= (isset($arsip['jenis_arsip']) && $arsip['jenis_arsip'] == 'keluar') ? 'selected' : '' ?>>Surat Keluar</option>
                                        <option value="nota_dinas" <?= (isset($arsip['jenis_arsip']) && $arsip['jenis_arsip'] == 'nota_dinas') ? 'selected' : '' ?>>Nota Dinas</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="bg-primary/5 border border-primary/10 p-6 rounded-2xl">
                            <h4 class="text-sm font-bold text-primary mb-2 flex items-center gap-1">
                                <span class="material-symbols-outlined text-lg">info</span> Info Upload
                            </h4>
                            <p class="text-[11px] text-slate-600 leading-relaxed mb-2">
                                File lama akan **terhapus secara otomatis** dari memori server jika Anda mengunggah file baru.
                            </p>
                            <p class="text-[11px] text-slate-600 leading-relaxed">
                                Format: PDF/JPG/PNG.
                            </p>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </main>
</div>
</body>
</html>