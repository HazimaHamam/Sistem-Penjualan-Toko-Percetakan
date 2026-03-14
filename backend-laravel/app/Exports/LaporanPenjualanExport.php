<?php

namespace App\Exports;

use App\Models\Penjualan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class LaporanPenjualanExport implements 
    FromCollection, 
    WithHeadings, 
    WithMapping,
    WithColumnFormatting,
    WithStyles
{
    public function collection()
    {
        return Penjualan::orderBy('id', 'asc')->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Tanggal',
            'Kode Transaksi',
            'Produk',
            'Jumlah',
            'Harga',
            'Total',
            'Pelanggan',
            'Pembayaran',
            'Status',
        ];
    }

    public function map($row): array
    {
        return [
            $row->id,
            $row->tanggal,
            $row->kode,
            $row->produk,
            $row->jumlah,
            $row->harga,
            $row->total,
            $row->pelanggan,
            $row->metode_pembayaran,
            $row->status,
        ];
    }


    public function columnFormats(): array
{
    return [
        'F' => '[$Rp-421] #,##0',
        'G' => '[$Rp-421] #,##0',
    ];
    }
    public function styles(Worksheet $sheet)
{
    $highestRow = $sheet->getHighestRow();

    return [
        // Header
        1 => [
            'font' => ['bold' => true],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical'   => Alignment::VERTICAL_CENTER,
            ],
        ],

        // Data
        "A2:J{$highestRow}" => [
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical'   => Alignment::VERTICAL_CENTER,
            ],
        ],
    ];
}
}
