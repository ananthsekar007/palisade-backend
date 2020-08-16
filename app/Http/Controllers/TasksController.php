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
        $tasks = Tasks::where(['user_id' =>  $userId, 'isCompleted' => 0, 'isArchieved' => 0])->get();
        $message = Config::get('response_messages.TASK_LISTED');
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

        $validator = Validator::make($request->all(), [
            "title" => "required|string",
            "description" => "required|string",
        ]);
        if (!$validator->fails()) {
            $tasks = $request->all();
            $tasks['user_id'] =  Auth::guard('api')->user()->user_id;
            Tasks::create($tasks);
            $message = Config::get('response_messages.TASK_CREATED');
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), []);
        if (!$validator->fails()) {
            $userId = Auth::guard('api')->user()->user_id;
            $tasks = Tasks::where(['task_id' => $id, 'user_id' => $userId])->first();
            if ($tasks != null) {
                $tasks->title = empty($request->title) ? $tasks->title : $request->title;
                $tasks->description = empty($request->description) ? $tasks->description : $request->description;
                $tasks->isCompleted = $request->isCompleted == $tasks->isCompleted ? $tasks->isCompleted : $request->isCompleted;
                $tasks->isArchieved =  $request->isArchieved == $tasks->isArchieved ? $tasks->isArchieved : $request->isArchieved;
                $tasks->save();
                $message = Config::get('response_messages.TASK_UPDATED');
                return ResponseController::Response200($message);
            } else {
                $message = Config::get('response_messages.NO_TASK_FOUND');
                return ResponseController::Error422($message, []);
            }
        } else {
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
        $task = Tasks::where(['task_id' => $id, 'user_id' => $userId])->first();
        if ($task != null) {
            $task->delete();
            $message = Config::get('response_messages.TASK_DELETED');
            return ResponseController::Response200($message);
        } else {
            $message = Config::get('response_messages.NO_TASK_FOUND');
            return ResponseController::Error422($message);
        }
    }
}
