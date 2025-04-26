<?php

namespace App\Exports;

use App\Models\Marker;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithCustomQuerySize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class MarkerExport implements FromQuery, WithHeadings, WithMapping, WithColumnWidths, WithCustomQuerySize
{
    use Exportable;
    public $query;

    public function __construct($query)
    {
        $this->query = $query;
    }

    public function query()
    {
        return Marker::searchable($this->query, true);
    }


    public function map($row): array
    {
        return [
            $row->area->title_ru,
            $row->place->title_ru,
            $row->breed->title_ru,
            $row->height,
            $row->diameter,
            $row->sanitary->title_ru,
//            $row->status->title_ru,
//            $row->category->title_ru,
            $row->age,
            $row->landing_date
        ];
    }

    public function headings(): array
    {
        return [
            'Район',
            'Место',
            'Порода',
            'Высота',
            'Диаметр',
            'Состояние',
//            'Статус',
//            'Вид насаждения',
            'Возраст',
            'Дата посадки'
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 35,
            'B' => 35,
            'C' => 35,
            'D' => 15,
            'E' => 15,
            'F' => 55,
//            'G' => 50,
//            'H' => 45,
            'I' => 15,
            'J' => 25
        ];
    }

    public function querySize(): int
    {
        return 500;
    }
}
