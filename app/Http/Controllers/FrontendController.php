<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class FrontendController extends Controller
{
    public function __construct()
	{
		$categories = Category::with('children:id,c_name,c_slug,c_parent_id')
            ->where('c_active',Category::STATUS_PUBLIC)
            ->whereNull('c_parent_id')
            ->get();
        View::share('categories', $categories);

        $categoriesHot = Category::with('children:id,c_name,c_slug,c_parent_id')
            ->where('c_home',Category::HOME)
            ->get();

		View::share('categoriesHot', $categoriesHot);
	}
}
