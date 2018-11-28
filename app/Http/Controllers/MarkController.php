<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mark;

class MarkController extends Controller
{
    public function index()
	{
		$avtos = Mark::all();
		$content = view('layouts.content')->with(compact('avtos'))->render();
    	return view('index')->with('content', $content);
	}
}
