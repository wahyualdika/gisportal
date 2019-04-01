@extends('admin.master')

@section('stylesheet')
@endsection

@section('main')
<div class="jumbotron">
  <div class="container">
    <h1>Hello, admin</h1>
  <p>Selamat di halaman utama administrator,silahkan menekan tombol dibawah untuk menginput data atau berita</p>
  <p><a class="btn btn-primary btn-lg" href="{{route('admin.news.form')}}" role="button">Berita</a>
  <a class="btn btn-primary btn-lg" href="{{route('admin.maps.form')}}" role="button">Peta</a>
  <a class="btn btn-primary btn-lg" href="{{route('admin.layers.form')}}" role="button">Layer</a></p>
  </div>
</div>
@endsection

@section('script')
@endsection
