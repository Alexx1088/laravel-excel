<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;
use Psy\Readline\Hoa\FileException;
use Symfony\Component\HttpFoundation\File\Exception\FileNotFoundException;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class UserController extends Controller
{
  public function export() {
      return Excel::download(new UsersExport, 'users.xlsx');
  }

  public function import() {

      $filepathsource = 'users.xls';
      $filepathdes = 'users.xlsx';
      $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($filepathsource);
      $writer = new Xlsx($spreadsheet);
      $writer->save($filepathdes);


    /*  try {*/

          Excel::import(new UsersImport, 'public/users.xls');

          return redirect('/')->with('success', 'All good!');
     /* } catch (FileNotFoundException $e) {
          dd($e->getMessage());
      }*/
  }

}
