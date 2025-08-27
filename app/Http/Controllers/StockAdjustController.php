<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\StockAdjust;
use App\Models\StockAjustDetail;
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
                ->addColumn('KodeSo', function ($row) {
                    return '<a href="' . route('so.show', $row->id) . '" class="text-primary fw-bold" style="text-decoration: underline; cursor: pointer;">' . $row->KodeSo . '</a>';
                })
                ->addColumn('action', function ($row) {
                    return '
                        <a href="' . route('so.edit', $row->id) . '" class="btn btn-sm btn-warning">Edit</a>
                        <button class="btn btn-sm btn-danger btn-delete" data-id="' . $row->id . '">Hapus</button>
                    ';
                })
                ->rawColumns(['action', 'KodeSo'])
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
            'Tanggal' => 'required',
            'Alasan' => 'required|string|max:255'
        ]);
        $data = $request->all();
        StockAdjust::create([
            'KodeSo' => $this->GenerateKode(),
            'Tanggal' => $request->Tanggal,
            'Alasan' => $request->Alasan,
            'Petugas' => auth()->user()->id,
            'UserCreate' => auth()->user()->name,
        ]);
        $getId = StockAdjust::latest()->first()->id;
        foreach ($request->IdProduk as $key => $value) {
            StockAjustDetail::create([
                'IdSo' => $getId,
                'IdProduk' => $value,
                'StokAwal' => $request->StokAwal[$key],
                'StokAkhir' => $request->StokAkhir[$key],
                'Penyesuaian' => $request->Penyesuaian[$key],
                'Jenis' => $request->Jenis[$key],
                'UserCreate' => auth()->user()->name,
            ]);
        }
        return redirect()->route('so.index')->with('success', 'SO berhasil diajukan');
    }
    private function GenerateKode()
    {
        $prefix = 'SO';
        $now = now();
        $tahun = $now->format('y');
        $bulan = $now->format('m');
        $kodeAwal = $prefix . $tahun . $bulan;

        // Cari kode terakhir di bulan & tahun ini
        $last = StockAdjust::where('KodeSo', 'like', $kodeAwal . '%')
            ->orderBy('KodeSo', 'desc')
            ->first();

        if ($last) {
            $lastNumber = (int) substr($last->KodeSo, -4);
            $nextNumber = $lastNumber + 1;
        } else {
            $nextNumber = 1;
        }

        $kodeBaru = $kodeAwal . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
        return $kodeBaru;
    }

    public function edit($id)
    {
        $kategori = KategoriItem::findOrFail($id);
        return view('master.kategori.edit', compact('kategori'));
    }
    public function show($id)
    {
        $data = StockAdjust::findOrFail($id);
        return view('manajemen-stok.adjust-stok.show', compact('data'));
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
