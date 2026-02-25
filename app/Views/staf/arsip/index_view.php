<?= $this->extend('layouts/admin_tailwind') ?> <?= $this->section('content') ?>

<div class="mb-6">
    <div class="flex items-center gap-2 text-[#0a2569] mb-2">
        <span class="material-symbols-outlined text-3xl">folder_managed</span>
        <h2 class="text-xl font-bold uppercase tracking-tight">Data Arsip & Naskah Dinas</h2>
    </div>
    <p class="text-slate-500 text-sm">Pencarian dokumen surat masuk, keluar, dan nota dinas.</p>
</div>

<div class="bg-white rounded-xl p-6 border border-slate-200 shadow-sm mb-8">
    <form action="" method="GET" class="flex flex-col md:flex-row gap-4 items-end">
        
        <div class="flex-1 w-full">
            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Kata Kunci Pencarian</label>
            <div class="relative">
                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400">search</span>
                <input type="text" name="keyword" value="<?= esc($keyword) ?>" placeholder="Cari Nomor Surat, Perihal, atau Pengirim..." 
                       class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border-slate-200 rounded-lg text-sm focus:ring-primary focus:border-primary transition-all">
            </div>
        </div>

        <div class="w-full md:w-64">
            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Jenis Arsip</label>
            <select name="jenis_arsip" class="w-full px-4 py-2.5 bg-slate-50 border-slate-200 rounded-lg text-sm focus:ring-primary focus:border-primary">
                <option value="Semua" <?= ($jenis == 'Semua' || empty($jenis)) ? 'selected' : '' ?>>Semua Jenis</option>
                <option value="Surat Masuk" <?= ($jenis == 'Surat Masuk') ? 'selected' : '' ?>>Surat Masuk</option>
                <option value="Surat Keluar" <?= ($jenis == 'Surat Keluar') ? 'selected' : '' ?>>Surat Keluar</option>
                <option value="Berkas Proyek" <?= ($jenis == 'Berkas Proyek') ? 'selected' : '' ?>>Berkas Proyek</option>
                <option value="SK (Keputusan)" <?= ($jenis == 'SK (Keputusan)') ? 'selected' : '' ?>>SK (Keputusan)</option>
            </select>
        </div>

        <div class="flex gap-2 w-full md:w-auto">
            <button type="submit" class="flex-1 md:flex-none bg-primary hover:bg-blue-700 text-white px-6 py-2.5 rounded-lg text-sm font-bold shadow-md transition-all flex items-center justify-center gap-2">
                <span class="material-symbols-outlined text-[18px]">manage_search</span> Cari
            </button>
            <?php if(!empty($keyword) || !empty($jenis)): ?>
                <a href="<?= base_url('staf/arsip') ?>" class="px-4 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-lg text-sm font-bold transition-all flex items-center justify-center" title="Reset Filter">
                    <span class="material-symbols-outlined text-[18px]">close</span>
                </a>
            <?php endif; ?>
        </div>
    </form>
</div>

<div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm">
            <thead>
                <tr class="bg-slate-50 text-slate-500 border-b border-slate-100 text-[11px] uppercase tracking-wider">
                    <th class="px-6 py-4 font-bold">No. Surat / Tanggal</th>
                    <th class="px-6 py-4 font-bold">Jenis Arsip</th>
                    <th class="px-6 py-4 font-bold">Pengirim / Tujuan</th>
                    <th class="px-6 py-4 font-bold">Perihal Ringkas</th>
                    <th class="px-6 py-4 font-bold">Lokasi Simpan</th>
                    <th class="px-6 py-4 font-bold text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                <?php if(!empty($arsip)): ?>
                    <?php foreach($arsip as $a): ?>
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-6 py-4">
                            <p class="font-bold text-slate-900 font-mono text-xs"><?= $a['nomor_surat'] ?></p>
                            <p class="text-[11px] text-slate-500 mt-0.5"><?= date('d M Y', strtotime($a['tanggal_surat'])) ?></p>
                        </td>
                        <td class="px-6 py-4">
                            <?php 
                                // Bikin warna beda-beda per jenis surat
                                $bg = 'bg-slate-100 text-slate-700';
                                if($a['jenis_arsip'] == 'Surat Masuk') $bg = 'bg-emerald-100 text-emerald-700';
                                if($a['jenis_arsip'] == 'Surat Keluar') $bg = 'bg-blue-100 text-blue-700';
                                if($a['jenis_arsip'] == 'SK (Keputusan)') $bg = 'bg-amber-100 text-amber-700';
                                if($a['jenis_arsip'] == 'Berkas Proyek') $bg = 'bg-purple-100 text-purple-700';
                            ?>
                            <span class="px-2.5 py-1 rounded text-[10px] font-bold uppercase tracking-wider <?= $bg ?>">
                                <?= $a['jenis_arsip'] ?>
                            </span>
                        </td>
                        <td class="px-6 py-4 font-medium text-slate-800"><?= $a['pengirim_tujuan'] ?></td>
                        <td class="px-6 py-4 text-slate-600 truncate max-w-xs" title="<?= $a['perihal'] ?? '' ?>">
                            <?= $a['perihal'] ?? '-' ?>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-1.5 text-xs text-slate-600 bg-slate-100 px-2 py-1 rounded inline-flex">
                                <span class="material-symbols-outlined text-[14px]">inventory_2</span>
                                <?= $a['lokasi_penyimpanan'] ?? '-' ?>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <button class="w-8 h-8 rounded-lg border border-slate-200 flex items-center justify-center text-primary hover:bg-blue-50 transition-colors inline-flex" title="Lihat Detail">
                                <span class="material-symbols-outlined text-[18px]">visibility</span>
                            </button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center py-12">
                            <div class="flex flex-col items-center justify-center text-slate-400">
                                <span class="material-symbols-outlined text-5xl mb-3 opacity-50">search_off</span>
                                <p class="text-base font-medium text-slate-600">Arsip tidak ditemukan</p>
                                <p class="text-xs mt-1">Coba gunakan kata kunci atau filter lain.</p>
                            </div>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>