<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestPassword;
use App\Models\Product;
use App\Models\Transaction;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends FrontendController
{
    /**
     * show tong quan user
     */
    public function index()
    {
        $transactions     = Transaction::where('tr_user_id', get_data_user('web'));
        $listTransactions = $transactions;

        $transactions         = $transactions->addSelect('id', 'tr_total', 'tr_address', 'tr_phone', 'created_at', 'tr_status')->paginate(10);
        $totalTransaction     = $listTransactions->select('id')->count();
        $totalTransactionDone = $listTransactions->where('tr_status', Transaction::STATUS_DONE)
            ->select('id')
            ->count();

        $viewData = [
            'totalTransaction'     => $totalTransaction,
            'totalTransactionDone' => $totalTransactionDone,
            'transactions'         => $transactions
        ];

        return view('user.index', $viewData);
    }

    public function updateInfo()
    {
        $user = User::find(get_data_user('web'));
        return view('user.info', compact('user'));
    }

    /**
     * luu thong tin
     */
    public function saveUpdateInfo(Request $request)
    {
        User::where('id', get_data_user('web'))
            ->update($request->except('_token'));

        return redirect()->back()->with('success', 'Cập nhật thông tin thành công');
    }

    public function updatePassword()
    {
        return view('user.password');
    }

    public function saveUpdatePassword(RequestPassword $requestPassword)
    {
        if (Hash::check($requestPassword->password_old, get_data_user('web', 'password'))) {
            $user           = User::find(get_data_user('web'));
            $user->password = bcrypt($requestPassword->password);
            $user->save();

            return redirect()->back()->with('success', 'Cập nhật thành công');
        }

        return redirect()->back()->with('danger', 'Mật khẩu cũ không đúng');
    }

    public function getProductPay()
    {
        $products = Product::orderBy('pro_pay', 'DESC')->limit(10)->get();
        return view('user.product', compact('products'));
    }

    public function getProductWishlist()
    {
        $user_id =  get_data_user('web');
        $products = Product::whereHas('user',function($query) use($user_id){
            $query->where('pf_user_id',$user_id);
        })->orderByDesc('id')
            ->simplePaginate(10);

        return view('user.favorite', compact('products'));
    }

    public function getTransaction()
    {
        $transactions = Transaction::with('user')
            ->where('tr_user_id', get_data_user('web'))
            ->orderByDesc('id')->paginate(10);

        $viewData     = [
            'transactions' => $transactions
        ];

        return view('user.transaction_history', $viewData);
    }

    public function addFavorite($productID)
    {
        $favoriteExists = \DB::table('products_favorite')
            ->where([
                'pf_product_id' => $productID,
                'pf_user_id'    => get_data_user('web')
            ])->first();

        if ($favoriteExists)
            return redirect()->back()->with('danger', 'Đã thêm vào yêu thích');

        $idFavorite = \DB::table('products_favorite')
            ->insertGetID([
                'pf_product_id' => $productID,
                'pf_user_id'    => get_data_user('web')
            ]);

        if ($idFavorite) {
            return redirect()->back()->with('success', 'Thêm vào yêu thích thành công');
        }

        return redirect()->back()->with('danger', 'Thêm vào yêu thích thất bại');
    }
}
