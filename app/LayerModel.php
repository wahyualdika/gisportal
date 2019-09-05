<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LayerModel extends Model
{
    protected $table = 'layer';
    protected $guarded = [];
    protected $casts = [
          'fields' => 'array',
          'default_layer' => 'array',
    ];

    public function popUp()
    {
        return $this->hasOne('App\PopUpLayer','layer_id','id');
    }

    public function foto()
   {
       return $this->hasMany('App\Foto','layer_id');
   }
}
