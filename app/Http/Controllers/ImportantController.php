<?php

namespace App\Http\Controllers;

use App\Models\Important;
use Illuminate\Http\Request;

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
        $importants = Important::paginate();

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
        return view('important.create', compact('important'));
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

        return view('important.edit', compact('important'));
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
