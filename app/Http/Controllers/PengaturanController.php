<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaturan;

class PengaturanController extends Controller
{
    public function index()
    {
        $pengaturan = Pengaturan::first();
        if (!$pengaturan) {
            $pengaturan = Pengaturan::create([
                'nama_toko' => 'Rafa Kasir',
                'alamat' => 'Alamat Belum Diatur',
                'telepon' => '-',
                'footer_struk' => 'Terima Kasih Telah Berbelanja',
            ]);
        }
        return view('pengaturan.index', compact('pengaturan'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'nama_toko' => 'required',
            'alamat' => 'required',
            'telepon' => 'required',
            'footer_struk' => 'required',
        ]);

        $pengaturan = Pengaturan::first();
        $pengaturan->update($request->all());

        return back()->with('success', 'Pengaturan toko berhasil diperbarui.');
    }
}
