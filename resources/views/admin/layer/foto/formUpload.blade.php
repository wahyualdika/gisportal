@extends('admin.master')
@section('stylesheet')
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

<form action='{{route('admin.foto.store')}}' method='POST' enctype='multipart/form-data'>
{{ csrf_field() }}

<div class='form-group' id="nama">
  <label for='exampleInputTitle'>Nama Layer</label>
  <input type='text' name='name' class='form-control' placeholder='Masukkan Nama Layer' value="{{$layer->title}}" readonly required>
</div>

<div class='form-group' id="nama">
  <label for='exampleInputTitle'>ID Layer</label>
  <input type='text' name='id' class='form-control' value="{{$layer->id_layer}}" readonly required>
</div>

<div class='form-group' id="url">
  <label for='exampleInputURL'>URL Layer</label>
  <span id="status"></span>
  <input type='text' name='url' class='form-control' id="url-layer" placeholder='Masukkan URL Layer' value="{{$layer->url}}" required>
</div>

  <div class='form-group' id='foto-layer'>
    <label for='exampleInputFoto'>Foto</label>
    <input type='file' name='image[]' class='form-control' id='foto-layer' multiple required>
  </div>


<input type='hidden' name='layer_id' value="{{$layer->id}}"/>


<button type='submit' name='submit' class='btn btn-default'>Submit</button>
</form>
</div>
@endsection

@section('script')

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script src="https://js.arcgis.com/3.27/"></script>
<script type="text/javascript">
</script>
@endsection
