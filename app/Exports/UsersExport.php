<?php

namespace App\Exports;

use App\Petugas;
use App\Masyarakat;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class UsersExport implements FromView, WithEvents, ShouldAutoSize
{
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $cellRange = 'A1:W1';
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);
            },
        ];
    }

    public function view(): View
    {
        return view('admin.laporan.users_excel', [
            'petugas' => Petugas::all()->where('level', 'Petugas')
        ]);
    }
}
