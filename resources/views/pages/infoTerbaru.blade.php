@extends('pages.master')
@section('stylesheet')
@endsection

@section('script')
@endsection

@section('header')
  <div class="wrapper col7">
  		<div id="container2">
  			<h1 style="font-size:28px">Berita Terbaru</h1>
        @php
            $tanggalLama="";
        		$tanggalBaru;
        @endphp

        @foreach($beritas as $berita)
            @php
            $tanggalBaru = date('d/m/Y',strtotime($berita->tanggal))
            @endphp
				    @if ($tanggalBaru != $tanggalLama)
                <p style='margin-bottom:-2px; color:#FF0000;'><b> {{ date('d/m/Y',strtotime($berita->tanggal)) }} </b></p>
              <ul>
                <li><a href="{!! url('/berita/detail/'.$berita->id) !!}">{{ $berita->namaBerita}}</a></li>
              </ul>
            @elseif($tanggalBaru == $tanggalLama)
              <ul>
                <li><a href="{!! url('/berita/detail/'.$berita->id) !!}">{{ $berita->namaBerita}}</a></li>
              </ul>
            @endif
            @php $tanggalLama = $tanggalBaru @endphp
        @endforeach
      </div>
  </div>
@endsection

@section('footer')
@endsection
