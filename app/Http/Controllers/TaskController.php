<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Category;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index','show']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::paginate(10);
        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('tasks.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'unique:tasks', 'min:3' , 'max:255'],
            'description' => ['nullable','max:500'],
            'status' => ['required','in:pending,completed'],
            'category_id' => ['required', 'exists:categories,id'],
        ]);
        
        $data['user_id'] = auth()->id();
        Task::create($data);

        return redirect()->route('tasks.index')->with('message',"Task Added successfully");
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        $categories = Category::all();
        return view('tasks.edit', compact('task','categories'));
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

        return redirect()->route('tasks.index')->with('message',"Task updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        // Using SoftDelete
        $task->delete();
        return redirect()->route('tasks.index')->with('message',"Task Deleted successfully");
    }

    // Archaivt Task
    public function archiveTask()
    {
        $tasks = Task::onlyTrashed()->get();
        return view('tasks.archive', compact('tasks'));
    }

    // Restore Archaivt Task
    public function restoreTask($id)
    {
        Task::withTrashed()->where('id', $id)->restore();
        return redirect()->route('archiveTask')->with('message','Task Restore successfully');
    }

    // Delete Task
    public function deleteTask($id)
    {
        // Using ForcetDelete
        $task = Task::withTrashed()->where('id',$id)->first();
        $task->forceDelete();
        return redirect()->route('archiveTask')->with('message','Task Deleted successfully');
    }
}
