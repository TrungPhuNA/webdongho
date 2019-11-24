<?php

namespace Modules\Admin\Http\Controllers;

use App\Http\Requests\RequestProduct;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class AdminProductController extends Controller
{
    public function index(Request $request)
	{
		$products = Product::with('category:id,c_name');

		if ($request->name)  $products->where('pro_name','like','%'.$request->name.'%');
		if ($request->cate)  $products->where('pro_category_id',$request->cate) ;

		$products = $products->orderByDesc('id')->paginate(10);

		$categories = $this->getCategories();

		$viewData = [
			'products'   => $products,
			'categories' => $categories
		];

		return view('admin::product.index',$viewData);
	}

	public function create()
	{
		$categories = $this->getCategories();
		$suppliers  = $this->getSupplier();

		return view('admin::product.create',compact('categories','suppliers'));
	}

	public function store(RequestProduct $requestProduct)
	{
	     $this->insertOrUpdate($requestProduct);

	     return redirect()->back()->with('success','Thêm mới thành công');
	}

	public function edit($id)
	{
		$product    = Product::find($id);
		$categories = $this->getCategories();
        $suppliers  = $this->getSupplier();
        $images     = ProductImage::where('pi_product_id', $id)->get();

		return view('admin::product.update',compact('product','categories','suppliers','images'));
	}

	public function update(RequestProduct $requestProduct,$id)
	{
		$this->insertOrUpdate($requestProduct,$id);

		return redirect()->back()->with('success','Cập nhật thành công ');
	}

	public function getCategories()
	{
		return Category::all();
	}

	public function getSupplier()
    {
        return Supplier::select('id','s_name')->orderByDesc('id')->get();
    }

	public function insertOrUpdate($requestProduct,$id='')
	{
		$product = new Product();

		if ($id) $product = Product::find($id);

        $product->pro_name            = $requestProduct->pro_name;
        $product->pro_slug            = str_slug($requestProduct->pro_name);
        $product->pro_category_id     = $requestProduct->pro_category_id;
        $product->pro_price           = $requestProduct->pro_price;
        $product->pro_sale            = $requestProduct->pro_sale;
        $product->pro_number          = $requestProduct->pro_number;
        $product->pro_description     = $requestProduct->pro_description;
        $product->pro_content         = $requestProduct->pro_content;
        $product->pro_title_seo       = $requestProduct->pro_title_seo ? $requestProduct->pro_title_seo : $requestProduct->pro_name;
        $product->pro_description_seo = $requestProduct->pro_description_seo ? $requestProduct->pro_description_seo : $requestProduct->pro_description_seo;
        $product->s_supplier_id       = $requestProduct->s_supplier_id;
        $product->pro_author_id       = get_data_user('admins');

        if ($requestProduct->pro_warranty) {
		    $product->pro_warranty = $requestProduct->pro_warranty;
        }
		if ( $requestProduct->hasFile('avatar'))
		{
			$file = upload_image('avatar');

			if (isset($file['name']))
			{
				$product->pro_avatar = $file['name'];
			}
		}

		$product->save();

		if ($product->id && $requestProduct->hasFile('album')) {
            $this->uploadAlbumImage($requestProduct->file('album'), $id);
        }
	}

	public function uploadAlbumImage($files, $product_id)
    {
        ProductImage::where('pi_product_id', $product_id)->delete();
        foreach ($files as $fileKey => $fileImage ) {
            $ext = $fileImage->getClientOriginalExtension();

            $extend = ['png','jpg','jpeg', 'PNG', 'JPG','webp'];

            if( !in_array($ext,$extend))
            {
                return false;
            }

            $filename = date('Y-m-d__').str_slug($fileImage->getClientOriginalName()).'.'.$ext;

            $path = public_path().'/uploads/'.date('Y/m/d/');
            if ( !\File::exists($path))
            {
                mkdir($path,0777,true);
            }

            // di chuyen file vao thu muc uploads
            $fileImage->move($path,$filename);
            $productImage = new ProductImage();
            $productImage->pi_name = $fileImage->getClientOriginalName();
            $productImage->pi_slug = $filename;
            $productImage->pi_product_id = $product_id;
            $productImage->save();
        }
    }

	public function delete($id)
	{
		\DB::table('products')->where('id',$id)->delete();
		return redirect()->back();
	}

	public function deleteImage($id)
    {
        ProductImage::where('id', $id)->delete();
        return redirect()->back()->with('success','Xoá thành công');
    }

	public function action($action,$id)
	{
		if ($action)
		{
			$product = Product::find($id);
			switch ($action)
			{
				case 'delete':
					$product->delete();
					break;

				case 'active':
					$product->pro_active =  $product->pro_active ? 0 : 1;
					break;

				case 'hot':
					$product->pro_hot =  $product->pro_hot ? 0 : 1 ;
					break;
			}

			$product->save();
		}

		return redirect()->back();
	}
}
