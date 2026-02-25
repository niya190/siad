<?= $this->extend('layouts/staf_tailwind') ?>
<?= $this->section('content') ?>

<div class="mb-8">
    <h2 class="text-3xl font-black tracking-tight text-slate-900">Staff Overview</h2>
    <p class="text-slate-500 mt-1">Operational status for <?= date('l, F jS') ?>.</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm">
        <div class="flex items-center justify-between mb-4">
            <span class="material-symbols-outlined text-amber-500 bg-amber-50 p-2 rounded-lg">scan</span>
        </div>
        <p class="text-slate-500 text-sm font-medium">Surat Masuk</p>
        <h3 class="text-3xl font-black text-slate-900 mt-1"><?= $surat_masuk ?></h3>
    </div>
    
    <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm">
        <div class="flex items-center justify-between mb-4">
            <span class="material-symbols-outlined text-primary bg-primary/10 p-2 rounded-lg">folder_open</span>
        </div>
        <p class="text-slate-500 text-sm font-medium">Surat Keluar</p>
        <h3 class="text-3xl font-black text-slate-900 mt-1"><?= $surat_keluar ?></h3>
    </div>
    
    <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm">
        <div class="flex items-center justify-between mb-4">
            <span class="material-symbols-outlined text-blue-500 bg-blue-50 p-2 rounded-lg">inventory_2</span>
        </div>
        <p class="text-slate-500 text-sm font-medium">Total Seluruh Arsip</p>
        <h3 class="text-3xl font-black text-slate-900 mt-1"><?= $total_arsip ?></h3>
    </div>
    
    <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm">
        <div class="flex items-center justify-between mb-4">
            <span class="material-symbols-outlined text-green-500 bg-green-50 p-2 rounded-lg">inventory</span>
            <?php if($arsip_hari_ini > 0): ?>
                <span class="text-xs font-bold text-green-600 bg-green-50 px-2 py-1 rounded">+<?= $arsip_hari_ini ?> Today</span>
            <?php endif; ?>
        </div>
        <p class="text-slate-500 text-sm font-medium">Arsip Masuk Hari Ini</p>
        <h3 class="text-3xl font-black text-slate-900 mt-1"><?= $arsip_hari_ini ?></h3>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <div class="lg:col-span-2 space-y-6">
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm">
            <div class="p-6 border-b border-slate-100 flex items-center justify-between">
                <h3 class="text-lg font-bold text-slate-900">Recent Activity</h3>
                <a href="<?= base_url('staf/arsip') ?>" class="text-primary text-sm font-semibold hover:underline">View All</a>
            </div>
            <div class="divide-y divide-slate-100">
                <div class="p-6 flex gap-4 hover:bg-slate-50 transition-colors">
                    <div class="flex-shrink-0">
                        <div class="size-10 rounded-full bg-primary/10 flex items-center justify-center">
                            <span class="material-symbols-outlined text-primary">auto_awesome</span>
                        </div>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-medium text-slate-900">
                            Sistem <span class="text-slate-500 font-normal">siap digunakan untuk pendaftaran arsip.</span>
                        </p>
                        <p class="text-xs text-slate-400 mt-1">Hari ini</p>
                    </div>
                </div>
                <div class="p-6 flex gap-4 hover:bg-slate-50 transition-colors">
                    <div class="flex-shrink-0">
                        <div class="size-10 rounded-full bg-slate-100 flex items-center justify-center">
                            <span class="material-symbols-outlined text-slate-400">qr_code_2</span>
                        </div>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-medium text-slate-900">
                            Jangan lupa untuk menempelkan QR Code/Label pada setiap <span class="font-bold">Box Penyimpanan</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="space-y-6">
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="p-6 border-b border-slate-100">
                <h3 class="text-lg font-bold text-slate-900">Quick Actions</h3>
            </div>
            <div class="p-6 grid grid-cols-1 gap-3">
                <a href="<?= base_url('staf/arsip/create') ?>" class="flex items-center gap-3 p-4 bg-slate-50 hover:bg-primary/5 hover:border-primary/50 transition-all border border-transparent rounded-xl text-left cursor-pointer">
                    <div class="size-10 rounded-lg bg-primary/10 text-primary flex items-center justify-center">
                        <span class="material-symbols-outlined">move_to_inbox</span>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-slate-900">New Intake</p>
                        <p class="text-xs text-slate-500">Log incoming materials</p>
                    </div>
                </a>
                <button class="flex items-center gap-3 p-4 bg-slate-50 hover:bg-primary/5 hover:border-primary/50 transition-all border border-transparent rounded-xl text-left">
                    <div class="size-10 rounded-lg bg-amber-100 text-amber-600 flex items-center justify-center">
                        <span class="material-symbols-outlined">print</span>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-slate-900">Print Label</p>
                        <p class="text-xs text-slate-500">Generate box barcode</p>
                    </div>
                </button>
            </div>
        </div>
        
        <div class="bg-primary-dark rounded-xl p-6 text-white shadow-lg relative overflow-hidden">
            <div class="relative z-10">
                <h4 class="font-bold text-lg mb-2">System Status</h4>
                <div class="flex items-center gap-2 mb-4">
                    <span class="size-2 bg-green-400 rounded-full"></span>
                    <span class="text-xs text-white/80 font-medium">All archives synced</span>
                </div>
            </div>
            <div class="absolute -bottom-4 -right-4 size-24 bg-white/5 rounded-full"></div>
            <div class="absolute top-0 right-0 size-32 bg-white/10 rounded-full blur-3xl"></div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>