<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Archive Entry Form - Distrik Navigasi Tanjungpinang</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    
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
        body { font-family: 'Public Sans', sans-serif; }
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
            <div class="size-10 rounded-lg bg-white flex items-center justify-center shrink-0 shadow-lg overflow-hidden">
                <img src="<?= base_url('assets/img/logo.JPEG') ?>" alt="Logo Distrik Navigasi" class="h-8 w-auto object-contain">
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

            <a href="<?= base_url('login/logout') ?>" class="text-slate-400 hover:text-red-500 ml-1 transition-colors" title="Logout">
                <span class="material-symbols-outlined text-2xl">logout</span>
            </a>
        </div>
    </div>
</header>

<div class="flex flex-1 overflow-hidden">
    <aside class="w-64 bg-sidebar-bg dark:bg-surface-dark border-r border-slate-200 dark:border-slate-800 flex flex-col flex-shrink-0 z-10 hidden md:flex">
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
            <a class="flex items-center gap-3 px-3 py-2 rounded-lg text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800 hover:text-primary dark:hover:text-white transition-colors group" href="<?= base_url('admin/settings') ?>">  
                <span class="material-symbols-outlined group-hover:text-primary dark:group-hover:text-blue-400 transition-colors">settings_applications</span>
                <span class="text-sm font-medium">System Settings</span>
            </a>
        </nav>
    </aside>

    <main class="flex-1 flex flex-col overflow-hidden bg-slate-50/50 dark:bg-background-dark relative">
        <div class="flex-1 overflow-y-auto p-6 lg:p-8 scroll-smooth">
            <form action="<?= base_url('admin/arsip/save') ?>" method="POST" enctype="multipart/form-data" class="max-w-5xl mx-auto space-y-6">
                <?= csrf_field() ?>

                <div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-4 pb-4 border-b border-slate-200 dark:border-slate-700">
                    <div>
                        <h2 class="text-2xl font-bold text-slate-900 dark:text-white">Add New Archive</h2>
                        <p class="text-sm text-slate-500 mt-1">Register physical and digital documents into the centralized system.</p>
                    </div>
                    <div class="flex gap-3">
                        <a href="<?= base_url('admin/arsip/search') ?>" class="flex items-center gap-2 px-4 py-2 bg-white dark:bg-surface-dark border border-slate-200 dark:border-slate-700 rounded-lg text-sm font-medium text-slate-700 dark:text-slate-200 hover:bg-slate-50 shadow-sm transition-all">
                            <span class="material-symbols-outlined text-lg">close</span> Cancel
                        </a>
                        <button type="submit" class="flex items-center gap-2 bg-primary hover:bg-blue-700 text-white px-6 py-2 rounded-lg shadow-md transition-all font-medium text-sm">
                            <span class="material-symbols-outlined text-lg">save</span> Save Record
                        </button>
                    </div>
                </div>

                <div class="grid grid-cols-12 gap-6">
                    <div class="col-span-12 lg:col-span-8 space-y-6">
                        <div class="bg-white dark:bg-surface-dark rounded-xl border border-slate-200 dark:border-slate-700 shadow-sm overflow-hidden">
                            <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-700 bg-slate-50/50 dark:bg-slate-800/30 flex items-center justify-between">
                                <h3 class="font-bold text-slate-900 dark:text-white flex items-center gap-2">
                                    <span class="material-symbols-outlined text-primary">description</span> Document Details
                                </h3>
                            </div>
                            <div class="p-6 space-y-6">
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    
                                    <div id="wrap_klasifikasi">
                                        <label class="block text-xs font-semibold text-slate-600 dark:text-slate-300 mb-1.5 uppercase tracking-wide">
                                            Classification Code <span class="text-red-500">*</span>
                                        </label>
                                        <select name="id_klasifikasi" id="id_klasifikasi" class="w-full bg-slate-50 dark:bg-slate-800 border border-slate-300 dark:border-slate-600 rounded-lg px-3 py-2 text-sm focus:ring-primary focus:border-primary" required>
                                            <option value="">Select Code...</option>
                                            <?php if(isset($klasifikasi)): foreach($klasifikasi as $k): ?>
                                                <option value="<?= $k['id_klasifikasi'] ?>" data-kode="<?= $k['kode_klasifikasi'] ?>">
                                                    <?= $k['kode_klasifikasi'] ?> - <?= $k['nama_klasifikasi'] ?>
                                                </option>
                                            <?php endforeach; endif; ?>
                                        </select>
                                        <input type="hidden" name="kode_klasifikasi_text" id="kode_klasifikasi_text">
                                        <p class="text-[10px] text-slate-500 mt-1">Kode Klasifikasi Arsip (KKA)</p>
                                    </div>

                                    <div id="wrap_bidang" class="hidden">
                                        <label class="block text-xs font-semibold text-slate-600 dark:text-slate-300 mb-1.5 uppercase tracking-wide">
                                            Kode Bidang <span class="text-red-500">*</span>
                                        </label>
                                        <input type="text" name="kode_bidang" id="kode_bidang" class="w-full bg-slate-50 dark:bg-slate-800 border border-slate-300 dark:border-slate-600 rounded-lg px-3 py-2 text-sm focus:ring-primary focus:border-primary placeholder-slate-400 uppercase" placeholder="e.g. SDMH, KU-PL" />
                                        <p class="text-[10px] text-slate-500 mt-1">Khusus Nota Dinas</p>
                                    </div>

                                    <div>
                                        <label class="block text-xs font-semibold text-slate-600 dark:text-slate-300 mb-1.5 uppercase tracking-wide">
                                            Sequence No. <span class="text-red-500">*</span>
                                        </label>
                                        <input name="no_urut" id="no_urut" class="w-full bg-slate-50 dark:bg-slate-800 border border-slate-300 dark:border-slate-600 rounded-lg px-3 py-2 text-sm focus:ring-primary focus:border-primary placeholder-slate-400" placeholder="e.g. 0045" type="text" required/>
                                        <p class="text-[10px] text-slate-500 mt-1">Nomor Urut Surat</p>
                                    </div>
                                    <div>
                                        <label class="block text-xs font-semibold text-slate-600 dark:text-slate-300 mb-1.5 uppercase tracking-wide">
                                            Year <span class="text-red-500">*</span>
                                        </label>
                                        <select name="tahun" id="tahun" class="w-full bg-slate-50 dark:bg-slate-800 border border-slate-300 dark:border-slate-600 rounded-lg px-3 py-2 text-sm focus:ring-primary focus:border-primary" required>
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
                                    <textarea name="perihal" class="w-full bg-white dark:bg-slate-800 border border-slate-300 dark:border-slate-600 rounded-lg px-3 py-2 text-sm focus:ring-primary focus:border-primary placeholder-slate-400 resize-none h-24" placeholder="Enter the full subject or description..." required></textarea>
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-semibold text-slate-700 dark:text-slate-200 mb-1.5">Document Type <span class="text-red-500">*</span></label>
                                        <select name="jenis_arsip" id="jenis_arsip" class="w-full bg-white dark:bg-slate-800 border border-slate-300 dark:border-slate-600 rounded-lg px-3 py-2 text-sm focus:ring-primary focus:border-primary" required>
                                            <option value="Surat Masuk">Surat Masuk</option>
                                            <option value="Surat Keluar">Surat Keluar</option>
                                            <option value="Nota Dinas">Nota Dinas</option>
                                            <option value="SK (Keputusan)">SK (Keputusan)</option>
                                            <option value="Berkas Proyek">Berkas Proyek</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-semibold text-slate-700 dark:text-slate-200 mb-1.5">Date of Document <span class="text-red-500">*</span></label>
                                        <input name="tanggal_surat" id="tanggal_surat" class="w-full bg-white dark:bg-slate-800 border border-slate-300 dark:border-slate-600 rounded-lg px-3 py-2 text-sm focus:ring-primary focus:border-primary" type="date" required/>
                                    </div>

                                    
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-200 mb-1.5">
                                        Sender / Recipient (Pengirim/Tujuan) <span class="text-red-500">*</span>
                                    </label>
                                    <input name="pengirim_tujuan" class="w-full bg-white dark:bg-slate-800 border border-slate-300 dark:border-slate-600 rounded-lg px-3 py-2 text-sm focus:ring-primary focus:border-primary" type="text" required/>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white dark:bg-surface-dark rounded-xl border border-slate-200 dark:border-slate-700 shadow-sm overflow-hidden">
                            <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-700 bg-slate-50/50 dark:bg-slate-800/30">
                                <h3 class="font-bold text-slate-900 dark:text-white flex items-center gap-2">
                                    <span class="material-symbols-outlined text-primary">upload_file</span> Digital Copy
                                </h3>
                            </div>
                            <div class="p-6">
                                <div onclick="document.getElementById('file_scan').click()" class="file-drop-area rounded-xl p-8 flex flex-col items-center justify-center text-center cursor-pointer bg-slate-50 dark:bg-slate-800/50 border-slate-300 dark:border-slate-600">
                                    <div class="size-12 rounded-full bg-blue-100 flex items-center justify-center text-primary mb-3">
                                        <span class="material-symbols-outlined text-2xl">cloud_upload</span>
                                    </div>
                                    <p class="text-sm font-medium text-slate-700 dark:text-slate-200">Click to upload or drag and drop</p>
                                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">PDF, JPG, or PNG</p>
                                    <input name="file_scan" id="file_scan" class="hidden" type="file" accept=".pdf,.jpg,.jpeg,.png"/>
                                </div>
                                <div id="file_preview" class="mt-4 flex items-center p-3 bg-blue-50 rounded-lg hidden">
                                    <span class="material-symbols-outlined text-primary mr-3">picture_as_pdf</span>
                                    <p id="file_name" class="text-sm font-medium text-slate-900 truncate">Filename.pdf</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-span-12 lg:col-span-4 space-y-6">
                        <div class="bg-white dark:bg-surface-dark rounded-xl border border-slate-200 dark:border-slate-700 shadow-sm overflow-hidden sticky top-6">
                            <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-700 bg-slate-50/50 dark:bg-slate-800/30">
                                <h3 class="font-bold text-slate-900 dark:text-white flex items-center gap-2">
                                    <span class="material-symbols-outlined text-secondary">location_on</span> Physical Mapping
                                </h3>
                            </div>
                            <div class="p-6 space-y-5">
                                
                                <div>
                                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-200 mb-1.5">
                                        Building (Gedung) <span class="text-red-500">*</span>
                                    </label>
                                    <select id="id_gedung" name="id_gedung" class="w-full bg-white dark:bg-slate-800 border border-slate-300 dark:border-slate-600 rounded-lg px-3 py-2.5 text-sm focus:ring-primary focus:border-primary" required>
                                        <option value="">-- Pilih Gedung --</option>
                                        <?php if(isset($gedung)): foreach($gedung as $g): ?>
                                            <option value="<?= $g['id_gedung'] ?>"><?= $g['nama_gedung'] ?></option>
                                        <?php endforeach; endif; ?>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-200 mb-1.5">
                                        Room (Ruangan) <span class="text-red-500">*</span>
                                    </label>
                                    <select id="id_ruangan" name="id_ruangan" class="w-full bg-slate-50 dark:bg-slate-800 border border-slate-300 dark:border-slate-600 rounded-lg px-3 py-2.5 text-sm focus:ring-primary focus:border-primary" disabled required>
                                        <option value="">-- Pilih Gedung Dulu --</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-200 mb-1.5">
                                        Cabinet Number (Lemari) <span class="text-red-500">*</span>
                                    </label>
                                    <select id="id_lemari" name="id_lemari" class="w-full bg-slate-50 dark:bg-slate-800 border border-slate-300 dark:border-slate-600 rounded-lg px-3 py-2.5 text-sm focus:ring-primary focus:border-primary" disabled required>
                                        <option value="">-- Pilih Ruangan Dulu --</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-200 mb-1.5">
                                        Shelf / Box (Rak) <span class="text-red-500">*</span>
                                    </label>
                                    <select name="id_rak" id="id_rak" class="w-full bg-slate-50 dark:bg-slate-800 border border-slate-300 dark:border-slate-600 rounded-lg px-3 py-2.5 text-sm focus:ring-primary focus:border-primary" disabled required>
                                        <option value="">-- Pilih Lemari Dulu --</option>
                                    </select>
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
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
$(document).ready(function() {
    
    // Inisialisasi Select2 untuk Klasifikasi
    $('#id_klasifikasi').select2({
        placeholder: "Select Code...",
        allowClear: true,
        width: '100%'
    });

    // ==========================================
    // LOGIKA PERGANTIAN FORM & LIVE PREVIEW ADMIN
    // ==========================================
    function updatePreview() {
        var jenis = $('#jenis_arsip').val();
        var kka = $('#kode_klasifikasi_text').val() || '[KODE]';
        var kodeBidang = $('#kode_bidang').val() || '[BIDANG]';
        var noUrut = $('#no_urut').val() || '[NO]';
        var tahun = $('#tahun').val() || '[TAHUN]';
        var tgl = $('#tanggal_surat').val();
        var satker = 'DNV-TPI';
        var hasil = '';

        if (jenis === 'Nota Dinas') {
            $('#wrap_klasifikasi').addClass('hidden');
            $('#id_klasifikasi').prop('required', false);
            
            $('#wrap_bidang').removeClass('hidden');
            $('#kode_bidang').prop('required', true);

            hasil = kodeBidang.toUpperCase() + '/' + noUrut + '/' + satker + '/' + tahun;
        } else {
            $('#wrap_klasifikasi').removeClass('hidden');
            $('#id_klasifikasi').prop('required', true);
            
            $('#wrap_bidang').addClass('hidden');
            $('#kode_bidang').prop('required', false);

            var romawi = '[BULAN]';
            if (tgl) {
                var d = new Date(tgl);
                var arrRomawi = ['', 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII'];
                romawi = arrRomawi[d.getMonth() + 1]; // Mengambil bulan dan jadikan romawi
            }
            hasil = kka + '/' + noUrut + '/' + satker + '/' + romawi + '/' + tahun;
        }
        $('#preview_nomor').text(hasil);
    }

    // Jalankan pas ada yang diketik atau diubah
    $('#id_klasifikasi').on('select2:select', function(e) {
        var kode = $(this).find(':selected').data('kode');
        $('#kode_klasifikasi_text').val(kode);
        updatePreview();
    });
    $('#no_urut, #tahun, #jenis_arsip, #tanggal_surat, #kode_bidang').on('change keyup', updatePreview);


    // ==========================================
    // LAIN-LAIN (Upload Preview & AJAX Gedung/Ruangan/Lemari/Rak)
    // ==========================================
    var csrfName = '<?= csrf_token() ?>';

    $('#file_scan').change(function() {
        var fileName = $(this).val().split('\\').pop();
        if(fileName) {
            $('#file_name').text(fileName);
            $('#file_preview').removeClass('hidden');
        } else {
            $('#file_preview').addClass('hidden');
        }
    });

    // 1. AJAX Gedung -> Ruangan
    $('#id_gedung').change(function(){
        var id_gedung = $(this).val();
        var csrfHash = $('input[name="<?= csrf_token() ?>"]').val(); 
        
        if(id_gedung != '') {
            $.ajax({
                url: "<?= base_url('admin/arsip/getRuangan') ?>",
                method: "POST",
                data: {
                    id_gedung: id_gedung,
                    [csrfName]: csrfHash
                },
                dataType: "json",
                success: function(data) {
                    $('#id_ruangan').html('<option value="">-- Pilih Ruangan --</option>').removeClass('bg-slate-50 dark:bg-slate-800').prop('disabled', false);
                    $.each(data, function(key, value){
                        $('#id_ruangan').append('<option value="'+value.id_ruangan+'">'+value.nama_ruangan+'</option>');
                    });
                    $('#id_lemari').html('<option value="">-- Pilih Ruangan Dulu --</option>').addClass('bg-slate-50 dark:bg-slate-800').prop('disabled', true);
                    $('#id_rak').html('<option value="">-- Pilih Lemari Dulu --</option>').addClass('bg-slate-50 dark:bg-slate-800').prop('disabled', true);
                }
            });
        } else {
            $('#id_ruangan').prop('disabled', true).addClass('bg-slate-50 dark:bg-slate-800').html('<option value="">-- Pilih Gedung Dulu --</option>');
            $('#id_lemari').prop('disabled', true).addClass('bg-slate-50 dark:bg-slate-800').html('<option value="">-- Pilih Ruangan Dulu --</option>');
            $('#id_rak').prop('disabled', true).addClass('bg-slate-50 dark:bg-slate-800').html('<option value="">-- Pilih Lemari Dulu --</option>');
        }
    });

    // 2. AJAX Ruangan -> Lemari
    $('#id_ruangan').change(function(){
        var id_ruangan = $(this).val();
        var csrfHash = $('input[name="<?= csrf_token() ?>"]').val(); 
        
        if(id_ruangan != '') {
            $.ajax({
                url: "<?= base_url('admin/arsip/getLemari') ?>",
                method: "POST",
                data: {
                    id_ruangan: id_ruangan,
                    [csrfName]: csrfHash
                },
                dataType: "json",
                success: function(data) {
                    $('#id_lemari').html('<option value="">-- Pilih Lemari --</option>').removeClass('bg-slate-50 dark:bg-slate-800').prop('disabled', false);
                    $.each(data, function(key, value){
                        $('#id_lemari').append('<option value="'+value.id_lemari+'">'+value.nama_lemari+'</option>');
                    });
                    $('#id_rak').html('<option value="">-- Pilih Lemari Dulu --</option>').addClass('bg-slate-50 dark:bg-slate-800').prop('disabled', true);
                }
            });
        } else {
            $('#id_lemari').prop('disabled', true).addClass('bg-slate-50 dark:bg-slate-800').html('<option value="">-- Pilih Ruangan Dulu --</option>');
            $('#id_rak').prop('disabled', true).addClass('bg-slate-50 dark:bg-slate-800').html('<option value="">-- Pilih Lemari Dulu --</option>');
        }
    });

    // 3. AJAX Lemari -> Rak
    $('#id_lemari').change(function(){
        var id_lemari = $(this).val();
        var csrfHash = $('input[name="<?= csrf_token() ?>"]').val();
        
        if(id_lemari != '') {
            $.ajax({
                url: "<?= base_url('admin/arsip/getRak') ?>",
                method: "POST",
                data: {
                    id_lemari: id_lemari,
                    [csrfName]: csrfHash
                },
                dataType: "json",
                success: function(data) {
                    $('#id_rak').html('<option value="">-- Pilih Rak / Box --</option>').removeClass('bg-slate-50 dark:bg-slate-800').prop('disabled', false);
                    $.each(data, function(key, value){
                        $('#id_rak').append('<option value="'+value.id_rak+'">'+value.nama_rak+'</option>');
                    });
                }
            });
        } else {
            $('#id_rak').prop('disabled', true).addClass('bg-slate-50 dark:bg-slate-800').html('<option value="">-- Pilih Lemari Dulu --</option>');
        }
    });
});
</script>

</body>
</html>