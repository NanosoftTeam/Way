<?php

namespace App\Http\Controllers;

use App\Models\Deadline;
use Illuminate\Http\Request;

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
        $deadlines = Deadline::orderBy("date", "ASC")->orderBy("priority", "ASC")->paginate();

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
        $deadline = new Deadline();
        return view('deadline.create', compact('deadline'));
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
        $deadline = Deadline::find($id);

        return view('deadline.edit', compact('deadline'));
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
