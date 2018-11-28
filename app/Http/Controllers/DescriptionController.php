<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Mark;
use App\Carmodel;
use App\Description;

class DescriptionController extends Controller
{
    public function show($marka, $model, $id)
    {
    	$show = true;
        $product = Product::findOrFail($id);
        $carmodel = Carmodel::where('name', $model)->first();
        $descs = $carmodel->getDescs($id);
        $content = view('layouts.content')->with(compact('product', 'marka', 'model', 'descs', 'show'))->render();
        return view('index')->with('content', $content);
    }
    public function add()
    {
    	$add = true;
    	$var = Mark::all('id', 'name')->toArray();
    	$marks = array();
    	foreach ($var as $value) {
    		array_push($marks, $value['name']);
    	}
    	$content = view('layouts.content')->with(compact('marks', 'add'))->render();
    	return view('index')->with('content', $content);
    }
    public function save(Request $request)
    {
    	$data = $request->all();
    	$desc = new Description;
    	if (strlen($data['image']) != 0)
        {
            $data['image'] = $desc->uploadMainImage($data['image']);
        }
        $desc->fill($data);
        $desc->save();
        return $desc;
    }
    public function edit($marka, $model, $product_id, $desc_id)
    {
        $edit = true;
        $arr = array();
        $product = Product::findOrFail($product_id);
        $carmodel = Carmodel::where('name', $model)->first();
        $product_name = $product->name;
        $arr['marka'] = $marka;
        $arr['carmodel_id'] = $carmodel->id;
        $arr['carmodel_name'] = $carmodel->name;
        $arr['product_id'] = $product_id;
        $arr['product_name'] = $product_name;
        $arr['desc_id'] = $desc_id;

        $content = view('layouts.content')->with(compact('arr', 'edit'))->render();
        return view('index')->with('content', $content);
    }
    public function get($desc_id)
    {
        $desc = Description::findOrFail($desc_id);
        $desc_array = $desc->toArray();

        unset($desc_array['product_id']);
        unset($desc_array['carmodel_id']);
        unset($desc_array['created_at']);
        unset($desc_array['updated_at']);

        $desc_array['image_src'] = $desc->getImage()->small;
        return $desc_array;
    }
    public function update(Request $request, $desc_id)
    {
        $desc = Description::findOrFail($desc_id);
        $data = [
            'note' => $request->get('note'),
            'image' => $request->get('image'),
            'video' => $request->get('video'),
            'status' => $request->get('status'),
            'price' => $request->get('price'),
            'sold' => $request->get('sold')
        ];

        if (!Description::isJSON($data['image']))
        {
            $data['image'] = $desc->uploadMainImage($data['image']);
        }

        unset($data['image_src']);
        $desc->fill($data);
        $desc->save();
        return $desc;
    }
    public function delete($desc_id)
    {
        $desc = Description::findOrFail($desc_id);
        $id = $desc->product_id;
        $carmodel = Carmodel::findOrFail($desc->carmodel_id);
        $model = $carmodel->name;
        $marka = Mark::findOrFail($carmodel->mark_id)->name;
        $desc->remove();
        return redirect()->route('show', [$marka, $model, $id]);
    }
}
