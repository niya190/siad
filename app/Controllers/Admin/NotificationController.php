<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class NotificationController extends BaseController
{
    public function index()
    {
        // Simulasi Data Notifikasi (Bisa diganti dengan Query Database nanti)
        $notifications = [
            [
                'type' => 'warning',
                'icon' => 'report',
                'color' => 'amber',
                'title' => 'Unauthorized Access Attempt',
                'time' => 'Today, 10:45 AM',
                'message' => "A login attempt was detected from an unrecognized IP address (192.168.1.105) for user account 'admin_operator'.",
                'action_text' => 'View Details',
                'action_link' => '#'
            ],
            [
                'type' => 'info',
                'icon' => 'update',
                'color' => 'blue',
                'title' => 'System Update Available',
                'time' => 'Today, 09:12 AM',
                'message' => 'Version 2.4.0 is ready for deployment. This update includes performance improvements and new archive metadata fields.',
                'action_text' => 'View Details',
                'action_link' => '#'
            ],
            [
                'type' => 'success',
                'icon' => 'sync_saved_locally',
                'color' => 'emerald',
                'title' => 'Archive Sync Complete',
                'time' => 'Yesterday, 04:30 PM',
                'message' => 'Successfully synchronized 452 new archive files with the secondary backup server at Tanjungpinang Port HQ.',
                'action_text' => 'View Details',
                'action_link' => '#'
            ],
            [
                'type' => 'critical',
                'icon' => 'dangerous',
                'color' => 'red',
                'title' => 'Database Connection Lost',
                'time' => 'CRITICAL',
                'message' => 'Storage Node #4 (Archive Vault) failed to respond for 10 minutes. Automatic failover initiated but manual review is required.',
                'action_text' => 'Investigate',
                'action_link' => '#'
            ],
            [
                'type' => 'muted',
                'icon' => 'person_add',
                'color' => 'slate',
                'title' => 'New User Registered',
                'time' => 'May 20, 2024',
                'message' => "A new staff account has been created for 'Siti Aminah' (Archive Dept). Pending administrative approval.",
                'action_text' => 'Manage User',
                'action_link' => base_url('admin/user')
            ]
        ];

        $data = [
            'title' => 'System Notifications',
            'notifications' => $notifications
        ];

        return view('admin/notifications_view', $data);
    }
}