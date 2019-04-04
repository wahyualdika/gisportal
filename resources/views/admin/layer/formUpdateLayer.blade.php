@extends('admin.master')
@section('stylesheet')
@endsection

@section('main')
<div class=container-fluid>
<form action='{{route('admin.layers.update',['id'=>$layer->id])}}' method='POST' enctype='multipart/form-data'>
{{ csrf_field() }}

<div class='form-group' id="nama">
  <label for='exampleInputTitle'>Nama Layer</label>
  <input type='text' name='title' class='form-control'  placeholder='Masukkan Nama Layer' value="{{$layer->title}}"required>
</div>

<div class='form-group'id="url">
  <label for='exampleInputURL'>URL Layer</label>
  <input type='text' name='url' class='form-control' id="url-layer" placeholder='Masukkan URL Layer' value="{{$layer->url}}" required>
</div>

<div class='form-group' id="type">
  <label for='exampleLayerType'>Layer Type</label>
  <p>Current Type:{{$layer->type}}</p>
  <select class="form-control" id="type-layer" name="type">
      <option selected="{{$layer->type}}" style="text-transform: uppercase">{{$layer->type}}</option>
      <option value="dynamic">Dynamic</option>
      <option value="feature">Feature</option>
  </select>
</div>

<div class='form-group' id="default-group" style="display: none">
  <label for='exampleGroupLayer'>Group Layer</label>
  <select class="js-example-tags form-control" id="group-layer" name="group">
    @foreach($groups as $group)
        <option value="{{$group->group}}">{{$group->group}}</option>
    @endforeach
  </select>
</div>

<div class='form-group' id="default-layer" style="display: none">
  <label for='exampleDefaultLayer'>Default Layers</label>
  <!-- <p>Current Layer:{{$default}}</p>
  <input type="hidden" name="default_layers" value="{{$default}}"> -->
  <select class="select2-multi-layers form-control" id="default-layer" name="default_layer[]" multiple="multiple">
      @foreach($arr as $val)
        <option  selected="selected" value="{{$val}}">{{$val}}</option>
      @endforeach
  </select>
</div>

<div class='form-group' id="default-fields" style="display: none">
  <label for='exampleDefaultLayer'>Default Fields</label>
  <!-- <p>Current Fields:{{$fields}}</p> -->
  <!-- <input type="hidden" name="fields" value="{{$fields}}"> -->
  <select class="select2-multi form-control" id="field-layer" name="fields[]" multiple="multiple">
    @foreach($arr as $val)
      <option  selected="selected" value="{{$val}}">{{$val}}</option>
    @endforeach
  </select>
</div>

<div class='form-group' id="visibility">
  <label for='exampleDefaultLayer'>Visibility</label>
  <select class="form-control" name="visible">
      <option value="1">Yes</option>
      <option value="0">No</option>
  </select>
</div>

<div class='form-group'>
  <label for='exampleIDLayer'>ID Layer</label>
  <input type='text' name='id_layer' class='form-control'  value="{{$layer->id_layer}}" placeholder='Masukkan ID Layer yang unik'>
</div>

<button type='submit' name='submit' class='btn btn-default'>Submit</button>
</form>
<div class=container-fluid>
@endsection
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script src="https://js.arcgis.com/3.27/"></script>
<script type="text/javascript">
  var field="";
  var layer="";

$(document).ready(function(){
    $(".js-example-tags").select2({
      tags: true
    });
    $("#type-layer").change(function(){
      var value = $("#type-layer").val();
        if(value == "dynamic"){
          $("#default-layer").show();
          $("#default-fields").hide();
          $("#default-group").hide();
        }
        else if(value == "feature"){
          $("#default-fields").show();
          $("#default-layer").hide();
          $("#default-group").show();
        }
        else{
          $("#default-fields").hide();
          $("#default-layer").hide();
          $("#default-group").hide();
        }

    });
});

    require(["dojo/dom", "dojo/on", "dojo/dom-class", "dojo/_base/json", "dojo/_base/array", "dojo/string", "esri/request", "dojo/domReady!","dijit/form/Select","dojo/data/ObjectStore","dojo/store/Memory","dojo/domReady!"], function(dom, on, domClass, dojoJson, array, dojoString, esriRequest,Select, ObjectStore, Memory) {
        on(dom.byId("type-layer"), "change", getFields);


        function getFields(){
          var url = dom.byId("url-layer").value;

          if(url.length === 0){
            alert("Please enter a URL");
            return;
          }

          var requestHandle = esriRequest({
            "url": url,
            "content": {
              "f": "json"
            },
            "callbackParamName": "callback"
          });
          requestHandle.then(requestSucceeded, requestFailed);
        }

        function requestSucceeded(response, io){
          var pad;
          pad = dojoString.pad;
          dojoJson.toJsonIndentStr = "  ";
          //console.log("response as text:\n", dojoJson.toJson(response, true));
          field = response.fields;
          layer = response.layers;

          var data = $.map(field, function (obj) {
              obj.text = obj.text || obj.name; // replace name with the property used for the text
              return obj;
          });
          $(".select2-multi").select2({
              data: data
          });

          var dataLayer = $.map(layer, function (obj) {
              obj.text = obj.text || obj.name; // replace name with the property used for the text
              return obj;
          });
          $(".select2-multi-layers").select2({
              data: dataLayer
          });
          //dom.byId("field-layer").value = field;
        }
        function requestFailed(error, io){

          domClass.add(dom.byId("content"), "failure");

          dojoJson.toJsonIndentStr = " ";
          dom.byId("content").value = dojoJson.toJson(error, true);

        }
    });

  </script>
@endsection
