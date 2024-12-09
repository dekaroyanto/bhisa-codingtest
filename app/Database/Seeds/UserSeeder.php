<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name'     => 'Admin Boy',
                'username' => 'admin',
                'email'    => 'admin@gmail.com',
                'password' => password_hash('admin', PASSWORD_BCRYPT),
                'role'     => 'admin',
                'status'   => 'active'
            ],
            [
                'name'     => 'User Cuy',
                'username' => 'user',
                'email'    => 'user@gmail.com',
                'password' => password_hash('user', PASSWORD_BCRYPT),
                'role'     => 'user',
                'status'   => 'deactive'
            ]
        ];

        $this->db->table('users')->insertBatch($data);
    }
}
