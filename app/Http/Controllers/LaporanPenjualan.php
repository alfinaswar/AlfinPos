<?php

namespace App\Http\Controllers;

use App\Exports\TransaksiExport;
use App\Models\KategoriItem;
use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class LaporanPenjualan extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $produk = Produk::all();
        $kategori = KategoriItem::all();
        $karyawan = User::all();

        return view('laporan.index', compact('produk', 'kategori', 'karyawan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $query = Transaksi::with('detailTransaksi.getProduk');

        if ($request->filled('produk')) {
            $query->whereHas('detailTransaksi', function ($q) use ($request) {
                $q->where('IdProduk', $request->produk);
            });
        }

        if ($request->filled('kategori')) {
            $query->whereHas('detailTransaksi.getProduk', function ($q) use ($request) {
                $q->where('KategoriItem', $request->kategori);
            });
        }

        if ($request->filled('karyawan')) {
            $query->where('IdKasir', $request->karyawan);
        }

        if ($request->filled('tanggal_awal') && $request->filled('tanggal_akhir')) {
            $query->whereBetween('created_at', [$request->tanggal_awal, $request->tanggal_akhir]);
        } elseif ($request->filled('tanggal_awal')) {
            $query->whereDate('created_at', '>=', $request->tanggal_awal);
        } elseif ($request->filled('tanggal_akhir')) {
            $query->whereDate('created_at', '<=', $request->tanggal_akhir);
        }

        $transaksi = $query->get();

        // 🔥 Flatten detail transaksi, lalu grouping berdasarkan IdProduk
        $grouped = $transaksi
            ->flatMap
            ->detailTransaksi
            ->groupBy('IdProduk')
            ->map(function ($items) {
                $produk = $items->first()->getProduk;
                return [
                    'IdProduk' => $items->first()->IdProduk,
                    'NamaProduk' => $produk->Nama ?? '-',
                    'HargaModal' => $produk->HargaModal ?? 0,
                    'HargaJual' => $produk->HargaJual ?? 0,
                    'TotalQty' => $items->sum('Qty'),
                    'TotalJual' => $items->sum('Subtotal'),
                    'Profit' => ($produk->HargaJual - $produk->HargaModal) * $items->sum('Qty'),
                ];
            })
            ->values();

        return Excel::download(new TransaksiExport($grouped), 'laporan_transaksi.xlsx');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
