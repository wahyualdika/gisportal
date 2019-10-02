@extends('admin.master')
@section('stylesheet')
<style>
    .failure { color: red; }
    #status { font-size: 12px; }
</style>
@endsection

@section('main')
<div class=container-fluid>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action='{{route('admin.layers.submit')}}' method='POST' enctype='multipart/form-data'>
{{ csrf_field() }}

<div class='form-group' id="nama">
  <label for='exampleInputTitle'>Nama Layer</label>
  <input type='text' name='title' class='form-control' placeholder='Masukkan Nama Layer' required>
</div>

<div class='form-group' id="url">
  <label for='exampleInputURL'>URL Layer</label>
  <span id="status"></span>
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
  <label for='exampleDefaultLayer'>Default Layers</label>
  <select class="select2-multi-layers form-control" id="default-layer" name="default_layer[]" multiple="multiple">
  </select>
</div>

<div class='form-group' id="default-fields" style="display: none">
  <label for='exampleDefaultLayer'>Default Fields</label>
  <select class="select2-multi-fields form-control" id="field-layer" name="fields[]" multiple="multiple">
  </select>
</div>

<div class='form-group' id="default-group">
  <label for='exampleGroupLayer'>Group Layer</label>
  <select class="js-example-tags form-control" id="group-layer" name="group">
    <option  selected="selected">Pilih Group</option>
    @foreach($layers as $layer)
        <option value="{{$layer->group}}">{{$layer->group}}</option>
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


<div class='form-group' id="id-layer">
  <label for='exampleIDLayer'>ID Layer</label>
  <input type='text' name='id_layer' class='form-control'  placeholder='Masukkan ID Layer yang unik'>
</div>

<!-- <div class='form-group' id="foto-layer">
  <label for='exampleFotoLayer'>Foto</label>
  <input type='file' name='image[]' class='form-control'>
</div>

<div class=container>
<div class='form container-fluid' id="foto-container">

</div>
</div>


<div>
  <p>
    <button type="button" class="btn btn-primary btn-xs" id="add-foto">Tambah Foto</button>
  </p>
  <p>
    <button type="button" class="btn btn-primary btn-xs" id="remove-foto">Hapus Foto</button>
  </p>
</div> -->


<button type='submit' name='submit' class='btn btn-default'>Submit</button>
</form>
</div>

@endsection
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script src="https://js.arcgis.com/3.27/"></script>
<script type="text/javascript">
var field="";
var layer="";
var count=0;
// var fAttr =   "<div id='foto-list'>"+
//               "<div class='form-group' id='foto-layer'>"+
//               "<label for='exampleInputField'>Field</label>"+
//               "<input type='file' name='image[]' class='form-control' id='url-layer' placeholder='Masukkan Nama Field' required>"+
//               "</div>"+"</div>";

$(document).ready(function(){
    $(".js-example-tags").select2({
      tags: true
    });

    // $("#add-foto").click(function(){
    //   $("#foto-container").append(fAttr);
    // });
    // $("#remove-foto").click(function(){
    //   $("#foto-list").detach();
    // });

    $("#type-layer").change(function(){
      var value = $("#type-layer").val();
        if(value == "dynamic"){
          $("#default-layer").show();
          $("#default-fields").hide();
        }
        else if(value == "feature"){
          $("#default-fields").show();
          $("#default-group").show();
        }
        else{
          $("#default-fields").hide();
          $("#default-layer").hide();
          $("#default-group").hide();
        }

    });
});

    require(["dojo/dom", "dojo/on", "dojo/dom-class", "dojo/_base/json", "dojo/_base/array", "dojo/string", "esri/request", "dojo/domReady!","dojo/domReady!"], function(dom, on, domClass, dojoJson, array, dojoString, esriRequest) {
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

          if ( response.hasOwnProperty("fields") ){
            field = response.fields;
            console.log("response foto:\n", field[13].name);
            for(var i = 0; i < field.length; i++){
                field[i]= {id:field[i].name,name:field[i].name}
            }
            var data = $.map(field, function (obj) {
                obj.text = obj.name; // replace name with the property used for the text
                return obj;
            });
            $(".select2-multi-fields").select2({
                data: data
            });
          }

            layer = response.layers;

            console.log("response :\n", layer);
            var dataLayer = $.map(layer, function (obj) {
                obj.text =  obj.text || obj.name;
                return obj;
            });
            $(".select2-multi-layers").select2({
                data: dataLayer
            });
            console.log("response as text:\n", dataLayer);
        }
        function requestFailed(error, io){

          domClass.add(dom.byId("status"), "failure");

          dojoJson.toJsonIndentStr = " ";
          dom.byId("status").value = dojoJson.toJson(error, true);

        }
    });

  </script>



@endsection
