<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\StockAdjust;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class StockAdjustController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = StockAdjust::latest();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return '
                        <a href="' . route('so.edit', $row->id) . '" class="btn btn-sm btn-warning">Edit</a>
                        <button class="btn btn-sm btn-danger btn-delete" data-id="' . $row->id . '">Hapus</button>
                    ';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('manajemen-stok.adjust-stok.index');
    }

    public function create()
    {
        $produk = Produk::orderBy('Nama', 'ASC')->get();
        return view('manajemen-stok.adjust-stok.create', compact('produk'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'Nama' => 'required|string|max:255'
        ]);

        KategoriItem::create([
            'Nama' => $request->Nama,
            'UserCreate' => auth()->user()->name,
        ]);

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $kategori = KategoriItem::findOrFail($id);
        return view('master.kategori.edit', compact('kategori'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'Nama' => 'required|string|max:255'
        ]);

        $kategori = KategoriItem::findOrFail($id);
        $kategori->update([
            'Nama' => $request->Nama,
            'UserUpdate' => auth()->user()->name
        ]);

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $kategori = KategoriItem::find($id);

        if (!$kategori) {
            return response()->json(['status' => 404, 'message' => 'Data tidak ditemukan']);
        }

        $kategori->delete();
        return response()->json(['status' => 200, 'message' => 'Kategori berhasil dihapus']);
    }
}
