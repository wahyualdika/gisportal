@extends('pages.master')
@section('stylesheet')
  <link rel="stylesheet" href="{!! URL::asset('/css/wg.css') !!}" type="text/css" />
  <link rel="stylesheet" href="{!! URL::asset('http://js.arcgis.com/3.14/dijit/themes/claro/claro.css') !!}" type="text/css" />
  <link rel="stylesheet" href="{!! URL::asset('http://js.arcgis.com/3.14/esri/css/esri.css') !!}" type="text/css" />
@endsection

@section('script')
  <script src="http://js.arcgis.com/3.14/"></script>
  <script src="{!! URL::asset('js/arcgisfunction.js') !!}"></script>
  <script src="{!! URL::asset('js/map.js') !!}"></script>
  <script src="{!! URL::asset('js/CollapsibleLists.js') !!}"></script>
  <script src="{!! URL::asset('js/runOnLoad.src.js') !!}"></script>
  <script type="text/javascript">
      runOnLoad(function(){ CollapsibleLists.apply(); });
  </script>
@endsection
@section('header')

  <div class="wrapper col7">
  	<div id="container2" style="width: 100%; height: 525px;">
  	<div data-dojo-type="dijit/layout/BorderContainer" style="width: 100%; height: 100%; top:-20px;">

  	<!-- TOP -->
  	<div data-dojo-type="dijit/layout/ContentPane" data-dojo-props="region:'top'">
  		<div id="navToolbar" dojoType="dijit.Toolbar">
  			<div dojoType="dijit.form.Button" id="zoomin" iconClass="zoominIcon" onClick="navToolbar.activate(esri.toolbars.Navigation.ZOOM_IN);"></div>
  			<div dojoType="dijit.form.Button" id="zoomout" iconClass="zoomoutIcon" onClick="navToolbar.activate(esri.toolbars.Navigation.ZOOM_OUT);"></div>
  			<div dojoType="dijit.form.Button" id="zoomprev" iconClass="zoomprevIcon" onClick="navToolbar.zoomToPrevExtent();"></div>
  			<div dojoType="dijit.form.Button" id="zoomnext" iconClass="zoomnextIcon" onClick="navToolbar.zoomToNextExtent();"></div>
  			<div dojoType="dijit.form.Button" id="pan" iconClass="panIcon" onClick="navToolbar.activate(esri.toolbars.Navigation.PAN);"></div>

  			pencarian:
  			<select id="pencarian">
  				<option value="1">layer P2K</option>
  				<option value="2">layer Perhubungan</option>
  				<option value="3">layer Pendidikan</option>
  				<option value="4">layer Kesehatan</option>
  				<option value="5">layer Monev2017</option>
  			</select>
  			<input type="text" id="cari" size="30"/>
  			<button onclick="find()">cari</button>
  			<button id="bersih" onclick="cleaning()">bersihkan hasil pencarian</button>
  			&nbsp;&nbsp;
  			kabupaten/kota:
  			<select id="BM" name="BM" onchange="Bookmarks(this.value)">
  				<option> ------------------------ </option>
  				<option value="1">Banda Aceh</option>
  				<option value="2">Kota Sabang</option>
  				<option value="3">Kab. Aceh Besar</option>
  				<option value="4">Kab. Aceh Jaya</option>
  				<option value="5">Kab. Pidie</option>
  				<option value="6">Kab. Pidie Jaya</option>
  				<option value="7">Kab. Bireuen</option>
  				<option value="8">Kab. Aceh Utara</option>
  				<option value="9">Kota Lhokseumawe</option>
  				<option value="10">Kab. Aceh Timur</option>
  				<option value="11">Kota Langsa</option>
  				<option value="12">Kab. Aceh Tamiang</option>
  				<option value="13">Kab. Bener Meriah</option>
  				<option value="14">Kab. Aceh Tengah</option>
  				<option value="15">Kab. Gayo Lues</option>
  				<option value="16">Kab. Aceh Barat</option>
  				<option value="17">Kab. Nagan Raya</option>
  				<option value="18">Kab. Aceh Barat Daya</option>
  				<option value="19">Kab. Aceh Selatan</option>
  				<option value="20">Kab. Aceh Tenggara</option>
  				<option value="21">Kota Subulussalam</option>
  				<option value="22">Kab. Aceh Singkil</option>
  				<option value="23">Kab. Simeulue</option>
  			</select>
  			<div id="printButton"></div>
  		</div>
  	</div>

  	<!-- LEFT -->
  	<div data-dojo-type="dijit/layout/AccordionContainer" data-dojo-props="region:'leading'">
  		<div data-dojo-type="dijit/layout/AccordionPane" style="width: 190px" title="Layer yang tersedia :">
  			<ul class="collapsibleList" style="margin-top:5px;">
  				<li>
  					<b>administrasi</b>
  					<ul>
  						<li><input type='checkbox' id='adm' onclick='getadm()' /> batas wiliayah</li>
  						<li><input type='checkbox' onclick='getlayer(13)' id='13'/> batas laut </li>
  					</ul>
  				</li>
  				<li>
  					<b>pendidikan</b>
  					<ul>
  						<li><input type='checkbox' onclick='getlayerp(12,8)' id='12'/> dayah </li>
  						<li><input type='checkbox' onclick='getpendik(0,"sma")' id='sma'/> sma sederajat</li>
  						<li><input type='checkbox' onclick='getpendik(1,"smp")' id='smp'/> smp sederajat</li>
  						<li><input type='checkbox' onclick='getpendik(2,"sd")' id='sd'/> sd sederajat</li>
  					</ul>
  				</li>
  				<li>
  					<b>tutupan lahan</b>
  					<ul>
  						<li><input type='checkbox' onclick='getlayer(0)' id='0'/> tutupan lahan 1990 </li>
  						<li><input type='checkbox' onclick='getlayer(1)' id='1'/> tutupan lahan 2000 </li>
  						<li><input type='checkbox' onclick='getlayer(2)' id='2'/> tutupan lahan 2006 </li>
  						<li><input type='checkbox' onclick='getlayer(3)' id='3'/> tutupan lahan 2013 </li>
  					</ul>
  				</li>
  				<li>
  					<b>pola ruang</b>
  					<ul>
  						<li><input type='checkbox' id='4' onclick='getlayer(4)' /> pola ruang 2013</li>
  					</ul>
  				</li>
  				<li>
  					<b>perhubungan</b>
  					<ul>
  						<li><input type='checkbox' onclick='getlayerp(10,1)' id='10'/> perhubungan </li>
  						<li><input type='checkbox' onclick='getlayerp(5,2)' id='5'/> pelabuhan </li>
  						<li><input type='checkbox' onclick='getlayerp(6,2)' id='6'/> bandara </li>
  						<li><input type='checkbox' onclick='getlayerp(7,4)' id='7'/> terminal </li>
  					</ul>
  				</li>

  				<li>
  					<b>P2K</b>
  					<ul>
  						<li><input type='checkbox' id='Agama' onclick='getp2k(0,"Agama")' /> agama </li>
  						<li><input type='checkbox' id='Pendidikan' onclick='getp2k(1,"Pendidikan")' /> pendidikan </li>
  						<li><input type='checkbox' id='Kesehatan' onclick='getp2k(2,"Kesehatan")' /> kesehatan </li>
  						<li><input type='checkbox' id='Infrastruktur' onclick='getp2k(3,"Infrastruktur")' /> infrastruktur </li>
  						<li><input type='checkbox' id='Olah Raga' onclick='getp2k(4,"Olah Raga")' /> olah Raga </li>
  						<li><input type='checkbox' id='Pariwisata' onclick='getp2k(5,"Pariwisata")' /> pariwisata </li>
  						<li><input type='checkbox' id='Perdagangan' onclick='getp2k(6,"Perdagangan")' /> perdagangan </li>
  						<li><input type='checkbox' id='Pertanian' onclick='getp2k(7,"Pertanian")' /> pertanian </li>
  						<li><input type='checkbox' id='Sosial' onclick='getp2k(8,"Sosial")' /> sosial </li>
  						<li><input type='checkbox' id='Perhubungan' onclick='getp2k(9,"Perhubungan")' /> perhubungan </li>
  						<li><input type='checkbox' id='Lain-lain' onclick='getp2k(10,"Lain-lain")' /> lain-lain </li>
  					</ul>
  				</li>

  				<li>
  					<b>Monev</b>
  					<ul class="collapsibleList"><li><b>2017</b>
  					<ul>
  						<li><input type='checkbox' id='Agama_1' onclick='getMonev2017(0,"Agama_1")' /> agama </li>
  						<li><input type='checkbox' id='Infrastruktur_1' onclick='getMonev2017(1,"Infrastruktur_1")' /> infrastruktur </li>
  						<li><input type='checkbox' id='Olah Raga_1' onclick='getMonev2017(2,"Olah Raga_1")' /> olah raga </li>
  						<li><input type='checkbox' id='Pendidikan_1' onclick='getMonev2017(3,"Pendidikan_1")' /> pendidikan </li>
  						<li><input type='checkbox' id='Perdagangan_1' onclick='getMonev2017(4,"Perdagangan_1")' /> perdagangan </li>
  						<li><input type='checkbox' id='Pertanian dan Peternakan' onclick='getMonev2017(5,"Pertanian dan Peternakan")' /> pertanian dan peternakan </li>
  						<li><input type='checkbox' id='Sarana dan Prasarana' onclick='getMonev2017(6,"Sarana dan Prasarana")' /> sarana dan prasarana </li>
  						<li><input type='checkbox' id='Sosial_1' onclick='getMonev2017(7,"Sosial_1")' /> sosial </li>
  					</ul></ul></li>
  				</li>


  				<li>
  					<b>kesehatan</b>
  					<ul>
  						<li><input type='checkbox' id='9' onclick='getlayerp(9,6)' /> infrastruktur </li>
  					</ul>
  				</li>
  				<li>
  					<b>pariwisata</b>
  					<ul>
  						<li><input type='checkbox' id='8' onclick='getlayerp(8,3)' /> kawasan wisata </li>
  					</ul>
  				</li>
  				<li>
  					<b>data wilayah pengelolaan perikanan</b>
  					<ul>
  						<li><input type='checkbox' onclick='getlayer(14)' id='14'/> wilayah 1 </li>
  						<li><input type='checkbox' onclick='getlayer(15)' id='15'/> wilayah 2 </li>
  					</ul>
  				</li>
  				<li>
  					<b>data kerawanan banjir</b>
  					<ul>
  						<li><input type='checkbox' onclick='getlayer(16)' id='16'/> tingkat rawan banjir tamiang </li>
  						<li><input type='checkbox' onclick='getlayer(17)' id='17'/> tingkat rawan banjir teunom </li>
  					</ul>
  				</li>
  			</ul>
  		</div>
  		<div data-dojo-type="dijit/layout/AccordionPane" style="width: auto" title="Legenda">
  			<div id="legend"></div>
  		</div>
  	</div>

  	<!-- MAIN -->
  	<div data-dojo-type="dijit/layout/TabContainer" data-dojo-props="region:'center'">
  		<div id="map">
  			<span id="info" style="position:absolute; left:25px; bottom:45px; color:#232621; z-index:50; font-weight:bold;"></span>
  		</div>
  		<div id="HomeButton"></div>
  		<div id="BasemapToggle"></div>
  	</div>

  	</div>
  	</div>

@endsection

@section('footer')
@endsection
