<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;

class HomeController extends FrontendController
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$productHot = Product::with('category:id,c_name')
        ->where([
		   'pro_hot' => Product::HOT_ON,
		   'pro_active' => Product::STATUS_PUBLIC
		])->limit(5)->get();
		
		$articleNews = Article::orderBy('id','DESC')->limit(6)->get();
		
		$categoriesHome = Category::with('products')
				->where('c_home',Category::HOME)
				->where('c_active',Category::STATUS_PUBLIC)
				->limit(3)
				->get();
		
		$productSuggest = [];

		$viewData = [
			'productHot'     => $productHot,
			'articleNews'    => $articleNews,
			'categoriesHome' => $categoriesHome,
			'productSuggest' => $productSuggest,
		];
		
        return view('home.index_2',$viewData);
        // return view('home.index',$viewData);
    }
    
    public function renderProductView(Request $request)
	{
		if ($request->ajax())
		{
			$listID = $request->id;
			$products = Product::whereIn('id',$listID)->get();
			$html = view('components.product_view',compact('products'))->render();
			
			return response()->json(['data' => $html]);
		}
	}
}
