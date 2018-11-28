<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class Description extends Model
{
	protected $fillable = ['note', 'image', 'video', 'status', 'price', 'sold', 'product_id', 'carmodel_id'];
	public function product()
    {
        return $this->belongsTo('App\Product');
    }
    public function carmodel()
    {
        return $this->belongsTo('App\Carmodel');
    }
    public function uploadMainImage($image)
    {
        if (strlen($image) == 0) { return; }
        $this->removeImage(); // якщо вже є в БД картінка для даного запису, видаляєм

        $obj = new \stdClass;
        $str = str_random(10);

        $obj->small = $str.'_small.png';
        $obj->medium = $str.'_medium.png';

        $img = Image::make($image);
        $img->fit(412, 309)->save(public_path().'/images/medium/'.$obj->medium);
        $img->fit(120, 90)->save(public_path().'/images/small/'.$obj->small);

        $obj = json_encode($obj);

        return $obj;
    }
    public function removeImage()
    {
        if ($this->image != null)
        {
            $image = json_decode($this->image);
            Storage::delete('/images/small/'.$image->small);
            Storage::delete('/images/medium/'.$image->medium);
        }
    }
    /**
     * ф-я для отримання картінки
     */
    public function getImage()
    {
        $obj = new \stdClass;
        if ($this->image == null)
        {
            $obj->small = '/images/small/default_small.png';
            $obj->medium = '/images/medium/default_medium.png';
            return $obj;
        }
        else
        {
            $image = json_decode($this->image);
            $obj->small = '/images/small/'.$image->small;
            $obj->medium = '/images/medium/'.$image->medium;
            return $obj;
        }
    }
   	/**
     * ф-я для видалення запису
     */
    public function remove()
    {
        $this->removeImage();
        $this->delete();
    }
    public static function isJSON($string)
    {
        return is_string($string) && is_array(json_decode($string, true)) && (json_last_error() == JSON_ERROR_NONE) ? true : false;
    }
}
