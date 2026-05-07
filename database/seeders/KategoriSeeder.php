<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kategori;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Alat Tulis Kantor',
            'Kertas & Buku',
            'Perlengkapan',
            'Aksesoris'
        ];

        foreach ($categories as $cat) {
            Kategori::create(['nama' => $cat]);
        }
    }
}
