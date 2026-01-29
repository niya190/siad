<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTabelNotaDinas extends Migration
{
    public function up()
    {
        // Mendefinisikan kolom untuk tabel nota_dinas
        $this->forge->addField([
            'id_nota' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nomor_nota' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true, // Bisa kosong jika masih Draft
            ],
            'perihal' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'sifat' => [
                'type'       => 'ENUM',
                'constraint' => ['Biasa', 'Segera', 'Sangat Segera', 'Rahasia'],
                'default'    => 'Biasa',
            ],
            'tujuan_disposisi' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'comment'    => 'Jabatan atau Divisi tujuan (Misal: Kepala Kantor)',
            ],
            'isi_nota' => [
                'type' => 'TEXT',
            ],
            'file_lampiran' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'id_pembuat' => [
                'type'       => 'INT',
                'constraint' => 5,
                'unsigned'   => true,
                'comment'    => 'Relasi ke tabel user (Staf yang buat)',
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['Draft', 'Diajukan', 'Disetujui', 'Revisi', 'Ditolak'],
                'default'    => 'Draft',
            ],
            'catatan_revisi' => [ // Jika pimpinan minta revisi
                'type'       => 'TEXT',
                'null'       => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        // Primary Key
        $this->forge->addKey('id_nota', true);

        // Foreign Key: id_pembuat nyambung ke id_user di tabel user
        // CASCADE: Jika user dihapus, notanya ikut terhapus (opsional)
        $this->forge->addForeignKey('id_pembuat', 'user', 'id_user', 'CASCADE', 'CASCADE');

        // Eksekusi pembuatan tabel
        $this->forge->createTable('nota_dinas');
    }

    public function down()
    {
        $this->forge->dropTable('nota_dinas');
    }
}