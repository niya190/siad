<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title><?= $title ?> - Admin SiArsip</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script>
        tailwind.config = { darkMode: "class", theme: { extend: { colors: { primary: "#0e4c92", "background-light": "#f8fafc", "surface-dark": "#1e293b" }, fontFamily: { display: ["Public Sans", "sans-serif"] } } } }
    </script>
</head>
<body class="bg-background-light font-display text-slate-900 antialiased h-screen flex flex-col overflow-hidden">

<header class="h-16 bg-white dark:bg-surface-dark border-b border-slate-200 dark:border-slate-800 flex items-center justify-between px-6 z-20 shadow-sm flex-shrink-0">
<div class="flex items-center gap-4">
<div class="flex items-center gap-3">
<div class="size-10 rounded-lg bg-primary flex items-center justify-center text-white shrink-0 shadow-lg shadow-blue-900/20">
<span class="material-symbols-outlined text-2xl">anchor</span>
</div>
<div class="flex flex-col">
<h1 class="text-slate-900 dark:text-white text-sm font-bold leading-tight">Distrik Navigasi</h1>
<p class="text-slate-500 dark:text-slate-400 text-xs font-medium">Tanjungpinang - Kelas I</p>
</div>
</div>
<div class="h-8 w-px bg-slate-200 dark:bg-slate-700 mx-2 hidden md:block"></div>

</div>
<div class="flex items-center gap-4">
<form action="<?= base_url('admin/arsip/search') ?>" method="GET" class="relative hidden sm:block">
    <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
        <span class="material-symbols-outlined text-slate-400 text-lg">search</span>
    </span>
    <input name="keyword" class="pl-9 pr-4 py-1.5 text-sm bg-slate-100 dark:bg-slate-800 border-none rounded-full w-64 focus:ring-2 focus:ring-primary/20 placeholder-slate-400 text-slate-700 dark:text-slate-200" placeholder="Global search..." type="text"/>
</form>
<a href="<?= base_url('admin/notifications') ?>" class="relative p-2 rounded-full text-slate-500 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors cursor-pointer">
    <span class="material-symbols-outlined">notifications</span>
    <span class="absolute top-2 right-2 w-2 h-2 bg-red-500 rounded-full border-2 border-white dark:border-surface-dark"></span>
</a>
<div class="flex items-center gap-3 pl-4 border-l border-slate-200 dark:border-slate-700">
            <div class="text-right hidden sm:block">
                <p class="text-sm font-semibold text-slate-900 dark:text-white leading-none"><?= esc(session()->get('nama_lengkap') ?? 'Administrator') ?></p>
                <span class="inline-flex items-center gap-1 mt-1 px-1.5 py-0.5 rounded text-[10px] font-bold bg-primary/10 text-primary dark:text-blue-300 uppercase tracking-wide">
                    <?= esc(session()->get('role') ?? 'Admin Role') ?>
                </span>
            </div>
            
            <?php 
                // Membuat inisial dari nama
                $namaAdmin = session()->get('nama_lengkap') ?? 'Admin';
                $partsAdmin = explode(' ', $namaAdmin);
                $initialsAdmin = strtoupper(substr($partsAdmin[0], 0, 1) . (isset($partsAdmin[1]) ? substr($partsAdmin[1], 0, 1) : ''));
            ?>
            <div class="flex size-9 items-center justify-center rounded-full bg-slate-200 dark:bg-slate-700 border-2 border-white dark:border-slate-600 shadow-sm text-slate-600 dark:text-slate-300 font-bold text-xs">
                <?= $initialsAdmin ?>
            </div>

            <a href="<?= base_url('login/logout') ?>" class="text-slate-400 hover:text-red-500 ml-1 transition-colors" title="Logout">
                <span class="material-symbols-outlined text-2xl">logout</span>
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
<span class="material-symbols-outlined text-slate-400 text-sm group-hover:text-primary transition-colors">expand_more</span>
</button>
</div>
<nav class="flex-1 overflow-y-auto py-4 px-3 space-y-1">
<div class="px-3 mb-2 text-xs font-semibold text-slate-400 uppercase tracking-wider">Main Menu</div>
<a class="flex items-center gap-3 px-3 py-2 rounded-lg text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800 hover:text-primary dark:hover:text-white transition-colors group" href="<?= base_url('admin/dashboard') ?>">
<span class="material-symbols-outlined group-hover:text-primary dark:group-hover:text-blue-400 transition-colors">dashboard</span>
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
<a class="flex items-center gap-3 px-3 py-2 rounded-lg bg-primary text-white font-medium shadow-md shadow-primary/20 transition-all group" href="<?= base_url('admin/lemari') ?>">
<span class="material-symbols-outlined filled">folder_managed</span>
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
<div class="p-4 border-t border-slate-200 dark:border-slate-800">
<div class="bg-blue-50 dark:bg-blue-900/20 rounded-lg p-3">
<div class="flex items-center gap-2 mb-2">
<span class="material-symbols-outlined text-primary dark:text-blue-400">cloud_sync</span>
<span class="text-xs font-bold text-primary dark:text-blue-400">System Status</span>
</div>
<div class="w-full bg-blue-200 dark:bg-blue-800 rounded-full h-1.5 mb-1">
<div class="bg-primary h-1.5 rounded-full" style="width: 98%"></div>
</div>
<p class="text-[10px] text-slate-500 dark:text-slate-400 text-right">Online (98%)</p>
</div>
</div>
</aside>
<div class="flex flex-1 overflow-hidden">
    <main class="flex-1 flex flex-col overflow-y-auto bg-background-light p-6 md:p-8">
        <div class="max-w-full mx-auto w-full">
            
            <div class="mb-6">
                <h2 class="text-2xl md:text-3xl font-bold text-slate-900 mb-2">Manajemen Lokasi Penyimpanan</h2>
                <p class="text-slate-500 text-sm">Kelola master hierarki penyimpanan fisik (Gedung ➡️ Ruangan ➡️ Lemari ➡️ Rak).</p>
            </div>

            <?php if(session()->getFlashdata('success')): ?>
                <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-xl flex items-center gap-2 font-bold text-sm">
                    <span class="material-symbols-outlined text-green-600">check_circle</span>
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>

            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4 lg:gap-6">
                
                <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden flex flex-col">
                    <div class="p-4 border-b border-slate-100 bg-slate-50 flex items-center gap-2">
                        <span class="material-symbols-outlined text-blue-600">domain</span>
                        <h3 class="font-bold text-slate-800">1. Data Gedung</h3>
                    </div>
                    <div class="p-4 border-b border-slate-100 bg-blue-50/30">
                        <form action="<?= base_url('admin/lemari/simpan-gedung') ?>" method="POST" class="flex gap-2">
                            <input type="text" name="nama_gedung" required placeholder="Nama Gedung Baru..." class="w-full rounded-lg border-slate-300 text-sm focus:ring-blue-600 focus:border-blue-600">
                            <button type="submit" class="bg-blue-600 text-white px-3 rounded-lg hover:bg-blue-700"><span class="material-symbols-outlined text-lg mt-1">add</span></button>
                        </form>
                    </div>
                    <div class="p-4 flex-1 overflow-y-auto max-h-[500px]">
                        <ul class="space-y-2">
                            <?php foreach($gedung as $g): ?>
                            <li class="p-3 bg-slate-50 rounded-lg border border-slate-100 flex justify-between items-center group hover:bg-blue-50 transition-colors">
                                <div>
                                    <p class="text-sm font-bold text-slate-800"><?= esc($g['nama_gedung']) ?></p>
                                    <p class="text-[10px] text-slate-500 bg-white border px-1 rounded w-fit mt-1">ID: <?= $g['id_gedung'] ?></p>
                                </div>
                                <div class="hidden group-hover:flex items-center gap-1">
                                    <button onclick="editData('gedung', <?= $g['id_gedung'] ?>, '<?= esc($g['nama_gedung']) ?>')" class="p-1 text-blue-500 hover:bg-blue-100 rounded" title="Edit"><span class="material-symbols-outlined text-[16px]">edit</span></button>
                                    <a href="<?= base_url('admin/lemari/hapus-gedung/'.$g['id_gedung']) ?>" onclick="return confirm('Hapus Gedung? Semua ruangan di dalamnya akan ikut terhapus!')" class="p-1 text-red-500 hover:bg-red-100 rounded"><span class="material-symbols-outlined text-[16px]">delete</span></a>
                                </div>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>

                <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden flex flex-col">
                    <div class="p-4 border-b border-slate-100 bg-slate-50 flex items-center gap-2">
                        <span class="material-symbols-outlined text-purple-600">meeting_room</span>
                        <h3 class="font-bold text-slate-800">2. Data Ruangan</h3>
                    </div>
                    <div class="p-4 border-b border-slate-100 bg-purple-50/30">
                        <form action="<?= base_url('admin/lemari/simpan-ruangan') ?>" method="POST" class="space-y-2">
                            <select name="id_gedung" required class="w-full rounded-lg border-slate-300 text-sm focus:ring-purple-600">
                                <option value="">-- Pilih Gedung Induk --</option>
                                <?php foreach($gedung as $g): ?>
                                    <option value="<?= $g['id_gedung'] ?>"><?= esc($g['nama_gedung']) ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="flex gap-2">
                                <input type="text" name="nama_ruangan" required placeholder="Nama Ruangan..." class="w-full rounded-lg border-slate-300 text-sm focus:ring-purple-600">
                                <button type="submit" class="bg-purple-600 text-white px-3 rounded-lg hover:bg-purple-700"><span class="material-symbols-outlined text-lg mt-1">add</span></button>
                            </div>
                        </form>
                    </div>
                    <div class="p-4 flex-1 overflow-y-auto max-h-[500px]">
                        <ul class="space-y-2">
                            <?php foreach($ruangan as $r): ?>
                            <li class="p-3 bg-slate-50 rounded-lg border border-slate-100 flex justify-between items-center group hover:bg-purple-50 transition-colors">
                                <div>
                                    <p class="text-sm font-bold text-slate-800"><?= esc($r['nama_ruangan']) ?></p>
                                    <p class="text-[10px] text-slate-500 mt-1">Gedung: <?= esc($r['nama_gedung'] ?? '-') ?></p>
                                </div>
                                <div class="hidden group-hover:flex items-center gap-1">
                                    <button onclick="editData('ruangan', <?= $r['id_ruangan'] ?>, '<?= esc($r['nama_ruangan']) ?>')" class="p-1 text-purple-500 hover:bg-purple-100 rounded" title="Edit"><span class="material-symbols-outlined text-[16px]">edit</span></button>
                                    <a href="<?= base_url('admin/lemari/hapus-ruangan/'.$r['id_ruangan']) ?>" onclick="return confirm('Hapus Ruangan ini?')" class="p-1 text-red-500 hover:bg-red-100 rounded"><span class="material-symbols-outlined text-[16px]">delete</span></a>
                                </div>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>

                <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden flex flex-col">
                    <div class="p-4 border-b border-slate-100 bg-slate-50 flex items-center gap-2">
                        <span class="material-symbols-outlined text-orange-500">shelves</span>
                        <h3 class="font-bold text-slate-800">3. Data Lemari</h3>
                    </div>
                    <div class="p-4 border-b border-slate-100 bg-orange-50/30">
                        <form action="<?= base_url('admin/lemari/simpan-lemari') ?>" method="POST" class="space-y-2">
                            <select name="id_ruangan" required class="w-full rounded-lg border-slate-300 text-sm focus:ring-orange-500">
                                <option value="">-- Pilih Ruangan --</option>
                                <?php foreach($ruangan as $r): ?>
                                    <option value="<?= $r['id_ruangan'] ?>"><?= esc($r['nama_ruangan']) ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="flex gap-2">
                                <input type="text" name="nama_lemari" required placeholder="Nama Lemari..." class="w-full rounded-lg border-slate-300 text-sm focus:ring-orange-500">
                                <button type="submit" class="bg-orange-500 text-white px-3 rounded-lg hover:bg-orange-600"><span class="material-symbols-outlined text-lg mt-1">add</span></button>
                            </div>
                        </form>
                    </div>
                    <div class="p-4 flex-1 overflow-y-auto max-h-[500px]">
                        <ul class="space-y-2">
                            <?php foreach($lemari as $l): ?>
                            <li class="p-3 bg-slate-50 rounded-lg border border-slate-100 flex justify-between items-center group hover:bg-orange-50 transition-colors">
                                <div>
                                    <p class="text-sm font-bold text-slate-800"><?= esc($l['nama_lemari']) ?></p>
                                    <p class="text-[10px] text-slate-500 mt-1">Ruang: <?= esc($l['nama_ruangan'] ?? '-') ?></p>
                                </div>
                                <div class="hidden group-hover:flex items-center gap-1">
                                    <button onclick="editData('lemari', <?= $l['id_lemari'] ?>, '<?= esc($l['nama_lemari']) ?>')" class="p-1 text-orange-500 hover:bg-orange-100 rounded" title="Edit"><span class="material-symbols-outlined text-[16px]">edit</span></button>
                                    <a href="<?= base_url('admin/lemari/hapus-lemari/'.$l['id_lemari']) ?>" onclick="return confirm('Hapus Lemari?')" class="p-1 text-red-500 hover:bg-red-100 rounded"><span class="material-symbols-outlined text-[16px]">delete</span></a>
                                </div>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>

                <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden flex flex-col">
                    <div class="p-4 border-b border-slate-100 bg-slate-50 flex items-center gap-2">
                        <span class="material-symbols-outlined text-green-600">layers</span>
                        <h3 class="font-bold text-slate-800">4. Data Rak / Box</h3>
                    </div>
                    <div class="p-4 border-b border-slate-100 bg-green-50/30">
                        <form action="<?= base_url('admin/lemari/simpan-rak') ?>" method="POST" class="space-y-2">
                            <select name="id_lemari" required class="w-full rounded-lg border-slate-300 text-sm focus:ring-green-600">
                                <option value="">-- Pilih Lemari --</option>
                                <?php foreach($lemari as $l): ?>
                                    <option value="<?= $l['id_lemari'] ?>"><?= esc($l['nama_lemari']) ?> (R.<?= $l['id_ruangan'] ?>)</option>
                                <?php endforeach; ?>
                            </select>
                            <div class="flex gap-2">
                                <input type="text" name="nama_rak" required placeholder="Nama Rak / Baris..." class="w-full rounded-lg border-slate-300 text-sm focus:ring-green-600">
                                <button type="submit" class="bg-green-600 text-white px-3 rounded-lg hover:bg-green-700"><span class="material-symbols-outlined text-lg mt-1">add</span></button>
                            </div>
                        </form>
                    </div>
                    <div class="p-4 flex-1 overflow-y-auto max-h-[500px]">
                        <ul class="space-y-2">
                            <?php foreach($rak as $rk): ?>
                            <li class="p-3 bg-slate-50 rounded-lg border border-slate-100 flex justify-between items-center group hover:bg-green-50 transition-colors">
                                <div>
                                    <p class="text-sm font-bold text-slate-800"><?= esc($rk['nama_rak']) ?></p>
                                    <p class="text-[10px] text-slate-500 mt-1">Lemari: <?= esc($rk['nama_lemari'] ?? '-') ?></p>
                                </div>
                                <div class="hidden group-hover:flex items-center gap-1">
                                    <button onclick="editData('rak', <?= $rk['id_rak'] ?>, '<?= esc($rk['nama_rak']) ?>')" class="p-1 text-green-600 hover:bg-green-100 rounded" title="Edit"><span class="material-symbols-outlined text-[16px]">edit</span></button>
                                    <a href="<?= base_url('admin/lemari/hapus-rak/'.$rk['id_rak']) ?>" onclick="return confirm('Hapus Rak ini?')" class="p-1 text-red-500 hover:bg-red-100 rounded"><span class="material-symbols-outlined text-[16px]">delete</span></a>
                                </div>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </main>
</div>

<form id="formEdit" method="POST" action="" class="hidden">
    <input type="hidden" name="nama_baru" id="inputNamaBaru">
</form>

<script>
    // FUNGSI PINTAR UNTUK MENGEDIT NAMA (BISA UNTUK SEMUA LEVEL)
    function editData(jenis, id, namaLama) {
        let namaBaru = prompt("Ubah nama " + jenis + " ini:", namaLama);
        
        if (namaBaru != null && namaBaru.trim() !== "" && namaBaru !== namaLama) {
            let form = document.getElementById('formEdit');
            let inputNama = document.getElementById('inputNamaBaru');
            
            inputNama.value = namaBaru;
            form.action = "<?= base_url('admin/lemari/update-') ?>" + jenis + "/" + id;
            form.submit();
        }
    }
</script>

</body>
</html>