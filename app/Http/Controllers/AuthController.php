<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Authentication;
use App\Helpers\Helper;
use App\Traits\ResponseService;

class AuthController extends Controller
{
	use ResponseService;

	public function __construct()
	{
		$this->middleware('auth', ['except' => ['register', 'login']]);
	}

	public function register(Request $request)
	{
		$validator = Validator::make(
			$request->only(['email', 'password']),
			[
				'email' => ['required', 'unique:users'],
				'password' => ['required']
			]
		);
		if ($validator->fails()) return $this->badRequest(['message' => $validator->errors()->all()]);

		try {
			$user = User::create([
				'email' => $request->input('email'),
				'password' => Hash::make($request->input('password'))
			]);

			return $this->success([
				'data' => ['email' => $user->email]
			]);
		} catch (\Exception $err) {

			return $this->serverError(['message' => $err->getMessage()]);
		}
	}

	public function login(Request $request)
	{
		$user = User::where('email', $request->input('email'))->first();
		if ($user && Hash::check($request->input('password'), $user->password)) {
			$iat = time();
			$exp = strtotime('+24 hours', $iat);
			$token = Helper::generateJwt([
				'iss'   => url('/'),
				'iat'   => $iat,
				'exp'   => $exp,
				'email' => $user->email
			]);

			return $this->success([
				'data' => [
					'user_id' => $user->id,
					'token'  => $token
				]
			]);
		}

		return $this->unauthorized([
			'message' => 'Email or Password wrong.'
		]);
	}
}
