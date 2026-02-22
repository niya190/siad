<?= $this->extend('layouts/admin_tailwind') ?>
<?= $this->section('content') ?>

<div class="flex items-center justify-between mb-6">
    <div class="flex items-center gap-2 text-[#0a2569]">
        <span class="material-symbols-outlined">grid_view</span>
        <h2 class="text-base font-bold uppercase tracking-tight">Status Infrastruktur Lemari</h2>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
    <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-6">
        <div class="flex justify-between items-start mb-4">
            <span class="text-slate-500 text-sm font-medium">Total Lemari</span>
            <span class="text-emerald-600 text-xs font-bold bg-emerald-50 px-2 py-0.5 rounded">Aktif</span>
        </div>
        <div class="flex flex-col">
            <span class="text-2xl font-bold text-slate-900"><?= $total_lemari ?> Unit</span>
        </div>
    </div>
    <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-6">
        <div class="flex justify-between items-start mb-4">
            <span class="text-slate-500 text-sm font-medium">Kapasitas Total</span>
            <span class="text-slate-500 text-xs font-bold bg-slate-100 px-2 py-0.5 rounded">Stabil</span>
        </div>
        <div class="flex flex-col">
            <span class="text-2xl font-bold text-slate-900"><?= number_format($total_kapasitas, 0, ',', '.') ?> Dokumen</span>
        </div>
    </div>
    <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-6">
        <div class="flex justify-between items-start mb-4">
            <span class="text-slate-500 text-sm font-medium">Slot Tersedia</span>
            <span class="text-primary text-xs font-bold bg-blue-50 px-2 py-0.5 rounded">Kosong</span>
        </div>
        <div class="flex flex-col">
            <span class="text-2xl font-bold text-slate-900"><?= number_format($slot_tersedia, 0, ',', '.') ?> Slot</span>
        </div>
    </div>
    <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-6 <?= ($lemari_kritis > 0) ? 'border-l-4 border-l-amber-500' : '' ?>">
        <div class="flex justify-between items-start mb-4">
            <span class="text-slate-500 text-sm font-medium">Peringatan Penuh</span>
            <span class="<?= ($lemari_kritis > 0) ? 'text-amber-600 bg-amber-50' : 'text-slate-400 bg-slate-100' ?> text-xs font-bold px-2 py-0.5 rounded">Atensi</span>
        </div>
        <div class="flex flex-col">
            <span class="text-2xl font-bold text-slate-900"><?= $lemari_kritis ?> Unit</span>
            <span class="text-xs text-slate-400 mt-1 italic">Kapasitas > 90%</span>
        </div>
    </div>
</div>

<div class="space-y-4 mb-12">
    <h3 class="text-lg font-bold text-slate-900">Daftar Inventori Lemari dan Rak</h3>
    
    <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">
        
        <?php foreach($daftar_lemari as $l): ?>
            <?php 
                $persen_total = $l['kapasitas_maksimal'] > 0 ? round(($l['jumlah_terisi'] / $l['kapasitas_maksimal']) * 100) : 0;
                
                $badge_bg = 'bg-emerald-500'; $badge_txt = 'Tersedia';
                if($persen_total >= 90) { $badge_bg = 'bg-red-500'; $badge_txt = 'Kritis'; }
                elseif($persen_total >= 75) { $badge_bg = 'bg-amber-500'; $badge_txt = 'Hampir Penuh'; }

                // Simulasi isi per rak agar tampilan progress bar sesuai dengan jumlah terisi
                $sisa_isi = $l['jumlah_terisi'];
                $rak_data = [];
                for($i=1; $i<=$l['jumlah_rak']; $i++) {
                    $isi_rak_ini = min($sisa_isi, $l['kapasitas_per_rak']);
                    $sisa_isi -= $isi_rak_ini;
                    $persen_rak = ($isi_rak_ini / $l['kapasitas_per_rak']) * 100;
                    
                    $warna_rak = 'bg-primary';
                    if($persen_rak >= 90) $warna_rak = 'bg-red-500';
                    elseif($persen_rak >= 75) $warna_rak = 'bg-amber-500';

                    $rak_data[] = [
                        'nama' => 'Rak '.$i,
                        'terisi' => $isi_rak_ini,
                        'persen' => $persen_rak,
                        'warna' => $warna_rak
                    ];
                }
            ?>

            <div class="bg-white rounded-xl border border-slate-200 overflow-hidden shadow-sm flex flex-col sm:flex-row">
                <div class="w-full sm:w-48 bg-slate-100 relative">
                    <div class="absolute inset-0 bg-cover bg-center opacity-80" style="background-image: url('https://images.unsplash.com/photo-1595062584313-4ce49efdfdb9?q=80&w=1000&auto=format&fit=crop');"></div>
                    <div class="absolute top-3 left-3 px-2 py-1 <?= $badge_bg ?> text-white text-[10px] font-bold rounded uppercase tracking-wider"><?= $badge_txt ?></div>
                </div>
                <div class="flex-1 p-6 flex flex-col gap-4">
                    <div class="flex justify-between items-start">
                        <div>
                            <h4 class="text-lg font-bold text-slate-900"><?= $l['nama_lemari'] ?></h4>
                            <p class="text-slate-500 text-xs mt-1"><?= $l['lokasi_ruangan'] ?></p>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-slate-50 p-2 rounded-lg">
                            <p class="text-[10px] uppercase text-slate-400 font-bold tracking-widest">Total Rak</p>
                            <p class="text-sm font-bold text-slate-700"><?= $l['jumlah_rak'] ?> Rak</p>
                        </div>
                        <div class="bg-slate-50 p-2 rounded-lg">
                            <p class="text-[10px] uppercase text-slate-400 font-bold tracking-widest">Kapasitas</p>
                            <p class="text-sm font-bold text-slate-700"><?= $l['jumlah_terisi'] ?> / <?= $l['kapasitas_maksimal'] ?></p>
                        </div>
                    </div>
                    
                    <div class="space-y-3">
                        <?php foreach(array_slice($rak_data, 0, 3) as $rak): ?>
                        <div class="flex flex-col gap-1.5">
                            <div class="flex justify-between text-xs font-medium">
                                <span class="text-slate-600"><?= $rak['nama'] ?></span>
                                <span class="text-slate-900 font-bold"><?= $rak['terisi'] ?>/<?= $l['kapasitas_per_rak'] ?></span>
                            </div>
                            <div class="h-2 w-full bg-slate-100 rounded-full overflow-hidden">
                                <div class="h-full <?= $rak['warna'] ?> rounded-full" style="width: <?= $rak['persen'] ?>%;"></div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                        <?php if($l['jumlah_rak'] > 3): ?>
                            <p class="text-[10px] text-slate-400 text-center italic">... dan <?= $l['jumlah_rak'] - 3 ?> rak lainnya</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8 pb-12">
    <div class="lg:col-span-2 space-y-4">
        <div class="bg-white p-8 rounded-xl border border-slate-200 shadow-sm">
            <h3 class="text-lg font-bold text-slate-900 mb-6">Pendaftaran Lemari Baru</h3>
            
            <form action="<?= base_url('admin/lemari/simpan') ?>" method="post" class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-1.5">
                        <label class="text-xs font-bold text-slate-500 uppercase tracking-wider">ID / Nama Lemari</label>
                        <input name="nama_lemari" required class="w-full bg-slate-50 border-slate-200 rounded-lg text-sm px-4 py-2.5 focus:ring-primary focus:border-primary" placeholder="Contoh: Lemari Arsip C1" type="text"/>
                    </div>
                    <div class="space-y-1.5">
                        <label class="text-xs font-bold text-slate-500 uppercase tracking-wider">Lokasi Penempatan</label>
                        <input name="lokasi_ruangan" required class="w-full bg-slate-50 border-slate-200 rounded-lg text-sm px-4 py-2.5 focus:ring-primary focus:border-primary" placeholder="Contoh: Gedung Utama - Ruang 101" type="text"/>
                    </div>
                    <div class="space-y-1.5">
                        <label class="text-xs font-bold text-slate-500 uppercase tracking-wider">Jumlah Rak (Laci)</label>
                        <input name="jumlah_rak" required class="w-full bg-slate-50 border-slate-200 rounded-lg text-sm px-4 py-2.5 focus:ring-primary focus:border-primary" type="number" value="4" min="1"/>
                    </div>
                    <div class="space-y-1.5">
                        <label class="text-xs font-bold text-slate-500 uppercase tracking-wider">Batas Maksimal Per Rak</label>
                        <div class="flex items-center gap-2">
                            <input name="kapasitas_per_rak" required class="flex-1 bg-slate-50 border-slate-200 rounded-lg text-sm px-4 py-2.5 focus:ring-primary focus:border-primary" type="number" value="50" min="1"/>
                            <span class="text-xs text-slate-400">Dokumen</span>
                        </div>
                    </div>
                </div>
                <div class="flex justify-end pt-2">
                    <button class="bg-primary text-white px-8 py-3 rounded-lg text-sm font-bold shadow-lg hover:bg-blue-700 transition-all" type="submit">Simpan Konfigurasi Lemari</button>
                </div>
            </form>
            
        </div>
    </div>
    
    <div class="space-y-4">
        <div class="bg-white p-8 rounded-xl border border-slate-200 shadow-sm">
            <div class="flex items-center gap-2 mb-6">
                <span class="material-symbols-outlined text-primary">info</span>
                <h3 class="text-lg font-bold text-slate-900">Panduan Teknis</h3>
            </div>
            <ul class="space-y-4 text-sm text-slate-600">
                <li class="flex gap-3"><span class="size-5 bg-slate-100 rounded-full flex items-center justify-center text-[10px] font-bold shrink-0">1</span><span>Tentukan ID unik untuk setiap lemari fisik.</span></li>
                <li class="flex gap-3"><span class="size-5 bg-slate-100 rounded-full flex items-center justify-center text-[10px] font-bold shrink-0">2</span><span>Gunakan batas maksimal standar (50 dokumen) untuk mencegah kerusakan rak.</span></li>
                <li class="flex gap-3"><span class="size-5 bg-slate-100 rounded-full flex items-center justify-center text-[10px] font-bold shrink-0">3</span><span>Sistem akan memberi peringatan jika rak mencapai 90% kapasitas.</span></li>
            </ul>
        </div>
    </div>
</div>

<?= $this->endSection() ?>