<?php

namespace App\Http\Controllers;

use App\Models\Important;
use Illuminate\Http\Request;

use Auth;
use Session;

/**
 * Class ImportantController
 * @package App\Http\Controllers
 */
class ImportantController extends Controller
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
        $importants = Important::when($actual_user_team, function ($query, $actual_user_team) {
            if($actual_user_team == 'x'){
                return $query->where('user_id', Auth::id());
            }
            else{
                return $query->where('team_id', $actual_user_team);
            }
        })->paginate();

        return view('important.index', compact('importants'))
            ->with('i', (request()->input('page', 1) - 1) * $importants->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $important = new Important();
        $team_name = "";
        if(Session::get('team_id') != 0){
            $team_name = Auth::user()->team->name;
        }
        return view('important.create', compact(['important','team_name']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Important::$rules);

        if(Session::get('team_id') != 0){
            $request['team_id'] = Session::get('team_id');
        }
        else{
            $request['user_id'] = Auth::id();
        }

        $important = Important::create($request->all());

        if($request->url == NULL or $request->url = ""){
            $important->url = route('importants.show', $important->id);
            $important->save();
        }

        return redirect()->route('importants.index')
            ->with('success', 'Important created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $important = Important::find($id);

        return view('important.show', compact('important'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $important = Important::find($id);
        $team_name = "";
        if(Session::get('team_id') != 0){
            $team_name = Auth::user()->team->name;
        }

        return view('important.edit', compact(['important','team_name']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Important $important
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Important $important)
    {
        request()->validate(Important::$rules);

        if($request['is_planned'] == NULL){
            $request['is_planned'] = 0;
        }


        $important->update($request->all());

        if($request->url == NULL or $request->url = ""){
            $important->url = route('importants.show', $important->id);
            $important->save();
        }

        return redirect()->route('importants.index')
            ->with('success', 'Important updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $important = Important::find($id)->delete();

        return redirect()->route('importants.index')
            ->with('success', 'Important deleted successfully');
    }
}
