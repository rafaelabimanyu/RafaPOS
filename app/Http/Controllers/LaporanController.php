<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use App\Models\Barang;
use App\Models\Stok;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function index()
    {
        // Data untuk Grafik Tren Pendapatan (7 Hari Terakhir)
        $revenueTrend = Transaksi::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('SUM(total_akhir) as total')
        )
        ->where('created_at', '>=', now()->subDays(7))
        ->groupBy('date')
        ->orderBy('date')
        ->get();

        // Data untuk Diagram Pie (Top 5 Barang Laris)
        $topBarangs = DetailTransaksi::select('barangs.nama', DB::raw('SUM(detail_transaksis.jumlah) as total_qty'))
            ->join('barangs', 'detail_transaksis.barang_id', '=', 'barangs.id')
            ->groupBy('barangs.id', 'barangs.nama')
            ->orderBy('total_qty', 'DESC')
            ->take(5)
            ->get();

        $transaksis = Transaksi::with('user')->latest()->take(50)->get();

        return view('laporan.index', compact('revenueTrend', 'topBarangs', 'transaksis'));
    }

    public function exportExcel()
    {
        $transaksis = Transaksi::with('user')->get();
        
        $filename = "laporan_penjualan_" . date('Y-m-d') . ".csv";
        $handle = fopen('php://output', 'w');
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        fputcsv($handle, ['ID', 'Kode Transaksi', 'Petugas', 'Total Harga', 'Diskon', 'Total Akhir', 'Bayar', 'Kembalian', 'Waktu']);

        foreach ($transaksis as $t) {
            fputcsv($handle, [
                $t->id,
                $t->kode_transaksi,
                $t->user->name,
                $t->total_harga,
                $t->diskon,
                $t->total_akhir,
                $t->bayar,
                $t->kembalian,
                $t->created_at
            ]);
        }

        fclose($handle);
        exit;
    }

    public function printPdf()
    {
        $transaksis = Transaksi::with('user')->latest()->get();
        return view('laporan.print', compact('transaksis'));
    }
}
