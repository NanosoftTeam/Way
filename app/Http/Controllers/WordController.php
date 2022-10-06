<?php

namespace App\Http\Controllers;

use App\Models\Word;
use App\Models\Wordlist;
use Illuminate\Http\Request;

use Auth;

class WordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Wordlist $wordlist)
    {
        $word = new Word();
        return view('word.create', compact(['wordlist', 'word']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Wordlist $wordlist)
    {
        request()->validate(Word::$rules);

        $request['user_id'] = Auth::id();

        if(isset($request['mw']) and $request['mw'] == 'on'){
            $request['mw'] = true;
        }else{
            $request['mw'] = false;
        }

        if(isset($request['iw']) and $request['iw'] == 'on'){
            $request['iw'] = true;
        }else{
            $request['iw'] = false;
        }

        if(isset($request['mt']) and $request['mt'] == 'on'){
            $request['mt'] = true;
        }else{
            $request['mt'] = false;
        }

        $word = new Word($request->all());
        $word->wordlist_id = $wordlist->id;
        $word->save();

        return redirect()->route('wordlists.show2', [$wordlist->id, $word->id])
            ->with('success', 'Wordlist created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Word  $word
     * @return \Illuminate\Http\Response
     */
    public function show(Word $word)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Word $word)
    {

        return view('word.edit', compact('word'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Word  $word
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Word $word)
    {
        request()->validate(Word::$rules);

        $request['user_id'] = Auth::id();

        if(isset($request['mw']) and $request['mw'] == 'on'){
            $request['mw'] = true;
        }else{
            $request['mw'] = false;
        }

        if(isset($request['iw']) and $request['iw'] == 'on'){
            $request['iw'] = true;
        }else{
            $request['iw'] = false;
        }

        if(isset($request['mt']) and $request['mt'] == 'on'){
            $request['mt'] = true;
        }else{
            $request['mt'] = false;
        }
        
        $word->update($request->all());

        return redirect()->route('wordlists.show2', [$word->wordlist_id, $word->id])
            ->with('success', 'Wordlist updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Word  $word
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $wordlist = Word::find($id)->delete();

        return response()->json([
            'status' => 'success'
        ]);
    }
}
