<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mark extends Model
{
	protected $fillable = ['name'];
    public function carmodels()
    {
        return $this->hasMany('App\Carmodel');
    }
}
