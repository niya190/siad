<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class NotificationController extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();
        
        // Mengambil 50 Riwayat Arsip Terbaru beserta nama yang menginput
        $builder = $db->table('data_arsip');
        $builder->select('data_arsip.*, users.nama_lengkap');
        $builder->join('users', 'users.id_user = data_arsip.id_petugas', 'left');
        $builder->orderBy('data_arsip.created_at', 'DESC');
        $builder->limit(50);
        $logs = $builder->get()->getResultArray();

        $data = [
            'title' => 'Log Aktivitas Sistem',
            'logs'  => $logs
        ];

        // Tampilkan ke halaman View
        return view('admin/notifications_view', $data);
    }
}