<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title><?= $title ?> - Admin SiArsip</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Fira+Code:wght@400;500;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <style>
        /* Menggunakan font Fira Code ala programmer */
        body { background-color: #0f172a; color: #38bdf8; font-family: 'Fira Code', monospace; }
        .log-container::-webkit-scrollbar { width: 8px; }
        .log-container::-webkit-scrollbar-track { background: #1e293b; }
        .log-container::-webkit-scrollbar-thumb { background: #475569; border-radius: 4px; }
    </style>
</head>
<body class="h-screen flex flex-col p-4 md:p-8">

    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-white flex items-center gap-3">
                <span class="material-symbols-outlined text-green-400">terminal</span> SERVER LOGS [CI4]
            </h1>
            <p class="text-xs text-slate-400 mt-1">C:\SiArsip\writable\logs\ >_ Tail -f system.log</p>
        </div>
        <a href="<?= base_url('admin/settings') ?>" class="px-4 py-2 bg-slate-800 text-white border border-slate-600 rounded hover:bg-slate-700 transition-colors text-sm font-bold flex items-center gap-2">
            <span class="material-symbols-outlined text-[18px]">close</span> TUTUP TERMINAL
        </a>
    </div>

    <div class="flex-1 bg-slate-900 border border-slate-700 rounded-lg p-6 overflow-hidden flex flex-col shadow-2xl shadow-blue-900/20">
        <div class="log-container overflow-y-auto flex-1 text-sm leading-relaxed space-y-6">
            
            <?php if(empty($logs)): ?>
                <div class="text-slate-500">// Tidak ada file log yang ditemukan di server saat ini.</div>
            <?php else: ?>
                <?php foreach($logs as $filename => $lines): ?>
                    <div>
                        <div class="text-yellow-400 font-bold border-b border-slate-700 pb-1 mb-2">=== FILE: <?= esc($filename) ?> ===</div>
                        <?php foreach($lines as $line): 
                            // Memberi warna khusus pada kata ERROR, WARNING, INFO
                            $line = esc($line);
                            if (strpos($line, 'ERROR') !== false) {
                                $line = '<span class="text-red-500 font-bold">' . $line . '</span>';
                            } elseif (strpos($line, 'WARNING') !== false) {
                                $line = '<span class="text-amber-500">' . $line . '</span>';
                            } elseif (strpos($line, 'INFO') !== false || strpos($line, 'DEBUG') !== false) {
                                $line = '<span class="text-green-400">' . $line . '</span>';
                            }
                        ?>
                            <div class="whitespace-pre-wrap break-all hover:bg-slate-800 p-1 rounded"><?= $line ?></div>
                        <?php endforeach; ?>
                    </div>
                <?php endforeach; ?>
                <div class="text-green-500 font-bold mt-4 animate-pulse">admin@siarsip:~$ _</div>
            <?php endif; ?>

        </div>
    </div>

</body>
</html>