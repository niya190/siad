<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SiArsip</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@400;600;800&display=swap" rel="stylesheet">
</head>
<body class="bg-slate-100 font-[Public_Sans] flex items-center justify-center min-h-screen p-4">

    <div class="bg-white rounded-2xl shadow-xl w-full max-w-md overflow-hidden">
        <div class="bg-blue-800 p-6 text-center text-white">
            <h1 class="text-2xl font-black tracking-tight">SiArsip Navigasi</h1>
            <p class="text-blue-200 text-sm mt-1">Masuk ke sistem manajemen arsip</p>
        </div>
        
        <div class="p-8">
            <?php if(session()->getFlashdata('error')): ?>
                <div class="mb-4 p-3 bg-red-100 text-red-700 text-sm rounded-lg font-semibold text-center"><?= session()->getFlashdata('error') ?></div>
            <?php endif; ?>
            <?php if(session()->getFlashdata('success')): ?>
                <div class="mb-4 p-3 bg-green-100 text-green-700 text-sm rounded-lg font-semibold text-center"><?= session()->getFlashdata('success') ?></div>
            <?php endif; ?>

            <form action="<?= base_url('login/auth') ?>" method="POST" class="space-y-5">
                <?= csrf_field() ?> 
                
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1">NIP / Username / Email</label>
                    <input type="text" name="login_id" required class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" placeholder="Masukkan ID Login...">
                </div>
                <div>
                    <div class="flex justify-between items-center mb-1">
                        <label class="block text-sm font-semibold text-slate-700">Password</label>
                        <a href="<?= base_url('forgot-password') ?>" class="text-xs text-blue-600 font-semibold hover:underline">Lupa Password?</a>
                    </div>
                    <input type="password" name="password" required class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" placeholder="••••••••">
                </div>
                <button type="submit" class="w-full bg-blue-700 text-white font-bold py-3 rounded-lg hover:bg-blue-800 transition-colors">LOGIN SEKARANG</button>
            </form>
            
            <p class="text-center text-sm text-slate-600 mt-6">Belum punya akun? <a href="<?= base_url('register') ?>" class="text-blue-700 font-bold hover:underline">Daftar di sini</a></p>
        </div>
    </div>

</body>
</html>