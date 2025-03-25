<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    // $adminRole = Role::firstOrCreate(['name' => 'admin']);
    // $siswaRole = Role::firstOrCreate(['name' => 'siswa']);

    // Daftar permission yang ingin ditambahkan
    // $permissions = [
    //     'manage users',
    //     'create lowongan pekerjaan',
    //     'edit lowongan pekerjaan',
    //     'delete lowongan pekerjaan',
    //     'create jurusan',
    //     'edit jurusan',
    //     'delete jurusan',
    //     'create tipe lowongan pekerjaan',
    //     'edit tipe lowongan pekerjaan',
    //     'delete tipe lowongan pekerjaan',
    //     'manage persyaratan berkas'
    // ];

    // foreach ($permissions as $permission) {
    //     Permission::firstOrCreate(['name' => $permission]);
    // }

    // $adminRole->syncPermissions(Permission::all());

    // $admin = User::where('email', 'admin@gmail.com')->first();
    // if (!$admin) {
        $admin = User::factory()->create([
            'nis' => '--',
            'name' => 'Admin2',
            'email' => 'admin2@gmail.com',
            'jurusan' => '-',
            'tahun_angkatan' => '-',
            'password' => bcrypt('password'),
            'no_telp' => '087822915777'
        ]);
    // }

    // if (!$admin->hasRole('admin')) {
        $admin->assignRole('admin');
    // }
    }
}
