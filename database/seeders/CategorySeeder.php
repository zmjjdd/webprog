<?php

namespace Database\Seeders;

use App\Models\Category; // Pastikan model Category sudah ada
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Menambahkan beberapa kategori contoh
        Category::create([
            'name' => 'Fashion',
            'description' => 'Pakaian, Sepatu, Aksesoris'
        ]);

        Category::create([
            'name' => 'Elektronik',
            'description' => 'Gadget, Komputer, Alat Elektronik'
        ]);

        Category::create([
            'name' => 'Aksesoris',
            'description' => 'Aksesoris untuk Pakaian dan Elektronik'
        ]);

        Category::create([
            'name' => 'Kesehatan',
            'description' => 'Produk Kesehatan dan Kecantikan'
        ]);
    }
}
