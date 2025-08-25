<?php

namespace App\Http\Controllers;

use App\Models\MasterShift;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class MasterShiftController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = MasterShift::latest();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return '
                        <a href="' . route('shift.edit', $row->id) . '" class="btn btn-sm btn-warning">Edit</a>
                        <button class="btn btn-sm btn-danger btn-delete" data-id="' . $row->id . '">Hapus</button>
                    ';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('master.shift.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('master.shift.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'NamaShift' => 'required|string|max:255',
            'JamMasuk' => 'required|date_format:H:i',
            'JamPulang' => 'required|date_format:H:i|after:JamMasuk',
        ]);

        MasterShift::create([
            'NamaShift' => $request->NamaShift,
            'JamMasuk' => $request->JamMasuk,
            'JamPulang' => $request->JamPulang,
        ]);

        return redirect()->route('shift.index')->with('success', 'Shift berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(MasterShift $masterShift)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $shift = MasterShift::findOrFail($id);
        return view('master.shift.edit', compact('shift'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MasterShift $masterShift)
    {
        $request->validate([
            'NamaShift' => 'required|string|max:255',
            'JamMasuk' => 'required|date_format:H:i',
            'JamPulang' => 'required|date_format:H:i|after:JamMasuk',
        ]);

        $masterShift->update([
            'NamaShift' => $request->NamaShift,
            'JamMasuk' => $request->JamMasuk,
            'JamPulang' => $request->JamPulang,
        ]);

        return redirect()->route('shift.index')->with('success', 'Shift berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = MasterShift::find($id);

        if (!$data) {
            return response()->json(['status' => 404, 'message' => 'Data tidak ditemukan']);
        }

        $data->delete();
        return response()->json(['status' => 200, 'message' => 'Shift berhasil dihapus']);
    }
}
