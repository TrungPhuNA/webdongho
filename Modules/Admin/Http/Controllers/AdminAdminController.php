<?php

namespace Modules\Admin\Http\Controllers;

use App\Http\Requests\AdminRequest;
use App\Models\Admin;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class AdminAdminController extends Controller
{
    public function index()
    {
        $admins = Admin::all();
        return view('admin::admin.index', compact('admins'));
    }

    public function create()
    {
        return view('admin::admin.create');
    }

    public function store(AdminRequest $request)
    {
        $data = $request->except('_token');
        $data['password'] = bcrypt($request->password);
        $data['created_at'] = Carbon::now();
        Admin::insert($data);

        return redirect()->back()->with('success','Thêm mới thành công');
    }

    public function edit($id)
    {
        $admin = Admin::find($id);
        return view('admin::admin.create', compact('admin'));
    }

    public function update(AdminRequest $request, $id) {
        $data = $request->except('_token');
        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        }

        Admin::find($id)->update($data);

        return redirect()->back()->with('success','Cập nhật thành công');
    }

    public function delete($id)
    {
        Admin::find($id)->delete();
        return redirect()->back()->with('success','Xoá dữ liệu thành công');
    }
}
