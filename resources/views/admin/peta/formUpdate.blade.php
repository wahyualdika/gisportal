@extends('admin.master')
@section('stylesheet')
@endsection

@section('main')
<div class=container-fluid>
<form action='{{route('admin.maps.update',['id'=>$peta->id])}}' method='POST' enctype='multipart/form-data'>
{{ csrf_field() }}
<script type="text/javascript">
         $(function() {
      $("#datepicker").datetimepicker({
        format: 'DD/MM/YYYY'
      });
    });
</script>

<div class='form-group'>
  <label for='exampleInput'>Nama Berita</label>
  <input type='text' name='namaPeta' class='form-control' value="{{$peta->nama_peta}}" placeholder='Masukkan Nama Berita'>
</div>

<div class='form-group'>
  <label for='exampleInputDeskripsi'>Deskripsi Berita</label>
  <input type='text' name='deskripsiPeta' class='form-control' value="{{$peta->deskripsi_peta}}" placeholder='Masukkan Deskripsi Berita'>
</div>

<div class='form-group'>
  <label for='exampleInputTanggal'>Tanggal Data Dimasukkan</label>
  <div class='input-group date'>
    <input type='text' class='form-control' name='date' value="{{$peta->tanggal_peta}}" id='datepicker'/>
    <div class='input-group-addon'>
      <span class='glyphicon glyphicon-calendar'></span>
    </div>
  </div>
</div>

<div class='form-group'>
  <label for='exampleInputFile'>Upload Gambar (pastikan file dibawah 1Mb)</label>
  <input type='file' name='gambarPeta' class='form-control'>
  <img src="{{URL::asset('storage/authentication/'.$peta->path)}}" width='180' height='100' class='img-responsive' alt='image-berita'>
</div>

<button type='submit' name='submit' class='btn btn-default'>Submit</button>
</form>
</div>
@endsection
@section('script')
@endsection
