<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'beranda',
            'barang',
            'barangmasuk',
            'barangkeluar',
            'riwayattransaksibarang',
            'suplair',
            'satuanbarang',
            'merk',
            'jenisbarang',
            'user',
            'permission',
            'role',
            'suratjalan' // ⬅️ ini yang penting kamu tambahkan!
        ];

        foreach ($permissions as $permission) {
            \Spatie\Permission\Models\Permission::firstOrCreate(['name' => 'create-' . $permission]);
            \Spatie\Permission\Models\Permission::firstOrCreate(['name' => 'read-' . $permission]);
            \Spatie\Permission\Models\Permission::firstOrCreate(['name' => 'update-' . $permission]);
            \Spatie\Permission\Models\Permission::firstOrCreate(['name' => 'delete-' . $permission]);
        }
    }
}
