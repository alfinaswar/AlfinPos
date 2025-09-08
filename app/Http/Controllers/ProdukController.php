<?php

namespace App\Http\Controllers;

use App\Models\JenisItem;
use App\Models\KategoriItem;
use App\Models\MasterSatuan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Laraindo\RupiahFormat;
use Yajra\DataTables\Facades\DataTables;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Produk::with('getKategori', 'getJenis')->latest();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return '
                        <a href="' . route('produk.edit', $row->id) . '" class="btn btn-sm btn-warning">Edit</a>
                        <button class="btn btn-sm btn-danger btn-delete" data-id="' . $row->id . '">Hapus</button>
                    ';
                })
                ->addColumn('Gambar', function ($row) {
                    if ($row->Gambar) {
                        $url = asset('storage/uploads/produk/' . $row->Gambar);
                        return '<img src="' . $url . '" alt="Gambar Produk" width="60" height="60" style="object-fit:cover;border-radius:6px;">';
                    } else {
                        return '<img src="' . asset('assets/img/pos/imagenotfound.png') . '" alt="Gambar Produk" width="60" height="60" style="object-fit:cover;border-radius:6px;">';
                    }
                })
                ->addColumn('HargaModal', function ($row) {
                    return RupiahFormat::currency($row->HargaModal);
                })
                ->addColumn('HargaJual', function ($row) {
                    return RupiahFormat::currency($row->HargaJual);
                })
                ->rawColumns(['action', 'Gambar', 'HargaModal', 'HargaJual'])
                ->make(true);
        }

        return view('master.produk.index');
    }

    public function create()
    {
        $KategoriItem = KategoriItem::orderBy('Nama', 'ASC')->get();
        $Satuan = MasterSatuan::orderBy('NamaSatuan', 'ASC')->get();
        return view('master.produk.create', compact('KategoriItem', 'Satuan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'KodeBarang' => 'required|string|max:100|unique:produks,KodeBarang',
            'Nama' => 'required|string|max:255',
            'KategoriItem' => 'required|exists:kategori_items,id',
            'JenisItem' => 'required|exists:jenis_items,id',
            'HargaModal' => 'required|numeric|min:0',
            'HargaJual' => 'required|numeric|min:0',
            'Stok' => 'required|integer|min:0',
            'Deskripsi' => 'required|string',
            'Gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'Status' => 'required|in:Aktif,Tidak Aktif',
        ]);

        $data = $request->all();
        $data['HargaModal'] = str_replace('.', '', $request->HargaModal);
        $data['HargaJual'] = str_replace('.', '', $request->HargaJual);
        $data['UserCreate'] = auth()->user()->name;

        if ($request->hasFile('Gambar')) {
            $file = $request->file('Gambar');
            $namaFile = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('public/uploads/produk', $namaFile);
            $data['Gambar'] = $namaFile;
        }

        Produk::create($data);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $produk = Produk::find($id);
        $KategoriItem = KategoriItem::orderBy('Nama', 'ASC')->get();
        return view('master.produk.edit', compact('produk', 'KategoriItem'));
    }

    public function update(Request $request, $id)
    {
        $produk = Produk::findOrFail($id);

        $request->validate([
            'KodeBarang' => 'required|string|max:100|unique:produks,KodeBarang,' . $produk->id,
            'Nama' => 'required|string|max:255',
            'KategoriItem' => 'required|exists:kategori_items,id',
            'JenisItem' => 'required|exists:jenis_items,id',
            'HargaModal' => 'required|numeric|min:0',
            'HargaJual' => 'required|numeric|min:0',
            'Stok' => 'required|integer|min:0',
            'Deskripsi' => 'required|string',
            'Gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'Status' => 'required|in:Aktif,Tidak Aktif',
        ]);

        $data = $request->all();
        $data['HargaModal'] = str_replace('.', '', $request->HargaModal);
        $data['HargaJual'] = str_replace('.', '', $request->HargaJual);
        $data['UserUpdate'] = auth()->user()->name;

        if ($request->hasFile('Gambar')) {
            $file = $request->file('Gambar');
            $namaFile = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('public/uploads/produk', $namaFile);
            $data['Gambar'] = $namaFile;
        } else {
            unset($data['Gambar']);
        }

        $produk->update($data);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function getJenisItem($id)
    {
        $jenis = JenisItem::where('KategoriItem', $id)->orderBy('Nama')->get(['id', 'Nama']);
        // dd($jenis);
        return response()->json($jenis);
    }

    public function destroy($id)
    {
        $kategori = Produk::find($id);

        if (!$kategori) {
            return response()->json(['status' => 404, 'message' => 'Data tidak ditemukan']);
        }

        $kategori->delete();
        return response()->json(['status' => 200, 'message' => 'Kategori berhasil dihapus']);
    }
}
