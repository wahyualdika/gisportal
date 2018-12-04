@extends('admin.master')
@section('stylesheet')
@endsection

@section('main')
  <div class="panel panel-primary"><div class="panel-heading">
    <h3 class="panel-title">Judul Berita</h3>
  </div>
  <div class="panel-body">
    {{ $berita->namaBerita }}
  </div></div>
<div class="panel panel-primary"><div class="panel-heading">
    <h3 class="panel-title">Tanggal Ditambahkan</h3>
  </div>
  <div class="panel-body">
     {{ $berita->tanggal }}
  </div></div>
<div class="panel panel-primary"><div class="panel-heading">
    <h3 class="panel-title">Deskripsi Berita</h3>
  </div>
  <div class="panel-body">
      {{ $berita->deskripsiBerita }}
  </div></div>
<div class="panel panel-primary"><div class="panel-heading">
    <h3 class="panel-title">isiBerita</h3>
  </div>
  <div class="panel-body">
      {!! $berita->isiBerita !!}
  </div></div>
<div class="panel panel-primary"><div class="panel-heading">
    <h3 class="panel-title">Gambar Berita</h3>
</div>
  <div class="panel-body">
   <img src="{{URL::asset('storage/authentication/'.$berita->gambar_path)}}" width='180' height='100' class='img-responsive' alt='image-berita'>
</div>
</div>

@endsection


@section('script')
@endsection
