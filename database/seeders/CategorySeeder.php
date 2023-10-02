<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            [
                'name' => 'Alat Tulis',
                'icon' => 'https://ik.imagekit.io/Lazuardi/PermintaanBarang/alatTulis.png?updatedAt=1691276046323',
                'color' => '0093DD',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Non Alat Tulis',
                'icon' => 'https://ik.imagekit.io/Lazuardi/PermintaanBarang/kursi.png?updatedAt=1691276046301',
                'color' => 'EB891B',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Elektronik',
                'icon' => 'https://ik.imagekit.io/Lazuardi/PermintaanBarang/elektronik.png?updatedAt=1691276046367',
                'color' => 'EB891B',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Lainnya',
                'icon' => 'https://ik.imagekit.io/Lazuardi/PermintaanBarang/lainnya.png?updatedAt=1691276046295',
                'color' => '0093DD',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
