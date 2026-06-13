<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class UsersExport implements FromCollection, WithHeadings, WithStyles, WithTitle, ShouldAutoSize
{
    public function collection()
    {
        return User::with('profile', 'services')
            ->where('role', '!=', 'admin')
            ->get()
            ->map(fn ($user, $i) => [
                'No'          => $i + 1,
                'Nama'        => $user->nama_lengkap,
                'Email'       => $user->email,
                'Username'    => $user->username,
                'Role'        => ucfirst($user->role),
                'NPM'         => $user->profile?->npm ?? '-',
                'Prodi'       => $user->profile?->prodi ?? '-',
                'Harga Mulai' => $user->profile?->harga_mulai ?? 0,
                'Jml Jasa'    => $user->services->count(),
                'Status'      => $user->profile?->status_ketersediaan ?? '-',
            ]);
    }

    public function headings(): array
    {
        return ['No', 'Nama Lengkap', 'Email', 'Username', 'Role', 'NPM', 'Program Studi', 'Harga Mulai (Rp)', 'Jumlah Jasa', 'Status'];
    }

    public function styles(Worksheet $sheet)
    {
        $lastRow = $sheet->getHighestRow();

        $sheet->getStyle('A1:J1')->applyFromArray([
            'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF'], 'size' => 11],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '15803D']],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
        ]);

        $sheet->getStyle("A1:J{$lastRow}")->getBorders()->getAllBorders()
            ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

        for ($row = 2; $row <= $lastRow; $row++) {
            if ($row % 2 === 0) {
                $sheet->getStyle("A{$row}:J{$row}")->applyFromArray([
                    'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => 'F0FDF4']],
                ]);
            }
        }

        return [];
    }

    public function title(): string
    {
        return 'Data User';
    }
}
