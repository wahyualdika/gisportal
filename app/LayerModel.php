<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LayerModel extends Model
{
  protected $table = 'layer';
  protected $guarded = [];
  protected $casts = [
        'fields' => 'array'
  ];
}
