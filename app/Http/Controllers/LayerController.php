<?php

namespace App\Http\Controllers;

use App\Classes\GenerateLayer;
use Illuminate\Http\Request;
use App\LayerModel;
use App\PopUpLayer;
use App\Http\Requests;
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
        $layers = LayerModel::all()->unique('group');
        return view('admin.layer.formLayer')->withLayers($layers);
    }

    public function viewDetails($id){
        $layer = LayerModel::find($id);
        $popup = "";
        $foto = "";
        try {
            if($layer->popup()->exists()){
              $popup = $layer->find($id)->popUp;
            }
            else{
              $popup = NULL;
            }
        } catch (\Exception $e) {
          return $e->getMessage();
        }

        try {
          if($layer->foto()->exists()){
            $foto = $layer->find($id)->foto;
          }
          else{
            $foto = NULL;
          }
        } catch (\Exception $e) {
          return $e->getMessage();
        }


        if($layer->type == 'dynamic'){
            $defaultlayer = implode(",",$layer->default_layer);
            return view('admin.layer.viewDetailLayer')->withLayer($layer)->withDefaultlayer($defaultlayer)->withPopup($popup)->withFoto($foto);
        }
        elseif ($layer->type == 'feature') {
            $field = implode(",",$layer->fields);
            return view('admin.layer.viewDetailLayer')->withLayer($layer)->withField($field)->withPopup($popup)->withFoto($foto);
        }
    }

    public function inputLayers(Request $request){

        if($request->type=='dynamic'){
          $this->validate($request,array(
              'title' => 'required|max:255',
              'url'   => 'required|max:255',
              'type'  => 'required|max:255',
              'default_layer' => 'required',
              'id_layer' => 'required|unique:layer,id_layer',
          ));
      }
      elseif($request->type == 'feature'){
        $this->validate($request,array(
            'title' => 'required|max:255',
            'url'   => 'required|max:255',
            'type'  => 'required|max:255',
            'id_layer' => 'required|unique:layer,id_layer',
            'fields' => 'required',
            'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
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

      $layer->save();
      $generator->generateLayer();
      return redirect()->route('admin.layers.all');
    }

    public function updateLayers($id){
      $layer = LayerModel::find($id);
      $groups = LayerModel::all()->unique('group');

      if($layer->type == 'feature'){
        if($layer->fields == null){
          $fields = "Tidak ada Field";
          return view('admin.layer.formUpdateLayer')->withLayer($layer)->withFields($fields)->withDefault($default)->withGroups($groups);
        }
        else{
          $fields = $layer->fields;
          return view('admin.layer.formUpdateLayer')->withLayer($layer)->withGroups($groups)->withFields($fields);
        }
      }
      elseif($layer->type == 'dynamic'){
        if($layer->default_layer == null){
          $default = "Tidak ada Default Layer";
          return view('admin.layer.formUpdateLayer')->withLayer($layer)->withDefault($default)->withGroups($groups);
      }
        else{
          $default = $layer->default_layer;
          return view('admin.layer.formUpdateLayer')->withLayer($layer)->withDefault($default)->withGroups($groups);
        }
      }

    }

    public function update(Request $request,$id){
      $layer = LayerModel::find($id);
      $generator = new GenerateLayer();

      if($request->type=='dynamic'){
        $this->validate($request,array(
            'title' => 'required|max:255',
            'url'   => 'required',
            'type'  => 'required|max:255',
            'default_layer' => 'required',
            'id_layer' => 'required|unique:layer,id_layer'. $layer->id,
        ));
      }
      elseif($request->type == 'feature'){
        $this->validate($request,array(
            'title' => 'required|max:255',
            'url'   => 'required|max:255',
            'type'  => 'required|max:255',
            'id_layer' => 'required|unique:layer,id_layer,'. $layer->id,
            'fields' => 'required',
        ));
      }

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

    public function generateFromDB()
    {
      $generator = new GenerateLayer();
      $generator->generateLayer();
      return redirect()->route('admin.layers.all')->with('success', 'Layer Generated!');
    }

    public function deleteLayers(Request $request, $id){
        $layer = LayerModel::find($id);
        $generator = new GenerateLayer();
        $layer->popUp()->delete();
        $layer->delete();
        $generator->generateLayer();
        return redirect()->route('admin.layers.all');
    }

}
