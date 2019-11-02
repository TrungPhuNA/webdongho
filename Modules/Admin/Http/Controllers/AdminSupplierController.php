<?php

namespace Modules\Admin\Http\Controllers;

use App\Http\Requests\RequestSupplier;
use App\Models\Supplier;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;

class AdminSupplierController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::orderByDesc('id')
            ->paginate(10);

        $viewData = [
            'suppliers' => $suppliers
        ];

        return view('admin::supplier.index', $viewData);
    }

    public function create()
    {
        return view('admin::supplier.create');
    }

    public function store(RequestSupplier $request)
    {
        $this->insertOrUpdate($request);
        return redirect()->back()->with('success','Thêm mới thành công');
    }

    public function edit($id)
    {
        $supplier =  Supplier::findOrFail($id);
        return view('admin::supplier.create',compact('supplier',$supplier));
    }

    public function update(RequestSupplier $request, $id)
    {
        $this->insertOrUpdate($request, $id);
        return redirect()->back()->with('success','Cập nhật thành công');
    }

    public function insertOrUpdate($request,$id='')
    {
        $code = true;
        try{
            $supplier = new Supplier();
            if ($id) {
                $supplier = Supplier::find($id);
            }
            $supplier->s_name      = $request->s_name;
            $supplier->s_email     = $request->s_email;
            $supplier->s_phone     = $request->s_phone;
            $supplier->s_fax       = $request->s_fax;
            $supplier->s_website   = $request->s_website;
            $supplier->s_author_id = get_data_user('admins');
            $supplier->save();
        }catch (\Exception $exception)
        {
            $code = false;
            Log::error("[Error insertOrUpdate Supplier]".$exception->getMessage()) ;
        }

        return $code;
    }

    public function delete($id)
    {
        Supplier::findOrFail($id)->delete();
        return redirect()->back()->with(['success' => 'Xoá dữ liệu thành công']);
    }
}
