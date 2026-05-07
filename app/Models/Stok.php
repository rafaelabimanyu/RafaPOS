<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Stok extends Model
{
    use HasFactory;

    protected $fillable = [
        'barang_id',
        'tipe',
        'jumlah',
        'keterangan',
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}
