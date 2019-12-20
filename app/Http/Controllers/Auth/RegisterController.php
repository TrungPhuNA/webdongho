<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\FrontendController;
use App\Http\Requests\RegisterRequest;
use App\User;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Mail;

class RegisterController extends FrontendController
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */
    public function __construct()
    {
        parent::__construct();
    }

   	public function getRegister()
	{
		return view('auth.register');
	}

	public function postRegister(RegisterRequest $request)
	{
		$user = new User();
		$user->name = $request->name;
		$user->email = $request->email;
		$user->phone = $request->phone;
		$user->password = bcrypt($request->password);
		$user->save();

		if ($user->id)
		{
            if (\Auth::guard('web')->loginUsingId($user->id))
            {
                return redirect('/');
            }
		}

        return redirect()->route('get.login');
	}

	/**
	 * Xác nhận tài khoản
	 */
	public function verifyAccount(Request $request)
	{
		$code = $request->code;
		$id = $request->id;

		$checkUser = User::where([
			'code_active' => $code,
			'id' => $id
		])->first();

		if (!$checkUser)
		{
			return redirect('/')->with('danger','Xin lỗi ! Đường dẫn xác nhận tài khoản không tồn tại , bạn vui lòng thử lại sau.');
		}

		$checkUser->active = 2;
		$checkUser->save();
		return redirect('/')->with('success','Xác nhận tài khoản thành công');
	}
}
