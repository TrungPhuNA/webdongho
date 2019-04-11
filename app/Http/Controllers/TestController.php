<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index()
	{
		return view('template.index');
	}
	
	public function category()
	{
		return view('template.category');
	}
	
	public function detail()
	{
		return view('template.detail');
	}
}
