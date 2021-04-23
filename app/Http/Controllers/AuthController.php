<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Models\User;

class AuthController extends Controller
{
	public function register(Request $request)
	{
		$user = new User;

		$this->validate($request, [
			'username' => ['required', 'unique:App\Models\User,username'],
			'email' => ['required', 'unique:App\Models\User,email'],
			'password' => ['required']
		]);
		try {

			$user->username = $request->input('username');
			$user->email = $request->input('email');
			$user->password = Crypt::encrypt($request->input('password'));
			$user->save();
			return response()->json([
				'status' => [
					'code' => 201,
					'message' => 'User registered'
				],
				'user' => [
					'username' => $request->input('username'),
					'email' => $request->input('email')
				]
			], 201);
		} catch (\Exception $e) {
			return response()->json([
				'status' => [
					'code' => 500,
					'message' => 'Server Error'
				]
			], 500);
		}
	}
}
