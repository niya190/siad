<?php

namespace App\Controllers;

use App\Models\ArsipModel;

class Validasi extends BaseController
{
    public function cek($token)
    {
        $model = new ArsipModel();
        // Cari surat berdasarkan Token Unik
        $surat = $model->where('token_validasi', $token)->first();

        if ($surat) {
            // TAMPILAN JIKA ASLI (Hijau)
            echo '
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <div style="font-family: Arial, sans-serif; text-align: center; padding: 20px; max-width: 600px; margin: auto;">
                <div style="border: 2px solid green; padding: 20px; border-radius: 10px; background-color: #f0fff4;">
                    <img src="https://img.icons8.com/color/96/verified-account.png" alt="Valid" style="width: 60px;">
                    <h2 style="color: green; margin: 10px 0;">✅ DOKUMEN ASLI</h2>
                    <p style="color: #555; font-size: 14px;">Tercatat Resmi di SIAD Navigasi</p>
                    <hr style="border: 0; border-top: 1px solid #ddd; margin: 20px 0;">
                    
                    <div style="text-align: left; background: #fff; padding: 15px; border-radius: 5px; border: 1px solid #eee;">
                        <p style="margin: 5px 0;"><b>Nomor Surat:</b><br> ' . esc($surat['nomor_surat']) . '</p>
                        <p style="margin: 5px 0;"><b>Perihal:</b><br> ' . esc($surat['perihal']) . '</p>
                        <p style="margin: 5px 0;"><b>Tanggal Surat:</b><br> ' . esc($surat['tanggal_surat']) . '</p>
                        <p style="margin: 5px 0;"><b>Status:</b><br> <span style="background:green; color:white; padding:3px 8px; border-radius:4px; font-size: 12px;">DISETUJUI SECARA ELEKTRONIK</span></p>
                    </div>
                    
                    <br>
                    <p style="font-size: 11px; color: grey;">Dokumen ini telah ditandatangani secara elektronik dan memiliki kekuatan hukum yang sah.</p>
                </div>
            </div>';
        } else {
            // TAMPILAN JIKA PALSU (Merah)
            echo '
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <div style="font-family: Arial, sans-serif; text-align: center; padding: 50px;">
                <img src="https://img.icons8.com/color/96/cancel.png" alt="Invalid" style="width: 80px;">
                <h2 style="color: red;">❌ TIDAK VALID</h2>
                <p>Maaf, QR Code ini tidak dikenali oleh sistem kami.<br>Mohon waspada terhadap dokumen palsu.</p>
            </div>';
        }
    }
}