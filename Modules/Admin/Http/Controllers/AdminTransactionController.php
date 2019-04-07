<?php

namespace Modules\Admin\Http\Controllers;

use App\Models\Order;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class AdminTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
    	$transactions = Transaction::with('user:id,name')
			->paginate(10);
    	
    	$viewData = [
    		'transactions' => $transactions
		];
    	
        return view('admin::transaction.index',$viewData);
    }
    
    public function viewOrder(Request $request,$id)
	{
		 if ($request->ajax())
		 {
		 	$orders = Order::with('product')
				->where('or_transaction_id',$id)->get();
		 	
		 	$html = view('admin::components.order',compact('orders'))->render();
		 	return \response()->json($html);
		 }
	}
}
