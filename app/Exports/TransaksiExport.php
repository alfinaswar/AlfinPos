<?php


namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;


class TransaksiExport implements FromView, WithColumnFormatting, WithStyles
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
        return view('laporan.excel.perhari', [
            'transaksi' => $this->transaksi,
            'tanggalList' => $this->tanggalList,
        ]);
    }

    public function columnFormats(): array
    {
        return [
            'C' => '#,##0',
            'D' => '#,##0',
            'F:ZZ' => '"Rp" #,##0',
        ];
    }
    public function styles(Worksheet $sheet)
    {
        return [
            1 => [ // baris pertama (header)
                'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '4A90E2'] // biru
                ],
                'alignment' => ['horizontal' => 'center'],
            ],
        ];
    }
}
