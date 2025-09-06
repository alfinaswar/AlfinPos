<?php

namespace App\Http\Controllers;

use App\Models\KonversiItem;
use App\Models\MasterSatuan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class KonversiItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = KonversiItem::with('getProduk')->latest();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('NamaProduk', function ($row) {
                    return $row->getProduk ? $row->getProduk->Nama : '-';
                })
                ->addColumn('action', function ($row) {
                    return '
                        <a href="' . route('konversi-satuan.edit', $row->id) . '" class="btn btn-sm btn-warning">Edit</a>
                        <button class="btn btn-sm btn-danger btn-delete" data-id="' . $row->id . '">Hapus</button>
                    ';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('master.konversi-satuan.index');
    }

    /**
     * Form tambah konversi baru
     */
    public function create()
    {
        $produk = Produk::get();
        $satuan = MasterSatuan::get();
        return view('master.konversi-satuan.create', compact('produk', 'satuan'));
    }

    /**
     * Simpan konversi baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'Satuan' => 'required|string|max:50',
            'Isi' => 'required|integer|min:1',
        ]);

        KonversiItem::create([
            'IdProduk' => $request->IdProduk,
            'Satuan' => $request->Satuan,
            'Isi' => $request->Isi,
        ]);

        return redirect()->route('konversi-satuan.index')
            ->with('success', 'Konversi berhasil ditambahkan.');
    }

    /**
     * Form edit konversi
     */
    public function edit($id)
    {
        $konversi = ProdukKonversi::findOrFail($id);
        $produk = $konversi->produk;
        return view('produk.konversi.edit', compact('konversi', 'produk'));
    }

    /**
     * Update konversi
     */
    public function update(Request $request, $id)
    {
        $konversi = ProdukKonversi::findOrFail($id);

        $request->validate([
            'Satuan' => 'required|string|max:50',
            'Isi' => 'required|integer|min:1',
            'HargaModal' => 'nullable|numeric|min:0',
            'HargaJual' => 'nullable|numeric|min:0',
        ]);

        $konversi->update([
            'Satuan' => $request->Satuan,
            'Isi' => $request->Isi,
            'HargaModal' => $request->HargaModal,
            'HargaJual' => $request->HargaJual,
        ]);

        return redirect()->route('produk.konversi.index', $konversi->IdProduk)
            ->with('success', 'Konversi berhasil diperbarui.');
    }

    /**
     * Hapus konversi
     */
    public function destroy($id)
    {
        $konversi = ProdukKonversi::findOrFail($id);
        $produkId = $konversi->IdProduk;
        $konversi->delete();

        return redirect()->route('produk.konversi.index', $produkId)
            ->with('success', 'Konversi berhasil dihapus.');
    }
}
