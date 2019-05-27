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

<div class='form-group' id="layer">
  <label for='exampleLayer'>Layer</label>
  <input type='number' name='layer' class='form-control' id="sub-layer" placeholder='contoh:0,2' required>
  </select>
</div>

<div class="container-fluid">
  <div class="row">
  <textarea id="content"></textarea>
  <button type="button" class="btn btn-primary btn-xs .col-md-4" id="show">Show Available Field</button>
  </div>
</div>

<div class='form-group' id="field-list">


</div>

<input type='hidden' name='layer_id' value="{{$layer->id}}"/>

<div>
  <p>
    <button type="button" class="btn btn-primary btn-xs" id="add-field">Tambah Field</button>
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
var count=0;
var fAttr =   "<label for='exampleInputField'>Field</label>"+
              "<input type='text' name='fields[]' class='form-control' id='url-layer' placeholder='Masukkan URL Layer' required>";
 $(document).ready(function(){
      $("#add-field").click(function(){
        $("#field-list").append(fAttr);
      });

      // $("button").click(function(){
      //   var id_layer = $("#id").val();
      //   $.get("{{url('/admin/popUp/')}}"+ id_layer, function(data, status){
      //     // $("#id").val(data);
      //     console.log(data);
      //   });
      // });
 });

    require(["dojo/dom", "dojo/on", "dojo/dom-class", "dojo/_base/json", "dojo/_base/array", "dojo/string", "esri/request", "dojo/domReady!","dijit/form/Select","dojo/data/ObjectStore","dojo/store/Memory","dojo/domReady!"], function(dom, on, domClass, dojoJson, array, dojoString, esriRequest) {
        on(dom.byId("show"), "click", getFields);


        function getFields(){
          //get the url and setup a proxy
          var url = dom.byId("url-layer").value;
          var layer = dom.byId("sub-layer").value;

          var urlcomplete = url+layer;

          console.log(url+layer);

          if(layer < 0){
            alert("Please enter a valid number");
            return;
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
        }
        function requestFailed(error, io){

          domClass.add(dom.byId("status"), "failure");

          dojoJson.toJsonIndentStr = " ";
          dom.byId("status").value = dojoJson.toJson(error, true);

        }
    });

  </script>



@endsection
