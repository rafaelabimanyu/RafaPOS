<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan - Rafa Kasir</title>
    <style>
        body { font-family: 'Inter', sans-serif; font-size: 12px; color: #333; margin: 40px; }
        .header { text-align: center; margin-bottom: 40px; }
        .header h1 { margin: 0; color: #7ed9b1; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #eee; padding: 10px; text-align: left; }
        th { bg-color: #f9f9f9; font-weight: bold; }
        .total-row { font-weight: bold; background: #f0fff4; }
        .footer { margin-top: 50px; text-align: right; }
        @media print {
            .no-print { display: none; }
        }
    </style>
</head>
<body onload="window.print()">
    <div class="header">
        <h1>Rafa Kasir</h1>
        <p>Laporan Penjualan Keseluruhan</p>
        <p>Tanggal Cetak: {{ date('d F Y H:i') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode</th>
                <th>Petugas</th>
                <th>Total</th>
                <th>Diskon</th>
                <th>Total Akhir</th>
                <th>Waktu</th>
            </tr>
        </thead>
        <tbody>
            @php $totalSemua = 0; @endphp
            @foreach($transaksis as $index => $t)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $t->kode_transaksi }}</td>
                <td>{{ $t->user->name }}</td>
                <td>Rp {{ number_format($t->total_harga, 0, ',', '.') }}</td>
                <td>Rp {{ number_format($t->diskon, 0, ',', '.') }}</td>
                <td>Rp {{ number_format($t->total_akhir, 0, ',', '.') }}</td>
                <td>{{ $t->created_at->format('d/m/Y H:i') }}</td>
            </tr>
            @php $totalSemua += $t->total_akhir; @endphp
            @endforeach
            <tr class="total-row">
                <td colspan="5" style="text-align: right">GRAND TOTAL</td>
                <td colspan="2">Rp {{ number_format($totalSemua, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <div class="footer">
        <p>Dicetak secara otomatis oleh Sistem Rafa Kasir</p>
        <p>Tanda Tangan,</p>
        <br><br><br>
        <p>( ____________________ )</p>
    </div>

    <div class="no-print" style="margin-top: 20px; text-align: center;">
        <button onclick="window.print()" style="padding: 10px 20px; background: #7ed9b1; color: white; border: none; border-radius: 5px; cursor: pointer;">Cetak Sekarang</button>
    </div>
</body>
</html>
