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
                ->addColumn('Status', function ($row) {
                    // Misal status: 0 = Pending, 1 = Disetujui, 2 = Ditolak
                    if ($row->Status == 'Y') {
                        return '<span class="badge bg-success">Disetujui</span>';
                    } elseif ($row->Status == 'N') {
                        return '<span class="badge bg-danger">Ditolak</span>';
                    } else {
                        return '<span class="badge bg-warning text-dark">Pending</span>';
                    }
                })
                ->addColumn('action', function ($row) {
                    return '
                        <a href="' . route('so.edit', $row->id) . '" class="btn btn-sm btn-warning">Edit</a>
                        <button class="btn btn-sm btn-danger btn-delete" data-id="' . $row->id . '">Hapus</button>
                    ';
                })
                ->rawColumns(['action', 'KodeSo', 'Status'])
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
        $data = StockAdjust::with('DetailSO')->findOrFail($id);
        return view('manajemen-stok.adjust-stok.edit', compact('data'));
    }
    public function show($id)
    {
        $data = StockAdjust::findOrFail($id);
        return view('manajemen-stok.adjust-stok.show', compact('data'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'Tanggal' => 'required',
            'Alasan' => 'required|string|max:255'
        ]);

        // Update data utama StockAdjust
        $stockAdjust = StockAdjust::findOrFail($id);
        $stockAdjust->update([
            'Tanggal' => $request->Tanggal,
            'Alasan' => $request->Alasan,
            'Petugas' => auth()->user()->id,
            'UserCreate' => auth()->user()->name,
        ]);

        // Hapus detail lama
        StockAjustDetail::where('IdSo', $stockAdjust->id)->delete();

        // Tambahkan detail baru
        foreach ($request->IdProduk as $key => $value) {
            StockAjustDetail::create([
                'IdSo' => $stockAdjust->id,
                'IdProduk' => $value,
                'StokAwal' => $request->StokAwal[$key],
                'StokAkhir' => $request->StokAkhir[$key],
                'Penyesuaian' => $request->Penyesuaian[$key],
                'Jenis' => $request->Jenis[$key],
                'UserCreate' => auth()->user()->name,
            ]);
        }

        return redirect()->route('so.index')->with('success', 'SO berhasil diperbarui');
    }

    public function approve($id)
    {
        $so = StockAdjust::with('DetailSO')->findOrFail($id);
        $so->Status = 'Y';
        $so->ApproveBy = auth()->user()->id;
        $so->ApproveAt = now();
        $so->save();

        if ($so->DetailSO) {
            foreach ($so->DetailSO as $detail) {
                if ($detail->IdProduk) {
                    $produk = Produk::find($detail->IdProduk);
                    if ($produk) {
                        $produk->Stok = $detail->StokAkhir;
                        $produk->save();
                    }
                }
            }
        }

        return redirect()->back()->with('success', 'Penyesuaian stok berhasil disetujui dan stok produk telah diperbarui.');
    }
    public function reject($id)
    {
        $so = StockAdjust::findOrFail($id);
        $so->Status = 'N';
        $so->ApproveBy = auth()->user()->id;
        $so->ApproveAt = now();
        $so->save();

        return redirect()->back()->with('success', 'Penyesuaian stok berhasil ditolak.');
    }
    public function destroy($id)
    {
        $AdjustStok = StockAdjust::find($id);

        if (!$AdjustStok) {
            return response()->json(['status' => 404, 'message' => 'Data tidak ditemukan']);
        }

        $AdjustStok->delete();
        return response()->json(['status' => 200, 'message' => 'SO berhasil dihapus']);
    }
}
