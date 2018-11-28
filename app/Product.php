<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
	protected $fillable = ['name', 'desc', 'published'];
	public function carmodels()
    {
        return $this->belongsToMany('App\Carmodel', 'product_carmodel');
    }
    public function descriptions()
    {
        return $this->hasMany('App\Description');
    }
}
