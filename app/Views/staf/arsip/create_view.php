<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title><?= $title ?> - SiArsip</title>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@400;500;700;900&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
      tailwind.config = { darkMode: "class", theme: { extend: { colors: { "primary": "#135bec", "background-light": "#f6f6f8", "nav-blue": "#1e40af" }, fontFamily: { "display": ["Public Sans", "sans-serif"] } } } }
    </script>
</head>
<body class="bg-background-light text-slate-900 min-h-screen flex flex-col font-display">

<header class="sticky top-0 z-50 w-full bg-nav-blue shadow-lg">
    <div class="mx-auto flex max-w-[1280px] items-center justify-between px-6 py-3">
        <div class="flex items-center gap-3">
            <div class="flex size-10 items-center justify-center rounded-lg bg-white/10 text-white"><span class="material-symbols-outlined text-2xl">folder_managed</span></div>
            <div><h2 class="text-lg font-bold leading-tight text-white">SiArsip</h2><p class="text-xs text-blue-200">Navigasi Tanjungpinang</p></div>
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
            <p class="mt-2 text-lg text-slate-500">Masukkan detail dokumen, lokasi penyimpanan fisik, dan unggah file digitalnya.</p>
        </div>

        <form action="<?= base_url('staf/arsip/simpan') ?>" method="post" enctype="multipart/form-data" class="bg-white rounded-xl shadow-sm border border-slate-200 p-8 space-y-8">
            <?= csrf_field() ?>

            <div>
                <h3 class="text-lg font-bold text-slate-800 flex items-center gap-2 mb-4 border-b pb-2">
                    <span class="material-symbols-outlined text-primary">description</span> Data Dokumen
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Jenis Arsip <span class="text-red-500">*</span></label>
                        <select name="jenis_arsip" required class="w-full rounded-lg border-slate-300 focus:border-primary focus:ring-primary text-sm">
                            <option value="">-- Pilih Jenis --</option>
                            <option value="Surat Masuk">Surat Masuk</option>
                            <option value="Surat Keluar">Surat Keluar</option>
                            <option value="Nota Dinas">Nota Dinas</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Klasifikasi <span class="text-red-500">*</span></label>
                        <select name="id_klasifikasi" required class="w-full rounded-lg border-slate-300 focus:border-primary focus:ring-primary text-sm">
                            <option value="">-- Pilih Kode Klasifikasi --</option>
                            <?php foreach($klasifikasi as $k): ?>
                                <option value="<?= $k['id_klasifikasi'] ?>"><?= $k['kode_klasifikasi'] ?> - <?= $k['nama_klasifikasi'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Nomor Surat <span class="text-red-500">*</span></label>
                        <input type="text" name="nomor_surat" required placeholder="Contoh: UM.001/1/2/NV" class="w-full rounded-lg border-slate-300 focus:border-primary focus:ring-primary text-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Tanggal Surat <span class="text-red-500">*</span></label>
                        <input type="date" name="tanggal_surat" required class="w-full rounded-lg border-slate-300 focus:border-primary focus:ring-primary text-sm">
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
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Gedung <span class="text-red-500">*</span></label>
                        <select name="id_gedung" id="id_gedung" required class="w-full rounded-lg border-slate-300 focus:border-primary focus:ring-primary text-sm bg-blue-50/50">
                            <option value="">-- Pilih Gedung --</option>
                            <?php foreach($gedung as $g): ?>
                                <option value="<?= $g['id_gedung'] ?>"><?= $g['nama_gedung'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Ruangan <span class="text-red-500">*</span></label>
                        <select name="id_ruangan" id="id_ruangan" required class="w-full rounded-lg border-slate-300 focus:border-primary focus:ring-primary text-sm bg-slate-50">
                            <option value="">-- Pilih Gedung Dulu --</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Lemari <span class="text-red-500">*</span></label>
                        <select name="id_lemari" id="id_lemari" required class="w-full rounded-lg border-slate-300 focus:border-primary focus:ring-primary text-sm bg-slate-50">
                            <option value="">-- Pilih Ruangan Dulu --</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Rak / Box <span class="text-red-500">*</span></label>
                        <select name="id_rak" id="id_rak" required class="w-full rounded-lg border-slate-300 focus:border-primary focus:ring-primary text-sm bg-slate-50">
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
                <a href="<?= base_url('staf/dashboard') ?>" class="px-6 py-2.5 rounded-lg border border-slate-300 text-slate-700 font-medium hover:bg-slate-50">Batal</a>
                <button type="submit" class="px-6 py-2.5 rounded-lg bg-primary text-white font-bold hover:bg-blue-700 shadow-md flex items-center gap-2">
                    <span class="material-symbols-outlined text-[20px]">save</span> Simpan Arsip
                </button>
            </div>
        </form>
    </div>
</main>

<script>
$(document).ready(function() {
    
    // 1. Ketika Gedung dipilih, ambil data Ruangan
    $('#id_gedung').change(function() {
        var id_gedung = $(this).val();
        
        $('#id_ruangan').html('<option value="">-- Loading... --</option>').removeClass('bg-slate-50');
        $('#id_lemari').html('<option value="">-- Pilih Ruangan Dulu --</option>').addClass('bg-slate-50');
        $('#id_rak').html('<option value="">-- Pilih Lemari Dulu --</option>').addClass('bg-slate-50');
        
        if(id_gedung != '') {
            $.ajax({
                url: "<?= base_url('staf/arsip/getRuangan') ?>",
                type: "POST",
                data: {id_gedung: id_gedung},
                dataType: "json",
                success: function(response) {
                    var options = '<option value="">-- Pilih Ruangan --</option>';
                    $.each(response, function(key, value) {
                        options += '<option value="'+ value.id_ruangan +'">'+ value.nama_ruangan +'</option>';
                    });
                    $('#id_ruangan').html(options);
                }
            });
        } else {
            $('#id_ruangan').html('<option value="">-- Pilih Gedung Dulu --</option>').addClass('bg-slate-50');
        }
    });

    // 2. Ketika Ruangan dipilih, ambil data Lemari
    $('#id_ruangan').change(function() {
        var id_ruangan = $(this).val();
        
        $('#id_lemari').html('<option value="">-- Loading... --</option>').removeClass('bg-slate-50');
        $('#id_rak').html('<option value="">-- Pilih Lemari Dulu --</option>').addClass('bg-slate-50');
        
        if(id_ruangan != '') {
            $.ajax({
                url: "<?= base_url('staf/arsip/getLemari') ?>",
                type: "POST",
                data: {id_ruangan: id_ruangan},
                dataType: "json",
                success: function(response) {
                    var options = '<option value="">-- Pilih Lemari --</option>';
                    $.each(response, function(key, value) {
                        options += '<option value="'+ value.id_lemari +'">'+ value.nama_lemari +'</option>';
                    });
                    $('#id_lemari').html(options);
                }
            });
        } else {
            $('#id_lemari').html('<option value="">-- Pilih Ruangan Dulu --</option>').addClass('bg-slate-50');
        }
    });

    // 3. Ketika Lemari dipilih, ambil data Rak
    $('#id_lemari').change(function() {
        var id_lemari = $(this).val();
        
        $('#id_rak').html('<option value="">-- Loading... --</option>').removeClass('bg-slate-50');
        
        if(id_lemari != '') {
            $.ajax({
                url: "<?= base_url('staf/arsip/getRak') ?>",
                type: "POST",
                data: {id_lemari: id_lemari},
                dataType: "json",
                success: function(response) {
                    var options = '<option value="">-- Pilih Rak / Box --</option>';
                    $.each(response, function(key, value) {
                        options += '<option value="'+ value.id_rak +'">'+ value.nama_rak +'</option>';
                    });
                    $('#id_rak').html(options);
                }
            });
        } else {
            $('#id_rak').html('<option value="">-- Pilih Lemari Dulu --</option>').addClass('bg-slate-50');
        }
    });

});
</script>

</body>
</html>