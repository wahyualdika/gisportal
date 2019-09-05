<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Foto;
use Image;
use File;
use App\LayerModel;

class FotoController extends Controller
{
      public function form($id){
          $layer = LayerModel::findOrFail($id);
          return view('admin.layer.foto.formUpload')->withLayer($layer);
      }

      public function store(Request $request){
        $this->validate($request,array(
            'name'      => 'required|string|max:255',
            'url'       => 'required|string',
            'id'        => 'required|max:25',
            'layer_id'  => 'required|numeric',
            'image'     => 'required',
            'image.*'   => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ));
          if($request->hasFile('image')){
              foreach($request->file('image') as $image)
                {
                  $name = $image->getClientOriginalName();
                  $location = public_path('storage/authentication/img/webgis/'.$request->id);
                  if(!File::isDirectory($location)){
                      File::makeDirectory($location,777,true);
                  }
                  Image::make($image)->resize(800,400)->save($location.'/'. $name);
                  $foto = new Foto();
                  $foto->path = 'img/webgis/'.$request->id.$name;
                  $foto->layer_id = $request->layer_id;
                  $foto->name = $request->name;
                  $foto->filename = $name;
                  $foto->save();
                }
          }
          return response()->json(['status' => '200','massage' => 'Data Saved']);
    }

    public function view($id){
        $fotos = LayerModel::findOrFail($id)->foto;
        $layer = LayerModel::findOrFail($id);
        return view('admin.layer.foto.view')->withFotos($fotos)->withLayer($layer);
    }

    public function edit(Request $request,$id){
      $counter = 0;
      $idImg = $request->idImg;
      $id_layer = LayerModel::findOrFail($id)->id_layer;
        if($request->hasFile('images')){
          foreach ($request->file('images') as $image)
          {
              $fotos = LayerModel::findOrFail($id)->foto()->where('id', $idImg[$counter++])->first();
              File::delete(public_path('storage/authentication/'.$fotos->path));
              $name = $image->getClientOriginalName();
              $location = public_path('storage/authentication/img/webgis/'.$id_layer.'/'.$name);
              Image::make($image)->resize(800,400)->save($location);
              $fotos->path = 'img/webgis/'.$id_layer.'/'.$name;
              $fotos->filename = $name;
              $fotos->save();
          }
        }
        else{
          echo "There is no file";
        }
    }
}
