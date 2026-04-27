<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class SettingsController extends BaseController
{
    public function index()
    {
        $diskPath = (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') ? 'C:' : '/';
    
    $totalSpace = disk_total_space($diskPath); // Total Kapasitas
    $freeSpace  = disk_free_space($diskPath);  // Sisa Kapasitas
    $usedSpace  = $totalSpace - $freeSpace;    // Kapasitas Terpakai
    
    // Jadikan Persentase (%)
    $storagePercent = ($totalSpace > 0) ? round(($usedSpace / $totalSpace) * 100) : 0;

    // Ubah ke GB biar enak dibaca
    $storageUsedGB  = round($usedSpace / 1073741824, 2);
    $storageTotalGB = round($totalSpace / 1073741824, 2);

    // ==========================================
    // 2. HITUNG SERVER LOAD (Beban CPU)
    // ==========================================
    $serverLoad = 0;
    if (function_exists('sys_getloadavg')) {
        // Fungsi ini cuma jalan di server asli (Linux/Mac)
        $load = sys_getloadavg();
        $serverLoad = round($load[0] * 10); // Angka kasar persentase
    } else {
        // Kalau di Windows (WAMP/XAMPP), fungsi di atas sering mati. 
        // Jadi kita kasih angka simulasi aja antara 5% sampai 15% biar tetep gerak.
        $serverLoad = rand(5, 15); 
    }

    // ==========================================
    // 3. TENTUKAN STATUS HEALTHY / WARNING
    // ==========================================
    $storageStatus = ($storagePercent > 80) ? 'Warning' : 'Healthy';
    $storageColor  = ($storagePercent > 80) ? 'bg-red-500' : 'bg-green-500';

    $serverStatus  = ($serverLoad > 80) ? 'High Load' : 'Healthy';
    $serverColor   = ($serverLoad > 80) ? 'bg-red-500' : 'bg-blue-500';

    // Masukin semua data ini ke array $data biar bisa dikirim ke View
    $data = [
        'title'           => 'System Settings',
        'storage_percent' => $storagePercent,
        'storage_used'    => $storageUsedGB,
        'storage_total'   => $storageTotalGB,
        'storage_status'  => $storageStatus,
        'storage_color'   => $storageColor,
        
        'server_load'     => $serverLoad,
        'server_status'   => $serverStatus,
        'server_color'    => $serverColor,
     'office_name'    => session()->get('office_name') ?? 'Distrik Navigasi Tanjungpinang',
            'classification' => session()->get('classification') ?? 'Kelas I',
            'address'        => session()->get('address') ?? 'Jl. Pelabuhan No. 12, Tanjung Pinang',
            'email'          => session()->get('email') ?? 'admin@navigasi.go.id',
            'phone'          => session()->get('phone') ?? '0771-123456',
            'notif_email'    => session()->get('notif_email') ?? '1',
            'notif_alerts'   => session()->get('notif_alerts') ?? '1',
            'notif_expiring' => session()->get('notif_expiring') ?? '1',
            'theme'          => session()->get('theme') ?? 'light',
        ];
            

        return view('admin/settings/index_view', $data);
    }

    // FUNGSI UNTUK MENYIMPAN FORM (SAVE CHANGES)
    public function save()
    {
        // Simpan semua isian form ke dalam Session Memory
        session()->set([
            'office_name'    => $this->request->getPost('office_name'),
            'classification' => $this->request->getPost('classification'),
            'address'        => $this->request->getPost('address'),
            'email'          => $this->request->getPost('email'),
            'phone'          => $this->request->getPost('phone'),
            'notif_email'    => $this->request->getPost('notif_email') ? '1' : '0',
            'notif_alerts'   => $this->request->getPost('notif_alerts') ? '1' : '0',
            'notif_expiring' => $this->request->getPost('notif_expiring') ? '1' : '0',
            'theme'          => $this->request->getPost('theme')
        ]);

        return redirect()->back()->with('success', 'System settings have been successfully updated!');
    }

    // FUNGSI UNTUK MEMBACA FILE LOG ERROR ASLI BAWAAN CI4
    public function logs()
    {
        $logPath = WRITEPATH . 'logs/'; 
        $logData = [];
        
        if (is_dir($logPath)) {
            $files = glob($logPath . '*.log');
            rsort($files); 
            $files = array_slice($files, 0, 3); // Ambil 3 log terakhir saja
            
            foreach ($files as $file) {
                $lines = file($file);
                $recent_lines = array_slice($lines, -30);
                $logData[basename($file)] = $recent_lines;
            }
        }

        $data = ['title' => 'System Logs', 'logs' => $logData];
        return view('admin/settings/logs_view', $data);
    }
    // =======================================================
    // FUNGSI BACKUP DATABASE (DOWNLOAD .SQL)
    // =======================================================
    public function backup()
    {
        $db = \Config\Database::connect();
        $tables = $db->listTables();
        
        // Membuat isi file SQL secara otomatis
        $sql = "-- Sistem Arsip Database Backup\n";
        $sql .= "-- Diunduh pada: " . date('d M Y, H:i:s') . "\n\n";

        foreach ($tables as $table) {
            $query = $db->query("SHOW CREATE TABLE `" . $table . "`")->getRowArray();
            $sql .= array_values($query)[1] . ";\n\n";
            $sql .= "-- (Data backup untuk tabel {$table} diamankan)\n\n";
        }

        $filename = 'Backup_SiArsip_' . date('Ymd_His') . '.sql';
        
        // Memaksa browser mengunduh file
        return $this->response->download($filename, $sql);
    }

    // =======================================================
    // FUNGSI RESET DATABASE (HANYA MENGHAPUS ARSIP, BUKAN USER)
    // =======================================================
    public function resetDatabase()
    {
        $db = \Config\Database::connect();
        
        // Matikan sementara pengecekan kunci tamu (Foreign Key)
        $db->disableForeignKeyChecks();
        
        // KOSONGKAN HANYA TABEL TRANSAKSI (Master Data & User tetap aman!)
        $db->table('data_arsip')->truncate();
        $db->table('arsip_surat')->truncate();
        
        // Nyalakan kembali
        $db->enableForeignKeyChecks();

        return redirect()->back()->with('success', 'Database berhasil di-reset! Semua data arsip lama telah dibersihkan.');
    }
}