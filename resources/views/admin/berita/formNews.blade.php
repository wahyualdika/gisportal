@extends('admin.master')
@section('stylesheet')
@endsection

@section('main')
<div class=container-fluid>
<form action='{{route('admin.news.submit')}}' method='POST' enctype='multipart/form-data'>
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
  <input type='text' name='namaBerita' class='form-control' placeholder='Masukkan Nama Berita'>
</div>

<div class='form-group'>
  <label for='exampleInputDeskripsi'>Deskripsi Berita</label>
  <input type='text' name='deskripsi' class='form-control'  placeholder='Masukkan Deskripsi Berita'>
</div>

<div class='form-group'>
    <label for='exampleInputIsi'>Isi Berita</label>
    <textarea class='form-control' name='isi' rows='5' id='summernote'></textarea>
</div>

<div class='form-group'>
  <label for='exampleInputTanggal'>Tanggal Data Dimasukkan</label>
  <div class='input-group date'>
    <input type='text' class='form-control' name='date' id='datepicker'/>
    <div class='input-group-addon'>
      <span class='glyphicon glyphicon-calendar'></span>
    </div>
  </div>
</div>

<div class='form-group'>
  <label for='exampleInputLink'>Link Berita</label>
  <input type='text' name='link' class='form-control'  placeholder='Masukkan Link Berita'>
</div>

<div class='form-group'>
  <label for='exampleInputFile'>Upload Gambar (pastikan file dibawah 1Mb)</label>
  <input type='file' name='gambarBerita' class='form-control'>
</div>

<button type='submit' name='submit' class='btn btn-default'>Submit</button>
</form>
</div>
@endsection
@section('script')
@endsection
