<?php

namespace App\Http\Controllers;

use App\Models\Clothes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Class ClothesController
 * @package App\Http\Controllers
 */
class ClothesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clothes = Clothes::orderBy("id", "ASC")->paginate();

        return view('clothes.index', compact('clothes'))
            ->with('i', (request()->input('page', 1) - 1) * $clothes->perPage());
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index2(Request $request)
    {
        $if_id = $request["id"];
        $if_type = $request["type"];
        $if_subtype = $request["subtype"];
        $if_status = $request["status"];
        $if_place = $request["place"];
        $if_notes = $request["notes"];

        if(isset($request["id"])){
            $clothes = Clothes::where('id', 'like', '%'.$if_id.'%')
            ->where('type', 'like', '%'.$if_type.'%')
            ->where('subtype', 'like', '%'.$if_subtype.'%')
            ->where('status', 'like', '%'.$if_status.'%')
            ->where('place', 'like', '%'.$if_place.'%')
            ->where('notes', 'like', '%'.$if_notes.'%')
            ->orderBy("id", "ASC")->paginate();
        }
        else{
            $clothes = Clothes::orderBy("id", "ASC")->paginate();
        }


        return view('clothes.index2', compact(['clothes', 'if_status']))
            ->with('i', (request()->input('page', 1) - 1) * $clothes->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clothes = new Clothes();
        return view('clothes.create', compact('clothes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Clothes::$rules);

        $clothes = Clothes::create($request->all());
        $clothes->last_status_changed = date('Y-m-d H:i:s');
        $clothes->save();

        return redirect()->route('clothes.index')
            ->with('success', 'Utworzono nowe ubranie O ID: '.$clothes->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $clothes = Clothes::find($id);

        return view('clothes.show', compact('clothes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $clothes = Clothes::find($id);

        return view('clothes.edit', compact('clothes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Clothes $clothes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Clothes $clothes)
    {
        request()->validate(Clothes::$rules);

        if($clothes->status != $request->status){
            $clothes->last_status_changed = date('Y-m-d H:i:s');
            $clothes->save();
        }

        $clothes->update($request->all());



        return redirect()->route('clothes.index')
            ->with('success', 'Clothes updated successfully');
    }

    public function update2(Request $request){

        $clothes = $request->get('clothes');

        if(isset($clothes)){
            foreach ($clothes as $id => $c) {
                if(isset($c['status'])){
                    if(Clothes::find($id)->status != $c['status']){
                        DB::table('clothes')
                            ->where('id', $id)
                            ->update([
                                'status' => $c['status'],
                                'last_status_changed' => date('Y-m-d H:i:s')
                            ]);
                    }
                    else{

                    }


                }

            }
        }

        return redirect()->route('clothes.index2')
            ->with('success', 'Clothes updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $clothes = Clothes::find($id)->delete();

        return redirect()->route('clothes.index')
            ->with('success', 'Clothes deleted successfully');
    }
}
