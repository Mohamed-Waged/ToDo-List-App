<?php

namespace App\Http\Controllers\Api;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::paginate(10);
        return response()->json($tasks);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'unique:tasks', 'min:3', 'max:255'],
            'description' => ['nullable', 'max:500'],
            'status' => ['required', 'in:pending,completed'],
            'category_id' => ['required', 'exists:categories,id'],
        ]);

        $data['user_id'] = 1;
        // $data['user_id'] = auth()->id();
        $task = Task::create($data);

        return response()->json(['task'=> $task , 'messsage'=>'Task Added Successfully']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        return response()->json($task);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $data = $request->validate([
            'title' => ['required','min:3','max:255', 'unique:tasks,title,'.$task->id],
            'description' => ['nullable','max:500'],
            'status' => ['required','in:pending,completed'],
            'category_id' => ['required', 'exists:categories,id'],
        ]);

        $task->update($data);
        return response()->json(['task'=> $task , 'messsage'=>'Task Updated Successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return response()->json(['success'=> true , 'messsage'=>'Task Deleted Successfully']);
    }

    public function restore(Task $task)
    {
        $task->restore();
        return response()->json(['success'=> true , 'messsage'=>'Task Restored Successfully']);
    }
}
