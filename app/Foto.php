<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
    protected $table = 'foto';
    public function layer()
    {
        return $this->belongsTo('App\Layer');
    }
}
