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
      <!-- <option selected="{{$layer->type}}" style="text-transform: uppercase">{{$layer->type}}</option> -->
      <option value="dynamic">Dynamic</option>
      <option value="feature">Feature</option>
  </select>
</div>

<div class='form-group'id="default-layer">
  <label for='exampleDefaultLayer'>Default Layer</label>
  <input type='number' name='default_layer' class='form-control'  placeholder='Masukkan Default Layer' value="{{$layer->default_layer}}">
</div>

<div class='form-group' id="default-fields" style="display: none">
  <label for='exampleDefaultLayer'>Default Fields</label>
  <p>Current Fields:{{$fields}}</p>
  <select class="select2-multi form-control" id="field-layer" name="fields[]" multiple="multiple">
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
$(document).ready(function(){

    $("#type-layer").change(function(){
      var value = $("#type-layer").val();
        if(value == "dynamic"){
          $("#default-layer").show();
          $("#default-fields").hide();
        }
        else if(value == "feature"){
          $("#default-fields").show();
          $("#default-layer").hide();
        }
        else{
          $("#default-fields").hide();
          $("#default-layer").hide();
        }

    });
});

    require(["dojo/dom", "dojo/on", "dojo/dom-class", "dojo/_base/json", "dojo/_base/array", "dojo/string", "esri/request", "dojo/domReady!","dijit/form/Select","dojo/data/ObjectStore","dojo/store/Memory","dojo/domReady!"], function(dom, on, domClass, dojoJson, array, dojoString, esriRequest,Select, ObjectStore, Memory) {
        on(dom.byId("type-layer"), "change", getFields);


        function getFields(){
          //get the url and setup a proxy
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

          //toJson converts the given JavaScript object
          //and its properties and values into simple text
          dojoJson.toJsonIndentStr = "  ";
          //console.log("response as text:\n", dojoJson.toJson(response, true));
          field = response.fields;
          layer = response.layers;
          //console.log(response.layers);
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
              dataLayer: layer
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
