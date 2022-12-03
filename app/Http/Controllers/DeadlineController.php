<?php

namespace App\Http\Controllers;

use App\Models\Deadline;
use App\Models\Team;
use App\Models\Goal;
use Illuminate\Http\Request;

use Auth;
use Session;

/**
 * Class DeadlineController
 * @package App\Http\Controllers
 */
class DeadlineController extends Controller
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
        
        $deadlines = Deadline::when($actual_user_team, function ($query, $actual_user_team) {
            if($actual_user_team == 'x'){
                return $query->where('user_id', Auth::id());
            }
            else{
                return $query->where('team_id', $actual_user_team);
            }
        })->orderBy("date", "ASC")->orderBy("priority", "ASC")->paginate();

        return view('deadline.index', compact('deadlines'))
            ->with('i', (request()->input('page', 1) - 1) * $deadlines->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $actual_user_team = Session::get('team_id');
        if($actual_user_team == 0){
            $actual_user_team = 'x';
        }
        $deadline = new Deadline();
        $team_name = "";
        $goals = Goal::when($actual_user_team, function ($query, $actual_user_team) {
            if($actual_user_team == 'x'){
                return $query->where('user_id', Auth::id());
            }
            else{
                return $query->where('team_id', $actual_user_team);
            }
        })->pluck('name', 'id');
        if(Session::get('team_id') != 0){
            $team_name = Auth::user()->team->name;
        }
        return view('deadline.create', compact(['deadline', 'team_name', 'goals']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Deadline::$rules);

        if($request['is_planned'] == NULL){
            $request['is_planned'] = 0;
        }

        if(Session::get('team_id') != 0){
            $request['team_id'] = Session::get('team_id');
        }
        else{
            $request['user_id'] = Auth::id();
        }

        $deadline = Deadline::create($request->all());

        return redirect()->route('deadlines.index')
            ->with('success', 'Deadline created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $deadline = Deadline::find($id);

        return view('deadline.show', compact('deadline'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $actual_user_team = Session::get('team_id');
        if($actual_user_team == 0){
            $actual_user_team = 'x';
        }
        $deadline = Deadline::find($id);
        $goals = Goal::when($actual_user_team, function ($query, $actual_user_team) {
            if($actual_user_team == 'x'){
                return $query->where('user_id', Auth::id());
            }
            else{
                return $query->where('team_id', $actual_user_team);
            }
        })->pluck('name', 'id');
        $team_name = "";
        if(Session::get('team_id') != 0){
            $team_name = Auth::user()->team->name;
        }

        return view('deadline.edit', compact(['deadline', 'team_name', 'goals']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Deadline $deadline
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Deadline $deadline)
    {
        request()->validate(Deadline::$rules);

        if($request['is_planned'] == NULL){
            $request['is_planned'] = 0;
        }


        $deadline->update($request->all());

        return redirect()->route('deadlines.index')
            ->with('success', 'Deadline updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $deadline = Deadline::find($id)->delete();

        return response()->json([
            'status' => 'success'
        ]);
    }
}
