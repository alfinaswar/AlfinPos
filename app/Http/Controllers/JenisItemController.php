<?php

namespace App\Http\Controllers;

use App\Models\JenisItem;
use App\Models\KategoriItem;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class JenisItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = JenisItem::with('KategoriItem')->latest();
            if ($request->kategori_id) {
                $data->where('KategoriItem', $request->kategori_id);
            }
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return '
                        <a href="' . route('jenis.edit', $row->id) . '" class="btn btn-sm btn-warning">Edit</a>
                        <button class="btn btn-sm btn-danger btn-delete" data-id="' . $row->id . '">Hapus</button>
                    ';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $KategoriItem = KategoriItem::orderBy('Nama', 'asc')->get();
        return view('master.jenis.index', compact('KategoriItem'));
    }

    public function create()
    {
        $KategoriItem = KategoriItem::orderBy('Nama', 'asc')->get();
        return view('master.jenis.create', compact('KategoriItem'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'KategoriItem' => 'required|string|max:255',
            'Nama' => 'required|string|max:255'
        ]);

        JenisItem::create([
            'Nama' => $request->Nama,
            'KategoriItem' => $request->KategoriItem,
            'UserCreate' => auth()->user()->name,
        ]);

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
