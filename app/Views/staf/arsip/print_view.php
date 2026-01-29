<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kartu Arsip Digital</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 11pt; }
        .header { text-align: center; border-bottom: 3px double #000; padding-bottom: 10px; margin-bottom: 20px; }
        .header h2 { margin: 0; font-size: 14pt; }
        .header p { margin: 0; font-size: 10pt; }
        
        .box-lokasi {
            border: 2px solid #000;
            background-color: #f0f0f0;
            padding: 15px;
            text-align: center;
            margin: 20px 0;
        }
        .lokasi-text { font-size: 16pt; font-weight: bold; text-transform: uppercase; }
        
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        td { padding: 8px; vertical-align: top; }
        .label { width: 180px; font-weight: bold; }
        .titik { width: 10px; }
        
        .footer { margin-top: 50px; text-align: right; font-size: 10pt; }
    </style>
</head>
<body>

    <div class="header">
        <h2>KANTOR DISTRIK NAVIGASI TIPE A KELAS I TANJUNG PINANG</h2>
        <p>SISTEM INFORMASI ARSIP DIGITAL (SIAD)</p>
    </div>

    <center>
        <h3 style="text-decoration: underline;">KARTU KENDALI ARSIP</h3>
        <span>ID Arsip: #<?= $arsip['id_arsip'] ?></span>
    </center>

    <div class="box-lokasi">
        <div>LOKASI PENYIMPANAN FISIK:</div>
        <div class="lokasi-text"><?= $arsip['lokasi_penyimpanan'] ?></div>
    </div>

    <table>
        <tr>
            <td class="label">Jenis Arsip</td>
            <td class="titik">:</td>
            <td><?= $arsip['jenis_arsip'] ?></td>
        </tr>
        <tr>
            <td class="label">Nomor Surat</td>
            <td class="titik">:</td>
            <td><strong><?= $arsip['nomor_surat'] ?></strong></td>
        </tr>
        <tr>
            <td class="label">Tanggal Surat</td>
            <td class="titik">:</td>
            <td><?= date('d F Y', strtotime($arsip['tanggal_surat'])) ?></td>
        </tr>
        <tr>
            <td class="label">Tanggal Terima/Input</td>
            <td class="titik">:</td>
            <td><?= date('d F Y', strtotime($arsip['tanggal_terima'])) ?></td>
        </tr>
        <tr>
            <td class="label">Pengirim / Tujuan</td>
            <td class="titik">:</td>
            <td><?= $arsip['pengirim_tujuan'] ?></td>
        </tr>
        <tr>
            <td class="label">Perihal / Isi</td>
            <td class="titik">:</td>
            <td><?= nl2br($arsip['perihal']) ?></td>
        </tr>
        <tr>
            <td class="label">Keterangan</td>
            <td class="titik">:</td>
            <td><?= $arsip['keterangan'] ? $arsip['keterangan'] : '-' ?></td>
        </tr>
        <tr>
            <td class="label">Perihal / Isi</td>
            <td class="titik">:</td>
            <td><?= nl2br($arsip['perihal']) ?></td>
        </tr>
        
        <tr>
            <td class="label">Status / Ket</td>
            <td class="titik">:</td>
            <td style="text-transform: uppercase; font-weight: bold; color: #d9534f;">
                <?= $arsip['keterangan'] ? $arsip['keterangan'] : '-' ?>
            </td>
        </tr>
        ```

---

### 3. Update Form Input (Biar User Gampang Milih)
Daripada ngetik manual "Segera", mending kita kasih pilihan (Dropdown) biar rapi.

**File:** `app/Views/staf/arsip/create_view.php`
Cari bagian input `keterangan`, ganti dengan ini:

```php
<div class="col-md-6">
    <div class="form-group">
        <label>Status / Keterangan</label>
        <select name="keterangan" class="form-control">
            <option value="Asli">Dokumen Asli</option>
            <option value="Fotokopi">Salinan / Fotokopi</option>
            <option value="Segera">Segera Ditindaklanjuti</option>
            <option value="Rahasia">Rahasia</option>
            <option value="Arsip Biasa">Arsip Biasa</option>
        </select>
    </div>
</div>
    </table>

    <div class="footer">
        <p>Dicetak pada: <?= date('d/m/Y H:i') ?></p>
        <br><br><br>
        <p>Petugas Arsip,<br><b><?= esc($petugas['nama_user'] ?? 'Admin') ?></b></p>
    </div>

</body>
</html>