<?php

namespace App\Http\Controllers;

use App\Models\BarangMasuk;
use App\Models\BarangMasukDetail;
use App\Models\Produk;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class BarangMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = BarangMasuk::with('DetailBarangMasuk')->latest();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return '
                        <a href="' . route('bm.edit', $row->id) . '" class="btn btn-sm btn-warning">Edit</a>
                        <button class="btn btn-sm btn-danger btn-delete" data-id="' . $row->id . '">Hapus</button>
                    ';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $produk = Produk::orderBy('Nama', 'asc')->get();
        return view('manajemen-stok.barang-masuk.index', compact('produk'));
    }

    public function create()
    {
        $produk = Produk::orderBy('Nama', 'asc')->get();
        return view('manajemen-stok.barang-masuk.create', compact('produk'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'Tanggal' => 'required|date',
            'Invoice' => 'nullable|file|max:5048',
        ]);
        $data = $request->all();
        if ($request->hasFile('Invoice')) {
            $file = $request->file('Invoice');
            $file->storeAs('public/invoice', $file->getClientOriginalName());
            $data['Invoice'] = $file->getClientOriginalName();
        }
        BarangMasuk::create($data);

        //Detail
        foreach ($request->idproduk as $key => $value) {
            BarangMasukDetail::create([
                'idBarangMasuk' => BarangMasuk::latest()->first()->id,
                'idProduk' => $value,
                'Qty' => $request->Qty[$key],
                'HargaModal' => $request->HargaModal[$key],
            ]);
        }

        return redirect()->route('jenis.index')->with('success', 'jenis berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $jenis = JenisItem::findOrFail($id);
        $KategoriItem = KategoriItem::orderBy('Nama', 'asc')->get();
        return view('master.jenis.edit', compact('jenis', 'KategoriItem'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'Nama' => 'required|string|max:255',
            'KategoriItem' => 'required|string|max:255',
        ]);

        $jenis = JenisItem::findOrFail($id);
        $jenis->update([
            'Nama' => $request->Nama,
            'KategoriItem' => $request->KategoriItem,
            'UserUpdate' => auth()->user()->name
        ]);

        return redirect()->route('jenis.index')->with('success', 'Jenis berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $jenis = JenisItem::find($id);

        if (!$jenis) {
            return response()->json(['status' => 404, 'message' => 'Data tidak ditemukan']);
        }

        $jenis->delete();
        return response()->json(['status' => 200, 'message' => 'jenis berhasil dihapus']);
    }
}
