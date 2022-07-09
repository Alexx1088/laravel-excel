<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Imports\UsersImport;
use App\Models\ProverkaModel;
use App\Models\User;
use Exception;
use Maatwebsite\Excel\Facades\Excel;
use Psy\Readline\Hoa\FileException;
use Symfony\Component\HttpFoundation\File\Exception\FileNotFoundException;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use function Symfony\Component\HttpKernel\DataCollector\getMessage;
use function Symfony\Component\Mime\Header\get;

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


   /*try {
          Excel::import(new UsersImport, 'excel/import/users.xls');

          return redirect('/')->with('success', 'All good!');
      } catch (FileNotFoundException $e) {
          dd(1111/*$e->getMessage());
      }*/

      $check = ProverkaModel::all();


      try {
          if (!file_exists($check)) {
              throw new Exception('file not found');
          }
      } catch (Exception $e) {

          echo $e->getMessage();

      }




  }




}
