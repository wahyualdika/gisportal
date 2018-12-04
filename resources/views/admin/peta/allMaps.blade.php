@extends('admin.master')
@section('stylesheet')
@endsection

@section('main')
<table class='table'>
  <tr>
    <th>Nama Peta</th>
    <th>Deskripsi Peta</th>
    <th>Link</th>
    <th style='text-align:center'>Aksi</th>
  </tr>
  @foreach ($petas as $peta)
      <tr>
        <td>{{ $peta->nama_peta }}</td>
        <td>{{ $peta->deskripsi_peta }}</td>
        <td><a href="{!! url('/admin/mapsDetails/'.$peta->id) !!}">Lihat Peta</a></td>
        <form  class="forms-sample" action='{{route('admin.maps.delete',['id'=>$peta->id])}}' method='post'>
          {{ csrf_field() }}
        <input type='hidden' name='id' value= {{ $peta->id }} />
        <td style='width:140px'>
          <div class='btn-group' role='group' aria-label='...'>
            <button name='submit' type='submit' class='btn btn-default'>Hapus</button>
            <a href='{!! url('/admin/maps/update/'.$peta->id) !!}' class='btn btn-default'>Edit</a>
          </div>
        </td>
        </form>
      </tr>
  @endforeach
</table>
{{ $petas->links() }}
@endsection

@section('script')
@endsection
