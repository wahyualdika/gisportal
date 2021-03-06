<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>UPTB-PDGA</title>
	</head>
		<link rel="stylesheet" href="{!! URL::asset('public/css/navi.css') !!}" type="text/css" />
		<link rel="stylesheet" href="{!! URL::asset('public/css/layout.css') !!}" type="text/css" />
    <link rel="stylesheet" href="{!! URL::asset('public/media/lofslidernews/css/layout.css') !!}" type="text/css" />
    <link rel="stylesheet" href="{!! URL::asset('public/media/lofslidernews/css/style.css') !!}" type="text/css" />
    @yield('stylesheet')


<!--Menu Bar-->

	<body id="top">

    <div class="wrapper col1">
  			<div id="header">
  				<a class="header-logo" href="#"></a>
  				<div id="logo">
  					<h1><a href="#">UPTB-PDGA</a></h1>
  					<p>Badan Perencanaan Pembangunan Daerah Aceh</p>
  				</div>
  				<div id="topnav">
  					<ul>
  						<li><a href="{{route('home')}}">HOME</a>
  						<ul>
  								<li><a href="{{route('admin.login')}}">ADMIN</a></li>
  						</ul>
  						</li>

  						<li><a href="http://gisportal.acehprov.go.id:8080/geoportal/catalog/main/home.page">GEOPORTAL</a></li>
  						<!-- <li><a href="{{route('home.webGIS')}}">WEBGIS</a></li> -->
							<li><a href="{{route('home.webGIS')}}">WEBGIS</a></li>
  						<li><a href="{{route('home.news.list')}}">BERITA</a></li>
  						<li><a href="#">PRODUK</a>
  							<ul>
  								<li><a href="{{route('home.map.recent')}}">PETA</a></li>
  							</ul>
  						</li>
  						<li class="last"><a href="doc.php?list=list.php">DOKUMEN</a></li>
  					</ul>
  				</div>
  			<br class="clear" />
  			</div>
  		</div>
@yield('header')
      <!-- footer -->

  <div class="wrapper col4">
		<div id="footer" style="background:#172F3D;">
		<div class="box1">
			<h2>Tentang kami</h2>
				<img class="imgl" src="{!! URL::asset('public/img/logo/bapp.jpg') !!}" alt="" />
				<p>Berkat peran Badan Perencanaan Pembangunan Aceh yang secara nyata dan signifikan berhasil memacu pembangunan Daerah Istimewa Aceh melalui perumusan kebijakan pembangunan daerah, maka pada perkembangannya Presiden Republik Indonesia memandang perlu meningkatkan status menjadi salah satu komponen dalam lingkungan organisasi pemerintah daerah. Peningkatan status ini dilakukan melalui surat Keputusan Presiden Republik Indonesia Nomor 15 Tahun 1973.</p>
		</div>
		<div class="box contactdetails">
			<h2>Hubungi Kami</h2>
				<ul>
					<li>UPTB - PDGA</li>
					<li>Jl. Tgk. H. Mohd. Daud Beureu-eh No.26</li>
					<li>Banda Aceh, Indonesia</li>
					<li>Kodepos 23121</li>
					<li>Tel: (0651) 21440</li>
					<li>Fax: (0651) 33654</li>
					<li>Email: Bappeda[at]acehprov.go.id </li>
					<li class="last">Website: <a href="http://bappeda.acehprov.go.id">Bappeda Aceh</a></li>
				</ul>
		</div>
		<div class="box flickrbox">
			<h2>Dinas Terkait</h2>
				<div class="wrap">
					<div class="fix"></div>
					<div class="flickr_badge_image" id="flickr_badge_image1"><a href="http://www.acehprov.go.id/" target="_blank"><img src="{!! URL::asset('public/img/logo/pemprov_aceh.png') !!}" alt="" /></a></div>
					<div class="flickr_badge_image" id="flickr_badge_image4"><a href="http://big.go.id/" target="_blank"><img src="{!! URL::asset('public/img/logo/big.png') !!}" alt="" /></a></div>
					<div class="flickr_badge_image" id="flickr_badge_image5"><a href="http://www.lapan.go.id/" target="_blank"><img src="{!! URL::asset('public/img/logo/lapan.png') !!}" alt="" /></a></div>
					<div class="fix"></div>
				</div>
		</div>
		<br class="clear" />
		</div>
	</div>
<!-- END -->
	<div class="wrapper col5">
		<div id="copyright">
			<p style="float:left;margin-right:80px;weight:bold"><b> Total Visitor  : {{ Counter::showAndCount('pages.master') }}</b></p>
			<p class="fl_left">Copyright &copy; 2015 - All Rights Reserved - <a href="#">Bappeda Aceh</a></p>
			<p class="fl_right"><a target="_blank" href="#" title="Free Website Templates">Bappeda Aceh</a></p>
			<br class="clear" />
		</div>
	</div>
@yield('footer')

  <script>var dojoConfig = { parseOnLoad: true };</script>
  <script src="{!! URL::asset('public/media/lofslidernews/js/jquery.js') !!}"></script>
  <script src="{!! URL::asset('public/media/lofslidernews/js/jquery.easing.js') !!}"></script>
  <script src="{!! URL::asset('public/media/lofslidernews/js/script.js') !!}"></script>
  <script type="text/javascript">
  $(document).ready( function(){
  $('#lofslidecontent45').lofJSidernews( {interval	:4000,
                      direction	:'opacity',
                      duration	:1000,
                      easing		:'easeInOutSine'} );
  });
  </script>
  @yield('script')

	</body>
</html>
