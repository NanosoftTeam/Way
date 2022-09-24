<?php

namespace App\Http\Controllers;

use App\Models\Goal;
use App\Models\Deadline;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

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
        $goals = Goal::orderBy('priority', "asc")->paginate();

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
        $deadlines = Deadline::orderBy("date", "ASC")->orderBy("priority", "ASC")->pluck('name', 'id');
        return view('goal.create', ['goal' => $goal, 'deadlines' => $deadlines]);
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
        $deadlines = Deadline::orderBy("date", "DESC")->orderBy("priority", "ASC")->pluck('name', 'id');

        return view('goal.edit', ['goal' => $goal, 'deadlines' => $deadlines]);
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
