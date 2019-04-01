@extends('admin.master')
@section('stylesheet')
@endsection

@section('main')
<div class=container-fluid>
  <table class='table'>
    <tr>
      <th>Nama Berita</th>
      <th>Deskripsi</th>
      <th>Link</th>
      <th style='text-align:center'>Aksi</th>
    </tr>

    @foreach ($beritas as $berita)
        <tr>
          <td>{{ $berita->namaBerita }}</td>
          <td>{{ $berita->deskripsiBerita }}</td>
          <td><a href= "{!! url('/admin/newsDetails/'.$berita->id) !!}" >Lihat Berita</a></td>
          <form  class="forms-sample" action='{{route('admin.news.delete',['id'=>$berita->id])}}' method='post'>
            {{ csrf_field() }}
          <input type='hidden' name='id' value= {{ $berita->id }} />
          <td style='width:140px'>
            <div class='btn-group' role='group' aria-label='...'>
              <button name='submit' type='submit' class='btn btn-default'>Hapus</button>
              <a href='{!! url('/admin/news/update/'.$berita->id) !!}' class='btn btn-default'>Edit</a>
            </div>
          </td>
          </form>
          </tr>
    @endforeach
  </table>
</div>
{{ $beritas->links() }}
@endsection


@section('script')
@endsection
