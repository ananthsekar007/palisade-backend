<?php

namespace App\Http\Controllers;

use App\Keystore;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Http\Request;

class KeystoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userId = Auth::guard('api')->user()->user_id;
        $values = Keystore::where('user_id', $userId)->get();
        $message= Config::get('response_messages.KEY_LISTED');
        return ResponseController::Response200($message, $values);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "title" => "required|string",
            "content" => "required|string",
        ]);
        if (!$validator->fails()) {
            $newValue = $request->all();
            $newValue['user_id'] =  Auth::guard('api')->user()->user_id;
            Keystore::create($newValue);
            $message = Config::get('response_messages.KEY_STORED');
            return  ResponseController::Response200($message);
        } else {
            return ErrorsController::ErrorValidationMessage($validator);
        };
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $userId = Auth::guard('api')->user()->user_id;
        $value = Keystore::where('keystore_id', $id)->where('user_id', $userId)->first();
        if ($value != null) {
            $message = Config::get('response_messages.KEY_LISTED');
            return ResponseController::Response200(null, $value);
        } else {
            $message = Config::get('response_messages.NO_KEY_FOUND');
            return ResponseController::Error422($message);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            "title" => "required|string",
            "content" => "required|string",
        ]);
        if (!$validator->fails()) {
            $userId = Auth::guard('api')->user()->user_id;
            $value = Keystore::where(['keystore_id' => $id, 'user_id' => $userId])->first();
            if ($value != null) {
                $newValue  =  $request->all();
                $value->fill($newValue)->save();
                $message = Config::get('response_messages.KEY_UPDATED');
                return ResponseController::Response200($message);
            } else {
                $message = Config::get('response_messages.NO_KEY_FOUND');
                return ResponseController::Error422($message, []);
            }
        }
        else {
            return ErrorsController::ErrorValidationMessage($validator);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $userId = Auth::guard('api')->user()->user_id;
        $value = Keystore::where(['keystore_id' => $id, 'user_id' => $userId])->first();
        if ($value != null) {
            $value->delete();
            $message = Config::get('response_messages.KEY_DELETED');
            return ResponseController::Response200($message);
        } else {
            $message = Config::get('response_messages.NO_KEY_FOUND');
            return ResponseController::Error422($message);
        }
    }
}
