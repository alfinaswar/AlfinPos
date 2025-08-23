<?php

namespace App\Http\Controllers;

use App\Models\JenisItem;
use App\Models\KategoriItem;
use App\Models\Produk;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produk = KategoriItem::with(['getProduk', 'getProduk.getJenis', 'getProduk.getKategori'])->orderBy('Nama', 'ASC')->get();
        return view('transaksi.pos', compact('produk'));
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

        // Menjumlahkan total quantity dari array products
        // Hitung subtotal dari array products
        $subtotal = 0;
        if (isset($data['products']) && is_array($data['products'])) {
            foreach ($data['products'] as $product) {
                $qty = isset($product['quantity']) ? (int) $product['quantity'] : 0;
                $harga = isset($product['price']) ? (int) $product['price'] : 0;
                $subtotal += $qty * $harga;
            }
        }
        Transaksi::create([
            'Kode' => $this->GenerateKodeTransaksi(),
            'Tanggal' => now(),
            'IdKasir' => auth()->user()->id,
            'IdOutlet' => null,
            'Subtotal' => $subtotal,
            'TotalDiskon' => null,
            'Pajak' => null,
            'BiayaLayanan' => null,
            'TotalAkhir' => $subtotal,
            'JumlahBayar' => $data['JumlahBayar'],
            'kembalian' => $data['kembalian'],
            'MetodePembayaran' => $data['MetodePembayaran'],
            'status_transaksi' => $data['status_transaksi'],
            'JenisDiskon' => $data['JenisDiskon'],
            'NilaiDiskon' => $data['NilaiDiskon'],
            'Catatan' => $data['Catatan'],
            'JumlahItem' => $data['JumlahItem'],
        ]);
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
    public function show(Transaksi $transaksi)
    {
        //
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
