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
        //dd($layer);
        return view('admin.layer.pop_up.form')->withLayer($layer);
    }

    public function input(Request $request){
      //dd($request);
        $this->validate($request,array(
            'title'     => 'required|max:255',
            'url'       => 'required',
            'layer'     => 'required|numeric',
            'fields'    => 'required|max:255',
            'id_layer'  => 'required',
            'layer_id'  => 'required|numeric',
        ));
        $popup = new PopUpLayer();
        $popUpGenerator = new GeneratePopUp();
        $popup->id_layer  = $request->id_layer;
        $popup->title     = $request->title;
        $popup->url       = $request->url;
        $popup->fields    = $request->fields;
        $popup->layer_id  = $request->layer_id;
        $popup->sub_layer = $request->layer;

        $popup->save();
        $popUpGenerator->generatePopUp();
        return response()->json($popup);
    }

    public function updateForm($id){
        $popup = PopUpLayer::where('id',$id)->firstOrFail();
        $fields = implode(",",$popup->fields);
        return view('admin.layer.pop_up.form_update')->withPopup($popup)->withFields($fields);
    }

    public function update(Request $request, $id){
      //dd($request);
        $this->validate($request,array(
            'title'     => 'required|max:255',
            'url'       => 'required',
            'layer'     => 'required|numeric',
            'fields'    => 'required|max:255',
            'id_layer'  => 'required',
            'layer_id'  => 'required|numeric',
        ));
        $popup = PopUpLayer::find($id);
        $popUpGenerator = new GeneratePopUp();
        $popup->id_layer  = $request->id_layer;
        $popup->title     = $request->title;
        $popup->url       = $request->url;
        $popup->fields    = $request->fields;
        $popup->layer_id  = $request->layer_id;
        $popup->sub_layer = $request->layer;

        $popup->save();
        $popUpGenerator->generatePopUp();
        return response()->json($popup);
    }

    public function generateFromDB()
    {
      $generator = new GeneratePopUp();
      $generator->generatePopUp();
      return redirect()->route('admin.layers.all')->with('success', 'Pop Generated!');
    }
}
