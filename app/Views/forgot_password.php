<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Lupa Password - SIAD</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700;900&display=swap" rel="stylesheet"/>
    
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    
    <script id="tailwind-config">
        tailwind.config = { darkMode: "class", theme: { extend: { colors: { "primary": "#135bec", "background-light": "#f8fafc", "background-dark": "#0f172a", }, fontFamily: { "display": ["Public Sans", "sans-serif"] }, }, }, }
    </script>
    <style> body { font-family: 'Public Sans', sans-serif; background-color: #f8fafc; } </style>
</head>
<body class="bg-background-light text-slate-900 min-h-screen flex flex-col items-center justify-center p-4">

    <div class="w-full max-w-md bg-white rounded-xl shadow-2xl overflow-hidden border border-slate-200">
        <div class="p-8 bg-primary text-center">
            <span class="material-symbols-outlined text-white text-5xl mb-2">lock_reset</span>
            <h2 class="text-2xl font-bold text-white">Lupa Password?</h2>
            <p class="text-blue-100 text-sm mt-1">Masukkan email terdaftar untuk mengatur ulang sandi Anda.</p>
        </div>

        <div class="p-8">
            <?php if(session()->getFlashdata('error')): ?>
                <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 rounded-xl flex items-center gap-2 font-medium text-sm">
                    <span class="material-symbols-outlined">error</span>
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <form action="<?= base_url('forgot-password/process') ?>" method="POST" class="space-y-6">
                <?= csrf_field() ?>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Alamat Email</label>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">mail</span>
                        <input name="email" required class="w-full pl-12 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition-all text-slate-900" placeholder="contoh@navigasi.go.id" type="email"/>
                    </div>
                </div>
                
                <button class="w-full bg-primary hover:bg-blue-700 text-white font-bold py-3 rounded-xl shadow-lg transition-all flex items-center justify-center gap-2" type="submit">
                    Kirim Instruksi <span class="material-symbols-outlined text-lg">send</span>
                </button>
            </form>

            <div class="mt-8 text-center">
                <a href="<?= base_url('login') ?>" class="text-sm font-semibold text-slate-500 hover:text-primary transition-colors flex items-center justify-center gap-1">
                    <span class="material-symbols-outlined text-lg">arrow_back</span> Kembali ke halaman Login
                </a>
            </div>
        </div>
    </div>

</body>
</html>