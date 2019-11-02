<?php

namespace Modules\Admin\Http\Controllers;

use App\Http\Requests\RequestCategory;
use App\Models\Category;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;

class AdminCategoryController extends Controller
{
	public function index()
	{
        $categories = Category::getListMenuSort();
		$viewData = [
			'categories' => $categories
		];


		
		return view('admin::category.index',$viewData);
	}
	
	public function create()
	{
	    $categoriesSort = Category::getListMenuSort();

		return view('admin::category.create',compact('categoriesSort'));
	}
	
	public function store(RequestCategory $requestCategory)
	{
		$this->insertOrUpdate($requestCategory);
		return redirect()->back()->with('success','Thêm mới thành công');
	}
	
	public function edit($id)
	{
        $categoriesSort = Category::getListMenuSort();
		$category  = Category::find($id);
		return view('admin::category.update',compact('category','categoriesSort'));
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
			$category->c_parent_id       = $requestCategory->c_parent_id;
			$category->c_icon            = str_slug($requestCategory->icon);
			$category->c_author_id       = get_data_user('admins');
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
					
				case 'home':
					$category->c_home = $category->c_home == 1 ? 0 : 1;
					$messages = 'Cập nhật thành công';
					$category->save();
					break;
				
				case 'active':
					$category->c_active = $category->c_active == 1 ? 0 : 1;
					$messages = 'Cập nhật thành công';
					$category->save();
					break;
				
			}
			
			
		}
		return redirect()->back()->with('success',$messages);
	}
}
