<?php

namespace App\Http\Controllers;

use App\Models\BarangMasuk;
use App\Models\BarangMasukDetail;
use App\Models\Produk;
use Illuminate\Http\Request;
use Laraindo\RupiahFormat;
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
                ->addColumn('Jumlah', function ($row) {
                    $jumlah = BarangMasukDetail::where('idBarangMasuk', $row->id)->sum('Qty');
                    return $jumlah;
                })
                ->addColumn('Modal', function ($row) {
                    $Modal = BarangMasukDetail::where('idBarangMasuk', $row->id)->sum('HargaModal');
                    $formatIndo = RupiahFormat::currency($Modal);
                    return $formatIndo;
                })
                ->addColumn('Kode', function ($row) {

                    $url = route('bm.show', $row->id);
                    return '<a href="' . $url . '">' . $row->KodeBm . '</a>';
                })
                ->rawColumns(['action', 'Jumlah', 'Modal', 'Kode'])
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
        $data['KodeBm'] = $this->generateNumber();
        $data['Total'] = str_replace('.', '', $request->Total);
        $data['UserCreate'] = auth()->user()->name;
        BarangMasuk::create($data);

        foreach ($request->idproduk as $key => $value) {
            $barangMasuk = BarangMasuk::latest()->first();
            BarangMasukDetail::create([
                'idBarangMasuk' => $barangMasuk->id,
                'idProduk' => $value,
                'Qty' => $request->Qty[$key],
                'HargaModal' => str_replace('.', '', $request->HargaModal[$key]),
                'Subtotal' => str_replace('.', '', $request->Subtotal[$key]),
                'UserCreate' => auth()->user()->name,
            ]);

            $produk = Produk::find($value);
            if ($produk) {
                $produk->Stok = $produk->Stok + $request->Qty[$key];
                $produk->save();
            }
        }

        return redirect()->route('bm.index')->with('success', 'jenis berhasil ditambahkan.');
    }
    // Membuka method generateNumber untuk menghasilkan kode Barang Masuk
    private function generateNumber()
    {
        $bulan = date('m');
        $tahun = date('Y');
        $last = BarangMasuk::whereRaw("DATE_FORMAT(Tanggal, '%m-%Y') = ?", [$bulan . '-' . $tahun])
            ->orderBy('id', 'desc')
            ->first();
        $number = 1;
        if ($last && $last->KodeBm) {
            $lastNumber = (int) substr($last->KodeBm, 8);
            $number = $lastNumber + 1;
        }
        return 'IN' . $bulan . $tahun . str_pad($number, 4, '0', STR_PAD_LEFT);
    }

    public function edit($id)
    {
        $bm = BarangMasuk::with('DetailBarangMasuk')->findOrFail($id);
        // dd($bm);
        $produk = Produk::orderBy('Nama', 'asc')->get();
        return view('manajemen-stok.barang-masuk.edit', compact('bm', 'produk'));
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
