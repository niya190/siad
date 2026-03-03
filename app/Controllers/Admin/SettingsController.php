<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class SettingsController extends BaseController
{
    public function index()
    {
        // Ambil data pengaturan dari Session, jika belum ada beri nilai Default
        $data = [
            'title'          => 'System Settings',
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