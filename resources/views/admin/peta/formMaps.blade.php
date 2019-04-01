@extends('admin.master')
@section('stylesheet')
@endsection

@section('main')
<div class=container-fluid>
<form action='{{route('admin.maps.submit')}}' method='POST' enctype='multipart/form-data'>
{{ csrf_field() }}
<script type="text/javascript">
    $(function() {
      $("#datepicker").datetimepicker({
        format: 'DD/MM/YYYY'
      });
    });
</script>
<div class='form-group'>
  <label for='exampleInput'>Nama Peta</label>
  <input type='text' name='namaPeta' class='form-control' placeholder='Masukkan Nama Berita'>
</div>

<div class='form-group'>
  <label for='exampleInputDeskripsi'>Deskripsi Peta</label>
  <input type='text' name='deskripsiPeta' class='form-control'  placeholder='Masukkan Deskripsi Berita'>
</div>

<div class='form-group'>
  <label for='exampleInputTanggal'>Tanggal Dimasukkan</label>
  <div class='input-group date'>
    <input type='text' class='form-control' name='date' id='datepicker'/>
    <div class='input-group-addon'>
      <span class='glyphicon glyphicon-calendar'></span>
    </div>
  </div>
</div>

<div class='form-group'>
  <label for='exampleInputFile'>Upload Gambar (pastikan file dibawah 1Mb)</label>
  <input type='file' name='gambarPeta' class='form-control'>
</div>

<button type='submit' name='submit' class='btn btn-default'>Submit</button>
</form>
</div>
@endsection
@section('script')
@endsection
