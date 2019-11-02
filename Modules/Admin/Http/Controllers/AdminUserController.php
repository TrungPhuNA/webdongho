<?php

namespace Modules\Admin\Http\Controllers;

use App\Models\Order;
use App\Models\Transaction;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class AdminUserController extends Controller
{
    public function index(Request $request)
    {
    	$users = User::whereRaw(1);
    	
    	$users = $users->orderBy('id','DESC')->paginate(10);
    	
    	$viewData = [
    		'users' => $users
		];
    	
        return view('admin::user.index',$viewData);
    }

    public function delete(Request $request, $id)
    {
        $user = User::findOrFail($id);
        Order::where('or_user_id', $id)->delete();
        Transaction::where('tr_user_id', $id)->delete();
        $user->delete();
        
        return redirect()->back();
    }
}
