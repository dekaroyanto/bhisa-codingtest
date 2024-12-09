<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTransaksiTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'             => ['type' => 'INT', 'auto_increment' => true],
            'no_faktur'      => ['type' => 'VARCHAR', 'constraint' => 20],
            'tanggal'        => ['type' => 'DATE'],
            'nama_perusahaan'   => ['type' => 'VARCHAR', 'constraint' => 100],
            'nama_up'   => ['type' => 'VARCHAR', 'constraint' => 100],
            'alamat_perusahaan' => ['type' => 'TEXT', 'null' => true],
            'nama_purchasing'   => ['type' => 'VARCHAR', 'constraint' => 100],
            'created_at'     => ['type' => 'DATETIME', 'null' => true],
            'updated_at'     => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('transaksi');
    }

    public function down()
    {
        $this->forge->dropTable('transaksi');
    }
}
