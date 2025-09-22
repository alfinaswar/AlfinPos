<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\MasterShift;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(): View
    {
        $totalPendapatanMingguIni = Transaksi::whereBetween('Tanggal', [now()->startOfWeek(), now()->endOfWeek()])
            ->sum('TotalAkhir');

        $totalPendapatanMingguLalu = Transaksi::whereBetween('Tanggal', [now()->subWeek()->startOfWeek(), now()->subWeek()->endOfWeek()])
            ->sum('TotalAkhir');

        $persentaseKenaikanMingguIni = $totalPendapatanMingguLalu > 0
            ? (($totalPendapatanMingguIni - $totalPendapatanMingguLalu) / $totalPendapatanMingguLalu) * 100
            : 0;
        $totalTransaksiHariIni = Transaksi::whereDate('Tanggal', now())->count();

        $totalPendapatanHariIni = Transaksi::whereDate('Tanggal', now())->sum('TotalAkhir');

        $RiwayatTransaksi = Transaksi::latest()->get()->take(10);

        // Query produk terpopuler berdasarkan jumlah terjual (TotalQty)
        $ProdukPopuler = TransaksiDetail::with('getProduk')->select('IdProduk')
            ->selectRaw('SUM(Qty) as total_terjual')
            ->groupBy('IdProduk')
            ->orderByDesc('total_terjual')
            ->take(5)
            ->get();
        $shift = MasterShift::get();
        $absenHariIni = Absensi::where('UserCreate', auth()->user()->id)
            ->whereDate('created_at', now()->toDateString())
            ->first();
        return view('home', compact(
            'totalPendapatanMingguIni',
            'persentaseKenaikanMingguIni',
            'totalTransaksiHariIni',
            'totalPendapatanHariIni',
            'RiwayatTransaksi',
            'ProdukPopuler',
            'shift',
            'absenHariIni'
        ));
    }
}
