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
        $layers = LayerModel::all('group')->unique();
        return view('admin.layer.formLayer')->withLayers($layers);
    }

    public function viewDetails($id){
      $layer = LayerModel::find($id);
      return view('admin.layer.viewDetailLayer')->withLayer($layer);
    }

    public function inputLayers(Request $request){

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
      $layer = new LayerModel();
      $generator = new GenerateLayer();
      $layer->title = $request->title;
      $layer->url = $request->url;
      $layer->type = strtolower($request->type);
      $layer->default_layer= $request->default_layer;
      $layer->id_layer = $request->id_layer;
      $layer->fields = $request->fields;
      $layer->visible = $request->visible;
      $layer->group = $request->group;
      //dd($layer->group);
      $layer->save();
      $generator->generateLayer();
      return redirect()->route('admin.layers.all');
    }

    public function updateLayers($id){
      $layer = LayerModel::find($id);
      $groups = LayerModel::all()->unique('group');

      if($layer->type == 'feature'){
        if($layer->fields == null){
          $fields = "Tidak ada Field"; $default = "Tidak ada Default Layer";
          return view('admin.layer.formUpdateLayer')->withLayer($layer)->withFields($fields)->withDefault($default)->withGroups($groups);
        }
        else{
          $fields = $layer->fields;
          $default = "Tidak ada Default Layer";
          return view('admin.layer.formUpdateLayer')->withLayer($layer)->withDefault($default)->withGroups($groups)->withFields($fields);
        }
      }
      elseif($layer->type == 'dynamic'){
        if($layer->default_layer == null){
          $default = "Tidak ada Default Layer";$fields = "Tidak ada Field";
          return view('admin.layer.formUpdateLayer')->withLayer($layer)->withDefault($default)->withFields($fields)->withGroups($groups);
        }
        else{
          $default = $layer->default_layer;
          $fields = "Tidak ada Field";
          return view('admin.layer.formUpdateLayer')->withLayer($layer)->withDefault($default)->withFields($fields)->withGroups($groups);
        }
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
      $layer->group = $request->group;
      $layer->save();
      $generator->generateLayer();
      return redirect()->route('admin.layers.all');
    }

    public function deleteLayers(Request $request, $id){
        $layer = LayerModel::find($id);
        $generator = new GenerateLayer();
        $layer->delete();
        $generator->generateLayer();
        return redirect()->route('admin.layers.all');
    }

}
