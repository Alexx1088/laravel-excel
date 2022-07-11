<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Imports\UsersImport;
use App\Models\User;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class UserController extends Controller
{
  public function export() {
      return Excel::download(new UsersExport, 'users.xlsx');
  }

  public function import() {
    /*  $filepathsource = 'users.xls';
      $filepathdes = 'users.xlsx';
      $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($filepathsource);
      $writer = new Xlsx($spreadsheet);
      $writer->save($filepathdes);*/
/*
   try {

       if (Excel::import(new UsersImport, 'excel/import/users.xls')) {

           throw new Exception('import is ok!');
       }
   } catch (Exception $exception) {
       $exception->getMessage();
       if ($exception->getMessage() !== 'import is ok'){
           dd('failure');
       }
       /* return redirect('/')->with('success', 'All good!');*/
    /*  } catch (FileNotFoundException $e) {
          dd($e->getMessage());
      }*/
     /* $check = ProverkaModel::all();

      try {
          if (!file_exists($check)) {
              throw new Exception('file not found');
          }
      } catch (Exception $e) {
          echo $e->getMessage();*/
     /* }*/
  }
  public function list() {
      $users = User::get();
      return view('users', compact('users'));
  }

  public function import_user(Request $request) {
  $request->validate(['excel_file' => 'required|mimes:xls']);

      try {
          Excel::import(new UsersImport, $request->file('excel_file'));
          return redirect()->back()->with('success', 'Users successfully imported');
        /*  $import->import('import-users.xlsx');*/

      } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
          $failures = $e->failures();
       //   dd($failures);
          return redirect()->back()->with('import_errors', $failures);

         /* foreach ($failures as $failure) {
              $failure->row(); // row that went wrong
              $failure->attribute(); // either heading key (if using heading row concern) or column index
              $failure->errors(); // Actual error messages from Laravel validator
              $failure->values(); // The values of the row that has failed.
          }*/
      }
         }

}
