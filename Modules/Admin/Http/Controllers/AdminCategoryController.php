<?php

namespace Modules\Admin\Http\Controllers;

use App\Http\Requests\RequestCategory;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;

class AdminCategoryController extends Controller
{
	public function index()
	{
		$categories = Category::select('id','c_name','c_title_seo','c_active')->get();
		
		$viewData = [
			'categories' => $categories
		];
		
		return view('admin::category.index',$viewData);
	}
	
	public function create()
	{
		return view('admin::category.create');
	}
	
	public function store(RequestCategory $requestCategory)
	{
		$this->insertOrUpdate($requestCategory);
		return redirect()->back()->with('success','Thêm mới thành công');
	}
	
	public function edit($id)
	{
		$category  = Category::find($id);
		return view('admin::category.update',compact('category'));
	}
	
	public function update(RequestCategory $requestCategory,$id)
	{
		$this->insertOrUpdate($requestCategory,$id);
		return redirect()->back()->with('success','Cập nhật dữ liệu thành công');
	}
	
	public function insertOrUpdate($requestCategory,$id='')
	{
		$code = 1;
		try{
			$category                    = new Category();
			
			if ($id)
			{
				$category                    = Category::find($id);
			}
			
			$category->c_name            = $requestCategory->name;
			$category->c_slug            = str_slug($requestCategory->name);
			$category->c_icon            = str_slug($requestCategory->icon);
			$category->c_title_seo       = $requestCategory->c_title_seo ? $requestCategory->c_title_seo : $requestCategory->name;
			$category->c_description_seo = $requestCategory->c_description_seo;
			$category->save();
		}catch (\Exception $exception)
		{
			$code = 0;
			Log::error("[Error insertOrUpdate Categories ]".$exception->getMessage()) ;
		}
		
		return $code;
	}
	
	public function action($action,$id)
	{
		$messages = '';
		if ($action)
		{
			$category = Category::find($id);
			switch ($action)
			{
				case 'delete':
					$category->delete();
					$messages = 'Xoá dữ liệu thành công';
					break;
			}
		}
		
		return redirect()->back()->with('success',$messages);
	}
}
