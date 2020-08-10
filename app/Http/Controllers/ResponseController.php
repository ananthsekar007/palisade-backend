<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class ResponseController extends Controller
{
    public static function Response200($message, $data = null)
    {
        $responseJsonData = array();
        $responseJsonData['status'] = Config::get('constants.response.SUCCESS');
        if ($message) {
            $responseJsonData['message'] = $message;
        }
        if ($data) {
            $responseJsonData['data'] = $data;
        }
        return response()->json($responseJsonData, 200);
    }

    public static function Error422($message, $data = null)
    {
        $responseJsonData = array();
        $responseJsonData['status'] = Config::get('constants.response.ERROR');
        if ($message) {
            $responseJsonData['message'] = $message;
        }
        if ($data) {
            $responseJsonData['data'] = $data;
        }
        return response()->json($responseJsonData, 422);
    }
}
