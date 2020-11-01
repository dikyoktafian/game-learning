<?php

namespace App\Exports;

use App\Models\MemberAnswer;
use Maatwebsite\Excel\Concerns\FromCollection;
// use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MemberAnswerExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return MemberAnswer::all();
    }
    public function headings(): array
    {
        return [
            'id',
            'User',
            'Date',
        ];
    }
}
