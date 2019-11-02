<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;

class ProductDetailController extends FrontendController
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function productDetail(Request $request)
	{
		$url = $request->segment(2);
		$url = preg_split('/(-)/i',$url);
		
		if ($id = array_pop($url))
		{
		    // Chi tiết sản phẩm
			$productDetail = Product::with('supplier:id,s_name')
                    ->where('pro_active',Product::STATUS_PUBLIC)
                    ->findOrFail($id);

			// Ảnh sản phẩm
            $images = ProductImage::where('pi_product_id', $id)->get();

			// Danh mục sản phẩm đó
			$cateProduct = Category::find($productDetail->pro_category_id);

			// Sản phẩm liên quan
            $productSuggest = Product::where('pro_active',Product::STATUS_PUBLIC)
                            ->where('pro_category_id', $cateProduct->id)
                            ->orderByDesc('id')
                            ->limit(8)
                            ->get();

			$viewData = [
                'productDetail'  => $productDetail,
                'cateProduct'    => $cateProduct,
                'productSuggest' => $productSuggest,
                'images'         => $images
			];
			
			return view('product.detail',$viewData);
		}

		return redirect()->to('/');
	}
}
