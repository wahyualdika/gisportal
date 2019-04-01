@extends('admin.master')
@section('stylesheet')
@endsection

@section('main')
<div class=container-fluid>
  <table class='table'>
    <tr>
      <th>Nama Layer</th>
      <th>URL Layer</th>
      <th>Link</th>
      <th style='text-align:center'>Aksi</th>
    </tr>

    @foreach ($layers as $layer)
        <tr>
          <td>{{ $layer->title }}</td>
          <td>{{ $layer->url }}</td>
          <td><a href= "{!! url('/admin/layerDetails/'.$layer->id) !!}" >Lihat Layer</a></td>
          <form  class="forms-sample" action='{{route('admin.layers.delete',['id'=>$layer->id])}}' method='post'>
            {{ csrf_field() }}
          <input type='hidden' name='id' value= {{ $layer->id }} />
          <td style='width:140px'>
            <div class='btn-group' role='group' aria-label='...'>
              <button name='submit' type='submit' class='btn btn-default'>Hapus</button>
              <a href='{!! url('/admin/layers/update/'.$layer->id) !!}' class='btn btn-default'>Edit</a>
            </div>
          </td>
          </form>
          </tr>
    @endforeach
  </table>
</div>

<div class=container-fluid>
<div class="row"><div class="col-md-1">
<a href="{{route('admin.layer.generate')}}" role="button">Generate Layer</a>
</div></div>
</div>

{{ $layers->links() }}
@endsection


@section('script')
@endsection