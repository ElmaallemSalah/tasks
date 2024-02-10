<?php

namespace App\Http\Controllers;

use App\Models\Task;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {


        $perPage = $request->input('perPage') === 'ALL' ? PHP_INT_MAX : ($request->input('perPage') ?? 20);
        $date_min = $request->input('date_min');
        $date_max = $request->input('date_max');
        if ($date_min!==null && $date_min!=='' &&$date_min!=="Invalid date" ) {
           
            $date_min = \Carbon\Carbon::parse($date_min)->format('Y-m-d');
        }
        if ($date_max!==null &&$date_max!==''&&$date_max!=="Invalid date") {
            $date_max = \Carbon\Carbon::parse($date_max)->format('Y-m-d');
        }



    


        $tasks = Task::query()
            ->select('id', 'title', 'description','completed', 'created_at')
            ->when($request->input('search'), function ($query, $search) {
                $query->where('title', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%');
                   
            })
            ->when($date_min, function ($query, $date_min) {
                $query->where('created_at', '>=', $date_min);
            })
            ->when($date_max, function ($query, $date_max) {
                $query->where('created_at', '<=', $date_max);
            })
            ->orderBy('id', 'desc')
            ->paginate($perPage)
            ->withQueryString();
            
 
          

        $search = $request->input('search');
        $perPage = $request->input('perPage');

        return inertia('Task/Index', compact('tasks', 'search', 'perPage', 'date_min', 'date_max'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Task/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|min:4|max:255|unique:tasks',
            'description' => 'required|string|max:255',
        
        ]);



        Task::create([
            'title' => $request->title,
            'description' => $request->description,
          
        ]);


        return redirect()->route('task.index')->with('status', ['type' => 'success', 'action' => 'Success', 'text' => 'Task created successfully!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        
        $task = Task::findOrFail($request->id);


        return inertia(
            'Task/Edit',
            compact('task')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)

    {
     
        $task = Task::findOrFail($request->id);
        $request->validate([
            'title' => 'required|string|max:255|min:4|unique:tasks,title,' . $task->id,
            'description' => 'required|string|max:255',
  
        ]);

        // if there is logo image condition
    
        

        $task->title = $request->title;
        $task->description = $request->description;

        $task->save();

        return redirect()->route('task.index')->with('status', ['type' => 'success', 'action' => 'Success', 'text' => 'Task updated successfully!']);
    }
    public function tougleCompleted(Request $request)

    {

        $task = Task::findOrFail($request->id);
        $task->completed = !$task->completed;
        $task->save();

     
        

       

        $task->save();

       
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $id)
    {
        $task = Task::find($id->id);
        $task->delete();


       // return redirect()->route('task.index')->with('status', ['type' => 'success', 'action' => 'Success', 'text' => 'Task Delete Successfully!']);


        //  with('message', 'Blog Delete Successfully');
    }
}
