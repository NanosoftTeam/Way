<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Debt;
use Illuminate\Http\Request;

/**
 * Class DebtController
 * @package App\Http\Controllers
 */
class DebtController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $debts = Debt::where('status', '!=', 1)->orderBy("date", "DESC")->paginate();
        $debts_all_sum = Debt::where("status", "!=", 1)->sum('amount');

        return view('debt.index', compact(['debts', 'debts_all_sum']))
            ->with('i', (request()->input('page', 1) - 1) * $debts->perPage());
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index2()
    {
        $debts = Debt::orderBy("date", "DESC")->paginate();

        //$debts_all_sum = Debt::where("status", "!=", 1)->sum('amount');

        return view('debt.index2', compact(['debts']))
            ->with('i', (request()->input('page', 1) - 1) * $debts->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $debt = new Debt();
        $contacts = Contact::orderBy("name", "ASC")->pluck('name', 'id');
        return view('debt.create', ['debt' => $debt, 'contacts' => $contacts]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Debt::$rules);

        $debt = Debt::create($request->all());

        return redirect()->route('debts.index')
            ->with('success', 'Debt created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $debt = Debt::find($id);

        return view('debt.show', compact('debt'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $debt = Debt::find($id);
        $contacts = Contact::orderBy("name", "ASC")->pluck('name', 'id');

        return view('debt.edit', ['debt' => $debt, 'contacts' => $contacts]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Debt $debt
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Debt $debt)
    {
        request()->validate(Debt::$rules);

        $debt->update($request->all());

        return redirect()->route('debts.index')
            ->with('success', 'Debt updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $debt = Debt::find($id)->delete();

        return response()->json([
            'status' => 'success'
        ]);
    }
}
