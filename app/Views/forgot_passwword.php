<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password - SiArsip</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@400;600;800&display=swap" rel="stylesheet">
</head>
<body class="bg-slate-100 font-[Public_Sans] flex items-center justify-center min-h-screen p-4">

    <div class="bg-white rounded-2xl shadow-xl w-full max-w-md overflow-hidden">
        <div class="bg-blue-800 p-6 text-center text-white">
            <h1 class="text-2xl font-black tracking-tight">Lupa Password?</h1>
            <p class="text-blue-200 text-sm mt-1">Kami akan mengirimkan link reset ke email Anda</p>
        </div>
        
        <div class="p-8">
            <?php if(session()->getFlashdata('error')): ?>
                <div class="mb-4 p-3 bg-red-100 text-red-700 text-sm rounded-lg font-semibold text-center"><?= session()->getFlashdata('error') ?></div>
            <?php endif; ?>

            <form action="<?= base_url('forgot-password/process') ?>" method="POST" class="space-y-5">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1">Email Terdaftar</label>
                    <input type="email" name="email" required class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" placeholder="Masukkan email Anda...">
                </div>
                
                <button type="submit" class="w-full bg-orange-500 text-white font-bold py-3 rounded-lg hover:bg-orange-600 transition-colors">KIRIM LINK RESET</button>
            </form>
            
            <div class="text-center mt-6">
                <a href="<?= base_url('/') ?>" class="text-sm text-blue-700 font-bold hover:underline">&laquo; Kembali ke halaman Login</a>
            </div>
        </div>
    </div>

</body>
</html>