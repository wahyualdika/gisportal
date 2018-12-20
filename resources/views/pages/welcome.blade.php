@extends('pages.master')
@section('stylesheet')
@endsection

@section('script')
@endsection

@section('header')
  <div class="wrapper col2">

  		<div id="container" style="top:-20px;">
  		<div id="lofslidecontent45" class="lof-slidecontent">
  		<div class="preload"><div></div></div>
  		<!-- CONTENT -->
  		<div class="lof-main-outer">
  			<ul class="lof-main-wapper" style="height:100%;">
          @foreach ($beritas as $berita)
              <li><a href='#'>
                <img src= "{!! URL::asset('storage/authentication/'.$berita->gambar_path) !!}" height='400px' width='900'>
                <div class='lof-main-item-desc'>
                <h3>"{{ $berita->namaBerita }}"</h3>
                <p>"{{$berita->deskripsiBerita}}"</p>
                </div>
              </a></li>
          @endforeach
  			</ul>
  		</div>

  		<!-- NAVI -->

  		<div class="lof-navigator-outer">
  			<ul class="lof-navigator">
          @foreach ($beritas as $berita)
            <li><a href="{!! url('/berita/detail/'.$berita->id) !!}">
            <div>
            <h3>{{$berita->namaBerita}}</h3>
            <p>{{date('d/m/Y',strtotime($berita->tanggal))}}</p>
            </div>
            </li></a>
          @endforeach
  			</ul>
  		</div>
  		</div>
  </div>
  <div class="wrapper col3">
  			<div id="container" style="top:10px;">
  			<div class="homepage2">

  			</div>
  <div class="homepage">
  				<ul>
  					<li>
  						<h2><img src="img/logo/Web_lap_64.png" alt="" /></a>WebGIS</h2>
  						<p style='font-size:14px;color:#40C440;'>Aplikasi Sistem Informasi Geografis (SIG) yang dirancang untuk bekerja dengan data yang tereferensi secara spasial/geografis berbasiskan web. Untuk mengakses data dan informasi geospasial Provinsi Aceh yang tersedia di UPTB - PDGA Bappeda Aceh.</p>
  						<p class="readmore"><a href="{{route('home.webGIS')}}">Menuju WebGIS &raquo;</a></p>
  					</li>
  					<li>
  						<h2><img src="img/logo/On_news_64.png" alt="" />Dokumen</h2>
  						<p style="font-size:14px;color:#40C440;">Silahkan pilih Dokumen untuk mengakses atau mengunduh file tutorial yang berkaitan dengan materi Sistem Informasi Geografis (SIG), WebGIS, Pengolahan Citra Satelit, Teknik Pemetaan dan Dokumen Standarisasi Data Spasial.</p>
  						<p class="readmore"><a href="{{route('home.dokumen')}}">Menuju Dokumen &raquo;</a></p>
  					</li>
  					<li class="last">
  						<h2><img src="img/logo/Loc_net_64.png" alt="" />Geoportal</h2>
  						<p style="font-size:14px;color:#40C440;">Geoportal merupakan sistem untuk mengunduh atau pun mengunggah data spasial</p>
  						<p class="readmore"><a href="http://gisportal.acehprov.go.id:8080/geoportal/catalog/main/home.page">Menuju Geoportal &raquo;</a></p>
  					</li>
  				</ul>
  			<br class="clear" />
  			</div>
  			</div>
  		</div>

@endsection


@section('footer')
@endsection
