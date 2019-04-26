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

    <div id="dialog-form" title="Delete Confirmation">
        <p>Do you want to delete this data?</p>
    </div>

    @foreach ($beritas as $berita)
        <tr>
          <td>{{ $berita->namaBerita }}</td>
          <td>{{ $berita->deskripsiBerita }}</td>
          <td><a href= "{!! url('/admin/newsDetails/'.$berita->id) !!}" >Lihat Berita</a></td>
          <!-- <form  class="forms-sample" action='{{route('admin.news.delete',['id'=>$berita->id])}}' method='post'>
            {{ csrf_field() }} -->
          <input type='hidden' name='id' class='id' value= {{ $berita->id }} />
          <td style='width:140px'>
            <div class='btn-group' role='group' aria-label='...'>
              <button  class='btn btn-default opener-dialog'>Hapus</button>
              <a href='{!! url('/admin/news/update/'.$berita->id) !!}' class='btn btn-default'>Edit</a>
            </div>
          </td>
          <!-- </form> -->
          </tr>
    @endforeach
  </table>
</div>
{{ $beritas->links() }}
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
                    url: "/admin/news/delete/"+id,
                    type: 'POST',
                    data: {
                        "id": id,
                    },
                    success: function (response)
                    {
                      console.log(response);
                      window.location.href = "{{url('/admin/allNews')}}"
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
