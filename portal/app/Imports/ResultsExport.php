<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ResultsExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // dd(session()->get('scid'));
        $sect=DB::table('users')
        ->select(DB::raw('users.name as uname,users.roll as uroll'))
        ->where('role','student')
        ->where('delet','!=','1')
        ->where('school_id',Auth::user()->school_id)
        ->where('section_id',session()->get('scid'))
        ->orderby('name')
        ->get();
        // ->pluck('roll', 'name');
        
        return $sect;

        // return Result::all();
    }

    public function headings(): array
    {
        return [
            'Students ID',
            'Students Name',
            'ASSIGNMENT 1',
            'ASSIGNMENT 2',
            'TEST1',
            'TEST2',
            'Exams',
        ];
    }

    public function map($result): array
    {
        // dd($result);
        return [
            $result->uroll,
            $result->uname,
            '',
            '',
            '',
            '',
            '',
        ];
    }

}
