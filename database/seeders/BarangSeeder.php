<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Barang;

class BarangSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['nama' => 'Buku Tulis Sidu', 'kategori' => 'Alat Tulis', 'hb' => 3000, 'hj' => 4500],
            ['nama' => 'Pensil 2B Faber Castel', 'kategori' => 'Alat Tulis', 'hb' => 2000, 'hj' => 3500],
            ['nama' => 'Pulpen Snowman Black', 'kategori' => 'Alat Tulis', 'hb' => 1500, 'hj' => 2500],
            ['nama' => 'Penggaris 30cm', 'kategori' => 'Alat Tulis', 'hb' => 2000, 'hj' => 4000],
            ['nama' => 'Penghapus Joyko', 'kategori' => 'Alat Tulis', 'hb' => 500, 'hj' => 1500],
            ['nama' => 'Kertas A4 Sinar Dunia', 'kategori' => 'Kertas', 'hb' => 45000, 'hj' => 55000],
            ['nama' => 'Kertas F4 Sinar Dunia', 'kategori' => 'Kertas', 'hb' => 50000, 'hj' => 60000],
            ['nama' => 'Map Plastik Biru', 'kategori' => 'Arsip', 'hb' => 1500, 'hj' => 3000],
            ['nama' => 'Binder Clip Small', 'kategori' => 'Alat Tulis', 'hb' => 5000, 'hj' => 8000],
            ['nama' => 'Stapler Joyko HD-10', 'kategori' => 'Alat Tulis', 'hb' => 12000, 'hj' => 18000],
            ['nama' => 'Isi Staples No.10', 'kategori' => 'Alat Tulis', 'hb' => 1500, 'hj' => 2500],
            ['nama' => 'Gunting Besar', 'kategori' => 'Alat Tulis', 'hb' => 8000, 'hj' => 12000],
            ['nama' => 'Cutter Joyko', 'kategori' => 'Alat Tulis', 'hb' => 5000, 'hj' => 7500],
            ['nama' => 'Lem Kertas Glukol', 'kategori' => 'Alat Tulis', 'hb' => 2000, 'hj' => 4000],
            ['nama' => 'Double Tape 1 inch', 'kategori' => 'Alat Tulis', 'hb' => 4000, 'hj' => 7000],
            ['nama' => 'Lakban Hitam', 'kategori' => 'Alat Tulis', 'hb' => 7000, 'hj' => 10000],
            ['nama' => 'Stabilo Boss Yellow', 'kategori' => 'Alat Tulis', 'hb' => 8000, 'hj' => 11000],
            ['nama' => 'Correction Tape Joyko', 'kategori' => 'Alat Tulis', 'hb' => 4000, 'hj' => 7000],
            ['nama' => 'Spidol Boardmaker Black', 'kategori' => 'Alat Tulis', 'hb' => 6000, 'hj' => 9000],
            ['nama' => 'Tinta Spidol Snowman', 'kategori' => 'Alat Tulis', 'hb' => 15000, 'hj' => 20000],
        ];

        foreach ($data as $item) {
            Barang::create([
                'nama' => $item['nama'],
                'kategori' => $item['kategori'],
                'harga_beli' => $item['hb'],
                'harga_jual' => $item['hj'],
                'stok' => rand(10, 50),
            ]);
        }
    }
}
