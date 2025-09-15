<?php

namespace App\Http\Controllers;

use App\Models\JenisItem;
use App\Models\KategoriItem;
use App\Models\KonversiItem;
use App\Models\MasterSatuan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
            $data = Produk::with('getKategori', 'getJenis', 'konversi.getNamaSatuan')->latest();

            if ($request->has('filter_kategori') && !empty($request->filter_kategori)) {
                $data = $data->where('KategoriItem', $request->filter_kategori);
            }
            if ($request->has('filter_nama_produk') && !empty($request->filter_nama_produk)) {
                $data = $data->where('id', $request->filter_nama_produk);
            }

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
                    $hargaModal = null;
                    if ($row->konversi && $row->konversi->count() > 0) {
                        $konversiTiga = $row->konversi->where('id', 3)->first();
                        if ($konversiTiga) {
                            $hargaModal = $konversiTiga->HargaModal;
                        } else {
                            $hargaModal = $row->konversi->first()->HargaModal;
                        }
                    }
                    return $hargaModal !== null ? RupiahFormat::currency($hargaModal) : '-';
                })
                ->addColumn('HargaJual', function ($row) {
                    $hargaJual = null;
                    if ($row->konversi && $row->konversi->count() > 0) {
                        $konversiTiga = $row->konversi->where('id', 3)->first();
                        if ($konversiTiga) {
                            $hargaJual = $konversiTiga->HargaJual;
                        } else {
                            $hargaJual = $row->konversi->first()->HargaJual;
                        }
                    }
                    return $hargaJual !== null ? RupiahFormat::currency($hargaJual) : '-';
                })
                ->rawColumns(['action', 'Gambar', 'HargaModal', 'HargaJual'])
                ->make(true);
        }
        $kategori = KategoriItem::orderBy('Nama', 'ASC')->get();
        $produk = Produk::orderBy('Nama', 'ASC')->get();
        return view('master.produk.index', compact('kategori', 'produk'));
    }

    public function create()
    {
        $KategoriItem = KategoriItem::orderBy('Nama', 'ASC')->get();
        $Satuan = MasterSatuan::orderBy('NamaSatuan', 'ASC')->get();
        return view('master.produk.create', compact('KategoriItem', 'Satuan'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'KodeBarang' => 'required|string|max:100|unique:produks,KodeBarang',
            'Nama' => 'required|string|max:255',
            'KategoriItem' => 'required|exists:kategori_items,id',
            'JenisItem' => 'required|exists:jenis_items,id',
            'Stok' => 'required|integer|min:0',
            'Deskripsi' => 'required|string',
            'Gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'Status' => 'required|in:Aktif,Tidak Aktif',
        ]);

        $data = $request->all();
        $data['UserCreate'] = auth()->user()->name;
        $namaFile = null;
        if ($request->hasFile('Gambar')) {
            $file = $request->file('Gambar');
            $namaFile = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('public/uploads/produk', $namaFile);
            $data['Gambar'] = $namaFile;
        }
        Produk::create([
            'KodeBarang' => $request->KodeBarang,
            'Nama' => $request->Nama,
            'KategoriItem' => $request->KategoriItem,
            'JenisItem' => $request->JenisItem,
            'Stok' => $request->Stok,
            'Deskripsi' => $request->Deskripsi,
            'Gambar' => $namaFile,
            'Status' => $request->Status,
            'UserCreate' => auth()->user()->name,
        ]);

        $produk = Produk::latest()->first();
        foreach ($request->Satuan as $key => $value) {
            KonversiItem::create([
                'IdProduk' => $produk->id,
                'Isi' => $request->Isi[$key],
                'Satuan' => $value,
                'HargaModal' => str_replace('.', '', $request->HargaModal[$key]),
                'HargaJual' => str_replace('.', '', $request->HargaJual[$key]),
                'UserCreate' => auth()->user()->name,
            ]);
        }

        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $produk = Produk::with('konversi')->find($id);
        $KategoriItem = KategoriItem::orderBy('Nama', 'ASC')->get();
        $JenisItem = JenisItem::get();
        $Satuan = MasterSatuan::orderBy('NamaSatuan', 'ASC')->get();
        return view('master.produk.edit', compact('produk', 'KategoriItem', 'JenisItem', 'Satuan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'KodeBarang' => 'required|string|max:100|unique:produks,KodeBarang,' . $id,
            'Nama' => 'required|string|max:255',
            'KategoriItem' => 'required|exists:kategori_items,id',
            'JenisItem' => 'required|exists:jenis_items,id',
            'Stok' => 'required|integer|min:0',
            'Deskripsi' => 'required|string',
            'Gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'Status' => 'required|in:Aktif,Tidak Aktif',
        ]);

        $produk = Produk::findOrFail($id);

        $data = $request->all();
        $data['UserUpdate'] = auth()->user()->name;

        if ($request->hasFile('Gambar')) {
            $file = $request->file('Gambar');
            $namaFile = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('public/uploads/produk', $namaFile);
            $data['Gambar'] = $namaFile;

            // Hapus gambar lama jika ada
            if ($produk->Gambar && Storage::exists('public/uploads/produk/' . $produk->Gambar)) {
                Storage::delete('public/uploads/produk/' . $produk->Gambar);
            }
        } else {
            $data['Gambar'] = $produk->Gambar;
        }

        $produk->update([
            'KodeBarang' => $request->KodeBarang,
            'Nama' => $request->Nama,
            'KategoriItem' => $request->KategoriItem,
            'JenisItem' => $request->JenisItem,
            'Stok' => $request->Stok,
            'Deskripsi' => $request->Deskripsi,
            'Gambar' => $data['Gambar'],
            'Status' => $request->Status,
            'UserUpdate' => auth()->user()->name,
        ]);

        KonversiItem::where('IdProduk', $produk->id)->delete();
        if ($request->Satuan && is_array($request->Satuan)) {
            foreach ($request->Satuan as $key => $value) {
                KonversiItem::create([
                    'IdProduk' => $produk->id,
                    'Isi' => $request->Isi[$key],
                    'Satuan' => $value,
                    'HargaModal' => str_replace('.', '', $request->HargaModal[$key]),
                    'HargaJual' => str_replace('.', '', $request->HargaJual[$key]),
                    'UserCreate' => auth()->user()->name,
                ]);
            }
        }

        return redirect()->route('produk.index')->with('success', 'Produk berhasil diupdate.');
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
