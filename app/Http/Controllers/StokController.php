<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stok;
use App\Models\Barang;
use Illuminate\Support\Facades\DB;

class StokController extends Controller
{
    public function index()
    {
        $stoks = Stok::with('barang')->latest()->get();
        $barangs = Barang::all();
        return view('stok.index', compact('stoks', 'barangs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|exists:barangs,id',
            'tipe' => 'required|in:masuk,keluar',
            'jumlah' => 'required|integer|min:1',
            'keterangan' => 'nullable|string',
        ]);

        DB::transaction(function () use ($request) {
            $barang = Barang::findOrFail($request->barang_id);
            
            if ($request->tipe === 'masuk') {
                $barang->increment('stok', $request->jumlah);
            } else {
                if ($barang->stok < $request->jumlah) {
                    throw new \Exception('Stok tidak mencukupi.');
                }
                $barang->decrement('stok', $request->jumlah);
            }

            Stok::create($request->all());
        });

        return back()->with('success', 'Data stok berhasil dicatat.');
    }
}
