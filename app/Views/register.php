<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - SiArsip</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@400;600;800&display=swap" rel="stylesheet">
</head>
<body class="bg-slate-100 font-[Public_Sans] flex items-center justify-center min-h-screen p-4">

    <div class="bg-white rounded-2xl shadow-xl w-full max-w-lg overflow-hidden">
        <div class="bg-blue-800 p-6 text-center text-white">
            <h1 class="text-2xl font-black tracking-tight">Buat Akun Staf</h1>
            <p class="text-blue-200 text-sm mt-1">Daftarkan diri Anda untuk mengakses sistem</p>
        </div>
        
        <div class="p-8">
            <?php if(session()->getFlashdata('error')): ?>
                <div class="mb-4 p-3 bg-red-100 text-red-700 text-sm rounded-lg font-semibold text-center"><?= session()->getFlashdata('error') ?></div>
            <?php endif; ?>

            <form action="<?= base_url('register/process') ?>" method="POST" class="space-y-4">
                <?= csrf_field() ?> 
                
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">NIP Pegawai</label>
                        <input type="text" name="nip" required class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Username</label>
                        <input type="text" name="username" required class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1">Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" required class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1">Alamat Email</label>
                    <input type="email" name="email" required class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1">Password</label>
                    <input type="password" name="password" required class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>
                
                <button type="submit" class="w-full bg-blue-700 text-white font-bold py-3 rounded-lg hover:bg-blue-800 transition-colors mt-2">DAFTAR SEKARANG</button>
            </form>
            
            <p class="text-center text-sm text-slate-600 mt-6">Sudah punya akun? <a href="<?= base_url('/') ?>" class="text-blue-700 font-bold hover:underline">Masuk di sini</a></p>
        </div>
    </div>

</body>
</html>