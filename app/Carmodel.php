<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carmodel extends Model
{
	protected $fillable = ['name', 'mark_id'];
    public function mark()
    {
        return $this->belongsTo('App\Mark');
    }
    public function products()
    {
        return $this->belongsToMany('App\Product', 'product_carmodel');
    }
    public function descriptions()
    {
        return $this->hasMany('App\Description');
    }
    public function getDescs($product_id)
    {
        $collection = $this->descriptions->where('product_id', $product_id);
        $descs = collect();
        foreach($collection as $col) {
            $descs->push($col);
        }
        return $descs;
    }
}
