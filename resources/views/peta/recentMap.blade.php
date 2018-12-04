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
				<li class="current"><a href="#">Layout Peta</a></li>
			</ul>
		</div>
	</div>

@if($maps->isEmpty())
<div class="wrapper col7">
    <div id="container3">
      <div class="page">
      			</br></br>
      			<center>
      				<a href="#">Tidak ada peta</a>
      			</center>
      </div>
    </div>
</div>
@else
  <div class="wrapper col7">
  		<div id="container3">
        @foreach ($maps as $map)
            <div class='img'>
              <a target='_blank' href="#">
              <img src="{{URL::asset('storage/authentication/'.$map->path)}}" alt='' width='300' height='200'>
            </a><div class='desc'>{{ $map->nama_peta }}</div>
            <div style='margin:5px;'>
              <a class='btn btn-default' href="{!! url('/map/png/download/'.$map->id) !!}">Download As PNG</a>
              <a class='btn btn-default' href="{!! url('/map/pdf/download/'.$map->id) !!}">Download As PFD</a>
            </div>
            </div>
        @endforeach
    <div class="page">
  			</br></br>
  			<center>
  				<a href="{{route('home.map.All')}}">Lihat lebih lengkap</a>
  			</center>
    </div>

  </div>
</div>
@endif


@endsection
@section('footer')
@endsection
