<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUsersTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'       => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'name'     => ['type' => 'VARCHAR', 'constraint' => '100'],
            'username' => ['type' => 'VARCHAR', 'constraint' => '100', 'unique' => true],
            'email'    => ['type' => 'VARCHAR', 'constraint' => '100', 'unique' => true],
            'password' => ['type' => 'VARCHAR', 'constraint' => '255'],
            'role'     => ['type' => 'ENUM', 'constraint' => ['admin', 'user'], 'default' => 'user'],
            'status'   => ['type' => 'ENUM', 'constraint' => ['active', 'deactive'], 'default' => 'deactive'],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
