@extends('admin.master')
@section('stylesheet')
@endsection

@section('main')
<form action='{{route('admin.foto.edit',['id'=>$layer->id])}}' class='forms-sample' method='post' enctype='multipart/form-data'>
  <div class="row">

      {{ csrf_field() }}
      @foreach ($fotos as $foto)
        <div class="col-sm-6 col-md-4">
          <div class="thumbnail">
            <img src="{!! URL::asset('public/storage/authentication/'.$foto->path) !!}" alt="foto">
            <div class="caption">

              <h3>{{$foto->filename}}</h3>
              <p> <label for="file" class="label label-default">Ganti Gambar</label></p>
              <p><input type='file' name='images[]' class='form-control' id='foto-layer'></p>
              <input type="hidden" name="idImg[]" value="{{$foto->id}}">

            </div>
          </div>
        </div>
      @endforeach


  </div>
  <p><button class='btn btn-default opener-dialog' type="submit">Ubah Foto</button></p>
</form>
@endsection

@section('script')
@endsection
