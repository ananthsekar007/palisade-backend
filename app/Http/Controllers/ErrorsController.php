<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class ErrorsController extends Controller
{
    public static function ErrorValidationMessage($validator){
        $allMessages = implode(" ", $validator->errors()->all());
        return response()->json([
            'status' => Config::get('response_messages.RESPONSE.FAILURE'),
            'message' => $allMessages
        ],400);
    }

    public static function Error204($message) {
        return self::throwErrorMessage(204, $message) ;
    }

    public static function Error400($message) {
        return self::throwErrorMessage(400, $message) ;
    }

    public static function Error401($message) {
        return self::throwErrorMessage(401, $message) ;
    }

    public static function Error403($message) {
        return self::throwErrorMessage(403, $message) ;
    }

    public static function Error404($message) {
        return self::throwErrorMessage(404, $message) ;
    }

    public static function Error406($message) {
        return self::throwErrorMessage(406, $message) ;
    }

    public static function Error409($message) {
        return self::throwErrorMessage(409, $message) ;
    }

    public static function Error419($message) {
        return self::throwErrorMessage(419, $message) ;
    }

    public static function Error422($message) {
        return self::throwErrorMessage(422, $message) ;
    }

    public static function Error500($message) {
        return self::throwErrorMessage(500, $message) ;
    }

    public static function throwErrorMessage($responseStatusCode, $responseMessage) {
        return response()->json([ 'status' => Config::get('response_messages.RESPONSE.ERROR'), 'message'=>$responseMessage==''? Config::get('response_messages.HTTP_RESPONSE' . $responseStatusCode): $responseMessage], $responseStatusCode);
    }
}

