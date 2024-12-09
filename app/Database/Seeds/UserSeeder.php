<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name'     => 'Admin User',
                'username' => 'admin',
                'email'    => 'admin@gmail.com',
                'password' => password_hash('admin', PASSWORD_BCRYPT),
            ]
        ];

        $this->db->table('users')->insertBatch($data);
    }
}
