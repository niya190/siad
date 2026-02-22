<?= $this->extend('layouts/admin_tailwind') ?>
<?= $this->section('content') ?>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm flex items-center gap-5">
        <div class="size-12 rounded-lg bg-primary/10 flex items-center justify-center text-primary">
            <span class="material-symbols-outlined text-[32px]">apartment</span>
        </div>
        <div>
            <p class="text-slate-500 text-xs font-semibold uppercase tracking-wider mb-1">Total Gedung</p>
            <h3 class="text-2xl font-bold text-slate-900 leading-none"><?= $total_gedung ?> <span class="text-sm font-medium text-slate-400 ml-1">Unit</span></h3>
        </div>
    </div>
    <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm flex items-center gap-5">
        <div class="size-12 rounded-lg bg-emerald-500/10 flex items-center justify-center text-emerald-600">
            <span class="material-symbols-outlined text-[32px]">meeting_room</span>
        </div>
        <div>
            <p class="text-slate-500 text-xs font-semibold uppercase tracking-wider mb-1">Total Ruangan</p>
            <h3 class="text-2xl font-bold text-slate-900 leading-none"><?= $total_ruangan ?> <span class="text-sm font-medium text-slate-400 ml-1">Kamar</span></h3>
        </div>
    </div>
    <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm flex items-center gap-5">
        <div class="size-12 rounded-lg bg-amber-500/10 flex items-center justify-center text-amber-600">
            <span class="material-symbols-outlined text-[32px]">pie_chart</span>
        </div>
        <div>
            <p class="text-slate-500 text-xs font-semibold uppercase tracking-wider mb-1">Rata-rata Hunian</p>
            <h3 class="text-2xl font-bold text-slate-900 leading-none"><?= $rata_hunian ?> <span class="text-sm font-medium text-slate-400 ml-1">%</span></h3>
        </div>
    </div>
</div>

<div class="flex items-center justify-between mb-6">
    <div class="flex items-center gap-2 mb-6">
        <span class="material-symbols-outlined text-[#135bec] text-2xl">domain</span>
        <h2 class="text-lg font-bold text-slate-800">Status Infrastruktur Fisik</h2>
    </div>
    <button class="text-[#135bec] text-xs font-bold hover:underline mb-6">Tambah Gedung Baru</button>
</div>

<div class="space-y-6">
    
    <?php foreach($gedung_list as $g): ?>
    <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="p-6 border-b border-slate-100 flex items-center justify-between bg-slate-50/50">
            <div class="flex items-center gap-4">
                <div class="size-14 rounded-lg bg-primary overflow-hidden relative">
                    <div class="absolute inset-0 bg-cover bg-center opacity-40" style="background-image: url('<?= $g['foto_url'] ?>')"></div>
                    <div class="absolute inset-0 flex items-center justify-center text-white">
                        <span class="material-symbols-outlined text-[24px]">corporate_fare</span>
                    </div>
                </div>
                <div>
                    <h3 class="text-base font-bold text-slate-900 leading-snug"><?= $g['nama_gedung'] ?></h3>
                    <p class="text-sm text-slate-500"><?= $g['alamat'] ?> • <?= $g['jumlah_lantai'] ?> Lantai</p>
                </div>
            </div>
            <div class="flex items-center gap-8">
                <div class="text-right">
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Hunian</p>
                    <div class="flex items-center gap-2">
                        <div class="w-24 h-2 bg-slate-200 rounded-full overflow-hidden">
                            <div class="h-full bg-primary rounded-full" style="width: <?= $g['persen_hunian'] ?>%"></div>
                        </div>
                        <span class="text-sm font-bold text-slate-700"><?= $g['persen_hunian'] ?>%</span>
                    </div>
                </div>
                <div class="flex gap-2">
                    <button class="size-9 rounded-lg border border-slate-200 flex items-center justify-center text-slate-600 hover:bg-slate-50">
                        <span class="material-symbols-outlined text-[18px]">edit</span>
                    </button>
                    <button class="px-3 py-1.5 rounded-lg bg-primary text-white text-xs font-bold flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-[16px]">add</span> Tambah Ruang
                    </button>
                </div>
            </div>
        </div>

        <?php if(count($g['daftar_ruangan']) > 0): ?>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead>
                    <tr class="bg-slate-50 text-slate-500 border-b border-slate-100">
                        <th class="px-6 py-3 font-semibold">Nama Ruangan</th>
                        <th class="px-6 py-3 font-semibold">Tipe</th>
                        <th class="px-6 py-3 font-semibold">Lantai</th>
                        <th class="px-6 py-3 font-semibold">Kapasitas</th>
                        <th class="px-6 py-3 font-semibold">Status</th>
                        <th class="px-6 py-3 font-semibold text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    <?php foreach($g['daftar_ruangan'] as $r): ?>
                        
                        <?php 
                            // Pewarnaan Badge Status pakai Tailwind
                            $color_bg = 'bg-emerald-100'; $color_txt = 'text-emerald-700'; $color_dot = 'bg-emerald-600';
                            if($r['status_ruangan'] == 'Dipesan') {
                                $color_bg = 'bg-amber-100'; $color_txt = 'text-amber-700'; $color_dot = 'bg-amber-600';
                            } elseif($r['status_ruangan'] == 'Penuh') {
                                $color_bg = 'bg-rose-100'; $color_txt = 'text-rose-700'; $color_dot = 'bg-rose-600';
                            }
                        ?>

                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-6 py-4 font-medium text-slate-900"><?= $r['nama_ruangan'] ?></td>
                            <td class="px-6 py-4 text-slate-600"><?= $r['tipe_ruangan'] ?></td>
                            <td class="px-6 py-4 text-slate-600"><?= $r['lantai'] ?></td>
                            <td class="px-6 py-4 text-slate-600"><?= $r['kapasitas'] ?> Orang</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center gap-1.5 px-2 py-1 rounded-md <?= $color_bg ?> <?= $color_txt ?> text-[11px] font-bold uppercase tracking-tight">
                                    <span class="size-1.5 rounded-full <?= $color_dot ?>"></span> <?= $r['status_ruangan'] ?>
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <button class="text-primary font-semibold hover:underline">Detail</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php else: ?>
            <div class="p-6 text-center text-slate-400">
                <p class="text-sm italic">Belum ada ruangan yang didaftarkan pada gedung ini.</p>
            </div>
        <?php endif; ?>
    </div>
    <?php endforeach; ?>

</div>

<?= $this->endSection() ?>