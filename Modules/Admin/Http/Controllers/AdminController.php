<?php

namespace Modules\Admin\Http\Controllers;

use App\Models\Article;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Rating;
use App\Models\Transaction;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class AdminController extends Controller
{
	/**
	 * Display a listing of the resource.
	 * @return Response
	 */
	public function index()
	{
		$contacts = Contact::limit(10)->get();
		$countUser = User::count();
		$countProduct = Product::count();
		$countArticle = Article::count();

		
		// doanh thu ngay
		$moneyDay = Transaction::whereDay('created_at',date('d'))
			->where('tr_status',Transaction::STATUS_DONE)
			->sum('tr_total');
		
		$mondayLast = Carbon::now()->startOfWeek();
		$sundayFirst = Carbon::now()->endOfWeek();
		$moneyWeed = Transaction::whereBetween('created_at',[$mondayLast,$sundayFirst])
			->where('tr_status',Transaction::STATUS_DONE)
			->sum('tr_total');
		
		// doanh thu thag
		$moneyMonth = Transaction::whereMonth('created_at',date('m'))
			->where('tr_status',Transaction::STATUS_DONE)
			->sum('tr_total');
		
		// doanh thu nam
		$moneyYear = Transaction::whereYear('created_at',date('Y'))
			->where('tr_status',Transaction::STATUS_DONE)
			->sum('tr_total');
		
		$dataMoney = [
			[
				"name" => "Doanh thu ngày",
				"y"    => (int)$moneyDay
			],
			[
				"name" => "Doanh thu tuần",
				"y"    => (int)$moneyWeed
			],
			[
				"name" => "Doanh thu tháng",
				"y"    => (int)$moneyMonth
			],
			[
				"name" => "Doanh thu năm",
				"y"    => (int)$moneyYear
			]
		];
		
		// danh sach don hang moi
		
		$transactionNews = Transaction::with('user:id,name')
			->limit(5)
			->orderByDesc('id')
			->get();
		
		
		$viewData = [
			'ratings'         => $ratings ?? null,
			'contacts'        => $contacts,
			'moneyDay'        => $moneyDay,
			'moneyMonth'      => $moneyMonth,
			'dataMoney'       => json_encode($dataMoney),
			'transactionNews' => $transactionNews,
			'countRating'     => $countRating ??  null,
			'countUser'       => $countUser,
			'countProduct'    => $countProduct,
			'countArticle'    => $countArticle,
		];
		
		return view('admin::index', $viewData);
	}
}
