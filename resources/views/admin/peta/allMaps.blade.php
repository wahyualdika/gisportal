@extends('admin.master')
@section('stylesheet')
@endsection

@section('main')
<div class=container-fluid>
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
        <!-- <form  class="forms-sample" action='{{route('admin.maps.delete',['id'=>$peta->id])}}' method='post'>
          {{ csrf_field() }} -->
        <input type='hidden' name='id' value= {{ $peta->id }} />
        <td style='width:140px'>
          <div class='btn-group' role='group' aria-label='...'>
            <button  class='btn btn-default opener-dialog' data-value="{{$peta->id}}">Hapus</button>
            <a href='{!! url('/admin/maps/update/'.$peta->id) !!}' class='btn btn-default'>Edit</a>
          </div>
        </td>
        <!-- </form> -->
      </tr>
  @endforeach
  <input type='hidden' name='id' class='id' />
</table>
</div>
{{ $petas->links() }}
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
                var id = $(".id").val();
                //console.log(input);
                $.ajaxSetup({
                  headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
                });
                $.ajax({
                    url:"{{url('/admin/maps/delete')}}/"+id,
                    type: 'POST',
                    data: {
                        "id": id,
                    },
                    success: function (response)
                    {
                      // console.log(response);
                      location.reload(true);
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
    var id = $(this).data('value');
    $(".id").val(id);
    $( "#dialog-form" ).dialog( "open" );
  });

});

</script>
@endsection
