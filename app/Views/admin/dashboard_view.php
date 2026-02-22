<?= $this->extend('layouts/admin_tailwind') ?>
<?= $this->section('content') ?>

<section>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        <div class="bg-white p-5 rounded-xl border border-slate-200 flex items-center shadow-sm">
            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center text-green-600 mr-4">
                <span class="material-icons">dns</span>
            </div>
            <div>
                <p class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Status Server</p>
                <div class="flex items-center space-x-2">
                    <span class="text-xl font-bold">Online</span>
                    <span class="h-2 w-2 bg-green-500 rounded-full animate-pulse"></span>
                </div>
                <p class="text-[10px] text-slate-500">Sistem Berjalan Normal</p>
            </div>
        </div>

        <div class="bg-white p-5 rounded-xl border border-slate-200 flex items-center shadow-sm">
            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center text-primary mr-4">
                <span class="material-icons">folder_open</span>
            </div>
            <div>
                <p class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Total Arsip Sistem</p>
                <span class="text-xl font-bold"><?= $total_arsip ?? 0 ?> Dokumen</span>
                <p class="text-[10px] text-slate-500">Tersimpan di Database</p>
            </div>
        </div>

        <div class="bg-red-50 p-5 rounded-xl border border-red-200 flex items-center shadow-sm relative overflow-hidden group">
            <div class="absolute right-0 top-0 h-full w-2 bg-red-500"></div>
            <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center text-red-600 mr-4">
                <span class="material-icons">report_problem</span>
            </div>
            <div class="flex-1">
                <p class="text-[11px] font-bold text-red-600 uppercase tracking-widest">Peringatan Penyimpanan</p>
                <span class="text-lg font-bold">Cek Kapasitas Lemari</span>
                <p class="text-[10px] text-red-500">Beberapa rak mungkin sudah penuh</p>
            </div>
        </div>
    </div>
</section>

<section class="mb-8">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-lg font-bold text-slate-800 flex items-center">
            <span class="material-icons mr-2 text-primary">account_tree</span>
            Status Kapasitas Penyimpanan Fisik
        </h2>
        <button class="text-xs font-bold text-primary hover:underline">Kelola Master Data</button>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">
        
        <?php if(!empty($daftar_lemari)): ?>
            <?php foreach($daftar_lemari as $lemari): ?>
                <?php 
                    // Hitung persentase keterisian lemari
                    $persen = 0;
                    if($lemari['kapasitas_maksimal'] > 0){
                        $persen = round(($lemari['jumlah_terisi'] / $lemari['kapasitas_maksimal']) * 100);
                    }

                    // Tentukan warna berdasarkan persentase
                    $color = 'bg-primary'; $text_color = 'text-primary'; $bg_icon = 'bg-blue-50';
                    $ring = '';
                    
                    if($persen >= 80 && $persen < 90) {
                        $color = 'bg-yellow-500'; $text_color = 'text-yellow-600'; $bg_icon = 'bg-yellow-50';
                    } elseif($persen >= 90) {
                        $color = 'bg-red-600'; $text_color = 'text-red-600'; $bg_icon = 'bg-red-50';
                        $ring = 'ring-1 ring-red-500/30'; // Efek merah menyala
                    }
                ?>

                <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm <?= $ring ?>">
                    <div class="flex justify-between items-start mb-4">
                        <span class="p-2 <?= $bg_icon ?> rounded-lg <?= $text_color ?>">
                            <span class="material-icons">inventory_2</span>
                        </span>
                        <?php if($persen >= 90): ?>
                            <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-red-100 text-red-600">Kritis</span>
                        <?php endif; ?>
                    </div>
                    
                    <h3 class="font-bold text-slate-900 mb-1"><?= $lemari['nama_lemari'] ?></h3>
                    <p class="text-xs text-slate-500 mb-4"><?= $lemari['lokasi_ruangan'] ?></p>
                    
                    <div class="space-y-1.5">
                        <div class="flex justify-between text-[10px] font-bold uppercase tracking-tight">
                            <span>Kapasitas (<?= $lemari['jumlah_terisi'] ?>/<?= $lemari['kapasitas_maksimal'] ?>)</span>
                            <span class="<?= $text_color ?>"><?= $persen ?>%</span>
                        </div>
                        <div class="w-full bg-slate-100 h-2 rounded-full overflow-hidden">
                            <div class="<?= $color ?> h-full rounded-full" style="width: <?= $persen ?>%"></div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-span-full p-4 bg-yellow-50 text-yellow-700 rounded-lg text-sm">
                Belum ada data lemari. Silakan tambahkan di Database.
            </div>
        <?php endif; ?>

        <div class="bg-primary/5 p-6 rounded-xl border-2 border-dashed border-primary/20 flex flex-col items-center justify-center text-center group cursor-pointer hover:bg-primary/10 transition-all">
            <div class="w-10 h-10 rounded-full bg-primary text-white flex items-center justify-center mb-2 group-hover:scale-110 transition-transform">
                <span class="material-icons">add</span>
            </div>
            <span class="text-xs font-bold text-primary uppercase">Tambah Lemari</span>
            <p class="text-[10px] text-slate-500 mt-1">Registrasi kapasitas baru</p>
        </div>
    </div>
</section>

<section>
    <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="p-6 border-b border-slate-100 flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-primary/10 rounded-lg flex items-center justify-center text-primary">
                    <span class="material-icons">manage_accounts</span>
                </div>
                <div>
                    <h2 class="text-lg font-bold text-slate-800">Manajemen Pengguna</h2>
                    <p class="text-xs text-slate-500">Daftar staf dan pimpinan yang aktif di sistem</p>
                </div>
            </div>
            <button class="bg-primary hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-xs font-bold flex items-center shadow-md transition-all">
                <span class="material-icons text-sm mr-2">person_add</span> Tambah User
            </button>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-slate-50 text-slate-500 text-[11px] font-bold uppercase tracking-wider border-b border-slate-100">
                        <th class="px-6 py-4">NIP / Username</th>
                        <th class="px-6 py-4">Nama Lengkap</th>
                        <th class="px-6 py-4">Role / Hak Akses</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    
                    <?php if(!empty($users)): ?>
                        <?php foreach($users as $u): ?>
                        <tr class="data-table-row transition-colors">
                            <td class="px-6 py-4 text-sm font-mono text-slate-600"><?= $u['kode_peran'] ?></td>
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 rounded-full bg-slate-200 mr-3 flex items-center justify-center text-xs font-bold text-slate-600">
                                        <?= substr($u['nama_user'], 0, 2) ?>
                                    </div>
                                    <span class="text-sm font-bold text-slate-800"><?= $u['nama_user'] ?></span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <?php 
                                    $bg = 'bg-slate-100 text-slate-700';
                                    if(strtolower($u['role']) == 'admin') $bg = 'bg-purple-100 text-purple-700';
                                    if(strtolower($u['role']) == 'staf') $bg = 'bg-blue-100 text-blue-700';
                                    if(strtolower($u['role']) == 'pimpinan') $bg = 'bg-emerald-100 text-emerald-700';
                                ?>
                                <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold <?= $bg ?> uppercase">
                                    <?= $u['role'] ?>
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right space-x-1">
                                <button class="p-1.5 text-slate-400 hover:text-primary transition-colors"><span class="material-icons text-lg">edit</span></button>
                                <button class="p-1.5 text-slate-400 hover:text-red-500 transition-colors"><span class="material-icons text-lg">lock_reset</span></button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="4" class="text-center py-4 text-slate-500">Belum ada data user.</td></tr>
                    <?php endif; ?>

                </tbody>
            </table>
        </div>
    </div>
</section>

<?= $this->endSection() ?>