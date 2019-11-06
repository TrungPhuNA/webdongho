<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SearchController extends FrontendController
{
    public function index(Request $request)
    {
        // Lấy danh mục
        $cateProduct = [];
        if ($id = $request->cate) {
            $cateProduct = Category::findOrFail($id);
            $categoryChildren = Category::where('c_parent_id', $id)->get();
        }

        // lấy danh mục con nếu có

        // Danh sách nhà cung cấp
        $suppliers = Supplier::select('id','s_name')->orderByDesc('id')->get();


        // Lấy sản phẩm
        $products = Product::where("pro_active", Product::STATUS_PUBLIC);
        $products->where('pro_category_id', $id);

        if ($request->k) {
            $products->where('pro_name', 'like', '%' . $request->k . '%');
        }

        if ($request->price) {
            $price = $request->price;
            switch ($price) {
                case '1':
                    $products->where('pro_price', '<', 1000000);
                    break;

                case '2':
                    $products->whereBetween('pro_price', [1000000, 3000000]);
                    break;

                case '3':
                    $products->whereBetween('pro_price', [3000000, 5000000]);
                    break;

                case '4':
                    $products->whereBetween('pro_price', [5000000, 7000000]);
                    break;

                case '5':
                    $products->whereBetween('pro_price', [7000000, 10000000]);
                    break;

                case '6':
                    $products->where('pro_price', '>', 10000000);
                    break;
            }
        }

        if ($request->orderby) {
            $orderby = $request->orderby;

            switch ($orderby) {
                case 'desc':
                    $products->orderBy('id', 'DESC');
                    break;

                case 'asc':
                    $products->orderBy('id', 'ASC');
                    break;

                case 'price_max':
                    $products->orderBy('pro_price', 'ASC');
                    break;

                case 'price_min':
                    $products->orderBy('pro_price', 'DESC');
                    break;
                default:
                    $products->orderBy('id', 'DESC');

            }
        }

        $products = $products->paginate(3);

        $viewData = [
            'products'         => $products,
            'cateProduct'      => $cateProduct,
            'categoryChildren' => $categoryChildren ?? null,
            'query'            => $request->query(),
            'suppliers'        => $suppliers,
            'productHot'       => $productHot ?? null
        ];

        return view('product.index', $viewData);
    }
}
