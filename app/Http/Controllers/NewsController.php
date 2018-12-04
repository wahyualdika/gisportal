<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\BeritaModel;
use Illuminate\Support\Facades\Redirect;
use DateTime;
use Image;
use File;

class NewsController extends Controller
{
  
  public function __construct()
  {
      $this->middleware('auth');
  }

  public function viewAllNews(){
    $beritas = BeritaModel::paginate(10);
    return view('admin.berita.allNews')->withBeritas($beritas);
  }

  public function viewDetails($id){
    $berita = BeritaModel::find($id);
    return view('admin.berita.viewDetails')->withBerita($berita);
  }

  public function getNewsForm(){
    return view('admin.berita.formNews');
  }

  public function inputNews(Request $request){
      $this->validate($request,array(
          'namaBerita' => 'required|max:255',
          'date'  => 'required',
          'isi' => 'required',
      ));
      $berita = new BeritaModel();
      $berita->namaBerita = $request->namaBerita;
      $berita->tanggal = DateTime::createFromFormat('d/m/Y', $request->date)->format('Y-m-d');
      $berita->deskripsiBerita = $request->deskripsi;
      $berita->isiBerita = $request->isi;
      $berita->linkBerita = $request->link;



      if($request->hasFile('gambarBerita')){
          $image = $request->file('gambarBerita');
          $filename = time(). '.' .$image->getClientOriginalExtension();
          $location = public_path('storage/authentication/img/'.$filename);
          Image::make($image)->resize(800,400)->save($location);
          $berita->gambar_path = 'img/'.$filename;
      }
      $berita->save();
      return redirect()->route('admin.news.all');
  }

  public function updateNews($id){
    $berita = BeritaModel::find($id);
    return view('admin.berita.formUpdate')->withBerita($berita);
  }

  public function update(Request $request, $id){
      $this->validate($request,array(
          'namaBerita' => 'required|max:255',
          'date'  => 'required',
          'isi' => 'required',
      ));
      $berita = BeritaModel::find($id);
      $berita->namaBerita = $request->namaBerita;
      $berita->tanggal = DateTime::createFromFormat('d/m/Y', $request->date)->format('Y-m-d');
      $berita->deskripsiBerita = $request->deskripsi;
      $berita->isiBerita = $request->isi;
      $berita->linkBerita = $request->link;



      if($request->hasFile('gambarBerita')){
          $image = $request->file('gambarBerita');
          File::delete(public_path('storage/authentication/'.$berita->gambar_path));
          $filename = time(). '.' .$image->getClientOriginalExtension();
          $location = public_path('storage/authentication/img/'.$filename);
          Image::make($image)->resize(800,400)->save($location);
          $berita->gambar_path = 'img/'.$filename;
      }
      $berita->save();
      return redirect()->route('admin.news.all');
  }


  public function deleteNews(Request $request, $id){
      $berita = BeritaModel::find($id);
      File::delete(public_path('storage/authentication/'.$berita->gambar_path));
      $berita->delete();
      return redirect()->route('admin.news.all');
  }
}
