<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = array(
            array('nama' => 'Pelanggan'),
            array('nama' => 'Admin'),
        );

        // Insert data ke dalam tabel "roles"
        Role::insert($roles);
    }
}
