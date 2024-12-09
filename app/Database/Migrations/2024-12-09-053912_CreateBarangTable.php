<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBarangTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => ['type' => 'INT', 'auto_increment' => true],
            'kode_barang' => ['type' => 'VARCHAR', 'constraint' => 10],
            'nama_barang' => ['type' => 'VARCHAR', 'constraint' => 100],
            'satuan'      => ['type' => 'VARCHAR', 'constraint' => 50],
            'harga'       => ['type' => 'DECIMAL', 'constraint' => '15,2'],
            'created_at'  => ['type' => 'DATETIME', 'null' => true],
            'updated_at'  => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('barang');
    }

    public function down()
    {
        $this->forge->dropTable('barang');
    }
}
