<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Barang extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'kategori',
        'harga_beli',
        'harga_jual',
        'stok',
    ];

    public function stoks()
    {
        return $this->hasMany(Stok::class);
    }

    public function details()
    {
        return $this->hasMany(DetailTransaksi::class);
    }
}
