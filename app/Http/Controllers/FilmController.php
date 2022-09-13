<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\Task;
use App\Models\Change;
use App\Models\User;
use App\Models\Course;
use App\Models\Deadline;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Exception;
use \Datetime;
use Auth;

class FilmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        
        $users = User::all();
        $courses = Course::orderBy('status', 'asc')->get();

        $if_date = $request['date'];
        $if_course = $request['course'];
        $if_status = $request['status'];
        $if_user = $request['user'];
        $if_channel = $request['channel'];

        if($if_status == '0'){
            $if_status = 100;
        }

        if($if_course == '0'){
            $if_course = "z";
        }

        if($if_channel == '0'){
            $if_channel = "z";
        }

        if(!isset($request['status'])){
            $if_status = 200;
        }


        $films = Film::when($if_date, function ($query, $if_date) {
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
        ->when($if_course, function ($query, $if_course) {
            if($if_course == "z"){
                return $query->where('course_id', 0);
            }
            else if($if_course != 'a'){
                return $query->where('course_id', $if_course);
            }   
        })
        ->when($if_status, function ($query, $if_status) {
            if($if_status == 200){
                return $query->where('status', '!=', 10);
            }
            else if($if_status == 'a'){
                return $query->where('status', '!=', 10);
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
        ->when($if_user, function ($query, $if_user) {
            if($if_user == 'a'){
                
            }
            else if($if_user == 'b'){
                return $query->where('person', NULL);
            }
            else{
                return $query->where('person', $if_user);
            }
        })
        ->when($if_channel, function ($query, $if_channel) {
            if($if_channel == "z"){
                return $query->where('channel', 0);
            }
            else if($if_channel != 'a'){
                return $query->where('channel', $if_channel);
            }   
        })
        ->orderBy('status', 'asc')->orderBy('end', 'asc')->paginate(18)->appends(request()->query());




        if ($request->ajax()) {
            return view('films.load', ['films' => $films])->render();  
        }

        return view('films.index', [
            'films' => $films,
            'users' => $users,
            'courses' => $courses,
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
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $film = new Film($request->all());
        $film->save();
        Change::create([
            'name' => $request->title,
            'user_id' => Auth::id(),
            'action' => 0,
            'model' => 0,
        ]);
        return redirect(route('films.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  Film  $film
     * @return View
     */
    public function show(Film $film, Request $request): View
    {
        $users = User::all();
        $courses = Course::orderBy('status', 'asc')->get();

        if($film->person != 0){
            $username = User::find($film->person)->name;
        }
        else{
            $username = "Infast Team";
        }

        if ($request->ajax()) {
            return view('films.show-load', [
                'film' => $film,
                'username' => $username,
                'users' => $users,
                'courses' => $courses,
                'tasks' => $film->tasks,
            ]);  
        }

        return view('films.show', [
            'film' => $film,
            'username' => $username,
            'users' => $users,
            'courses' => $courses,
            'tasks' => $film->tasks,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  Film  $film
     * @return View
     */
    public function show2(Film $film): View
    {
        if($film->person != 0){
            $username = User::find($film->person)->name;
        }
        else{
            $username = "Infast Team";
        }
        return view('films.show2', [
            'film' => $film,
            'tasks' => $film->tasks,
            'username' => $username,
        ]);
    }


    public function edit(Request $request, $id)
    {
        $film = Film::find($id);
        return $film;
        
    }

    public function plan_edit(Film $film)
    {
        $users = User::all();
        $courses = Course::orderBy('status', 'asc')->get();

        return view('films.plan.edit', [
            'film' => $film,
            'users' => $users,
            'courses' => $courses,
            'tasks' => $film->tasks
        ]);
        
    }

    public function plan_update(Request $request, Film $film)
    {
        $film->fill($request->all());
        $film->save();


        $tasks = $request->get('tasks');
        $tasksn = $request->get('tasksn');
        $date = $request->date;

        if(isset($tasks)){
            foreach ($tasks as $id => $task) {
                if(isset($task['name'])){
                    if(isset($task['delete']) and $task['delete'] == true){
                        DB::table('tasks')->delete($id);
                    }
                    else{
                        DB::table('tasks')
                            ->where('id', $id)
                            ->update([
                                'name'  => $task['name'], 
                                'user_id' => $task['user_id'],
                                'status' => $task['status'],
                                'end' => $task['end']
                            ]); 
                    }
                
                }
                
            }
        } 

        if(isset($tasksn)){
            foreach ($tasksn as $id => $taskn) {
                if(isset($taskn['name'])){
                    if(isset($taskn['todo'])){
                        $t_status = 1;
                    }
                    else{
                        $t_status = 0;
                    }
                    DB::table('tasks')
                        ->insert([
                            'name'  => $taskn['name'], 
                            'user_id' => $taskn['user_id'],
                            'film_id' => $film->id,
                            'status' => $t_status,
                            'end' => $taskn['end']
                        ]);
                }
                
            
            }
        }

        DB::table('tasks')
            ->where('end', NULL)
            ->where('film_id', $film->id)
            ->where('status', '>', 0)
            ->where('status', '!=', 4)
            ->update([
                'end'  => $date, 
            ]);

        Change::create([
            'name' => "[planowanie] ".$film->title,
            'user_id' => Auth::id(),
            'action' => 1,
            'model' => 0,
        ]);
       
        switch ($request->input('action')) {
            case 'save1':
                return redirect(route('films.index'));
            break;
    
            case 'save2':
                return redirect(route('films.show', $film->id));
            break;
    
            case 'save3':
                return redirect(route('films.plan.calendar', $film->id));
            break;
        }
        
        
    }

    public function plan_calendar(Request $request, Film $film)
    {
        if($request->ajax())
    	{
    		$data = Task::where("film_id", $film->id)->where('status', '>', 0)->where('status', '!=', 4)->where('end', '!=', NULL)->get(['id', 'name', 'start', 'end']);

            
            foreach ($data as $element) {
                if($element->start == NULL or $element->start == ''){
                    $element->start = $element->end;
                }
                if($element->end != NULL and $element->end != ''){
                    $date1 = new DateTime($element->end);
                    $date1->modify('+1 day');

                    $element->end = $date1->format('Y-m-d');
                }
                $element->title = $element->name;
                
            }

            return response()->json($data);
    	}

        return view('films.plan.calendar', [
            'film' => $film
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Film  $film
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Film $film)
    {
        $film->fill($request->all());
        $film->save();
        Change::create([
            'name' => $request->title,
            'user_id' => Auth::id(),
            'action' => 1,
            'model' => 0,
        ]);
        return redirect(route('films.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Film  $film
     * @return \Illuminate\Http\Response
     */
    public function destroy(Film $film)
    {
        $film->delete();

        Change::create([
            'name' => $film->title,
            'user_id' => Auth::id(),
            'action' => 2,
            'model' => 0,
        ]);

        return response()->json([
            'status' => 'success'
        ]);
    }

    public function calendar(Request $request)
    {
        if($request->ajax())
    	{
    		$data = Deadline::where('date', '!=', NULL)->get(['id', 'name', 'priority', 'date', 'type', 'is_planned']);
            

            
            foreach ($data as $element) {
                if($element->is_planned == 0) {
                    $element->name = "❌ ".$element->name;
                }

                $element->start = $element->date;
                $element->end = $element->date;
                $element->title = $element->name;
                $element->id2 = $element->id;
                $element->id *= -1;
                $element->type2 = $element->type;
                $element->type = 1;
                if($element->end != NULL and $element->end != ''){
                    $date1 = new DateTime($element->end);
                    $date1->modify('+1 day');

                    $element->end = $date1->format('Y-m-d');
                }
                
                $colors = array("#e3342f", "#ff6600", "#ccb800", "#38c172",  "#868e96");
                $element->color = $colors[$element->priority];

                if($element->type2 == "Wyjazd"){
                    $element->rendering = 'background';
                    $element->color = "#ccb800";
                }

                

                unset($element->type2);
            }


            $data2 = Task::where('end', '!=', NULL)->where('status', '!=', 4)->get(['id', 'name', 'start', 'end', 'duration']);

            foreach ($data2 as $element) {
                $element->title = $element->name;
                $element->id2 = $element->id;
                $element->type = 2;
                //if($element->start == NULL or $element->start == ''){
                    $element->start = $element->end;
                //}
                if($element->end != NULL and $element->end != ''){
                    $date1 = new DateTime($element->end);
                    $date1->modify('+1 day');

                    $element->end = $date1->format('Y-m-d');
                }

                if($element->duration == NULL or $element->duration == 0){
                    $element->color = "#cccccc";
                    $element->textColor = "#000000";
                }
                else{
                    $element->color = "#ababab";
                }

                
                
            }

            //$data = array_merge($data2, $data);
            //$data = $data->merge($data2);
            //$data = $questions->toBase()->merge($answers);
            $data = $data->toBase()->merge($data2);



            return response()->json($data);
    	}
    	return view('films.calendar');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return JsonResponse
     */
    public function action(Request $request): JsonResponse
    {
    	if($request->ajax())
    	{
            $request->end = new DateTime($request->end);
            $request->end->modify('-1 day');
    		if($request->type == 'add')
    		{
    			$event = Task::create([
    				'name'		=>	$request->name,
                    'start' => $request->start,
                    'status' => 1,
    				'end'		=>	$request->end,
                    'priority'    =>  4
    			]);

    			return response()->json($event);
    		}

    		if($request->type == 'update')
    		{
                if($request->event_type == 1){
                    $event = Deadline::find($request->id)->update([
                        'name'		=>	$request->title,
                        'date'		=>	$request->start,
                    ]);

                }
                else{
                    $event = Task::find($request->id)->update([
                        'name'		=>	$request->title,
                        'start'		=>	$request->start,
                        'end'		=>	$request->end
                    ]);

                }
    			

    			return response()->json($event);
    		}

    		if($request->type == 'show')
    		{
                return redirect(route('deadlines.show', $request->id));
    		}
    	}
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return JsonResponse
     */
    public function plan_action(Request $request): JsonResponse
    {
    	if($request->ajax())
    	{
            $request->end = new DateTime($request->end);
            $request->end->modify('-1 day');
    		if($request->type == 'add')
    		{
    			$event = Task::create([
    				'name'		=>	$request->name,
    				'start'		=>	$request->start,
    				'end'		=>	$request->end,
                    'status'    =>  0
    			]);

                Change::create([
                    'name' => $request->name,
                    'user_id' => Auth::id(),
                    'action' => 0,
                    'model' => 2,
                ]);

    			return response()->json($event);
    		}

    		if($request->type == 'update')
    		{
    			$event = Task::find($request->id)->update([
    				'name'		=>	$request->name,
    				'start'		=>	$request->start,
    				'end'		=>	$request->end
    			]);

                Change::create([
                    'name' => $request->name,
                    'user_id' => Auth::id(),
                    'action' => 1,
                    'model' => 2,
                ]);

    			return response()->json($event);
    		}

            if($request->type == 'del-date')
    		{
    			$event = Task::find($request->id)->update([
    				'start'		=>	NULL,
    				'end'		=>	NULL
    			]);

                Change::create([
                    'name' => $request->name,
                    'user_id' => Auth::id(),
                    'action' => 1,
                    'model' => 2,
                ]);

    			return response()->json($event);
    		}

    		if($request->type == 'show')
    		{
                return redirect(route('films.show', $request->id));
    		}
    	}
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Film $film
     * @return View
     */
    public function tab_info(Film $film): View
    {
        if($film->person != 0){
            $username = User::find($film->person)->name;
        }
        else{
            $username = "Infast Team";
        }

        return view('films.tabs.info', [
            'film' => $film,
            'username' => $username
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Film $film
     * @return View
     */
    public function tab_tasks(Film $film): View
    {
        return view('films.tabs.tasks', [
            'tasks' => $film->tasks,
            'film' => $film
        ]);
    }
}
