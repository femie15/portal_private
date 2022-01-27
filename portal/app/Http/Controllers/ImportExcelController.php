<?php

namespace App\Http\Controllers;

// use Excel;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Attendance;
use App\Models\Result;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\src\Facades\Excel;
use App\Imports\ResultsImport;
use App\Imports\ResultsExport;

class ImportExcelController extends Controller
{
    public function importExportView()
    {
        
        if(Auth::user()->role !="school" && Auth::user()->role !="teacher")
        {
            return redirect()->to('/dashboard');
        }
       return view('excel.index');
    }

    public function importExcel(Request $request) 
    {
        // dd(count($request->files));
        if (count($request->files)<1) {
           dd('No file selected, please go back to select a result file');
        }

        \Excel::import(new ResultsImport,$request->import_file);

        \Session::put('success', 'Result imported successfully, you can click the Back button.');
           
        return back();
    }

    public function exportExcel($type) 
    {
        return \Excel::download(new ResultsExport, $type.'.csv');
    }

    function index()
    {
    //  $data = DB::table('results')->orderBy('id', 'ASC')->get();
    //  dd($data);
    //  return view('excel.index');
    }

    function import(Request $request)
    {
     $this->validate($request, [
      'select_file'  => 'required|mimes:xls,xlsx'
     ]);

     $path = $request->file('select_file')->getRealPath();

     $data = Excel::load($path)->get();

     if($data->count() > 0)
     {
      foreach($data->toArray() as $key => $value)
      {
       foreach($value as $row)
       {
        $insert_data[] = array(
         'CustomerName'  => $row['customer_name'],
         'Gender'   => $row['gender'],
         'Address'   => $row['address'],
         'City'    => $row['city'],
         'PostalCode'  => $row['postal_code'],
         'Country'   => $row['country']
        );
       }
      }

      if(!empty($insert_data))
      {
       DB::table('results')->insert($insert_data);
      }
     }
     return back()->with('success', 'Excel Data Imported successfully.');
    }
}

