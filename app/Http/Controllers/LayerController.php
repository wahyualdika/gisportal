<?php

namespace App\Http\Controllers;

use App\Classes\GenerateLayer;
use Illuminate\Http\Request;
use App\LayerModel;
use App\Http\Requests;
use File;
use Illuminate\Support\Facades\Storage;

class LayerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function viewAll(){
      $layers = LayerModel::paginate(10);
      return view('admin.layer.allLayers')->withlayers($layers);
    }

    public function getLayerForm(){
        return view('admin.layer.formLayer');
    }

    public function viewDetails($id){
      $layer = LayerModel::find($id);
      return view('admin.layer.viewDetailLayer')->withLayer($layer);
    }

    public function inputLayers(Request $request){

      if($request->type=='dynamic'){
        //dump($request);
        $this->validate($request,array(
            'title' => 'required|max:255',
            'url'   => 'required|max:255',
            'type'  => 'required|max:255',
            'default_layer' => 'required',
            'id_layer' => 'required',
        ));
      }
      elseif($request->type == 'feature'){
        //dump($request);
        $this->validate($request,array(
            'title' => 'required|max:255',
            'url'   => 'required|max:255',
            'type'  => 'required|max:255',
            'id_layer' => 'required',
            'fields' => 'required',
        ));
      }
      $layer = new LayerModel();
      $generator = new GenerateLayer();
      $layer->title = $request->title;
      $layer->url = $request->url;
      $layer->type = strtolower($request->type);
      $layer->default_layer= $request->default_layer;
      $layer->id_layer = $request->id_layer;
      $layer->fields = $request->fields;
      $layer->visible = $request->visible;
      $layer->save();
      $generator->generateLayer();
      return redirect()->route('admin.layers.all');
    }

    public function updateLayers($id){
      $layer = LayerModel::find($id);
      if($layer->fields == null){
        $fields = "Tidak ada Field";
        return view('admin.layer.formUpdateLayer')->withLayer($layer)->withFields($fields);
      }
      else{
        $arr = $layer->fields;
        $fields = implode(",",$arr);
        return view('admin.layer.formUpdateLayer')->withLayer($layer)->withFields($fields);
      }
    }

    public function update(Request $request,$id){
      if($request->type=='dynamic'){
        $this->validate($request,array(
            'title' => 'required|max:255',
            'url'   => 'required|max:255',
            'type'  => 'required|max:255',
            'default_layer' => 'required',
            'id_layer' => 'required',
        ));
      }
      elseif($request->type == 'feature'){
        $this->validate($request,array(
            'title' => 'required|max:255',
            'url'   => 'required|max:255',
            'type'  => 'required|max:255',
            'id_layer' => 'required',
            'fields' => 'required',
        ));
      }

      $layer = LayerModel::find($id);
      $generator = new GenerateLayer();
      $layer->title = $request->title;
      $layer->url = $request->url;
      $layer->type = strtolower($request->type);
      $layer->default_layer= $request->default_layer;
      $layer->id_layer = strtolower($request->id_layer);
      $layer->fields = $request->fields;
      $layer->visible = $request->visible;
      $layer->save();
      $generator->generateLayer();
    }

    public function deleteLayers(Request $request, $id){
        $layer = LayerModel::find($id);
        $layer->delete();
        return redirect()->route('admin.layers.all');
    }

}