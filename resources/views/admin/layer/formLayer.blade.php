@extends('admin.master')
@section('stylesheet')
@endsection

@section('main')
<div class=container-fluid>
<form action='{{route('admin.layers.submit')}}' method='POST' enctype='multipart/form-data'>
{{ csrf_field() }}

<div class='form-group' id="nama">
  <label for='exampleInputTitle'>Nama Layer</label>
  <input type='text' name='title' class='form-control' placeholder='Masukkan Nama Layer' required>
</div>

<div class='form-group' id="url">
  <label for='exampleInputURL'>URL Layer</label>
  <input type='text' name='url' class='form-control' id="url-layer" placeholder='Masukkan URL Layer' required>
</div>

<div class='form-group' id="type">
  <label for='exampleLayerType'>Layer Type</label>
  <select class="form-control type" id="type-layer" name="type">
      <option selected="selected">Pilih Type</option>
      <option value="dynamic">Dynamic</option>
      <option value="feature">Feature</option>
  </select>
</div>

<div class='form-group' id="default-layer" style="display: none">
  <label for='exampleDefaultLayer'>Default Layer</label>
  <input type='number' name='default_layer' class='form-control' placeholder='Masukkan Default Layer'>
</div>

<div class='form-group' id="default-fields" style="display: none">
  <label for='exampleDefaultLayer'>Default Fields</label>
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


<div class='form-group' id="id-layer">
  <label for='exampleIDLayer'>ID Layer</label>
  <input type='text' name='id_layer' class='form-control'  placeholder='Masukkan ID Layer yang unik'>
</div>

<button type='submit' name='submit' class='btn btn-default'>Submit</button>
</form>
</div>

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
          console.log("response as text:\n", dojoJson.toJson(response, true));
          field = response.fields;
          var data = $.map(field, function (obj) {
              obj.text = obj.text || obj.name; // replace name with the property used for the text
              return obj;
          });
          $(".select2-multi").select2({
              data: data
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
