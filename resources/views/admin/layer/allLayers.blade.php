@extends('admin.master')
@section('stylesheet')
@endsection

@section('main')
<div class=container-fluid>

  @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
  @endif

  <table class='table'>
    <tr>
      <th>Nama Layer</th>
      <th>URL Layer</th>
      <th>Link</th>
      <th style='text-align:center'>Aksi</th>
    </tr>

    <div id="dialog-form" title="Delete Confirmation">
        <p>Do you want to delete this data?</p>
    </div>

    @foreach ($layers as $layer)
        <tr>
          <td>{{ $layer->title }}</td>
          <td>{{ $layer->url }}</td>
          <td><a href= "{!! url('/admin/layerDetails/'.$layer->id) !!}" >Lihat Layer</a></td>
          <!-- <form  class="forms-sample" action='{{route('admin.layers.delete',['id'=>$layer->id])}}' method='post'> -->
            <!-- {{ csrf_field() }} -->

          <input type='hidden' name='id' id='id' value= {{ $layer->id }} />
          <td style='width:140px'>
            <div class='btn-group' role='group' aria-label='...'>
              <button class='btn btn-default opener-dialog'>Hapus</button>
              <a href='{!! url('/admin/layers/update/'.$layer->id) !!}' class='btn btn-default'>Edit</a>
            </div>
          </td>
          <!-- </form> -->
          <!-- <button id="opener" class='btn btn-default'>opener</button> -->
          </tr>
    @endforeach
  </table>
  <a href='{{route('admin.layer.generate')}}' class='btn btn-info'>Generate Layer</a>
</div>

{{ $layers->links() }}
@endsection


@section('script')
<script>
$( function() {
  $( "#dialog-form" ).dialog({
    autoOpen: false,
    modal: true,
    buttons: [
        {
              text: "Yes",
              icon: "ui-icon-heart",
              click: function() {
                var id = $("#id").val();
                //console.log(input);
                $.ajaxSetup({
                  headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
                });
                $.ajax({
                    url: "/admin/layers/delete/"+id,
                    type: 'POST',
                    data: {
                        "id": id,
                    },
                    success: function (response)
                    {
                      console.log(response);
                      window.location.href = "{{url('/admin/allLayers')}}"
                      $( "#dialog-form" ).dialog( "close" );
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });

            }
        }
    ]
  });

  $( ".opener-dialog" ).click(function() {
    $( "#dialog-form" ).dialog( "open" );
  });

});

</script>
@endsection
