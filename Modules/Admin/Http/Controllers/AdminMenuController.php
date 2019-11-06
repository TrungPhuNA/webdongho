<?php

namespace Modules\Admin\Http\Controllers;

use App\Http\Requests\RequestMenu;
use App\Models\Article;
use App\Models\Menu;
use Carbon\Carbon;
use Illuminate\Routing\Controller;

class AdminMenuController extends Controller
{
    public function index()
    {
        $menus = Menu::all();

        return view('admin::menu.index', compact('menus'));
    }

    public function create()
    {
        return view('admin::menu.create');
    }

    public function store(RequestMenu $requestMenu)
    {
        $menu = new Menu();
        $menu->m_name = $requestMenu->m_name;
        $menu->m_slug = str_slug($requestMenu->m_name);
        $menu->created_at = Carbon::now();
        $menu->save();

        return redirect()->back()->with('success','Thêm mới thành công');
    }

    public function edit($id)
    {
        $menu = Menu::findOrFail($id);
        return view('admin::menu.create', compact('menu'));
    }

    public function update(RequestMenu $requestMenu, $id)
    {
        $menu = Menu::findOrFail($id);
        $menu->m_name = $requestMenu->m_name;
        $menu->m_slug = str_slug($requestMenu->m_name);
        $menu->created_at = Carbon::now();
        $menu->save();

        return redirect()->back()->with('success','Cập nhật thành công');
    }

    public function delete($id)
    {
        Article::where('a_category_id', $id)->delete();
        Menu::findOrFail($id)->delete();

        return redirect()->back()->with('success','Xoá thành công');
    }
}
