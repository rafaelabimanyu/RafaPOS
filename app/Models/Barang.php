<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Barang extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'kategori_id',
        'kategori', // keeping for legacy if needed, but primarily using kategori_id now
        'harga_beli',
        'harga_jual',
        'stok',
    ];

    public function kategori_rel()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    public function stoks()
    {
        return $this->hasMany(Stok::class);
    }

    public function details()
    {
        return $this->hasMany(DetailTransaksi::class);
    }
}
