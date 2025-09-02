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
    // public function store(Request $request)
    // {
    //     $query = Produk::with([
    //         'getPenjualan' => function ($q) use ($request) {
    //             if ($request->filled('karyawan')) {
    //                 $q->where('IdKasir', $request->karyawan);
    //             }
    //             if ($request->filled('tanggal_awal') && $request->filled('tanggal_akhir')) {
    //                 $q->whereBetween('created_at', [$request->tanggal_awal, $request->tanggal_akhir]);
    //             } elseif ($request->filled('tanggal_awal')) {
    //                 $q->whereDate('created_at', '>=', $request->tanggal_awal);
    //             } elseif ($request->filled('tanggal_akhir')) {
    //                 $q->whereDate('created_at', '<=', $request->tanggal_akhir);
    //             }
    //         }
    //     ]);

    //     if ($request->filled('produk')) {
    //         $query->where('id', $request->produk);
    //     }

    //     if ($request->filled('kategori')) {
    //         $query->where('KategoriItem', $request->kategori);
    //     }

    //     $produk = $query->get();

    //     $transaksi = $produk->map(function ($p) {
    //         $qty = $p->getPenjualan->sum('Qty');
    //         $total = $p->getPenjualan->sum(function ($penj) {
    //             return $penj->Qty * $penj->HargaSatuan;
    //         });
    //         $profit = $p->getPenjualan->sum(function ($penj) {
    //             return ($penj->HargaSatuan - $penj->HargaModal) * $penj->Qty;
    //         });

    //         return [
    //             'Nama' => $p->Nama,
    //             'HargaModal' => $p->HargaModal,
    //             'HargaJual' => $p->HargaJual,
    //             'QtyPenjualan' => $qty,
    //             'Total' => $total,
    //             'Profit' => $profit,
    //         ];
    //     });

    //     return Excel::download(new TransaksiExport($transaksi), 'laporan_transaksi.xlsx');
    // }

    public function store(Request $request)
    {
        $query = Produk::with([
            'getPenjualan' => function ($q) use ($request) {
                if ($request->filled('karyawan')) {
                    $q->where('IdKasir', $request->karyawan);
                }
                if ($request->filled('tanggal_awal') && $request->filled('tanggal_akhir')) {
                    $q->whereBetween('created_at', [$request->tanggal_awal, $request->tanggal_akhir]);
                } elseif ($request->filled('tanggal_awal')) {
                    $q->whereDate('created_at', '>=', $request->tanggal_awal);
                } elseif ($request->filled('tanggal_akhir')) {
                    $q->whereDate('created_at', '<=', $request->tanggal_akhir);
                }
            }
        ]);

        if ($request->filled('produk')) {
            $query->where('id', $request->produk);
        }

        if ($request->filled('kategori')) {
            $query->where('KategoriItem', $request->kategori);
        }

        $produk = $query->get();

        // siapkan data pivot per produk + tanggal
        $transaksi = [];
        $tanggalList = collect();

        foreach ($produk as $p) {
            $grouped = $p->getPenjualan
                ->groupBy(fn($penj) => \Carbon\Carbon::parse($penj->created_at)->format('Y-m-d'));

            $row = [
                'Nama' => $p->Nama,
                'HargaModal' => $p->HargaModal,
                'HargaJual' => $p->HargaJual,
                'Hari' => []
            ];

            foreach ($grouped as $tanggal => $list) {
                $row['Hari'][$tanggal] = [
                    'QtyPenjualan' => $list->sum('Qty'),
                    'Total' => $list->sum(fn($penj) => $penj->Qty * $penj->HargaSatuan),
                    'Profit' => $list->sum(fn($penj) => ($penj->HargaSatuan - $penj->HargaModal) * $penj->Qty),
                ];
                $tanggalList->push($tanggal);
            }

            $transaksi[] = $row;
        }

        $tanggalList = $tanggalList->unique()->sort()->values();

        return Excel::download(new TransaksiExport($transaksi, $tanggalList), 'laporan_transaksi_perhari.xlsx');
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
