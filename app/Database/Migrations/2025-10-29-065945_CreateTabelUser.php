<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTabelUser extends Migration
{
    public function up()
    {
        // Mendefinisikan kolom untuk tabel user
        $this->forge->addField([
            'id_user' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama_user' => [ // Username untuk login
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'unique'     => true,
            ],
            'password_hash' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'role' => [
                'type'       => 'ENUM',
                // UBAH DISINI: Sesuaikan dengan hierarki kantor navigasi
                'constraint' => ['admin', 'staf', 'pimpinan'], 
                'default'    => 'staf',
            ],
            'kode_peran' => [ 
                // UBAH DISINI: Bukan NIM/NIDN lagi, tapi NIP (Nomor Induk Pegawai)
                'type'       => 'VARCHAR',
                'constraint' => 20, // Cukup untuk NIP (biasanya 18 digit)
                'null'       => true, 
            ],
        ]);

        $this->forge->addKey('id_user', true);
        $this->forge->createTable('user');
    }

    public function down()
    {
        $this->forge->dropTable('user');
    }
}