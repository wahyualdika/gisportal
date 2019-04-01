@extends('admin.master')
@section('stylesheet')
@endsection

@section('main')
<div class="panel panel-primary"><div class="panel-heading">
  <h3 class="panel-title">Nama Layer</h3>
</div>
<div class="panel-body">
  {{ $layer->title }}
</div></div>
  <div class="panel panel-primary"><div class="panel-heading">
    <h3 class="panel-title">URL Layer</h3>
  </div>
  <div class="panel-body">
    {{ $layer->url }}
  </div></div>
<div class="panel panel-primary"><div class="panel-heading">
    <h3 class="panel-title">Tipe Layer</h3>
  </div>
  <div class="panel-body">
     {{ $layer->type }}
  </div></div>
<div class="panel panel-primary"><div class="panel-heading">
    <h3 class="panel-title">Default Layer</h3>
  </div>
  <div class="panel-body">
      {{ $layer->default_layer }}
  </div></div>
<div class="panel panel-primary"><div class="panel-heading">
    <h3 class="panel-title">Visibility</h3>
  </div>
  <div class="panel-body">
    @if($layer->visible == 1)
        Yes
    @else
        No
    @endif
  </div></div>

@endsection


@section('script')
@endsection