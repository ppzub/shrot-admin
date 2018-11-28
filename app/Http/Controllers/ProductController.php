<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mark;
use App\Carmodel;
use App\Product;

class ProductController extends Controller
{
    public function add()
    {

    	$var = Mark::all('id', 'name')->toArray();
    	$addprod = true;
    	$marks = array();
    	foreach ($var as $value) {
    		array_push($marks, $value['name']);
    	}
    	$content = view('layouts.content')->with(compact('marks', 'addprod'))->render();
    	return view('index')->with('content', $content);
    }
    public function save(Request $request)
    {

        $data = $request->all();
        $product = $data['product'];

        $models = $data['models'];
        $insert_models = array();
        foreach ($models as $item) {
            array_push($insert_models, Carmodel::where('name', $item['model'])->first()->id);
        }
        $insert_product = null;
        if ($insert_product = Product::where('name', $product['name'])->first()) {}
        else {
             $insert_product = Product::create($product);
        }
        $insert_product->carmodels()->attach($insert_models);
        return $insert_models;
    }
    public function show($marka, $model)
    {
        $showprod = true;
        $products = Carmodel::where('name', $model)->first()->products;
        $content = view('layouts.content')->with(compact('marka', 'model', 'products', 'showprod'))->render();
        return view('index')->with('content', $content);
    }
    public function editname(Request $request)
    {
        $data = $request->all();
        $product = Product::findOrFail($data['id']);
        $product->name = $data['new'];
        $product->save();
        return $product;
    }

    public function getname($id)
    {
        $product = Product::findOrFail($id);
        return $product->name;
    }
    public function get($model)
    {
        $carmodel = Carmodel::where('name', $model)->first();
        $products = array();
        foreach ($carmodel->products as  $value)
        {
            array_push($products, ['id' => $value->id, 'name' => $value->name]);
        }
        return $products;
    }
    public function list()
    {
        $prods = Product::all();
        $content = view('layouts.content')->with(compact('prods'))->render();
        return view('index')->with('content', $content);
    }
    public function deleteprod()
    {
        $var = Mark::all('id', 'name')->toArray();
        $deleteprod = true;
        $marks = array();
        foreach ($var as $value) {
            array_push($marks, $value['name']);
        }
        $content = view('layouts.content')->with(compact('marks', 'deleteprod'))->render();
        return view('index')->with('content', $content);
    }
    public function detach(Request $request)
    {
        $data = $request->all();
        $carmodel = Carmodel::findOrFail($data['carmodel_id']);
        $carmodel->products()->detach($data['product_id']);
        return $data;
    }
    public function removeprod()
    {
        $var = Product::all('id', 'name')->toArray();
        $removeprod = true;
        $products = array();
        foreach ($var as $value) {
            array_push($products, ['id' => $value['id'], 'name' => $value['name']]);
        }
        $content = view('layouts.content')->with(compact('products', 'removeprod'))->render();
        return view('index')->with('content', $content);
    }
    public function remove($id)
    {
        $product = Product::findOrFail($id);
        $product->carmodels()->detach();
        $product->delete();
        return '';
    }
}
