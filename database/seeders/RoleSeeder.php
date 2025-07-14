<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'admin-pertamina',
            'admin-distributor',
        ];

        foreach ($data as $role) {
            \Spatie\Permission\Models\Role::create(['name' => $role]);
        }

        $adminPertamina = [
            'nama' => 'admin-pertamina',
            'photo' => 'https://images.unsplash.com/photo-1595476108010-b4d1f102b1b1?ixlib=rb-1.2.1&auto=format&fit=crop&w=634&q=80',
            'email' => 'admin@pertamina.com',
            'password' => bcrypt('password'),
            'jenis_kelamin' => 'L',
            'tanggal_lahir' => now(),
            'alamat' => 'Jl. Pertamina No. 1',
            'no_telephone' => '081234567890',
            'status_registrasi' => 'Berhasil',
        ];

        $adminDistributor = [
            'nama' => 'admin-distributor',
            'photo' => 'https://images.unsplash.com/photo-1519699047748-de8e457a634e?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80',
            'email' => 'distributor@pertamina.com',
            'password' => bcrypt('password'),
            'jenis_kelamin' => 'L',
            'tanggal_lahir' => now(),
            'alamat' => 'Jl. Distributor No. 1',
            'no_telephone' => '081234567891',
            'status_registrasi' => 'Berhasil',
        ];

        $userPertamina = \App\Models\User::create($adminPertamina);
        $userDistributor = \App\Models\User::create($adminDistributor);

        $userPertamina->assignRole('admin-pertamina');
        $userDistributor->assignRole('admin-distributor');
    }
}
