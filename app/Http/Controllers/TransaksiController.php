<?php

namespace App\Http\Controllers;

use App\Models\JenisItem;
use App\Models\KategoriItem;
use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Transaksi::with('NamaKasir')->latest();
            if ($request->kasir) {
                $data->where('IdKasir', $request->kasir);
            }

            if ($request->start_date && $request->end_date) {
                $data->whereBetween('Tanggal', [$request->start_date, $request->end_date]);
            }
            if ($request->status) {
                $data->where('status_transaksi', $request->status);
            }

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return '
                    <a href="' . route('pos.edit', $row->id) . '" class="btn btn-sm btn-warning">Edit</a>
                    <a href="' . route('pos.show', $row->id) . '" class="btn btn-sm btn-info">Show</a>
                    <button class="btn btn-sm btn-danger btn-delete" data-id="' . $row->id . '">Hapus</button>
                ';
                })
                ->addColumn('TotalAkhir', function ($row) {
                    return 'Rp ' . number_format($row->TotalAkhir, 0, ',', '.');
                })
                ->addColumn('Subtotal', function ($row) {
                    return 'Rp ' . number_format($row->Subtotal, 0, ',', '.');
                })
                ->addColumn('Status', function ($row) {
                    $statusMap = [
                        'Pending' => ['label' => 'Pending', 'class' => 'warning'],
                        'Berhasil' => ['label' => 'Berhasil', 'class' => 'success'],
                        'Dibatalkan' => ['label' => 'Dibatalkan', 'class' => 'danger'],
                        'Refund Sebagian' => ['label' => 'Refund Sebagian', 'class' => 'info'],
                        'Refund Penuh' => ['label' => 'Refund Penuh', 'class' => 'dark'],
                    ];

                    $status = $statusMap[$row->status_transaksi] ?? ['label' => 'Tidak Diketahui', 'class' => 'secondary'];
                    return '<span class="badge badge-' . $status['class'] . '">' . $status['label'] . '</span>';
                })
                ->rawColumns(['action', 'TotalAkhir', 'Status'])
                ->make(true);
        }

        // untuk filter kasir di dropdown
        $kasir = User::get();
        return view('transaksi.index', compact('kasir'));
    }

    public function kasir()
    {
        $produk = KategoriItem::withCount(['getProduk'])
            ->with(['getProduk', 'getProduk.getJenis', 'getProduk.getKategori', 'getProduk.konversi.getNamaSatuan'])
            ->orderBy('Nama', 'ASC')
            ->get();
        // dd($produk);
        $history = Transaksi::whereDate('created_at', now())->latest()->get();
        return view('transaksi.pos', compact('produk', 'history'));
    }
    public function scanBarcode(Request $request)
    {
        $barcode = $request->barcode;
        dd($barcode);
        // Cari produk di database
        $product = Produk::where('barcode', $barcode)->first();

        if ($product) {
            return response()->json([
                'success' => true,
                'product' => [
                    'kode' => $product->kode,
                    'nama' => $product->nama,
                    'harga' => $product->harga
                ]
            ]);
        } else {
            return response()->json(['success' => false]);
        }
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
        $subtotal = 0;
        if (isset($data['products']) && is_array($data['products'])) {
            foreach ($data['products'] as $product) {

                $qty = isset($product['quantity']) ? (int) $product['quantity'] : 0;
                $harga = isset($product['price']) ? (int) $product['price'] : 0;
                $subtotal += $qty * $harga;
                $produk = Produk::find($product['id']);
                if ($produk) {
                    $produk->Stok -= $qty;
                    $produk->save();
                }
            }
        }

        $jumlahBayar = str_replace('.', '', $data['uangditerima']);
        $kembalian = $jumlahBayar - $subtotal;

        Transaksi::create([
            'Kode' => $this->GenerateKodeTransaksi(),
            'Tanggal' => now(),
            'IdKasir' => auth()->user()->id ?? 1,
            'IdOutlet' => null,
            'Subtotal' => $subtotal,
            'TotalDiskon' => null,
            'Pajak' => null,
            'BiayaLayanan' => null,
            'TotalAkhir' => $subtotal,
            'JumlahBayar' => $jumlahBayar,
            'kembalian' => $kembalian,  // Simpan kembalian yang telah dihitung
            'MetodePembayaran' => null,
            'status_transaksi' => 'Berhasil',
            'JenisDiskon' => 'None',
            'NilaiDiskon' => 0,
            'Catatan' => null,
            'JumlahItem' => $qty,
        ]);

        $transaksi = Transaksi::orderBy('id', 'desc')->first();
        if ($transaksi) {
            $transaksiId = $transaksi->id;

            foreach ($data['products'] as $product) {
                $produk = Produk::find($product['id']);
                TransaksiDetail::create([
                    'IdTransaksi' => $transaksiId,
                    'IdProduk' => $product['id'],
                    'Qty' => (int) $product['quantity'],
                    'HargaSatuan' => (int) $product['price'],
                    'HargaModal' => $produk ? (int) $produk->HargaModal : 0,
                    'HargaGrosir' => isset($product['HargaGrosir']) ? (int) $product['HargaGrosir'] : null,
                    'Subtotal' => (int) $product['price'] * (int) $product['quantity'],
                    'TipeDiskon' => null,
                    'Diskon' => null,
                    'TotalAkhir' => (int) $product['price'] * (int) $product['quantity'],
                    'IdKasir' => auth()->user()->id ?? 1,
                    'Shift' => null,
                ]);
            }
        }
        // cetak struk
        $struk = Transaksi::orderBy('id', 'desc')->first();

        return response()->json([
            'success' => true,
            'message' => 'Transaksi berhasil disimpan.',
            'url_struk' => route('pos.struk', $struk->id)
        ]);
    }

    public function cetakStruk($id)
    {
        $transaksi = Transaksi::with('detailTransaksi.getProduk')->findOrFail($id);

        return view('pos.struk', compact('transaksi'));
    }

    private function GenerateKodeTransaksi()
    {
        // Ambil kode transaksi terakhir dari database, lalu generate kode baru
        $lastTransaksi = Transaksi::orderBy('id', 'desc')->first();
        $prefix = 'TRX';
        $date = date('ymd');
        $lastNumber = 1;

        if ($lastTransaksi && preg_match('/^TRX(\d{6})(\d{5})$/', $lastTransaksi->Kode, $matches)) {
            if ($matches[1] == $date) {
                $lastNumber = intval($matches[2]) + 1;
            }
        }

        $kodeBaru = $prefix . $date . str_pad($lastNumber, 5, '0', STR_PAD_LEFT);
        return $kodeBaru;
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data = Transaksi::with('detailTransaksi.getProduk', 'NamaKasir')->find($id);
        // dd($data);
        return view('transaksi.show', compact('data'));
    }

    public function downloadPdf($id)
    {
        $data = Transaksi::with('detailTransaksi.getProduk', 'NamaKasir')->findOrFail($id);

        $pdf = Pdf::loadView('transaksi.detail-pdf', compact('data'))
            ->setPaper('a4', 'portrait');

        return $pdf->download('Transaksi_' . $data->Kode . '.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaksi $transaksi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaksi $transaksi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaksi $transaksi)
    {
        //
    }
}
