<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function getListArticle()
	{
		$articles = Article::paginate(10);
		
		return view('article.index',compact('articles'));
	}
	
	public function getDetailArticle(Request $request)
	{
		$articles = Article::paginate(10);
		
		return view('article.detail',compact('articles'));
	}
}
