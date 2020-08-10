<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;
use League\OAuth2\Server\RequestEvent;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'email' => 'required|email',
                'password' => 'required|string'
            ]
        );
        if (!$validator->fails()) {
            $credentials = [
                'email' => $request->email,
                'password' => $request->password
            ];
            if (Auth::attempt($credentials)) {
                $user = Auth::user();
                $token = $user->createToken("APP_TOKEN")->accessToken;
                return response()->json([
                    'status' => Config::get('response_messages.RESPONSE.SUCCESS'),
                    'message' => Config::get('response_messages.LOGGED_ON'),
                    'access_token' => $token,
                    'user' => $user
                ], 200);
            } else {
                $message = Config::get('response_messages.INVALID_USERNAME_PASSWORD');
                return ResponseController::Error422($message);
            }
        } else {
            return ErrorsController::ErrorValidationMessage($validator);
        }
    }
};
