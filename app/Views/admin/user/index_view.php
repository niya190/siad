<?= $this->extend('layouts/admin_tailwind') ?>
<?= $this->section('content') ?>

<div class="bg-white rounded-xl p-6 border border-slate-100 flex items-center justify-between mb-6 shadow-sm">
    <div class="flex items-center gap-4">
        <div class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center text-blue-600">
            <span class="material-symbols-outlined">person_search</span>
        </div>
        <div>
            <h3 class="text-sm font-bold text-slate-800">Active System Users</h3>
            <p class="text-xs text-slate-400">Overview of administrative access and roles</p>
        </div>
    </div>
    
    <a href="<?= base_url('admin/user/create') ?>" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2.5 rounded-lg text-xs font-bold flex items-center gap-2 shadow-lg shadow-blue-200 transition-all">
        <span class="material-symbols-outlined text-sm">person_add</span>
        Add New User
    </a>
</div>

<div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden mb-8">
    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm">
            <thead>
                <tr class="bg-slate-50 text-slate-500 border-b border-slate-100 text-xs uppercase tracking-wider">
                    <th class="px-6 py-4 font-bold">NIP / Username</th>
                    <th class="px-6 py-4 font-bold">Nama Lengkap</th>
                    <th class="px-6 py-4 font-bold">Role / Hak Akses</th>
                    <th class="px-6 py-4 font-bold">Bagian</th>
                    <th class="px-6 py-4 font-bold text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                <?php if(!empty($users)): ?>
                    <?php foreach($users as $u): ?>
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-6 py-4 font-mono text-slate-600"><?= $u['kode_peran'] ?></td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-slate-200 flex items-center justify-center text-xs font-bold text-slate-600">
                                    <?= substr($u['nama_user'], 0, 2) ?>
                                </div>
                                <span class="font-bold text-slate-900"><?= $u['nama_user'] ?></span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <?php 
                                $bg = 'bg-slate-100 text-slate-700';
                                if($u['role'] == 'admin') $bg = 'bg-blue-100 text-blue-700 border border-blue-200';
                                if($u['role'] == 'staf') $bg = 'bg-emerald-100 text-emerald-700 border border-emerald-200';
                                if($u['role'] == 'pimpinan') $bg = 'bg-amber-100 text-amber-700 border border-amber-200';
                            ?>
                            <span class="px-2.5 py-1 rounded-md text-[10px] font-bold uppercase tracking-wider <?= $bg ?>">
                                <?= $u['role'] ?>
                            </span>
                        </td>
                        <td class="px-6 py-4 text-slate-600"><?= $u['kode_bagian'] ?? '-' ?></td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <button class="w-8 h-8 rounded-lg border border-slate-200 flex items-center justify-center text-slate-400 hover:text-blue-600 hover:bg-blue-50 transition-colors" title="Edit Data">
                                    <span class="material-symbols-outlined text-[18px]">edit</span>
                                </button>
                                <button class="w-8 h-8 rounded-lg border border-slate-200 flex items-center justify-center text-slate-400 hover:text-red-600 hover:bg-red-50 transition-colors" title="Hapus User">
                                    <span class="material-symbols-outlined text-[18px]">delete</span>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center py-6 text-slate-400">Tidak ada data pengguna.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
    <div class="p-6 bg-white rounded-xl border border-slate-200 flex items-center gap-4 shadow-sm">
        <div class="w-12 h-12 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-600">
            <span class="material-symbols-outlined">how_to_reg</span>
        </div>
        <div>
            <p class="text-xs font-bold text-slate-500 uppercase tracking-wider">User Aktif</p>
            <h4 class="text-2xl font-black text-slate-900"><?= $user_aktif ?? 0 ?></h4>
        </div>
    </div>
    
    <div class="p-6 bg-white rounded-xl border border-slate-200 flex items-center gap-4 shadow-sm">
        <div class="w-12 h-12 rounded-full bg-amber-100 flex items-center justify-center text-amber-600">
            <span class="material-symbols-outlined">person_off</span>
        </div>
        <div>
            <p class="text-xs font-bold text-slate-500 uppercase tracking-wider">User Nonaktif</p>
            <h4 class="text-2xl font-black text-slate-900">0</h4>
        </div>
    </div>
    
    <div class="p-6 bg-white rounded-xl border border-slate-200 flex items-center gap-4 shadow-sm">
        <div class="w-12 h-12 rounded-full bg-primary/10 flex items-center justify-center text-primary">
            <span class="material-symbols-outlined">security</span>
        </div>
        <div>
            <p class="text-xs font-bold text-slate-500 uppercase tracking-wider">Admin Level</p>
            <h4 class="text-2xl font-black text-slate-900"><?= $total_admin ?? 0 ?></h4>
        </div>
    </div>
</div>

<?= $this->endSection() ?>