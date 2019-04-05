<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\MapModel;
use DateTime;
use Image;
use File;


class PetaController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function viewAll(){
      $petas = MapModel::paginate(10);
      return view('admin.peta.allMaps')->withPetas($petas);
    }

    public function viewDetails($id){
      $peta = MapModel::find($id);
      return view('admin.peta.viewDetails')->withPeta($peta);
    }

    public function getMapsForm(){
      return view('admin.peta.formMaps');
    }

    public function updateMaps($id){
      $peta = MapModel::find($id);
      return view('admin.peta.formUpdate')->withPeta($peta);
    }

    public function inputMaps(Request $request){
        $this->validate($request,array(
            'namaPeta' => 'required|max:255',
            'date'  => 'required',
        ));
        $peta = new MapModel();
        $peta->nama_peta = $request->namaPeta;
        $peta->tanggal_peta = DateTime::createFromFormat('d/m/Y', $request->date)->format('Y-m-d');
        $peta->deskripsi_peta = $request->deskripsiPeta;

        if($request->hasFile('gambarPeta')){
            $image = $request->file('gambarPeta');
            $filename = time(). '.' .$image->getClientOriginalExtension();
            $location = public_path('storage/authentication/img_peta/'.$filename);
            Image::make($image)->resize(800,400)->save($location);
            $peta->path = 'img_peta/'.$filename;
        }
        $peta->save();
        return redirect()->route('admin.maps.all');
    }

    public function update(Request $request, $id){
        $this->validate($request,array(
            'namaPeta' => 'required|max:255',
            'date'  => 'required',
        ));
        $peta = MapModel::find($id);
        $peta->nama_peta = $request->namaPeta;
        $peta->tanggal_peta = DateTime::createFromFormat('Y-m-d', $request->date)->format('Y-m-d');
        $peta->deskripsi_peta = $request->deskripsiPeta;

        if($request->hasFile('gambarPeta')){
            $image = $request->file('gambarPeta');
            File::delete(public_path('storage/authentication/'.$peta->path));
            $filename = time(). '.' .$image->getClientOriginalExtension();
            $location = public_path('storage/authentication/img_peta/'.$filename);
            Image::make($image)->resize(800,400)->save($location);
            $peta->path = 'img_peta/'.$filename;
        }
        $peta->save();
        return redirect()->route('admin.maps.all');
    }



    public function deleteMaps(Request $request, $id){
      $peta = MapModel::find($id);
      File::delete(public_path('storage/authentication/'.$peta->path));
      $peta->delete();
      return redirect()->route('admin.maps.all');
    }
}
