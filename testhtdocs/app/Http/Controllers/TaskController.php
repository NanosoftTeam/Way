<?php

namespace App\Http\Controllers;

//use Illuminate\Support\Facades\Input;

use App\Models\Task;
use App\Models\User;
use App\Models\Deadline;
use App\Models\Goal;
use App\Models\Change;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Illuminate\Support\Facades\DB;
use Exception;
use Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::all();
        $deadlines = Deadline::orderBy("date", "ASC")->orderBy("priority", "ASC")->get();
        $tasks_all = Task::orderBy('end', 'desc')->orderBy('status', 'asc')->get();
        $goals = Goal::orderBy('priority', 'asc')->get();

        $if_date = $request['date'];
        $if_deadline = $request['deadline'];
        $if_status = $request['status'];
        $if_goal = $request['goal'];
        $if_parent = $request['parent'];
        $if_only_projects = $request['projects'];
        $if_search = $request['search'];

        if($if_status == '0'){
            $if_status = 100;
        }

        if($if_parent == '0'){
            $if_parent = "x"; 
        }
        else{
            $if_only_projects = 0;
        }

        if(!isset($request['parent'])){
            $if_parent = "x";
        }

        if(!isset($request['status'])){
            $if_status = 200;
        }

        $tasks = Task::when($if_search, function ($query, $if_search) {
            return $query->where('name', 'like', '%'.$if_search.'%');
        }) 
        ->when($if_date, function ($query, $if_date) {
            if($if_date == '1'){
                return $query->whereDate('end', '<=', date('Y-m-d'));
            }
            else if($if_date == '2'){
                return $query->where('end', NULL);
            }  
            else if($if_date == '3'){
                return $query->whereDate('end', '<', date('Y-m-d'));
            }  
        })
        ->when($if_deadline, function ($query, $if_deadline) {
            if($if_deadline == 'a'){
                
            }
            else if($if_deadline == 'b'){
                return $query->whereNull('deadline_id');
            }
            else{
                return $query->where('deadline_id', $if_deadline);
            }   
        })
        ->when($if_status, function ($query, $if_status) {
            if($if_status == 200){
                return $query->where('status', '!=', 4);
            }
            else if($if_status == 'a'){
                return $query->where('status', '!=', 4);
            } 
            else if($if_status == 'b'){
                
            }
            else if($if_status == 100){
                return $query->where('status', '=', 0);
            }
            else{
                return $query->where('status', '=', (int)$if_status);
            }
        })
        ->when($if_goal, function ($query, $if_goal) {
            if($if_goal == 'a'){
                
            }
            else if($if_goal == 'b'){
                return $query->where('goal_id', NULL);
            }
            else{
                return $query->where('goal_id', $if_goal);
            }
        }) 
        ->where('count_children', 0)
        //->groupBy('parent_id')
        ->get();
        //->paginate(18);
        //->appends(request()->query());


        $potrzebne_projekty = array();
        foreach ($tasks as $t) {
            //if($t->count_children == 0 or $t->count_children == NULL){
                if($t->parent_id != NULL){
                    
                    array_push($potrzebne_projekty, $t->parent_id);
                    $chwil = $tasks_all->where("id", $t->parent_id);
                    $chwil = $chwil->first();

                    while($chwil->parent_id != NULL){
                        array_push($potrzebne_projekty, $chwil->parent_id);
                        $chwil = $tasks_all->where("id", $chwil->parent_id);
                        $chwil = $chwil->first();
                        

                    }
                }
                
            //}
        }

        $tasks = Task::when($if_search, function ($query, $if_search) {
            return $query->where('name', 'like', '%'.$if_search.'%');
        }) 
        ->when($if_date, function ($query, $if_date) {
            if($if_date == '1'){
                return $query->whereDate('end', '<=', date('Y-m-d'));
            }
            else if($if_date == '2'){
                return $query->where('end', NULL);
            }  
            else if($if_date == '3'){
                return $query->whereDate('end', '<', date('Y-m-d'));
            }  
        })
        ->when($if_deadline, function ($query, $if_deadline) {
            if($if_deadline == 'a'){
                
            }
            else if($if_deadline == 'b'){
                return $query->whereNull('deadline_id');
            }
            else{
                return $query->where('deadline_id', $if_deadline);
            }  
        })
        ->when($if_status, function ($query, $if_status) {
            if($if_status == 200){
                return $query->where('status', '!=', 4);
            }
            else if($if_status == 'a'){
                return $query->where('status', '!=', 4);
            } 
            else if($if_status == 'b'){
                
            }
            else if($if_status == 100){
                return $query->where('status', '=', 0);
            }
            else{
                return $query->where('status', '=', (int)$if_status);
            }
        })
        ->when($if_goal, function ($query, $if_goal) {
            if($if_goal == 'a'){
                
            }
            else if($if_goal == 'b'){
                return $query->where('goal_id', NULL);
            }
            else{
                return $query->where('goal_id', $if_goal);
            }
        })
        ->when($if_only_projects, function ($query, $if_only_projects) {
            if($if_only_projects == 1){
                return $query->where('count_children', '!=', 0);
            }
        }) 
        //TO DO: CZY NA PEWNO OK->where('count_children', 0)
        ->when($if_parent, function ($query, $if_parent) use ($potrzebne_projekty) {
            if($if_parent == 'x'){
                return $query->where('parent_id', NULL)->orWhere(function($query2) use ($potrzebne_projekty){
                    $query2->whereIn('id', $potrzebne_projekty)
                        ->where('parent_id', NULL);
                });
            }
            else if($if_parent == 'i'){
                
            }
            else{
                return $query->where('parent_id', $if_parent)->orWhere(function($query2) use ($potrzebne_projekty, $if_parent){
                    $query2->whereIn('id', $potrzebne_projekty)
                        ->where('parent_id', $if_parent);
                });
            }
        })
        ->orderBy('end', 'desc')
        ->orderBy('status', 'asc')
        //->groupBy('parent_id')
        //->get();
        ->paginate(18)
        ->appends(request()->query());

        //$tasks2 = Task::whereIn('id', $potrzebne_projekty)->get();

        //$tasks = $tasks2->merge($tasks); toooooooooo

        /*foreach ($tasks as $t) {
            if($t->count_children != 0 or $t->count_children != NULL){
                if(in_array($t->id, $potrzebne_projekty)){

                }
                else{
                    $t->name = "do us";
                }
                
            }
        }*/


        if($if_parent == 'x'){
            /*$tasks = Arr::where($tasks, function ($value, $key) {
                return $value['parent_id'] == NULL;
            });*/

            //$tasks = $tasks->where('parent_id', NULL);
            //$tasks->all();
        }
        else{
            //$tasks = $tasks->where('parent_id', $if_parent);
           // $tasks->all();
        }


        /*$tasks = $tasks->when($if_parent, function ($query, $if_parent) {
            if($if_parent == 'x'){
                return $query->where('parent_id', NULL);
            }
            else if($if_parent == 'i'){
                
            }
            else{
                return $query->where('parent_id', $if_parent);
            }
        });*/

        //$tasks_g = $tasks->groupBy('parent_id');
        if ($request->ajax()) {
            

            //return $tasks_g;
            return view('tasks.load', ['tasks' => $tasks, 'parent' => $if_parent])->render();  
        }

        return view('tasks.index', [
            'tasks' => $tasks,
            'tasks_all' => $tasks_all,
            'users' => $users,
            'goals' => $goals,
            'deadlines' => $deadlines,
            'parent' => $if_parent,
            'potrzebne_projekty' => $potrzebne_projekty,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $task = new Task($request->all());
        $task->user_id = Auth::id();
        $task->save();

        if($request->parent_id != NULL){
           $task2 = Task::find($request->parent_id);
           $task2->count_children += 1;
           $task2->save(); 
        }
        
        Change::create([
            'name' => $request->name,
            'user_id' => Auth::id(),
            'action' => 0,
            'model' => 2,
        ]);
        return redirect(route('tasks.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task, Request $request)
    {
        $users = User::all();
        $goals = Goal::orderBy('priority', 'asc')->get();
        $deadlines = Deadline::orderBy("date", "DESC")->orderBy("priority", "ASC")->get();
        $tasks_all = Task::where('status', '!=', '4')->orderBy('end', 'asc')->orderBy('status', 'asc')->get();

        if ($request->ajax()) {
            return view('tasks.show-load', [
                'task' => $task,
                'users' => $users
            ]); 
        }

        return view('tasks.show', [
            'task' => $task,
            'users' => $users,
            'goals' => $goals,
            'deadlines' => $deadlines,
            'tasks_all' => $tasks_all
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit_date(Request $request)
    {
        $tasks = Task::where('end', '<', date('Y-m-d'))
            ->where('status', '!=', 4)
            ->get();
        $tasks_count = $tasks->count();
        return view('tasks.editdate', [
            'tasks_count' => $tasks_count
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show2(Task $task)
    {
        return view('tasks.show2', [
            'task' => $task,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $task = Task::find($id);
        return $task;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit2(Request $request, $id)
    {
        $task = Task::find($id);
        return view('tasks.edit2', [
            'task' => $task,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        

        $parent_id = $task->parent_id;

        $task->fill($request->all());
        $task->user_id = Auth::id();
        $task->save();

        if($request->parent_id != $parent_id){
            if($parent_id != NULL){
                $task2 = Task::find($parent_id);
                $task2->count_children -= 1;
                $task2->save();
            }
            
            if($task->parent_id != NULL){
                $task3 = $task->parent;
                $task3->count_children += 1;
                $task3->save();  
            }
           
        }
        
        Change::create([
            'name' => $request->name,
            'user_id' => Auth::id(),
            'action' => 1,
            'model' => 2,
        ]);
        return redirect(route('tasks.index'));
    }

/**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update2(Request $request, Task $task)
    {
        

        $parent_id = $task->parent_id;

        $task->fill($request->all());
        $task->user_id = Auth::id();
        $task->save();

        if($request->parent_id != $parent_id){
            if($parent_id != NULL){
                $task2 = Task::find($parent_id);
                $task2->count_children -= 1;
                $task2->save();
            }
            
            if($task->parent_id != NULL){
                $task3 = $task->parent;
                $task3->count_children += 1;
                $task3->save();  
            }
           
        }
        

        return view('tasks.x', [
            'task' => $task,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        if($task->parent_id != NULL){
            $task2 = Task::find($task->parent_id);
            $task2->count_children -= 1;
            $task2->save(); 
        }
        $task->delete();
        

        Change::create([
            'name' => $task->name,
            'user_id' => Auth::id(),
            'action' => 2,
            'model' => 2,
        ]);

        return response()->json([
            'status' => 'success'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function change_date(Request $request)
    {
        DB::table('tasks')
            ->where('end', '<', date('Y-m-d'))
            ->where('status', '!=', 4)
            ->update([
                'end' => $request['date']
            ]); 

        return redirect(route('tasks.index'));
    }
}
