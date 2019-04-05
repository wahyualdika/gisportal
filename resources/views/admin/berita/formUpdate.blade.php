@extends('admin.master')
@section('stylesheet')
@endsection

@section('main')
<div class=container-fluid>
<form action='{{route('admin.news.update',['id'=>$berita->id])}}' method='POST' enctype='multipart/form-data'>
{{ csrf_field() }}
<script type="text/javascript">
         $(function() {
      $("#datepicker").datetimepicker({
        defaultDate: new Date("$berita->tanggal"),
        format: 'DD/MM/YYYY'
      });
    });
</script>

<div class='form-group'>
  <label for='exampleInput'>Nama Berita</label>
  <input type='text' name='namaBerita' class='form-control' value="{{$berita->namaBerita}}" placeholder='Masukkan Nama Berita'>
</div>

<div class='form-group'>
  <label for='exampleInputDeskripsi'>Deskripsi Berita</label>
  <input type='text' name='deskripsi' class='form-control' value="{{$berita->deskripsiBerita}}" placeholder='Masukkan Deskripsi Berita'>
</div>

<div class='form-group'>
    <label for='exampleInputIsi'>Isi Berita</label>
    <textarea class='form-control' name='isi' rows='5' id='summernote'> {!!$berita->isiBerita!!} </textarea>
</div>

<div class='form-group'>
  <label for='exampleInputTanggal'>Tanggal Data Dimasukkan</label>
  <div class='input-group date'>
    <input type='text' class='form-control' name='date' value="{{$berita->tanggal}}" id='datepicker'/>
    <div class='input-group-addon'>
      <span class='glyphicon glyphicon-calendar'></span>
    </div>
  </div>
</div>

<div class='form-group'>
  <label for='exampleInputLink'>Link Berita</label>
  <input type='text' name='link' class='form-control' value="{{$berita->linkBerita}}" placeholder='Masukkan Link Berita'>
</div>

<div class='form-group'>
  <label for='exampleInputFile'>Upload Gambar (pastikan file dibawah 1Mb)</label>
  <input type='file' name='gambarBerita' class='form-control'>
  <img src="{{URL::asset('storage/authentication/'.$berita->gambar_path)}}" width='180' height='100' class='img-responsive' alt='image-berita'>
</div>

<button type='submit' name='submit' class='btn btn-default'>Submit</button>
</form>
</div>
@endsection
@section('script')
@endsection
