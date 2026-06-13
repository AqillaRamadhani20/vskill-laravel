<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class OrdersExport implements FromCollection, WithHeadings, WithStyles, WithTitle, ShouldAutoSize
{
    public function collection()
    {
        return Order::with('service', 'buyer', 'seller')
            ->latest()
            ->get()
            ->map(fn ($order, $i) => [
                'No'       => $i + 1,
                'Jasa'     => $order->service->judul_jasa ?? '-',
                'Kategori' => $order->service->kategori ?? '-',
                'Pembeli'  => $order->buyer->nama_lengkap ?? '-',
                'Penyedia' => $order->seller->nama_lengkap ?? '-',
                'Harga'    => $order->service->harga ?? 0,
                'Status'   => ucfirst($order->status),
                'Tanggal'  => $order->created_at?->format('d/m/Y H:i'),
            ]);
    }

    public function headings(): array
    {
        return ['No', 'Judul Jasa', 'Kategori', 'Pembeli', 'Penyedia', 'Harga (Rp)', 'Status', 'Tanggal Order'];
    }

    public function styles(Worksheet $sheet)
    {
        $lastRow = $sheet->getHighestRow();

        // Header row
        $sheet->getStyle('A1:H1')->applyFromArray([
            'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF'], 'size' => 11],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '15803D']],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
        ]);

        // All cells border
        $sheet->getStyle("A1:H{$lastRow}")->getBorders()->getAllBorders()
            ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

        // Alternating row colors
        for ($row = 2; $row <= $lastRow; $row++) {
            if ($row % 2 === 0) {
                $sheet->getStyle("A{$row}:H{$row}")->applyFromArray([
                    'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => 'F0FDF4']],
                ]);
            }
        }

        return [];
    }

    public function title(): string
    {
        return 'Data Order';
    }
}
