<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Archive Entry Form - Distrik Navigasi Tanjungpinang</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        primary: "#0e4c92", 
                        secondary: "#fbb03b", 
                        "background-light": "#f8fafc",
                        "background-dark": "#0f172a",
                        "surface-light": "#ffffff",
                        "surface-dark": "#1e293b",
                        "sidebar-bg": "#ffffff",
                        "sidebar-active": "#eff6ff",
                    },
                    fontFamily: {
                        display: ["Public Sans", "sans-serif"],
                    }
                },
            },
        }
    </script>
    <style>
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 3px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
        .file-drop-area { border: 2px dashed #cbd5e1; transition: all 0.2s; }
        .file-drop-area:hover { border-color: #0e4c92; background-color: #f8fafc; }
    </style>
</head>
<body class="bg-background-light dark:bg-background-dark font-display text-slate-900 dark:text-slate-100 antialiased h-screen flex flex-col overflow-hidden">

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
    </div>
    <div class="flex items-center gap-4">
        <div class="flex items-center gap-3 pl-4 border-l border-slate-200 dark:border-slate-700">
            <div class="text-right hidden sm:block">
                <p class="text-sm font-semibold text-slate-900 dark:text-white leading-none"><?= esc(session()->get('nama_lengkap') ?? 'Administrator') ?></p>
                <span class="inline-flex items-center gap-1 mt-1 px-1.5 py-0.5 rounded text-[10px] font-bold bg-primary/10 text-primary dark:text-blue-300 uppercase tracking-wide">
                    <?= esc(session()->get('role') ?? 'Admin Role') ?>
                </span>
            </div>
            
            <?php 
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
            </button>
        </div>
        <nav class="flex-1 overflow-y-auto py-4 px-3 space-y-1">
            <div class="px-3 mb-2 text-xs font-semibold text-slate-400 uppercase tracking-wider">Main Menu</div>
            
            <a class="flex items-center gap-3 px-3 py-2 rounded-lg text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800 hover:text-primary dark:hover:text-white transition-colors group" href="<?= base_url('admin/dashboard') ?>">
                <span class="material-symbols-outlined group-hover:text-primary transition-colors">dashboard</span>
                <span class="text-sm font-medium">Dashboard</span>
            </a>
            
            <a class="flex items-center gap-3 px-3 py-2 rounded-lg text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800 hover:text-primary dark:hover:text-white transition-colors group" href="<?= base_url('admin/arsip/search') ?>">
                <span class="material-symbols-outlined group-hover:text-primary transition-colors">search</span>
                <span class="text-sm font-medium">Search Archives</span>
            </a>
            
            <a class="flex items-center gap-3 px-3 py-2 rounded-lg bg-primary text-white font-medium shadow-md shadow-primary/20 transition-all group" href="<?= base_url('admin/arsip/create') ?>">
                <span class="material-symbols-outlined filled">input</span>
                <span class="text-sm">Data Entry</span>
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
            
            <a class="flex items-center gap-3 px-3 py-2 rounded-lg text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800 hover:text-primary dark:hover:text-white transition-colors group" href="#">
                <span class="material-symbols-outlined group-hover:text-primary dark:group-hover:text-blue-400 transition-colors">settings_applications</span>
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

    <main class="flex-1 flex flex-col overflow-hidden bg-slate-50/50 dark:bg-background-dark relative">
        <div class="flex-1 overflow-y-auto p-6 lg:p-8 scroll-smooth">
            
            <form action="<?= base_url('admin/arsip/save') ?>" method="POST" enctype="multipart/form-data" class="max-w-5xl mx-auto space-y-6">
                <?= csrf_field() ?>

                <div class="flex justify-between items-end pb-2">
                    <div>
                        <nav class="flex text-sm text-slate-500 dark:text-slate-400 mb-1">
                            <a class="hover:text-primary" href="<?= base_url('admin/dashboard') ?>">Home</a>
                            <span class="mx-2">/</span>
                            <a class="hover:text-primary" href="<?= base_url('admin/arsip/search') ?>">Archives</a>
                            <span class="mx-2">/</span>
                            <span class="text-slate-800 dark:text-white font-medium">New Record</span>
                        </nav>
                        <h2 class="text-2xl font-bold text-slate-900 dark:text-white">Add New Archive</h2>
                        <p class="text-sm text-slate-500 mt-1">Register physical and digital documents into the centralized system.</p>
                    </div>
                    <div class="flex gap-3">
                        <a href="<?= base_url('admin/arsip/search') ?>" class="flex items-center gap-2 px-4 py-2 bg-white dark:bg-surface-dark border border-slate-200 dark:border-slate-700 rounded-lg text-sm font-medium text-slate-700 dark:text-slate-200 hover:bg-slate-50 dark:hover:bg-slate-800 shadow-sm transition-all">
                            <span class="material-symbols-outlined text-lg">close</span> Cancel
                        </a>
                        <button type="submit" class="flex items-center gap-2 bg-primary hover:bg-blue-700 text-white px-6 py-2 rounded-lg shadow-md shadow-blue-500/20 transition-all font-medium text-sm">
                            <span class="material-symbols-outlined text-lg">save</span> Save Record
                        </button>
                    </div>
                </div>

                <div class="grid grid-cols-12 gap-6">
                    <div class="col-span-12 lg:col-span-8 space-y-6">
                        
                        <div class="bg-white dark:bg-surface-dark rounded-xl border border-slate-200 dark:border-slate-700 shadow-soft overflow-hidden">
                            <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-700 bg-slate-50/50 dark:bg-slate-800/30 flex items-center justify-between">
                                <h3 class="font-bold text-slate-900 dark:text-white flex items-center gap-2">
                                    <span class="material-symbols-outlined text-primary">description</span> Document Details
                                </h3>
                                <span class="text-xs font-medium bg-blue-100 text-blue-700 px-2 py-1 rounded border border-blue-200">Kemenhub Standards</span>
                            </div>
                            <div class="p-6 space-y-6">
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    <div>
                                        <label class="block text-xs font-semibold text-slate-600 dark:text-slate-300 mb-1.5 uppercase tracking-wide">
                                            Classification Code <span class="text-red-500">*</span>
                                        </label>
                                        <select name="id_klasifikasi" id="id_klasifikasi" class="w-full bg-slate-50 dark:bg-slate-800 border border-slate-300 dark:border-slate-600 rounded-lg px-3 py-2 text-sm focus:ring-primary focus:border-primary" required>
                                            <option value="">Select Code...</option>
                                            <?php foreach($klasifikasi as $k): ?>
                                                <option value="<?= $k['id_klasifikasi'] ?>" data-kode="<?= $k['kode_klasifikasi'] ?>">
                                                    <?= $k['kode_klasifikasi'] ?> - <?= $k['nama_klasifikasi'] ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                        <input type="hidden" name="kode_klasifikasi_text" id="kode_klasifikasi_text">
                                        <p class="text-[10px] text-slate-500 mt-1">Kode Klasifikasi Arsip (KKA)</p>
                                    </div>
                                    <div>
                                        <label class="block text-xs font-semibold text-slate-600 dark:text-slate-300 mb-1.5 uppercase tracking-wide">
                                            Sequence No. <span class="text-red-500">*</span>
                                        </label>
                                        <input name="no_urut" class="w-full bg-slate-50 dark:bg-slate-800 border border-slate-300 dark:border-slate-600 rounded-lg px-3 py-2 text-sm focus:ring-primary focus:border-primary placeholder-slate-400" placeholder="e.g. 0045" type="text" required/>
                                        <p class="text-[10px] text-slate-500 mt-1">Nomor Urut Surat</p>
                                    </div>
                                    <div>
                                        <label class="block text-xs font-semibold text-slate-600 dark:text-slate-300 mb-1.5 uppercase tracking-wide">
                                            Year <span class="text-red-500">*</span>
                                        </label>
                                        <select name="tahun" class="w-full bg-slate-50 dark:bg-slate-800 border border-slate-300 dark:border-slate-600 rounded-lg px-3 py-2 text-sm focus:ring-primary focus:border-primary" required>
                                            <option value="<?= date('Y') ?>"><?= date('Y') ?></option>
                                            <option value="<?= date('Y')-1 ?>"><?= date('Y')-1 ?></option>
                                            <option value="<?= date('Y')-2 ?>"><?= date('Y')-2 ?></option>
                                        </select>
                                        <p class="text-[10px] text-slate-500 mt-1">Tahun Arsip</p>
                                    </div>
                                </div>
                                <div class="h-px bg-slate-100 dark:bg-slate-700"></div>
                                <div>
                                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-200 mb-1.5">
                                        Reference / Subject (Perihal) <span class="text-red-500">*</span>
                                    </label>
                                    <textarea name="perihal" class="w-full bg-white dark:bg-slate-800 border border-slate-300 dark:border-slate-600 rounded-lg px-3 py-2 text-sm focus:ring-primary focus:border-primary placeholder-slate-400 resize-none h-24" placeholder="Enter the full subject or description of the document..." required></textarea>
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-semibold text-slate-700 dark:text-slate-200 mb-1.5">Document Type <span class="text-red-500">*</span></label>
                                        <select name="jenis_arsip" class="w-full bg-white dark:bg-slate-800 border border-slate-300 dark:border-slate-600 rounded-lg px-3 py-2 text-sm focus:ring-primary focus:border-primary" required>
                                            <option value="Surat Masuk">Surat Masuk</option>
                                            <option value="Surat Keluar">Surat Keluar</option>
                                            <option value="Nota Dinas">Nota Dinas</option>
                                            <option value="SK (Keputusan)">SK (Keputusan)</option>
                                            <option value="Berkas Proyek">Berkas Proyek</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-semibold text-slate-700 dark:text-slate-200 mb-1.5">Date of Document <span class="text-red-500">*</span></label>
                                        <input name="tanggal_surat" class="w-full bg-white dark:bg-slate-800 border border-slate-300 dark:border-slate-600 rounded-lg px-3 py-2 text-sm focus:ring-primary focus:border-primary" type="date" required/>
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-200 mb-1.5">
                                        Sender / Recipient (Pengirim/Tujuan) <span class="text-red-500">*</span>
                                    </label>
                                    <input name="pengirim_tujuan" class="w-full bg-white dark:bg-slate-800 border border-slate-300 dark:border-slate-600 rounded-lg px-3 py-2 text-sm focus:ring-primary focus:border-primary" placeholder="e.g. Ditjen Hubla / Bagian Keuangan" type="text" required/>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white dark:bg-surface-dark rounded-xl border border-slate-200 dark:border-slate-700 shadow-soft overflow-hidden">
                            <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-700 bg-slate-50/50 dark:bg-slate-800/30 flex items-center justify-between">
                                <h3 class="font-bold text-slate-900 dark:text-white flex items-center gap-2">
                                    <span class="material-symbols-outlined text-primary">upload_file</span> Digital Copy
                                </h3>
                            </div>
                            <div class="p-6">
                                <div onclick="document.getElementById('file_scan').click()" class="file-drop-area rounded-xl p-8 flex flex-col items-center justify-center text-center cursor-pointer bg-slate-50 dark:bg-slate-800/50 border-slate-300 dark:border-slate-600">
                                    <div class="size-12 rounded-full bg-blue-100 dark:bg-blue-900/40 flex items-center justify-center text-primary dark:text-blue-400 mb-3">
                                        <span class="material-symbols-outlined text-2xl">cloud_upload</span>
                                    </div>
                                    <p class="text-sm font-medium text-slate-700 dark:text-slate-200">
                                        <span class="text-primary hover:underline">Click to upload</span> or drag and drop
                                    </p>
                                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">PDF, JPG, or PNG (Max. 10MB)</p>
                                    <input name="file_scan" id="file_scan" class="hidden" type="file" accept=".pdf,.jpg,.jpeg,.png"/>
                                </div>
                                <div id="file_preview" class="mt-4 flex items-center p-3 bg-blue-50 dark:bg-blue-900/20 rounded-lg border border-blue-100 dark:border-blue-800/50 hidden">
                                    <span class="material-symbols-outlined text-primary mr-3">picture_as_pdf</span>
                                    <div class="flex-1 min-w-0">
                                        <p id="file_name" class="text-sm font-medium text-slate-900 dark:text-white truncate">Filename.pdf</p>
                                        <p class="text-xs text-slate-500">Selected for upload</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-span-12 lg:col-span-4 space-y-6">
                        <div class="bg-white dark:bg-surface-dark rounded-xl border border-slate-200 dark:border-slate-700 shadow-soft overflow-hidden sticky top-6">
                            <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-700 bg-slate-50/50 dark:bg-slate-800/30">
                                <h3 class="font-bold text-slate-900 dark:text-white flex items-center gap-2">
                                    <span class="material-symbols-outlined text-secondary">location_on</span> Physical Mapping
                                </h3>
                                <p class="text-xs text-slate-500 mt-1">Locate where the physical hardcopy is stored.</p>
                            </div>
                            <div class="p-6 space-y-5">
                                <div>
                                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-200 mb-1.5">
                                        Room (Ruangan) <span class="text-red-500">*</span>
                                    </label>
                                    <select id="id_ruangan" class="w-full bg-white dark:bg-slate-800 border border-slate-300 dark:border-slate-600 rounded-lg px-3 py-2.5 text-sm focus:ring-primary focus:border-primary" required>
                                        <option value="">-- Pilih Ruangan --</option>
                                        <?php if(isset($ruangan)): foreach($ruangan as $r): ?>
                                            <option value="<?= $r['id_ruangan'] ?>"><?= $r['nama_ruangan'] ?></option>
                                        <?php endforeach; endif; ?>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-200 mb-1.5">
                                        Cabinet Number (Lemari) <span class="text-red-500">*</span>
                                    </label>
                                    <select id="id_lemari" class="w-full bg-white dark:bg-slate-800 border border-slate-300 dark:border-slate-600 rounded-lg px-3 py-2.5 text-sm focus:ring-primary focus:border-primary" disabled required>
                                        <option value="">-- Pilih Ruangan Dulu --</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-200 mb-1.5">
                                        Shelf / Box (Rak) <span class="text-red-500">*</span>
                                    </label>
                                    <select name="id_rak" id="id_rak" class="w-full bg-white dark:bg-slate-800 border border-slate-300 dark:border-slate-600 rounded-lg px-3 py-2.5 text-sm focus:ring-primary focus:border-primary" disabled required>
                                        <option value="">-- Pilih Lemari Dulu --</option>
                                    </select>
                                </div>
                                <div class="pt-4 border-t border-slate-100 dark:border-slate-700">
                                    <div class="flex items-start gap-3 p-3 bg-amber-50 dark:bg-amber-900/20 border border-amber-100 dark:border-amber-800/30 rounded-lg">
                                        <span class="material-symbols-outlined text-amber-500 shrink-0 mt-0.5">info</span>
                                        <div class="text-xs text-amber-800 dark:text-amber-200">
                                            <p class="font-medium mb-0.5">Verification Required</p>
                                            Ensure physical location is correct before saving. Rak (Shelf) determines the final record location.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </main>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    // 1. File Upload Preview
    $('#file_scan').change(function() {
        var fileName = $(this).val().split('\\').pop();
        if(fileName) {
            $('#file_name').text(fileName);
            $('#file_preview').removeClass('hidden');
        } else {
            $('#file_preview').addClass('hidden');
        }
    });

    // 2. Set Hidden KKA Code
    $('#id_klasifikasi').change(function() {
        var kode = $(this).find(':selected').data('kode');
        $('#kode_klasifikasi_text').val(kode);
    });

    // 3. AJAX Ruangan -> Lemari
    $('#id_ruangan').change(function(){
        var id_ruangan = $(this).val();
        if(id_ruangan != '') {
            $.ajax({
                url: "<?= base_url('admin/arsip/getLemari') ?>",
                method: "POST",
                data: {id_ruangan: id_ruangan},
                dataType: "json",
                success: function(data) {
                    $('#id_lemari').html('<option value="">-- Pilih Lemari --</option>');
                    $.each(data, function(key, value){
                        $('#id_lemari').append('<option value="'+value.id_lemari+'">'+value.nama_lemari+'</option>');
                    });
                    $('#id_lemari').prop('disabled', false); 
                    $('#id_rak').html('<option value="">-- Pilih Lemari Dulu --</option>').prop('disabled', true);
                }
            });
        } else {
            $('#id_lemari').prop('disabled', true).html('<option value="">-- Pilih Ruangan Dulu --</option>');
            $('#id_rak').prop('disabled', true).html('<option value="">-- Pilih Lemari Dulu --</option>');
        }
    });

    // 4. AJAX Lemari -> Rak
    $('#id_lemari').change(function(){
        var id_lemari = $(this).val();
        if(id_lemari != '') {
            $.ajax({
                url: "<?= base_url('admin/arsip/getRak') ?>",
                method: "POST",
                data: {id_lemari: id_lemari},
                dataType: "json",
                success: function(data) {
                    $('#id_rak').html('<option value="">-- Pilih Rak / Box --</option>');
                    $.each(data, function(key, value){
                        $('#id_rak').append('<option value="'+value.id_rak+'">'+value.nama_rak+'</option>');
                    });
                    $('#id_rak').prop('disabled', false);
                }
            });
        } else {
            $('#id_rak').prop('disabled', true).html('<option value="">-- Pilih Lemari Dulu --</option>');
        }
    });
});
</script>

</body>
</html>