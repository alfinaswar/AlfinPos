<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Absensi::with(['getShift', 'getUser'])->latest();

            if ($request->karyawan_id) {
                $data->where('UserCreate', $request->karyawan_id);
            }
            if ($request->start_date && $request->end_date) {
                $data->whereBetween('Tanggal', [$request->start_date, $request->end_date]);
            } elseif ($request->start_date) {
                $data->whereDate('Tanggal', '>=', $request->start_date);
            } elseif ($request->end_date) {
                $data->whereDate('Tanggal', '<=', $request->end_date);
            }

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('NamaKaryawan', function ($row) {
                    return $row->getUser->name;
                })
                ->addColumn('Shift', function ($row) {
                    return $row->getShift->NamaShift;
                })
                ->addColumn('Jenis', function ($row) {
                    $jenis = $row->Jenis;
                    $label = '';
                    $icon = '';
                    switch ($jenis) {
                        case 'Hadir':
                            $label = 'success';
                            $icon = '<i class="fa fa-check-circle"></i>';
                            break;
                        case 'Izin':
                            $label = 'info';
                            $icon = '<i class="fa fa-info-circle"></i>';
                            break;
                        case 'Sakit':
                            $label = 'warning';
                            $icon = '<i class="fa fa-medkit"></i>';
                            break;
                        case 'Cuti':
                            $label = 'secondary';
                            $icon = '<i class="fa fa-plane"></i>';
                            break;
                        default:
                            $label = 'dark';
                            $icon = '<i class="fa fa-question-circle"></i>';
                            break;
                    }
                    return '<span class="badge bg-' . $label . '">' . $icon . ' ' . $jenis . '</span>';
                })
                ->rawColumns(['Shift', 'NamaKaryawan', 'Jenis'])
                ->make(true);
        }
        $karyawan = User::get();
        return view('hrm.absen.index', compact('karyawan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'Shift' => 'required',
            'Jenis' => 'required|in:Hadir,Izin,Sakit,Cuti',
            'Catatan' => 'nullable|string|max:255',
        ]);

        Absensi::create([
            'UserCreate' => auth()->id(),
            'Shift' => $request->Shift,
            'Jenis' => $request->Jenis,
            'Catatan' => $request->Catatan,
            'Tanggal' => now()->toDateString(),
        ]);

        $user = User::find(auth()->id());
        if ($user) {
            $user->shift = $request->Shift;
            $user->save();
        }

        return redirect()->back()->with('success', 'Anda Berhasil Mengisi Kehadiran');
    }

    /**
     * Display the specified resource.
     */
    public function show(Absensi $absensi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Absensi $absensi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Absensi $absensi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Absensi $absensi)
    {
        //
    }
}
