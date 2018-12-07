@extends('pages.master')
@section('stylesheet')
@endsection

@section('script')
@endsection

@section('header')
  <div class="wrapper col6">
  		<div id="breadcrumb">
  			<ul>
  				<li><a href="index.php">HOME</a></li>
  				<li>&#187;</li>
  				<li class="current"><a href="#">Dokumen</a></li>
  			</ul>
  		</div>
  		</div>



  		<div class="wrapper col7">
  		<div id="container2">
  			<h1 style="font-size:28px">Dokumen</h1>

  			<p><b>Modul :</b></p>



  			<center>
  			<table>
  			<tr>
  				<td><center>Inggris</center></td>
  				<td><center>Indonesia</center></td>
  			</tr>
  			<tr>
  				<td><center>--------------</center></td>
  				<td><center>--------------</center></td>
  			</tr>
  			<tr>
  				<td>1. <a href="{{URL::asset('storage/dokumen/Laporan-Daemeter/Reports-on-Provision-of-Baseline-Data-and-Cadastral-Maps/Advanced_training_modules.pdf')}}">Advanced_training_modules</a></td>
  				<td>1. tidak tersedia</td>
  			</tr>
  			<tr>
  				<td>2. <a href="{{URL::asset('storage/dokumen/Laporan-Daemeter/Reports-on-Provision-of-Baseline-Data-and-Cadastral-Maps/Advanced_training_modules.pdf')}}">Basic_training_modules</a></td>
  				<td>2. tidak tersedia</td>
  			</tr>
  			<tr>
  				<td>--------------------------------</td>
  				<td>--------------------------------</td>
  			</tr>
  			</table>

  			</center>

  		</div>
  		</div>
@endsection


@section('footer')
@endsection
