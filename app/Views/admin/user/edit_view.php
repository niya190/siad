<!DOCTYPE html>
<html lang="id" class="light">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title><?= $title ?? 'Edit Pegawai' ?> - SIAD Navigasi</title>
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
                        "surface-dark": "#1e293b", "sidebar-bg": "#ffffff", "sidebar-active": "#eff6ff",
                    },
                    fontFamily: { display: ["Public Sans", "sans-serif"] },
                },
            },
        }
    </script>
</head>
<body class="bg-background-light dark:bg-background-dark font-display text-slate-900 dark:text-slate-100 antialiased h-screen flex flex-col overflow-hidden">

<header class="h-16 bg-white dark:bg-surface-dark border-b border-slate-200 dark:border-slate-800 flex items-center justify-between px-6 z-20 shadow-sm flex-shrink-0">
    <div class="flex items-center gap-4">
        <div class="flex items-center gap-3">
            <div class="size-10 rounded-lg bg-primary flex items-center justify-center shrink-0 shadow-lg overflow-hidden p-1">
                <img src="<?= base_url('assets/img/logo.JPEG') ?>" alt="Logo Distrik Navigasi" class="h-8 w-auto object-contain bg-white rounded">
            </div>
            <div class="flex flex-col">
                <h1 class="text-slate-900 dark:text-white text-sm font-bold leading-tight">Distrik Navigasi</h1>
                <p class="text-slate-500 dark:text-slate-400 text-xs font-medium">Tanjungpinang - Kelas I</p>
            </div>
        </div>
    </div>
    <div class="flex items-center gap-4">
        <div class="flex items-center gap-3 pl-4 border-l border-slate-200">
            <div class="text-right hidden sm:block">
    <p class="text-sm font-semibold text-slate-900 dark:text-white leading-none">
        <?= esc(session()->get('nama_lengkap') ?? 'Administrator') ?>
    </p>
    <div class="flex items-center justify-end gap-2 mt-1">
        
        <?php 
            // Ambil data NIP langsung dari session
            $nipPegawai = session()->get('nip');
            
            // Logika Pintar: Tampilkan tulisan NIP HANYA kalau datanya ada (bukan NULL atau kosong)
            if (!empty($nipPegawai)) : 
        ?>
            <span class="text-[10px] font-medium text-slate-500 dark:text-slate-400 tracking-wider">
                NIP: <?= esc($nipPegawai) ?>
            </span>
        <?php endif; ?>
        
        <span class="inline-flex items-center gap-1 px-1.5 py-0.5 rounded text-[10px] font-bold bg-primary/10 text-primary dark:text-blue-300 uppercase tracking-wide">
            <?= esc(session()->get('role') ?? 'Admin') ?>
        </span>
    </div>
</div>
            <div class="flex size-9 items-center justify-center rounded-full bg-slate-200 border-2 border-white shadow-sm text-slate-600 font-bold text-xs">AD</div>
            <a href="<?= base_url('login/logout') ?>" class="text-slate-400 hover:text-red-500 ml-1 transition-colors" title="Logout">
                <span class="material-symbols-outlined text-xl">logout</span>
            </a>
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
            </button>
        </div>
        <nav class="flex-1 overflow-y-auto py-4 px-3 space-y-1">
            <div class="px-3 mb-2 text-xs font-semibold text-slate-400 uppercase tracking-wider">Main Menu</div>
            <a class="flex items-center gap-3 px-3 py-2 rounded-lg text-slate-600 hover:bg-slate-50 hover:text-primary transition-colors" href="<?= base_url('admin/dashboard') ?>">
                <span class="material-symbols-outlined">dashboard</span> <span class="text-sm font-medium">Dashboard</span>
            </a>
            <a class="flex items-center gap-3 px-3 py-2 rounded-lg text-slate-600 hover:bg-slate-50 hover:text-primary transition-colors" href="<?= base_url('admin/arsip/search') ?>">
                <span class="material-symbols-outlined">search</span> <span class="text-sm font-medium">Search Archives</span>
            </a>
            <a class="flex items-center gap-3 px-3 py-2 rounded-lg text-slate-600 hover:bg-slate-50 hover:text-primary transition-colors" href="<?= base_url('admin/arsip/create') ?>">
                <span class="material-symbols-outlined">input</span> <span class="text-sm font-medium">Data Entry</span>
            </a>
            <div class="mt-6 mb-2 px-3 text-xs font-semibold text-slate-400 uppercase tracking-wider">Administrative</div>
            <a class="flex items-center gap-3 px-3 py-2 rounded-lg text-slate-600 hover:bg-slate-50 hover:text-primary transition-colors" href="<?= base_url('admin/lemari') ?>">
                <span class="material-symbols-outlined">folder_managed</span> <span class="text-sm font-medium">Archive Manager</span>
            </a>
            <a class="flex items-center gap-3 px-3 py-2 rounded-lg bg-primary text-white font-medium shadow-md shadow-primary/20 transition-all group" href="<?= base_url('admin/user') ?>">
                <span class="material-symbols-outlined filled">people</span> <span class="text-sm">User Management</span>
            </a>
            <a class="flex items-center gap-3 px-3 py-2 rounded-lg text-slate-600 hover:bg-slate-50 hover:text-primary transition-colors" href="<?= base_url('admin/settings') ?>">
                <span class="material-symbols-outlined">settings_applications</span> <span class="text-sm font-medium">System Settings</span>
            </a>
        </nav>
    </aside>

    <main class="flex-1 flex flex-col overflow-y-auto bg-background-light p-8">
        <div class="max-w-6xl mx-auto w-full pb-12">
            
            <div class="mb-6">
                <a href="<?= base_url('admin/user') ?>" class="flex items-center gap-2 text-primary hover:text-primary/80 transition-colors font-bold text-sm w-fit">
                    <span class="material-symbols-outlined">arrow_back</span> Kembali ke Direktori Pegawai
                </a>
            </div>

            <div class="mb-8">
                <h2 class="text-3xl font-bold text-slate-900 mb-2">Edit Data Pegawai</h2>
                <p class="text-slate-500">Perbarui informasi pribadi, hak akses, atau status akun pegawai di sistem.</p>
            </div>

            <form action="<?= base_url('admin/user/update/' . ($user['id_user'] ?? '')) ?>" method="POST">
                <?= csrf_field() ?>
                
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    
                    <div class="lg:col-span-2 space-y-6">
                        
                        <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm">
                            <h3 class="text-lg font-bold text-slate-900 mb-6 flex items-center gap-2">
                                <span class="material-symbols-outlined text-primary">person</span> Personal Information
                            </h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="flex flex-col gap-2">
                                    <label class="text-sm font-bold text-slate-700">Nama Lengkap <span class="text-red-500">*</span></label>
                                    <input name="nama_lengkap" value="<?= esc($user['nama_lengkap'] ?? '') ?>" required class="bg-slate-50 border-slate-200 rounded-lg p-2.5 text-sm focus:ring-primary focus:border-primary" type="text"/>
                                </div>
                                
                                <div class="flex flex-col gap-2">
                                    <label class="text-sm font-bold text-slate-700">Email Address <span class="text-red-500">*</span></label>
                                    <input name="email" value="<?= esc($user['email'] ?? '') ?>" required class="bg-slate-50 border-slate-200 rounded-lg p-2.5 text-sm focus:ring-primary focus:border-primary" type="email"/>
                                </div>
                                
                                <div class="flex flex-col gap-2">
                                    <label class="text-sm font-bold text-slate-700">NIP (Username) <span class="text-red-500">*</span></label>
                                    <input name="username" value="<?= esc($user['username'] ?? '') ?>" required class="bg-slate-50 border-slate-200 rounded-lg p-2.5 text-sm focus:ring-primary focus:border-primary" type="text"/>
                                </div>
                                
                                <div class="flex flex-col gap-2">
                                    <label class="text-sm font-bold text-slate-700">Department / Unit</label>
                                    <input name="divisi" value="<?= esc($user['divisi'] ?? '') ?>" class="bg-slate-50 border-slate-200 rounded-lg p-2.5 text-sm focus:ring-primary focus:border-primary" placeholder="Cth: Tata Usaha" type="text"/>
                                </div>
                                
                                <div class="flex flex-col gap-2">
                                    <label class="text-sm font-bold text-slate-700">System Role <span class="text-red-500">*</span></label>
                                    <select name="role" required class="bg-slate-50 border-slate-200 rounded-lg p-2.5 text-sm focus:ring-primary focus:border-primary w-full">
                                        <option value="admin" <?= (isset($user['role']) && $user['role'] == 'admin') ? 'selected' : '' ?>>Administrator (Full Access)</option>
                                        <option value="staf" <?= (isset($user['role']) && $user['role'] == 'staf') ? 'selected' : '' ?>>Staff (Basic Access)</option>
                                        <option value="pimpinan" <?= (isset($user['role']) && $user['role'] == 'pimpinan') ? 'selected' : '' ?>>Pimpinan</option>
                                    </select>
                                </div>
                                
                                <div class="flex flex-col gap-2">
                                    <label class="text-sm font-bold text-slate-700">Status Akun <span class="text-red-500">*</span></label>
                                    <select name="status" required class="bg-slate-50 border-slate-200 rounded-lg p-2.5 text-sm focus:ring-primary focus:border-primary w-full">
                                        <option value="active" <?= (isset($user['status']) && $user['status'] == 'active') ? 'selected' : '' ?>>Active (Bisa Login)</option>
                                        <option value="suspended" <?= (isset($user['status']) && $user['status'] == 'suspended') ? 'selected' : '' ?>>Suspended (Diblokir)</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm">
                            <h3 class="text-lg font-bold text-slate-900 mb-6 flex items-center gap-2">
                                <span class="material-symbols-outlined text-amber-500">lock_reset</span> Ganti Password (Opsional)
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="flex flex-col gap-2">
                                    <label class="text-sm font-bold text-slate-700">Password Baru</label>
                                    <input name="password" minlength="6" class="bg-slate-50 border-slate-200 rounded-lg p-2.5 text-sm focus:ring-primary focus:border-primary" placeholder="••••••••" type="password"/>
                                    <span class="text-xs text-slate-500">Kosongkan kolom ini jika tidak ingin mengubah password pegawai.</span>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-end gap-4 py-4">
                            <a href="<?= base_url('admin/user') ?>" class="px-6 py-2.5 border border-slate-200 text-slate-700 font-bold rounded-lg hover:bg-slate-100 transition-colors">
                                Cancel
                            </a>
                            <button type="submit" class="px-8 py-2.5 bg-primary text-white font-bold rounded-lg hover:bg-primary/90 transition-all shadow-md flex items-center gap-2">
                                <span class="material-symbols-outlined text-[20px]">save</span> Update Pegawai
                            </button>
                        </div>
                    </div>

                    <div class="flex flex-col gap-6">
                        <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm">
                            <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wider mb-4">Informasi Akses</h3>
                            <div class="space-y-4">
                                <div class="flex items-start gap-3 p-3 bg-primary/5 rounded-lg border border-primary/10">
                                    <span class="material-symbols-outlined text-primary text-lg">verified_user</span>
                                    <div>
                                        <p class="text-xs font-bold text-primary">Hak Akses Pegawai</p>
                                        <ul class="text-[11px] text-slate-600 mt-1 list-disc list-inside space-y-1">
                                            <li>Role saat ini: <strong><?= strtoupper(esc($user['role'] ?? 'STAF')) ?></strong></li>
                                            <li>Status akun: <strong><?= strtoupper(esc($user['status'] ?? 'ACTIVE')) ?></strong></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="bg-amber-50 p-6 rounded-xl border border-amber-200">
                            <h3 class="text-sm font-bold text-amber-600 mb-2 flex items-center gap-1"><span class="material-symbols-outlined text-lg">info</span> Notice</h3>
                            <p class="text-xs text-slate-700 leading-relaxed">
                                Jika Anda mengubah <strong>NIP (Username)</strong> atau <strong>Password</strong>, pastikan untuk memberitahukan kepada pegawai yang bersangkutan karena data tersebut digunakan untuk masuk ke dalam sistem.
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