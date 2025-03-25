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
    $adminRole = Role::firstOrCreate(['name' => 'admin']);
    $siswaRole = Role::firstOrCreate(['name' => 'siswa']);

    // Daftar permission yang ingin ditambahkan
    $permissions = [
        'manage users',
        'create lowongan pekerjaan',
        'edit lowongan pekerjaan',
        'delete lowongan pekerjaan',
        'create jurusan',
        'edit jurusan',
        'delete jurusan',
        'create tipe lowongan pekerjaan',
        'edit tipe lowongan pekerjaan',
        'delete tipe lowongan pekerjaan',
        'manage persyaratan berkas'
    ];

    // Loop untuk menambahkan permission tanpa duplikasi
    foreach ($permissions as $permission) {
        Permission::firstOrCreate(['name' => $permission]);
    }

    // Pastikan adminRole memiliki semua permission
    $adminRole->syncPermissions(Permission::all());

    // Cek apakah admin sudah ada, kalau belum, buat
    $admin = User::where('email', 'admin@gmail.com')->first();
    if (!$admin) {
        $admin = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
        ]);
    }

    // Pastikan admin memiliki role "admin"
    if (!$admin->hasRole('admin')) {
        $admin->assignRole($adminRole);
    }
    }
}
