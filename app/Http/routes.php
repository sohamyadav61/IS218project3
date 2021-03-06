<?php

use App\Task;
use Illuminate\Http\Request;

/**
 * Display All Tasks
 */
Route::get('/', function () {

    $task = Task::orderby('created_at', 'asc')->get;
    return view('tasks.blade.php', [
        'tasks' => $tasks,
    ]);

});

/**
 * Add A New Task
 */
Route::post('/task', function (Request $request) {
    $validator = Validator::make($request->all(), [
        'name' => 'required|max:255',
    ]);

    if ($validator->fails()) {
        return redirect('/')
            ->withInput()
            ->withErrors($validator);
    }

    $task = new Task;
    $task->name = $request ->name;
    $task-> save();
    dd($task);

});

/**
 * Delete An Existing Task
 */
Route::delete('/task/{task}', function (Task $task) {
    $task->delete();
    return redirect('/');
});