<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes\GeneratePopUp;
use App\Http\Requests;
use App\LayerModel;
use App\PopUpLayer;

class PopUpController extends Controller
{
    public function form($idLayer)
    {
        $layer = LayerModel::find($idLayer);
        return view('admin.layer.pop_up.form')->withLayer($layer);
    }

    public function input(Request $request){
      if ($request->type == "feature") {
        $this->validate($request,array(
            'title'     => 'required|string|max:255',
            'url'       => 'required|string',
            'fields'    => 'required|max:255',
            'id_layer'  => 'required',
            'layer_id'  => 'required|numeric',
            'aliases'   => 'required|max:255',
        ));
        $str = str_split($request->url);
        $popup = new PopUpLayer();
        $popUpGenerator = new GeneratePopUp();
        $popup->id_layer  = $request->id_layer;
        $popup->title     = $request->title;
        $popup->url       = $request->url;
        $popup->fields    = $request->fields;
        $popup->layer_id  = $request->layer_id;
        $popup->sub_layer = end($str);
        $popup->aliases   = $request->aliases;

        $popup->save();
        $popUpGenerator->generatePopUp();
        return response()->json(['status' => '200','massage' => 'Data Saved']);
      }

      elseif ($request->type == "dynamic") {
        $this->validate($request,array(
            'title'     => 'required|string|max:255',
            'url'       => 'required|string',
            'layer'     => 'required|numeric',
            'fields'    => 'required|max:255',
            'id_layer'  => 'required',
            'layer_id'  => 'required|numeric',
            'aliases'   => 'required|max:255',
        ));
        $popup = new PopUpLayer();
        $popUpGenerator = new GeneratePopUp();
        $popup->id_layer  = $request->id_layer;
        $popup->title     = $request->title;
        $popup->url       = $request->url;
        $popup->fields    = $request->fields;
        $popup->layer_id  = $request->layer_id;
        $popup->sub_layer = $request->layer;
        $popup->aliases   = $request->aliases;

        $popup->save();
        $popUpGenerator->generatePopUp();
        return response()->json(['status' => '200','massage' => 'Data Saved']);
      }

    }

    public function updateForm($id){
        $popup = PopUpLayer::where('id',$id)->firstOrFail();
        $fields = implode(",",$popup->fields);
        return view('admin.layer.pop_up.form_update')->withPopup($popup)->withFields($fields);
    }

    public function update(Request $request, $id){

      if ($request->type == "feature") {
        $this->validate($request,array(
            'title'     => 'required|string|max:255',
            'url'       => 'required|string',
            'fields'    => 'required|max:255',
            'id_layer'  => 'required|string',
            'layer_id'  => 'required|numeric',
            'aliases'   => 'required|max:255',
        ));
        $str = str_split($request->url);
        $popup = PopUpLayer::find($id);
        $popUpGenerator = new GeneratePopUp();
        $popup->id_layer  = $request->id_layer;
        $popup->title     = $request->title;
        $popup->url       = $request->url;
        $popup->fields    = $request->fields;
        $popup->layer_id  = $request->layer_id;
        $popup->sub_layer = end($str);
        $popup->aliases   = $request->aliases;

        $popup->save();
        $popUpGenerator->generatePopUp();
        return response()->json(['status' => '200','massage' => 'Data Saved']);

      }


        $this->validate($request,array(
            'title'     => 'required|string|max:255',
            'url'       => 'required|string',
            'layer'     => 'required|numeric',
            'fields'    => 'required|max:255',
            'id_layer'  => 'required|string',
            'layer_id'  => 'required|numeric',
            'aliases'   => 'required|max:255',
        ));
        $popup = PopUpLayer::find($id);
        $popUpGenerator = new GeneratePopUp();
        $popup->id_layer  = $request->id_layer;
        $popup->title     = $request->title;
        $popup->url       = $request->url;
        $popup->fields    = $request->fields;
        $popup->layer_id  = $request->layer_id;
        $popup->sub_layer = $request->layer;
        $popup->aliases   = $request->aliases;

        $popup->save();
        $popUpGenerator->generatePopUp();
        return response()->json(['status' => '200','massage' => 'Data Saved']);
    }

    public function generateFromDB()
    {
      $generator = new GeneratePopUp();
      $generator->generatePopUp();
      return redirect()->route('admin.layers.all')->with(['success'=> 'Pop Generated!']);
    }

    public function delete($id){
      $popup = PopUpLayer::find($id);
      $layer_id = $popup::find($id)->layer;
      if($popup->delete()){
        return redirect()->route('admin.maps.details',['id'=>$layer_id->id])->with(['success' => 'Pop Up Berhasil di Hapus']);
      }
      elseif (!$popup->delete()) {
        return redirect()->route('admin.maps.details',['id'=>$layer_id->id])->with(['error' => 'Pop Up Gagal di Hapus']);
      }
    }
}
