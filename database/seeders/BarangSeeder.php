<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Barang;
use App\Models\Kategori;

class BarangSeeder extends Seeder
{
    public function run(): void
    {
        $kategoris = Kategori::all();
        
        $data = [
            ['nama' => 'Buku Tulis Sidu', 'hb' => 3000, 'hj' => 4500],
            ['nama' => 'Pensil 2B Faber Castel', 'hb' => 2000, 'hj' => 3500],
            ['nama' => 'Pulpen Snowman Black', 'hb' => 1500, 'hj' => 2500],
            ['nama' => 'Penggaris 30cm', 'hb' => 2000, 'hj' => 4000],
            ['nama' => 'Penghapus Joyko', 'hb' => 500, 'hj' => 1500],
            ['nama' => 'Kertas A4 Sinar Dunia', 'hb' => 45000, 'hj' => 55000],
            ['nama' => 'Kertas F4 Sinar Dunia', 'hb' => 50000, 'hj' => 60000],
            ['nama' => 'Map Plastik Biru', 'hb' => 1500, 'hj' => 3000],
            ['nama' => 'Binder Clip Small', 'hb' => 5000, 'hj' => 8000],
            ['nama' => 'Stapler Joyko HD-10', 'hb' => 12000, 'hj' => 18000],
            ['nama' => 'Isi Staples No.10', 'hb' => 1500, 'hj' => 2500],
            ['nama' => 'Gunting Besar', 'hb' => 8000, 'hj' => 12000],
            ['nama' => 'Cutter Joyko', 'hb' => 5000, 'hj' => 7500],
            ['nama' => 'Lem Kertas Glukol', 'hb' => 2000, 'hj' => 4000],
            ['nama' => 'Double Tape 1 inch', 'hb' => 4000, 'hj' => 7000],
            ['nama' => 'Lakban Hitam', 'hb' => 7000, 'hj' => 10000],
            ['nama' => 'Stabilo Boss Yellow', 'hb' => 8000, 'hj' => 11000],
            ['nama' => 'Correction Tape Joyko', 'hb' => 4000, 'hj' => 7000],
            ['nama' => 'Spidol Boardmaker Black', 'hb' => 6000, 'hj' => 9000],
            ['nama' => 'Tinta Spidol Snowman', 'hb' => 15000, 'hj' => 20000],
        ];

        foreach ($data as $item) {
            Barang::create([
                'nama' => $item['nama'],
                'kategori_id' => $kategoris->random()->id,
                'harga_beli' => $item['hb'],
                'harga_jual' => $item['hj'],
                'stok' => rand(10, 50),
            ]);
        }
    }
}
