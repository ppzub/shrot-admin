<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mark;
use App\Carmodel;
class CarmodelController extends Controller
{
    public function add()
    {
    	$var = Mark::all('id', 'name')->toArray();
    	$addmodel = true;
    	$marks = array();
    	foreach ($var as $value) {
    		array_push($marks, $value['name']);
    	}
    	$content = view('layouts.content')->with(compact('marks', 'addmodel'))->render();
    	return view('index')->with('content', $content);
    }
    public function save(Request $request)
    {
    	$data = $request->all();
    	$insert_data = array();
    	foreach ($data as $item)
    	{
    		$temp = array();
    		$temp['name'] = $item['model'];
    		$temp['mark_id'] = Mark::where('name', $item['marka'])->first()->id;
    		array_push($insert_data, $temp);
    	}
    	Carmodel::insert($insert_data);
    	return $insert_data;
    }
    public function get($name, $desc = false)
    {
        $mark = Mark::where('name', $name)->first();
        $carmodels = array();
        if (!$desc) {
            foreach ($mark->carmodels as  $value)
            {
                array_push($carmodels, $value->name);
            }
        }
        else {
            foreach ($mark->carmodels as  $value)
            {
                if (!$value->products->isEmpty()) {
                    array_push($carmodels, ['id' => $value->id, 'name' => $value->name]);
                }
            }
        }
        return $carmodels;
    }
}
