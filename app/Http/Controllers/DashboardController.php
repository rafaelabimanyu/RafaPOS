<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\User;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function admin()
    {
        $data = [
            'total_pendapatan' => Transaksi::sum('total_harga'),
            'jumlah_barang' => Barang::count(),
            'total_petugas' => User::where('role', 'petugas')->count(),
            'recent_sales' => Transaksi::with('user')->latest()->take(5)->get(),
        ];

        return view('admin.dashboard', $data);
    }

    public function petugas()
    {
        $user = Auth::user();
        $data = [
            'penjualan_hari_ini' => Transaksi::where('user_id', $user->id)
                ->whereDate('created_at', today())
                ->sum('total_harga'),
            'jumlah_transaksi' => Transaksi::where('user_id', $user->id)
                ->whereDate('created_at', today())
                ->count(),
            'recent_sales' => Transaksi::where('user_id', $user->id)->latest()->take(5)->get(),
        ];

        return view('petugas.dashboard', $data);
    }
}
