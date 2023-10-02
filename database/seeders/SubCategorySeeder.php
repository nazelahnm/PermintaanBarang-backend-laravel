<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subcategories')->insert([
            // Kategori: Alat Tulis
            [
                'categoryId' => 1,
                'name' => 'Kertas',
                'icon' => 'https://ik.imagekit.io/Lazuardi/PermintaanBarang/alatTulis.png?updatedAt=1691276046323',
                'color' => '0093DD',
                'unit' => 'Rim',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'categoryId' => 1,
                'name' => 'Tinta',
                'icon' => 'https://ik.imagekit.io/Lazuardi/PermintaanBarang/tinta.png?updatedAt=1691276051873',
                'color' => '68B92E',
                'unit' => 'Set',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'categoryId' => 1,
                'name' => 'Map',
                'icon' => 'https://ik.imagekit.io/Lazuardi/PermintaanBarang/map.png?updatedAt=1691276046302',
                'color' => 'EB891B',
                'unit' => 'Biji',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'categoryId' => 1,
                'name' => 'Amplop',
                'icon' => 'https://ik.imagekit.io/Lazuardi/PermintaanBarang/amplop.png?updatedAt=1691276046336',
                'color' => '0093DD',
                'unit' => 'Biji',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'categoryId' => 1,
                'name' => 'Klip',
                'icon' => 'https://ik.imagekit.io/Lazuardi/PermintaanBarang/klip.png?updatedAt=1691276046376',
                'color' => '68B92E',
                'unit' => 'Biji',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'categoryId' => 1,
                'name' => 'Stapler',
                'icon' => 'https://ik.imagekit.io/Lazuardi/PermintaanBarang/fa6-solid_stapler.png?updatedAt=1691752933714',
                'color' => 'EB891B',
                'unit' => 'Set',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'categoryId' => 1,
                'name' => 'Bolpoin, Pensil, dll',
                'icon' => 'https://ik.imagekit.io/Lazuardi/PermintaanBarang/fluent_pen-24-filled.png?updatedAt=1691753184338',
                'color' => '0093DD',
                'unit' => 'Biji',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'categoryId' => 1,
                'name' => 'Lainnya',
                'unit' => null,
                'icon' => 'https://ik.imagekit.io/Lazuardi/PermintaanBarang/other.png?updatedAt=1691276051871',
                'color' => '68B92E',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Kategori: Non Alat Tulis
            [
                'categoryId' => 2,
                'name' => 'Kursi',
                'unit' => 'Buah',
                'icon' => 'https://ik.imagekit.io/Lazuardi/PermintaanBarang/kursi.png?updatedAt=1691276046301',
                'color' => '0093DD',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'categoryId' => 2,
                'name' => 'Galon',
                'unit' => 'Buah',
                'icon' => 'https://ik.imagekit.io/Lazuardi/PermintaanBarang/galon.png?updatedAt=1691276046336',
                'color' => '68B92E',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'categoryId' => 2,
                'name' => 'Air Mineral Gelas',
                'unit' => 'Buah',
                'icon' => 'https://ik.imagekit.io/Lazuardi/PermintaanBarang/air.png?updatedAt=1691276046382',
                'color' => 'EB891B',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'categoryId' => 2,
                'name' => 'Tisu',
                'unit' => 'Buah',
                'icon' => 'https://ik.imagekit.io/Lazuardi/PermintaanBarang/tisu.png?updatedAt=1691276052244',
                'color' => '0093DD',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'categoryId' => 2,
                'name' => 'Lainnya',
                'unit' => 'Buah',
                'icon' => 'https://ik.imagekit.io/Lazuardi/PermintaanBarang/other.png?updatedAt=1691276051871',
                'color' => '68B92E',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Kategori: Elektronik
            [
                'categoryId' => 3,
                'name' => 'Kabel LAN',
                'unit' => 'Set',
                'icon' => 'https://ik.imagekit.io/Lazuardi/PermintaanBarang/image%2021.png?updatedAt=1691497882626',
                'color' => '0093DD',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'categoryId' => 3,
                'name' => 'Kabel Roll',
                'unit' => 'Buah',
                'icon' => 'https://ik.imagekit.io/Lazuardi/PermintaanBarang/kabel.png?updatedAt=1691276046582',
                'color' => '68B92E',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'categoryId' => 3,
                'name' => 'Lampu',
                'unit' => 'Buah',
                'icon' => 'https://ik.imagekit.io/Lazuardi/PermintaanBarang/tabler_bulb-filled.png?updatedAt=1691497882397',
                'color' => 'EB891B',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'categoryId' => 3,
                'name' => 'Baterai',
                'unit' => 'Buah',
                'icon' => 'https://ik.imagekit.io/Lazuardi/PermintaanBarang/entypo_battery.png?updatedAt=1691497882433',
                'color' => '0093DD',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'categoryId' => 3,
                'name' => 'Lainnya',
                'unit' => 'Set',
                'icon' => 'https://ik.imagekit.io/Lazuardi/PermintaanBarang/other.png?updatedAt=1691276051871',
                'color' => '68B92E',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Kategori: Others
            [
                'categoryId' => 4,
                'name' => 'Lainnya',
                'unit' => null,
                'icon' => 'https://ik.imagekit.io/Lazuardi/PermintaanBarang/other.png?updatedAt=1691276051871',
                'color' => '68B92E',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
