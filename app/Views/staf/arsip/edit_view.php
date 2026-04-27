<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title><?= $title ?> - SIAD Navigasi</title>
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
            <div class="size-10 rounded-lg bg-white flex items-center justify-center shrink-0 shadow-lg overflow-hidden">
    <img src="<?= base_url('assets/img/logo.JPEG') ?>" 
         alt="Logo Distrik Navigasi" 
         class="h-8 w-auto object-contain">
</div>
            <div><h2 class="text-lg font-bold leading-tight text-white">SIAD</h2><p class="text-xs text-blue-200">Navigasi Tanjungpinang</p></div>
        </div>
        <a href="<?= base_url('staf/arsip/detail/' . $arsip['id_arsip']) ?>" class="text-blue-100 hover:text-white flex items-center gap-2 text-sm font-medium transition-colors">
            <span class="material-symbols-outlined text-[20px]">arrow_back</span> Batal & Kembali
        </a>
    </div>
</header>

<main class="flex-1 px-4 py-8 md:px-8">
    <div class="mx-auto max-w-4xl">
        <div class="mb-8">
            <h1 class="text-3xl font-black tracking-tight text-slate-900 md:text-4xl">Edit Data Arsip</h1>
            <p class="mt-2 text-lg text-slate-500">Perbarui informasi dokumen <strong><?= esc($arsip['nomor_surat']) ?></strong>.</p>
        </div>

        <form action="<?= base_url('staf/arsip/update/' . $arsip['id_arsip']) ?>" method="post" enctype="multipart/form-data" class="bg-white rounded-xl shadow-sm border border-slate-200 p-8 space-y-8">
            <?= csrf_field() ?>

            <div>
                <h3 class="text-lg font-bold text-slate-800 flex items-center gap-2 mb-4 border-b pb-2">
                    <span class="material-symbols-outlined text-primary">description</span> Data Dokumen
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Tanggal Terima / Input</label>
                        <input type="date" name="tanggal_terima" value="<?= esc($arsip['tanggal_terima']) ?>" required class="w-full rounded-lg border-slate-300 focus:border-primary focus:ring-primary text-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Jenis Arsip</label>
                        <select name="jenis_arsip" required class="w-full rounded-lg border-slate-300 focus:border-primary focus:ring-primary text-sm">
                            <option value="Surat Masuk" <?= $arsip['jenis_arsip'] == 'Surat Masuk' ? 'selected' : '' ?>>Surat Masuk</option>
                            <option value="Surat Keluar" <?= $arsip['jenis_arsip'] == 'Surat Keluar' ? 'selected' : '' ?>>Surat Keluar</option>
                            <option value="Nota Dinas" <?= $arsip['jenis_arsip'] == 'Nota Dinas' ? 'selected' : '' ?>>Nota Dinas</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Klasifikasi (Kode Kemenhub)</label>
                        <select name="id_klasifikasi" class="w-full rounded-lg border-slate-300 focus:border-primary focus:ring-primary text-sm">
                            <option value="">-- Pilih Klasifikasi --</option>
                            <?php foreach($klasifikasi as $k): ?>
                                <option value="<?= $k['id_klasifikasi'] ?>" <?= $arsip['id_klasifikasi'] == $k['id_klasifikasi'] ? 'selected' : '' ?>>
                                    <?= $k['kode_klasifikasi'] ?> - <?= $k['nama_klasifikasi'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Nomor Surat</label>
                        <input type="text" name="nomor_surat" value="<?= esc($arsip['nomor_surat']) ?>" required class="w-full rounded-lg border-slate-300 focus:border-primary focus:ring-primary text-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Tanggal Surat</label>
                        <input type="date" name="tanggal_surat" value="<?= esc($arsip['tanggal_surat']) ?>" required class="w-full rounded-lg border-slate-300 focus:border-primary focus:ring-primary text-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Pengirim / Tujuan</label>
                        <input type="text" name="pengirim_tujuan" value="<?= esc($arsip['pengirim_tujuan']) ?>" required class="w-full rounded-lg border-slate-300 focus:border-primary focus:ring-primary text-sm">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Perihal / Isi Ringkas</label>
                        <textarea name="perihal" rows="2" required class="w-full rounded-lg border-slate-300 focus:border-primary focus:ring-primary text-sm"><?= esc($arsip['perihal']) ?></textarea>
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Keterangan Tambahan</label>
                        <input type="text" name="keterangan" value="<?= esc($arsip['keterangan']) ?>" class="w-full rounded-lg border-slate-300 focus:border-primary focus:ring-primary text-sm">
                    </div>
                </div>
            </div>

            <div>
                <h3 class="text-lg font-bold text-slate-800 flex items-center gap-2 mb-4 border-b pb-2">
                    <span class="material-symbols-outlined text-green-600">inventory_2</span> Lokasi Penyimpanan Fisik
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Ruangan <span class="text-red-500">*</span></label>
                        <select name="id_ruangan" id="id_ruangan" required class="w-full rounded-lg border-slate-300 focus:border-primary focus:ring-primary text-sm bg-blue-50/50">
                            <option value="">-- Pilih Ruangan --</option>
                            <?php foreach($ruangan as $r): ?>
                                <option value="<?= $r['id_ruangan'] ?>"><?= $r['nama_ruangan'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Lemari <span class="text-red-500">*</span></label>
                        <select name="id_lemari" id="id_lemari" required class="w-full rounded-lg border-slate-300 focus:border-primary focus:ring-primary text-sm bg-blue-50/50">
                            <option value="">-- Loading... --</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Rak / Ordner <span class="text-red-500">*</span></label>
                        <select name="id_rak" id="id_rak" required class="w-full rounded-lg border-slate-300 focus:border-primary focus:ring-primary text-sm bg-blue-50/50">
                            <option value="">-- Loading... --</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="bg-blue-50 p-6 rounded-xl border border-blue-100">
                <h3 class="text-lg font-bold text-primary flex items-center gap-2 mb-2"><span class="material-symbols-outlined">upload_file</span> Ganti File Digital (Opsional)</h3>
                <p class="text-sm text-slate-600 mb-4">Biarkan kosong jika tidak ingin mengganti file PDF saat ini.</p>
                
                <?php if($arsip['file_scan']): ?>
                <div class="mb-4 p-3 bg-white border border-slate-200 rounded-lg flex items-center gap-3">
                    <span class="material-symbols-outlined text-red-500">picture_as_pdf</span>
                    <span class="text-sm font-medium text-slate-700">File Saat Ini: <a href="<?= base_url('uploads/arsip/'.$arsip['file_scan']) ?>" target="_blank" class="text-primary hover:underline"><?= esc($arsip['file_scan']) ?></a></span>
                </div>
                <?php endif; ?>

                <input type="file" name="file_scan" accept="application/pdf" class="w-full text-sm text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-primary file:text-white hover:file:bg-blue-700 transition-colors" />
            </div>

            <div class="flex justify-end gap-3 pt-4 border-t border-slate-200">
                <a href="<?= base_url('staf/arsip/detail/' . $arsip['id_arsip']) ?>" class="px-6 py-2.5 rounded-lg border border-slate-300 text-slate-700 font-medium hover:bg-slate-50">Batal</a>
                <button type="submit" class="px-6 py-2.5 rounded-lg bg-primary text-white font-bold hover:bg-blue-700 shadow-md flex items-center gap-2">
                    <span class="material-symbols-outlined text-[20px]">save</span> Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</main>

<script>
$(document).ready(function() {
    
    // Ambil ID lokasi yang sudah tersimpan di database dari PHP
    var id_ruangan_awal = "<?= $id_ruangan_tersimpan ?>";
    var id_lemari_awal  = "<?= $id_lemari_tersimpan ?>";
    var id_rak_awal     = "<?= $id_rak_tersimpan ?>";

    // Fungsi Load Lemari
    function loadLemari(id_ruangan, selected_lemari = '') {
        $('#id_lemari').html('<option value="">-- Loading... --</option>');
        if(id_ruangan != '') {
            $.ajax({
                url: "<?= base_url('staf/arsip/getLemari') ?>",
                type: "POST",
                data: {id_ruangan: id_ruangan},
                dataType: "json",
                success: function(response) {
                    var options = '<option value="">-- Pilih Lemari --</option>';
                    $.each(response, function(key, value) {
                        var is_selected = (value.id_lemari == selected_lemari) ? 'selected' : '';
                        options += '<option value="'+ value.id_lemari +'" '+is_selected+'>'+ value.nama_lemari +'</option>';
                    });
                    $('#id_lemari').html(options);
                    
                    // Kalau ada lemari lama, langsung load rak-nya juga
                    if(selected_lemari != '') loadRak(selected_lemari, id_rak_awal); 
                }
            });
        } else {
            $('#id_lemari').html('<option value="">-- Pilih Ruangan Dulu --</option>');
            $('#id_rak').html('<option value="">-- Pilih Lemari Dulu --</option>');
        }
    }

    // Fungsi Load Rak
    function loadRak(id_lemari, selected_rak = '') {
        $('#id_rak').html('<option value="">-- Loading... --</option>');
        if(id_lemari != '') {
            $.ajax({
                url: "<?= base_url('staf/arsip/getRak') ?>",
                type: "POST",
                data: {id_lemari: id_lemari},
                dataType: "json",
                success: function(response) {
                    var options = '<option value="">-- Pilih Rak / Box --</option>';
                    $.each(response, function(key, value) {
                        var is_selected = (value.id_rak == selected_rak) ? 'selected' : '';
                        options += '<option value="'+ value.id_rak +'" '+is_selected+'>'+ value.nama_rak +'</option>';
                    });
                    $('#id_rak').html(options);
                }
            });
        }
    }

    // TRIGGER SAAT HALAMAN PERTAMA KALI DIBUKA (Auto Select Data Lama)
    if(id_ruangan_awal != '') {
        $('#id_ruangan').val(id_ruangan_awal);
        loadLemari(id_ruangan_awal, id_lemari_awal);
    }

    // TRIGGER SAAT USER MENGGANTI PILIHAN (Ubah Lokasi)
    $('#id_ruangan').change(function() {
        loadLemari($(this).val());
    });

    $('#id_lemari').change(function() {
        loadRak($(this).val());
    });

});
</script>
</body>
</html>