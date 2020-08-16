<?php

namespace App\Http\Controllers;

use App\Tasks;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userId = Auth::guard('api')->user()->user_id;
        $tasks = Tasks::where('user_id', $userId)->get();
        $message= Config::get('response_messages.TASK_LISTED');
        return ResponseController::Response200($message, $tasks);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $tasks = Tasks::where('task_id', $id)->where('user_id', $userId)->first();
        if ($tasks != null) {
            $message = Config::get('response_messages.TASK_LISTED');
            return ResponseController::Response200($message, $tasks);
        } else {
            $message = Config::get('response_messages.NO_TASK_FOUND');
            return ResponseController::Error422($message);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
