<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title><?= $title ?? 'Rekam Arsip' ?> - SIAD Navigasi</title>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@400;500;700;900&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
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
        <a href="<?= base_url('staf/dashboard') ?>" class="text-blue-100 hover:text-white flex items-center gap-2 text-sm font-medium transition-colors">
            <span class="material-symbols-outlined text-[20px]">arrow_back</span> Kembali
        </a>
    </div>
</header>

<main class="flex-1 px-4 py-8 md:px-8">
    <div class="mx-auto max-w-4xl">
        <div class="mb-8">
            <h1 class="text-3xl font-black tracking-tight text-slate-900 md:text-4xl">Rekam Arsip Baru</h1>
            <p class="mt-2 text-lg text-slate-500">Logika Admin: Masukkan detail dokumen dan lokasi fisik (Gedung -> Ruangan -> Lemari -> Rak).</p>
        </div>

        <form action="<?= base_url('staf/arsip/save') ?>" method="post" enctype="multipart/form-data" class="bg-white rounded-xl shadow-sm border border-slate-200 p-8 space-y-8">
            <?= csrf_field() ?>

            <div>
                <h3 class="text-lg font-bold text-slate-800 flex items-center gap-2 mb-4 border-b pb-2">
                    <span class="material-symbols-outlined text-primary">description</span> Data Dokumen
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">

                <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Jenis Arsip <span class="text-red-500">*</span></label>
                        <select name="jenis_arsip" id="jenis_arsip" required class="w-full rounded-lg border-slate-300 focus:border-primary focus:ring-primary text-sm">
                            <option value="">-- Pilih Jenis --</option>
                            <option value="Surat Masuk">Surat Masuk</option>
                            <option value="Surat Keluar">Surat Keluar</option>
                            <option value="Nota Dinas">Nota Dinas</option>
                        </select>
                    </div>
                    <div>
                        <div id="wrap_klasifikasi">
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Klasifikasi (KKA) <span class="text-red-500">*</span></label>
                        <select name="id_klasifikasi" id="id_klasifikasi" required class="w-full rounded-lg border-slate-300 focus:border-primary focus:ring-primary text-sm bg-blue-50/50">
                            <option value="">-- Pilih Kode --</option>
                            <?php if(isset($klasifikasi)): foreach($klasifikasi as $k): ?>
                                <option value="<?= $k['id_klasifikasi'] ?>" data-kode="<?= $k['kode_klasifikasi'] ?>"><?= $k['kode_klasifikasi'] ?> - <?= $k['nama_klasifikasi'] ?></option>
                            <?php endforeach; endif; ?>
                        </select>
                        <input type="hidden" name="kode_klasifikasi_text" id="kode_klasifikasi_text">
                    </div>

                    <div id="wrap_bidang" class="hidden">
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Kode Bidang (Khusus Nota Dinas) <span class="text-red-500">*</span></label>
                        <input type="text" name="kode_bidang" id="kode_bidang" placeholder="Contoh: SDMH, KU-PL" class="w-full rounded-lg border-slate-300 focus:border-primary focus:ring-primary text-sm uppercase">
                    </div>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">No. Urut Surat <span class="text-red-500">*</span></label>
                        <input type="text" name="no_urut" required placeholder="Contoh: 0045" class="w-full rounded-lg border-slate-300 focus:border-primary focus:ring-primary text-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Tahun <span class="text-red-500">*</span></label>
                        <select name="tahun" required class="w-full rounded-lg border-slate-300 focus:border-primary focus:ring-primary text-sm">
                            <option value="<?= date('Y') ?>"><?= date('Y') ?></option>
                            <option value="<?= date('Y')-1 ?>"><?= date('Y')-1 ?></option>
                        </select>
                    </div>
                </div>

               <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Tanggal Surat <span class="text-red-500">*</span></label>
                        <input type="date" name="tanggal_surat" id="tanggal_surat" required class="w-full rounded-lg border-slate-300 focus:border-primary focus:ring-primary text-sm">
                    </div>
                    
                    
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Pengirim / Tujuan <span class="text-red-500">*</span></label>
                        <input type="text" name="pengirim_tujuan" required placeholder="Instansi pengirim atau tujuan surat..." class="w-full rounded-lg border-slate-300 focus:border-primary focus:ring-primary text-sm">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Perihal / Ringkasan <span class="text-red-500">*</span></label>
                        <textarea name="perihal" rows="2" required placeholder="Isi perihal surat..." class="w-full rounded-lg border-slate-300 focus:border-primary focus:ring-primary text-sm"></textarea>
                    </div>
                </div>
            </div>

            <div>
                <h3 class="text-lg font-bold text-slate-800 flex items-center gap-2 mb-4 border-b pb-2">
                    <span class="material-symbols-outlined text-green-600">inventory_2</span> Lokasi Penyimpanan Fisik
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Gedung <span class="text-red-500">*</span></label>
                        <select name="id_gedung" id="id_gedung" required class="w-full rounded-lg border-slate-300 focus:border-primary focus:ring-primary text-sm bg-blue-50/50">
                            <option value="">-- Pilih Gedung --</option>
                            <?php if(isset($gedung)): foreach($gedung as $g): ?>
                                <option value="<?= $g['id_gedung'] ?>"><?= $g['nama_gedung'] ?></option>
                            <?php endforeach; endif; ?>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Ruangan <span class="text-red-500">*</span></label>
                        <select name="id_ruangan" id="id_ruangan" required class="w-full rounded-lg border-slate-300 focus:border-primary focus:ring-primary text-sm bg-slate-50" disabled>
                            <option value="">-- Pilih Gedung Dulu --</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Lemari <span class="text-red-500">*</span></label>
                        <select name="id_lemari" id="id_lemari" required class="w-full rounded-lg border-slate-300 focus:border-primary focus:ring-primary text-sm bg-slate-50" disabled>
                            <option value="">-- Pilih Ruangan Dulu --</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Rak / Box <span class="text-red-500">*</span></label>
                        <select name="id_rak" id="id_rak" required class="w-full rounded-lg border-slate-300 focus:border-primary focus:ring-primary text-sm bg-slate-50" disabled>
                            <option value="">-- Pilih Lemari Dulu --</option>
                        </select>
                    </div>
                </div>
            </div>
            
            <div class="bg-blue-50 p-6 rounded-xl border border-blue-100">
                <h3 class="text-lg font-bold text-primary flex items-center gap-2 mb-2">
                    <span class="material-symbols-outlined">scan</span> Unggah File Digital (Scan)
                </h3>
                <p class="text-sm text-slate-600 mb-4">Unggah hasil scan dokumen asli dalam format PDF (Maksimal 5MB).</p>
                <input type="file" name="file_scan" accept="application/pdf" class="w-full text-sm text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-primary file:text-white hover:file:bg-blue-700 transition-colors" />
            </div>

            <div class="flex justify-end gap-3 pt-4 border-t border-slate-200">
                <a href="<?= base_url('staf/arsip') ?>" class="px-6 py-2.5 rounded-lg border border-slate-300 text-slate-700 font-medium hover:bg-slate-50">Batal</a>
                <button type="submit" class="px-6 py-2.5 rounded-lg bg-primary text-white font-bold hover:bg-blue-700 shadow-md flex items-center gap-2">
                    <span class="material-symbols-outlined text-[20px]">save</span> Simpan Arsip
                </button>
            </div>
        </form>
    </div>
</main>

<script>
$(document).ready(function() {
    // Ambil teks KKA saat klasifikasi dipilih
    $('#id_klasifikasi').select2({
        placeholder: "-- Ketik Kode atau Nama Klasifikasi --",
        allowClear: true,
        width: '100%'
    });

    // Ambil teks KKA saat klasifikasi dipilih
    $('#id_klasifikasi').on('select2:select', function (e) {
        var kode = $(this).find(':selected').data('kode');
        $('#kode_klasifikasi_text').val(kode);
    });

    // Menyiapkan nama token CSRF CodeIgniter
    var csrfName = '<?= csrf_token() ?>';
    // 1. AJAX Gedung -> Ruangan
    $('#id_gedung').change(function() {
        var id_gedung = $(this).val();
        var csrfHash = $('input[name="<?= csrf_token() ?>"]').val(); // Ambil token terbaru
        
        // Reset dropdown di bawahnya
        $('#id_ruangan').html('<option value="">-- Loading... --</option>').removeClass('bg-slate-50').prop('disabled', false);
        $('#id_lemari').html('<option value="">-- Pilih Ruangan Dulu --</option>').addClass('bg-slate-50').prop('disabled', true);
        $('#id_rak').html('<option value="">-- Pilih Lemari Dulu --</option>').addClass('bg-slate-50').prop('disabled', true);
        
        if(id_gedung != '') {
            $.ajax({
                url: "<?= base_url('staf/arsip/getRuangan') ?>",
                type: "POST",
                data: {
                    id_gedung: id_gedung,
                    [csrfName]: csrfHash // Kirim token
                },
                dataType: "json",
                success: function(response) {
                    var options = '<option value="">-- Pilih Ruangan --</option>';
                    if(response.length === 0) {
                        options = '<option value="">-- Ruangan Kosong --</option>';
                    } else {
                        $.each(response, function(key, value) {
                            options += '<option value="'+ value.id_ruangan +'">'+ value.nama_ruangan +'</option>';
                        });
                    }
                    $('#id_ruangan').html(options);
                }
            });
        } else {
            $('#id_ruangan').html('<option value="">-- Pilih Gedung Dulu --</option>').addClass('bg-slate-50').prop('disabled', true);
        }
    });

    // 2. AJAX Ruangan -> Lemari
    $('#id_ruangan').change(function() {
        var id_ruangan = $(this).val();
        var csrfHash = $('input[name="<?= csrf_token() ?>"]').val();
        
        $('#id_lemari').html('<option value="">-- Loading... --</option>').removeClass('bg-slate-50').prop('disabled', false);
        $('#id_rak').html('<option value="">-- Pilih Lemari Dulu --</option>').addClass('bg-slate-50').prop('disabled', true);
        
        if(id_ruangan != '') {
            $.ajax({
                url: "<?= base_url('staf/arsip/getLemari') ?>",
                type: "POST",
                data: {
                    id_ruangan: id_ruangan,
                    [csrfName]: csrfHash
                },
                dataType: "json",
                success: function(response) {
                    var options = '<option value="">-- Pilih Lemari --</option>';
                    if(response.length === 0) {
                        options = '<option value="">-- Lemari Kosong di Ruang Ini --</option>';
                    } else {
                        $.each(response, function(key, value) {
                            options += '<option value="'+ value.id_lemari +'">'+ value.nama_lemari +'</option>';
                        });
                    }
                    $('#id_lemari').html(options);
                }
            });
        } else {
            $('#id_lemari').html('<option value="">-- Pilih Ruangan Dulu --</option>').addClass('bg-slate-50').prop('disabled', true);
        }
    });

    // 3. AJAX Lemari -> Rak
    $('#id_lemari').change(function() {
        var id_lemari = $(this).val();
        var csrfHash = $('input[name="<?= csrf_token() ?>"]').val();
        
        $('#id_rak').html('<option value="">-- Loading... --</option>').removeClass('bg-slate-50').prop('disabled', false);
        
        if(id_lemari != '') {
            $.ajax({
                url: "<?= base_url('staf/arsip/getRak') ?>",
                type: "POST",
                data: {
                    id_lemari: id_lemari,
                    [csrfName]: csrfHash
                },
                dataType: "json",
                success: function(response) {
                    var options = '<option value="">-- Pilih Rak / Box --</option>';
                    if(response.length === 0) {
                        options = '<option value="">-- Rak Kosong di Lemari Ini --</option>';
                    } else {
                        $.each(response, function(key, value) {
                            options += '<option value="'+ value.id_rak +'">'+ value.nama_rak +'</option>';
                        });
                    }
                    $('#id_rak').html(options);
                }
            });
        } else {
            $('#id_rak').html('<option value="">-- Pilih Lemari Dulu --</option>').addClass('bg-slate-50').prop('disabled', true);
        }
    });
});

// ==========================================
    // SCRIPT LIVE PREVIEW NOMOR SURAT
    // ==========================================
    // ==========================================
    // LOGIKA PERGANTIAN FORM & LIVE PREVIEW
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
            // Sembunyikan KKA, Munculkan Kode Bidang
            $('#wrap_klasifikasi').addClass('hidden');
            $('#id_klasifikasi').prop('required', false);
            
            $('#wrap_bidang').removeClass('hidden');
            $('#kode_bidang').prop('required', true);

            // Format Preview: BIDANG/NO/DNV-TPI/TAHUN
            hasil = kodeBidang.toUpperCase() + '/' + noUrut + '/' + satker + '/' + tahun;
        } else {
            // Sembunyikan Kode Bidang, Munculkan KKA
            $('#wrap_klasifikasi').removeClass('hidden');
            $('#id_klasifikasi').prop('required', true);
            
            $('#wrap_bidang').addClass('hidden');
            $('#kode_bidang').prop('required', false);

            // Format Preview Biasa
            var romawi = '[BULAN]';
            if (tgl) {
                var d = new Date(tgl);
                var arrRomawi = ['', 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII'];
                romawi = arrRomawi[d.getMonth() + 1];
            }
            hasil = kka + '/' + noUrut + '/' + satker + '/' + romawi + '/' + tahun;
        }
        
        $('#preview_nomor').text(hasil);
    }

    // Jalankan pas ada yang diketik atau diubah
    $('#id_klasifikasi').on('select2:select', updatePreview);
    $('#no_urut, #tahun, #jenis_arsip, #tanggal_surat, #kode_bidang').on('change keyup', updatePreview);
</script>

</body>
</html>