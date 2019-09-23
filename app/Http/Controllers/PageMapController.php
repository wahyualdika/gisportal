<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\MapModel;
use Codedge\Fpdf\Fpdf\Fpdf;

class PageMapController extends Controller
{
      public function getWebGIS(){
        // return view('WebGIS.main');
        return view('cmv.viewer.index');
      }

      public function getRecentMap(){
        $maps = MapModel::orderBy('tanggal_peta', 'desc')
             ->take(5)
             ->get();
        return view('peta.recentMap')->withMaps($maps);
      }

      public function getAllMap(){
        $maps = MapModel::paginate(10);
        return view('peta.allMap')->withMaps($maps);
      }

      public function downloadPNG($id){
        $map = MapModel::find($id);
        $path_file = public_path().'/storage/authentication/'.$map->path;
        return response()->download($path_file);
      }

      public function downloadPDF($id){
        $map = MapModel::find($id);
        $path_file = public_path().'/storage/authentication/'.$map->path;
        $pdf = new Fpdf();
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetFont('Times','',12);
        $pdf->Image($path_file,-5,25,215,245);
        $pdf->Output();
      }
}
