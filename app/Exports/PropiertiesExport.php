<?php

namespace App\Exports;

use App\Models\Property;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PropiertiesExport implements FromCollection,WithHeadings,WithStyles
{
    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]],
        ];
    }
    public function headings(): array
    {
        return [
            'Codigo',
            'Fecha',
            'Titulo',
            'Precio GT',
            'Precio USD',
            'Direccion',
            'Vendedor',
            'Detalle',
            'Estado'
        ];
    }
    public function collection()
    {
        // return Property::select('code','created_at','title','engage_gtq',
        // 'sale_usd','adress','partner','another_details','status')->get();

        return Property::all();
    }
}