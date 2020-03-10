<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class TasksController extends Controller {
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $tasks = Task::orderBy('due_date', 'asc')->paginate(6);

        return view('tasks.index')->with('tasks', $tasks);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //Validate The Data
        $this->validate($request, [
            'name' => 'required|string|max:225|min:3',
            'description' => 'required|string|max:10000|min:10',
            'due_date' => 'required|date',
        ]);

        //Create a new task
        $task = new \App\Models\Task;
        //Assign the Task data  from our request
        $task->name = $request->name;
        $task->description = $request->description;
        $task->due_date = $request->due_date;
        $task->user_id = Auth::id();
        //save the task
        $task->save();

        //flash session message with success
        Session::flash('success', 'Created task successfully');

        //return a redirect
        return redirect()->route('task.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //search the task with id
        //return a view (show.blade.php)
        //pass with the return the variable that contains the specific task
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $task = Task::find($id);
        $task->dueDateFormatting = false;

        return view('tasks.edit')->withTask($task);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //Validate The Data
        $this->validate($request, [
            'name' => 'required|string|max:225|min:3',
            'description' => 'required|string|max:10000|min:10',
            'due_date' => 'required|date'
        ]);

        //Find the related task
        $task = Task::find($id);

        //Assign the Task data  from our request
        $task->name = $request->name;
        $task->description = $request->description;
        $task->due_date = $request->due_date;

        //save the task
        $task->save();

        //flash session message with success
        Session::flash('success', 'Saved the task successfully');

        //return a redirect
        return redirect()->route('task.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //finding the specific task by id
        $task = Task::find($id);
        //deleting the task
        $task->delete();
        //flashing a session message
        Session::flash('success', 'Deleted the task successfully');
        //returning a redirect back to index
        return redirect()->route('task.index');
    }
    
}
