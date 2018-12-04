@extends('pages.master')
@section('stylesheet')
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
@endsection

@section('script')
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
@endsection

@section('header')

  <div class="wrapper col6">
  		<div id="breadcrumb" >
  			<ul>
  				<li><a href="{{route('home')}}">HOME</a></li>
  				<li>&#187;</li>
  				<li class="current"><a href="#">List Peta</a></li>
  			</ul>
  		</div>
  </div>
  <div class="container">
  	<div class="row">
      @foreach ($maps as $map)
          <div class="col-md-4">
            <h2><span class='label label-default' style='text-align:center;'></span></h2>
              <a target='_blank' href="#">
                <img class='img-responsive' src="{{URL::asset('storage/authentication/'.$map->path)}}" alt='' width='300' height='200'>
              </a>
              <div style='margin:5px;text-align:center'>
                <a class='btn btn-default' href="{!! url('/map/png/download/'.$map->id) !!}">Download As PNG</a>
                <a class='btn btn-default' href="{!! url('/map/pdf/download/'.$map->id) !!}">Download As PFD</a>
              </div>
          </div>
      @endforeach

  	</div>
  	</div>
  {{ $maps->links() }}
@endsection
@section('footer')
@endsection
