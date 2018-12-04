@extends('pages.master')
@section('stylesheet')
@endsection

@section('script')
@endsection

@section('header')
  <div class="wrapper col6">
  		<div id="breadcrumb">
  			<ul>
  				<li><a href="{{route('home')}}">HOME</a></li>
  				<li>&#187;</li>
  				<li class="current"><a href="{{route('home.map.recent')}}">Berita Terbaru</a></li>
  			</ul>
  		</div>
  </div>

  <div class="wrapper col7">
  		<div id="container2">
  			<img src="{{URL::asset('storage/authentication/'.$berita->gambar_path)}}" width="525" height="350">
  			<h1 style="font-size:28px">{{$berita->namaBerita}}</h1>
  			<p>{!!$berita->isiBerita!!}</p>
  		</div>
  </div>
@endsection

@section('footer')
@endsection
