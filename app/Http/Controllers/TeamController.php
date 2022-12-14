<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Session;
use Auth;

/**
 * Class TeamController
 * @package App\Http\Controllers
 */
class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teams = Team::paginate();
        //Session::put('team_id', Auth::user()->team_id);
        return view('team.index', compact('teams'))
            ->with('i', (request()->input('page', 1) - 1) * $teams->perPage());
    }

    public function index2()
    {
        $team = Auth::user()->team;
        $actual_team = 0;
        if(Session::get('team_id') == 0){
            $actual_team = 0;
        }
        else{
            $actual_team = Session::get('team_id');
        }
        return view('team.index2', compact(['team', 'actual_team']));
    }

    public function overflow()
    {
        $userTasks = Auth::user()->tasks;
        return view('team.overflow', compact('userTasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $team = new Team();
        return view('team.create', compact('team'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Team::$rules);

        $team = Team::create($request->all());

        return redirect()->route('teams.index')
            ->with('success', 'Team created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $team = Team::find($id);

        return view('team.show', compact('team'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $team = Team::find($id);

        return view('team.edit', compact('team'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Team $team
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Team $team)
    {
        request()->validate(Team::$rules);

        $team->update($request->all());

        return redirect()->route('teams.index')
            ->with('success', 'Team updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $team = Team::find($id)->delete();

        return response()->json([
            'status' => 'success'
        ]);
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function team_exit()
    {
        Session::put('team_id', 0);

        return redirect()->route('team.index2');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function team_enter()
    {
        Session::put('team_id', Auth::user()->team_id);

        return redirect()->route('team.index2');
    }
}
