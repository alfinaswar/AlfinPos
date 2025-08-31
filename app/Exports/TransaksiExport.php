<?php

namespace App\Exports;

use App\Models\Transaksi;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class TransaksiExport implements FromView
{
    protected $grouped;

    public function __construct($grouped)
    {
        $this->grouped = $grouped;
    }

    public function view(): View
    {
        return view('laporan.excel.index', [
            'grouped' => $this->grouped
        ]);
    }
}
