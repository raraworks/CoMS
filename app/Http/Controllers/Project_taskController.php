<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Project_task;

class Project_taskController extends Controller
{
  public function store(Request $request)
  {
    if ($request->ajax()) {
      //validate form data
      $validator = Validator::make($request->all(), [
        "task_name"=>'required|max:255'
      ])->validate();
      $task = new Project_task;
      $task->task_name = $request->task_name;
      $task->due_date = date('Y-m-d', strtotime($request->due_date));
      $task->due_time = date('H:i:s', strtotime($request->due_time));
      $task->content = $request->content;
      $task->project_id = $request->project;
      $task->save();
      $partialView = view('projects.ajaxviews.addtask')->with('task', $task)->render();
      return response()->json($partialView);
    }
  }
  public function destroy(Request $request)
  {
    if ($request->ajax()) {
      $taskToDelete = Project_task::findOrFail($request->task_id);
      $taskToDelete->delete();
      return;
    }
  }
}
