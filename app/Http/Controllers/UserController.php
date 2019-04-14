<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
	/**
	 * show tong quan user
	 */
    public function index()
	{
		$transactions 		  = Transaction::where('tr_user_id',get_data_user('web'));
		$listTransactions 	  = $transactions;
		
		$transactions = $transactions->addSelect('id','tr_total','tr_address','tr_phone','created_at','tr_status')->paginate(10);
		$totalTransaction     = $listTransactions->select('id')->count();
		$totalTransactionDone = $listTransactions->where('tr_status',Transaction::STATUS_DONE)
								->select('id')
								->count();
		
		$viewData = [
			'totalTransaction'	   => $totalTransaction,
			'totalTransactionDone' => $totalTransactionDone,
			'transactions'	       => $transactions
		];
		
		return view('user.index',$viewData);
	}
	
	public function updateInfo()
	{
		$user = User::find(get_data_user('web'));
		return view('user.info',compact('user'));
	}
	
	/**
	 * luu thong tin
	 */
	public function saveUpdateInfo(Request $request)
	{
		User::where('id',get_data_user('web'))
			->update($request->except('_token')) ;
		
		return redirect()->back()->with('success','Cập nhật thông tin thành công');
	}
}
