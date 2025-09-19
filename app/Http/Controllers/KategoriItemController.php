<?php

namespace App\Http\Controllers;

use App\Models\KategoriItem;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class KategoriItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = KategoriItem::latest();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return '
                        <a href="' . route('kategori.edit', $row->id) . '" class="btn btn-sm btn-warning">Edit</a>
                        <button class="btn btn-sm btn-danger btn-delete" data-id="' . $row->id . '">Hapus</button>
                    ';
                })
                ->addColumn('Icon', function ($row) {
                    if ($row->Icon) {
                        $url = asset('storage/uploads/icon-kategori/' . $row->Icon);
                        return '<img src="' . $url . '" alt="Icon Kategori" width="100" height="100" style="object-fit:cover;border-radius:6px;">';
                    } else {
                        return '<img src="' . asset('assets/img/pos/imagenotfound.png') . '" alt="Icon Kategori" width="100" height="100" style="object-fit:cover;border-radius:6px;">';
                    }
                })
                ->rawColumns(['action', 'Icon'])
                ->make(true);
        }

        return view('master.kategori.index');
    }

    public function create()
    {
        return view('master.kategori.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'Nama' => 'required|string|max:255',
            'Icon' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $namaFile = null;
        if ($request->hasFile('Icon')) {
            $file = $request->file('Icon');
            $namaFile = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/uploads/icon-kategori', $namaFile);
        }

        KategoriItem::create([
            'Nama' => $request->Nama,
            'Icon' => $namaFile,
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
            'Nama' => 'required|string|max:255',
            'Icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $kategori = KategoriItem::findOrFail($id);

        $namaFile = $kategori->Icon;
        if ($request->hasFile('Icon')) {
            $file = $request->file('Icon');
            $namaFile = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/uploads/icon-kategori', $namaFile);
        }

        $kategori->update([
            'Nama' => $request->Nama,
            'Icon' => $namaFile,
            'UserUpdate' => auth()->user()->name,
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
