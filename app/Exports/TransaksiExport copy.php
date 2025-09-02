<?php


namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class TransaksiExport implements FromView, WithColumnFormatting
{
    protected $transaksi;
    protected $tanggalList;

    public function __construct($transaksi, $tanggalList)
    {
        $this->transaksi = $transaksi;
        $this->tanggalList = $tanggalList;
    }

    public function view(): View
    {
        return view('exports.transaksi_perhari', [
            'transaksi' => $this->transaksi,
            'tanggalList' => $this->tanggalList,
        ]);
    }

    public function columnFormats(): array
    {
        return [
            'C' => NumberFormat::FORMAT_CURRENCY_IDR_SIMPLE,  // Harga Modal
            'D' => NumberFormat::FORMAT_CURRENCY_IDR_SIMPLE,  // Harga Jual
            'F:ZZ' => NumberFormat::FORMAT_CURRENCY_IDR_SIMPLE, // Total & Profit dinamis
        ];
    }
}
