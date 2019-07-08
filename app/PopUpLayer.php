<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PopUpLayer extends Model
{
    protected $table = 'pop_up_layer';
    protected $guarded = [];
    protected $casts = [
          'fields' => 'array',
          'aliases'=> 'array',
    ];

    public function layer(){
      return $this->belongsTo('App\LayerModel');
    }
}
