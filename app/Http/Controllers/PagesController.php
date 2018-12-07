<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\BeritaModel;

class PagesController extends Controller
{
    public function getHome(){
        $beritas = BeritaModel::orderBy('tanggal', 'desc')
             ->take(5)
             ->get();
        return view('pages.welcome')->withBeritas($beritas);
    }

    public function getDokumen(){
      return view('pages.dokumen');
    }

    public function getRecentNews(){
      $beritas = BeritaModel::orderBy('tanggal', 'desc')
             ->take(5)
             ->get();
        return view('pages.infoTerbaru')->withBeritas($beritas);
    }

    public function getDetailNews($id){
      $berita = BeritaModel::find($id);
      return view('pages.newsDetail')->withBerita($berita);
    }
}
