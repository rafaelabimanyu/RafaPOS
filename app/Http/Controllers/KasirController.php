<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class KasirController extends Controller
{
    public function index()
    {
        $barangs = Barang::where('stok', '>', 0)->get();
        return view('kasir.index', compact('barangs'));
    }

    public function process(Request $request)
    {
        $request->validate([
            'items' => 'required|array|min:1',
            'bayar' => 'required|numeric|min:0',
            'total_harga' => 'required|numeric|min:0',
        ]);

        if ($request->bayar < $request->total_harga) {
            return back()->with('error', 'Pembayaran tidak cukup.');
        }

        try {
            DB::beginTransaction();

            $transaksi = Transaksi::create([
                'user_id' => Auth::id(),
                'kode_transaksi' => 'TRX-' . strtoupper(Str::random(8)),
                'total_harga' => $request->total_harga,
                'bayar' => $request->bayar,
                'kembalian' => $request->bayar - $request->total_harga,
            ]);

            foreach ($request->items as $item) {
                $barang = Barang::findOrFail($item['id']);
                
                if ($barang->stok < $item['jumlah']) {
                    throw new \Exception("Stok {$barang->nama} tidak mencukupi.");
                }

                $barang->decrement('stok', $item['jumlah']);

                DetailTransaksi::create([
                    'transaksi_id' => $transaksi->id,
                    'barang_id' => $barang->id,
                    'jumlah' => $item['jumlah'],
                    'harga_satuan' => $item['harga'],
                    'subtotal' => $item['jumlah'] * $item['harga'],
                ]);
            }

            DB::commit();
            return redirect()->route('petugas.dashboard')->with('success', 'Transaksi berhasil diproses! Kode: ' . $transaksi->kode_transaksi);

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal memproses transaksi: ' . $e->getMessage());
        }
    }
}
