@extends('admin.master')
@section('stylesheet')
<style>
    .failure { color: red; }
    #status { font-size: 12px; }
</style>
@endsection

@section('main')
<div class=container>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action='{{route('admin.popUp.input')}}' method='POST' enctype='multipart/form-data'>
{{ csrf_field() }}

<div class='form-group' id="id-layer">
  <label for='exampleIDLayer'>ID Layer</label>
  <input type='text' name='id_layer' class='form-control' value='{{$layer->id_layer}}' placeholder='Masukkan ID Layer yang unik'>
</div>

<div class='form-group' id="nama">
  <label for='exampleInputTitle'>Nama Layer</label>
  <input type='text' name='title' class='form-control' id='nama' value='{{$layer->title}}' placeholder='Masukkan Nama Layer' required>
</div>

<div class='form-group' id="url">
  <label for='exampleInputURL'>URL Layer</label>
  <span id="status"></span>
  <input type='text' name='url' class='form-control' id="url-layer" value='{{$layer->url}}' placeholder='Masukkan URL Layer' required>
</div>

<div class='form-group' id="type">
  <label for='exampleLayerType'>Layer Type</label>
  <select class="form-control type" id="type-layer" name="type">
      <option selected="selected">Pilih Type</option>
      <option value="dynamic">Dynamic</option>
      <option value="feature">Feature</option>
  </select>
</div>

<div class='form-group' id="sub-layer" style="display: none">
  <label for='exampleDefaultLayer'>Sub Layers</label>
  <select class="select2-multi-layers form-control" id="sub-layer" name="layer" value="">
  </select>
</div>

<div class="container-fluid">
  <div class="row">
  <textarea id="content"></textarea>
  <button type="button" class="btn btn-primary btn-xs .col-md-4" id="show">Show Available Field</button>
  </div>
</div>

<div class=container>
<div class='form container-fluid' id="field-container">

</div>
</div>

<input type='hidden' name='layer_id' value="{{$layer->id}}"/>

<div>
  <p>
    <button type="button" class="btn btn-primary btn-xs" id="add-field">Tambah Field</button>
  </p>
  <p>
    <button type="button" class="btn btn-primary btn-xs" id="remove-field">Hapus Field</button>
  </p>
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
var layer="";
var count=0;
var fAttr =   "<div id='field-list'>"+
              "<div class='form-group'>"+
              "<label for='exampleInputField'>Field</label>"+
              "<input type='text' name='fields[]' class='form-control' id='url-layer' placeholder='Masukkan Nama Field' required>"+
              "</div>"+
              "<div class='form-group'>"+
              "<label for='exampleInputAlias'>Alias</label>"+
              "<input type='text' name='aliases[]' class='form-control' id='url-layer' placeholder='Masukkan Alias Field' required>"+
              "</div>"+"</div>";
 $(document).ready(function(){
       $("#add-field").click(function(){
         $("#field-container").append(fAttr);
       });
       $("#remove-field").click(function(){
         $("#field-list").detach();
       });

           $("#type-layer").change(function(){
             var value = $("#type-layer").val();
               if(value == "dynamic"){
                 $("#sub-layer").show();
               }
               else{
                 $("#sub-layer").hide();
               }
           });
      });


 require(["dojo/dom", "dojo/on", "dojo/dom-class", "dojo/_base/json", "dojo/_base/array", "dojo/string", "esri/request", "dojo/domReady!","dijit/form/Select","dojo/data/ObjectStore","dojo/store/Memory","dojo/domReady!"], function(dom, on, domClass, dojoJson, array, dojoString, esriRequest) {
     on(dom.byId("type-layer"), "change", getLayers);


     function getLayers(){
       //get the url and setup a proxy
       var url = dom.byId("url-layer").value;

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

           if(response.hasOwnProperty("layers")){
             layer = response.layers;
           for(var i = 0; i < layer.length; i++){
               layer[i]= {id:layer[i].id,name:layer[i].name}
           }
           var dataLayer = $.map(layer, function (obj) {
               obj.text =  obj.id;
               return obj;
           });
           $(".select2-multi-layers").select2({
               data: dataLayer
           });
         }

     }
     function requestFailed(error, io){

       domClass.add(dom.byId("status"), "failure");

       dojoJson.toJsonIndentStr = " ";
       dom.byId("status").value = dojoJson.toJson(error, true);

     }

 });

    require(["dojo/dom", "dojo/on", "dojo/dom-class", "dojo/_base/json", "dojo/_base/array", "dojo/string", "esri/request", "dojo/domReady!","dijit/form/Select","dojo/data/ObjectStore","dojo/store/Memory","dojo/domReady!"], function(dom, on, domClass, dojoJson, array, dojoString, esriRequest) {
        on(dom.byId("show"), "click", getFields);


        function getFields(){
          //get the url and setup a proxy
          var url = dom.byId("url-layer").value;
          var typeLayer = $("#type-layer").val();

          if(typeLayer == "dynamic"){
            var layer = $('#sub-layer').select2('data');
            var urlcomplete = url+layer[0].id;
          }
          else if (typeLayer == "feature"){
            var urlcomplete = url;
            $('#sub-layer').attr('value', '0');
          }

          var requestHandle = esriRequest({
            "url": urlcomplete,
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
            var fieldinfo = field.map(function(f) {
              return f.name
            });
          }
          $("#content").val(fieldinfo);
          console.log(response.id);
        }
        function requestFailed(error, io){

          domClass.add(dom.byId("status"), "failure");

          dojoJson.toJsonIndentStr = " ";
          dom.byId("status").value = dojoJson.toJson(error, true);

        }
    });

  </script>



@endsection
