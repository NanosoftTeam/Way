<?php

namespace App\Http\Controllers;

use App\Models\Deadline;
use App\Models\Goal;
use Illuminate\Http\Request;

use Auth;
use Session;

/**
 * Class GoalController
 * @package App\Http\Controllers
 */
class GoalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $actual_user_team = Session::get('team_id');
        if($actual_user_team == 0){
            $actual_user_team = 'x';
        }

        $goals = Goal::when($actual_user_team, function ($query, $actual_user_team) {
            if($actual_user_team == 'x'){
                return $query->where('user_id', Auth::id());
            }
            else{
                return $query->where('team_id', $actual_user_team);
            }
        })->orderBy('priority', "asc")->paginate();

        return view('goal.index', compact('goals'))
            ->with('i', (request()->input('page', 1) - 1) * $goals->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $goal = new Goal();
        $deadlines = Deadline::where('user_id', Auth::id())->orderBy("date", "ASC")->orderBy("priority", "ASC")->pluck('name', 'id');
        $team_name = "";
        if(Session::get('team_id') != 0){
            $team_name = Auth::user()->team->name;
        }
        return view('goal.create', ['goal' => $goal, 'deadlines' => $deadlines, 'team_name' => $team_name]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Goal::$rules);

        if(Session::get('team_id') != 0){
            $request['team_id'] = Session::get('team_id');
        }
        else{
            $request['user_id'] = Auth::id();
        }

        $goal = Goal::create($request->all());

        return redirect()->route('goals.index')
            ->with('success', 'Goal created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $goal = Goal::find($id);

        return view('goal.show', compact('goal'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $goal = Goal::find($id);
        $deadlines = Deadline::where('user_id', Auth::id())->orderBy("date", "DESC")->orderBy("priority", "ASC")->pluck('name', 'id');
        $team_name = "";
        if(Session::get('team_id') != 0){
            $team_name = Auth::user()->team->name;
        }

        return view('goal.edit', ['goal' => $goal, 'deadlines' => $deadlines, 'team_name' => $team_name]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Goal $goal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Goal $goal)
    {
        request()->validate(Goal::$rules);


        $goal->update($request->all());

        return redirect()->route('goals.index')
            ->with('success', 'Goal updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $goal = Goal::find($id)->delete();

        return response()->json([
            'status' => 'success'
        ]);
    }
}
