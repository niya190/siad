<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Login SIAD - Distrik Navigasi Tanjungpinang</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700;900&display=swap" rel="stylesheet"/>
    
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    
    <script id="tailwind-config">
        tailwind.config = { darkMode: "class", theme: { extend: { colors: { "primary": "#135bec", "background-light": "#f8fafc", "background-dark": "#0f172a", }, fontFamily: { "display": ["Public Sans", "sans-serif"] }, borderRadius: { "DEFAULT": "0.25rem", "lg": "0.5rem", "xl": "0.75rem", "full": "9999px" }, }, }, }
    </script>
    <style>
        body { font-family: 'Public Sans', sans-serif; }
        .maritime-pattern { background-color: #f8fafc; background-image: radial-gradient(#135bec 0.5px, transparent 0.5px), radial-gradient(#135bec 0.5px, #f8fafc 0.5px); background-size: 20px 20px; background-position: 0 0, 10px 10px; opacity: 0.05; }
    </style>
</head>
<body class="bg-background-light dark:bg-background-dark font-display text-slate-900 dark:text-slate-100 min-h-screen flex flex-col">

<div class="fixed inset-0 maritime-pattern pointer-events-none"></div>

<div class="relative flex flex-1 items-center justify-center p-4 md:p-8">
    <div class="w-full max-w-[1100px] grid grid-cols-1 lg:grid-cols-2 bg-white dark:bg-slate-900 rounded-xl shadow-2xl overflow-hidden border border-slate-200 dark:border-slate-800">
        
        <div class="hidden lg:flex flex-col justify-between p-12 bg-primary relative overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-br from-primary via-primary/90 to-blue-900/80"></div>
            <div class="relative z-10">
                <div class="flex items-center gap-3 mb-8">
                    <div class="p-2 bg-white rounded-lg shadow-lg">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/e/e5/Logo_Kementerian_Perhubungan_Republik_Indonesia.png/600px-Logo_Kementerian_Perhubungan_Republik_Indonesia.png" alt="Logo Kemenhub" class="h-12 w-auto">
                    </div>
                    <div>
                        <h3 class="text-white font-bold text-lg leading-tight">Distrik Navigasi Tipe A</h3>
                        <p class="text-blue-100 text-sm">Kelas 1 Tanjungpinang</p>
                    </div>
                </div>
                <div class="mt-20">
                    <h1 class="text-white text-5xl font-black tracking-tight mb-4">SIAD</h1>
                    <p class="text-blue-100 text-lg max-w-md leading-relaxed">Sistem Manajemen Kearsipan Digital terintegrasi untuk efisiensi dokumentasi navigasi pelayaran.</p>
                </div>
            </div>
            <div class="relative z-10 flex gap-4 text-blue-100/60 text-sm">
                <span>© <?= date('Y') ?> Distrik Navigasi Tanjungpinang</span>
            </div>
        </div>

        <div class="flex flex-col justify-center p-8 md:p-16">
            
            <div class="lg:hidden flex items-center gap-3 mb-10">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/e/e5/Logo_Kementerian_Perhubungan_Republik_Indonesia.png/600px-Logo_Kementerian_Perhubungan_Republik_Indonesia.png" alt="Logo Kemenhub" class="h-10 w-auto">
                <div>
                    <h2 class="text-primary font-bold text-xl tracking-tight">SIAD</h2>
                    <p class="text-slate-500 text-xs">Distrik Navigasi Tanjungpinang</p>
                </div>
            </div>
            
            <div class="mb-8">
                <h2 class="text-3xl font-bold text-slate-900 dark:text-white mb-2">Selamat Datang</h2>
                <p class="text-slate-500 dark:text-slate-400">Silakan masuk ke akun Anda untuk mengelola arsip.</p>
            </div>

            <?php if(session()->getFlashdata('error')): ?>
                <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 rounded-xl flex items-center gap-2 font-medium text-sm">
                    <span class="material-symbols-outlined">error</span>
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>
            <?php if(session()->getFlashdata('success')): ?>
                <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-xl flex items-center gap-2 font-medium text-sm">
                    <span class="material-symbols-outlined">check_circle</span>
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>

            <form action="<?= base_url('login/auth') ?>" method="POST" class="space-y-6">
                <?= csrf_field() ?>
                
                <div>
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">NIP / Username / Email</label>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">person</span>
                        <input name="login_id" required class="w-full pl-12 pr-4 py-4 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition-all text-slate-900 dark:text-white" placeholder="Masukkan NIP, username, atau email" type="text" autocomplete="off"/>
                    </div>
                </div>
                
                <div>
                    <div class="flex justify-between mb-2">
                        <label class="text-sm font-semibold text-slate-700 dark:text-slate-300">Password</label>
                        <a class="text-sm font-semibold text-primary hover:text-primary/80 transition-colors" href="<?= base_url('forgot-password') ?>">Lupa Password?</a>
                    </div>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">lock</span>
                        <input name="password" required id="passwordInput" class="w-full pl-12 pr-12 py-4 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition-all text-slate-900 dark:text-white" placeholder="Masukkan password" type="password"/>
                        
                        <button class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 focus:outline-none" type="button" onclick="togglePassword()">
                            <span class="material-symbols-outlined" id="eyeIcon">visibility</span>
                        </button>
                    </div>
                </div>
                
                <button class="w-full bg-primary hover:bg-primary/90 text-white font-bold py-4 rounded-xl shadow-lg shadow-primary/20 transition-all transform active:scale-[0.98] flex items-center justify-center gap-2" type="submit">
                    Masuk ke Aplikasi
                    <span class="material-symbols-outlined">login</span>
                </button>
            </form>

            <div class="mt-12 pt-8 border-t border-slate-100 dark:border-slate-800">
                <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                    <div class="flex items-center gap-2 text-slate-500 dark:text-slate-400 text-xs">
                        <span class="material-symbols-outlined text-sm">location_on</span>
                        <span>Jl. Ahmad Yani No. 1, Tanjungpinang, Kepulauan Riau</span>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>

<footer class="py-6 px-4 text-center">
    <p class="text-slate-500 dark:text-slate-500 text-xs uppercase tracking-widest font-semibold">
        Kementerian Perhubungan RI • Direktorat Jenderal Perhubungan Laut
    </p>
</footer>

<script>
    // Logika menampilkan atau menyembunyikan password
    function togglePassword() {
        var pwd = document.getElementById("passwordInput");
        var icon = document.getElementById("eyeIcon");
        if (pwd.type === "password") {
            pwd.type = "text";
            icon.textContent = "visibility_off";
        } else {
            pwd.type = "password";
            icon.textContent = "visibility";
        }
    }
</script>

</body>
</html>