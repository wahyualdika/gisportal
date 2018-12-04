@extends('admin.master')
@section('stylesheet')
@endsection

@section('main')
  <div class="panel panel-primary"><div class="panel-heading">
    <h3 class="panel-title">Judul Peta</h3>
  </div>
  <div class="panel-body">
    {{ $peta->nama_peta }}
  </div></div>
<div class="panel panel-primary"><div class="panel-heading">
    <h3 class="panel-title">Tanggal Ditambahkan</h3>
  </div>
  <div class="panel-body">
     {{ $peta->tanggal_peta }}
  </div></div>
<div class="panel panel-primary"><div class="panel-heading">
    <h3 class="panel-title">Deskripsi Peta</h3>
  </div>
  <div class="panel-body">
      {{ $peta->deskripsi_peta }}
  </div></div>
<div class="panel panel-primary"><div class="panel-heading">
    <h3 class="panel-title">Gambar Peta</h3>
</div>
  <div class="panel-body">
   <img src="{{URL::asset('storage/authentication/'.$peta->path)}}" width='180' height='100' class='img-responsive' alt='image-berita'>
</div>
</div>
@endsection


@section('script')
@endsection
