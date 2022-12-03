<?php

namespace App\Http\Controllers;

use App\Models\Wordlist;
use App\Models\Word;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Auth;


/**
 * Class WordlistController
 * @package App\Http\Controllers
 */
class WordlistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $wordlists = Wordlist::where('user_id', Auth::id())->paginate();

        return view('wordlist.index', compact('wordlists'))
            ->with('i', (request()->input('page', 1) - 1) * $wordlists->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $wordlist = new Wordlist();
        return view('wordlist.create', compact('wordlist'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Wordlist::$rules);

        $request["user_id"] = Auth::id();

        $wordlist = Wordlist::create($request->all());

        return redirect()->route('wordlists.index')
            ->with('success', 'Wordlist created successfully.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function import(Request $request, Wordlist $wordlist)
    {
        $rows = $request->import;
        $rows = explode("\n", $rows);
        // Define the array that will contain the columns names
        $columns = [];

        foreach($rows as $i => $row)
        {
            $row = explode("\t", $row);
            if((!isset($row[0]) and !isset($row[1])) or ($row[0] == "" and $row[1] == "")){
                continue;
            }
            if(!isset($row[2])){
                $row[2] = "";
            }
            if(!isset($row[3])){
                $row[3] = "";
            }
            if(!isset($row[4]) or $row[4] == ""){
                $row[4] = 0;
            }
            if(!isset($row[5]) or $row[5] == ""){
                $row[5] = 0;
            }
            if(!isset($row[6]) or $row[6] == ""){
                $row[6] = 0;
            }
            $row[6] = (int)$row[6];
            //$row[6] = 0;
            DB::table('words')
                        ->insert([
                            'name'  => str_replace(array("\r", "\n"), '', $row[0]), 
                            'translation' => str_replace(array("\r", "\n"), '', $row[1]),
                            'name_info' => str_replace(array("\r", "\n"), '', $row[2]),
                            'translation_info' => str_replace(array("\r", "\n"), '', $row[3]),
                            'mw' => str_replace(array("\r", "\n"), '', $row[4]),
                            'iw' => str_replace(array("\r", "\n"), '', $row[5]),
                            'mt' => str_replace(array("\r", "\n"), '', $row[6]),
                            'wordlist_id' => $wordlist->id,
                        ]);
        }

        return redirect()->route('wordlists.show', $wordlist->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $wordlist = Wordlist::find($id);

        return view('wordlist.show', compact('wordlist'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function export(Wordlist $wordlist)
    {
        return view('wordlist.export', compact('wordlist'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function export2(Wordlist $wordlist)
    {
        return view('wordlist.export2', compact('wordlist'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show2(Wordlist $wordlist, $id)
    {

        return view('wordlist.show', compact('wordlist'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $wordlist = Wordlist::find($id);

        return view('wordlist.edit', compact('wordlist'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function learn($id)
    {
        $words = Word::where('user_id', Auth::id())->where('wordlist_id', $id)->orderBy('correct_answers')->take(10)->inRandomOrder()->get();
        $wordlist= Wordlist::find($id);

        return view('wordlist.learn', compact(['words', 'wordlist']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function learn2($id)
    {
        $words = Word::where('user_id', Auth::id())->where('wordlist_id', $id)->orderBy('last_correct_answer', 'desc')->take(10)->inRandomOrder()->get();
        $wordlist= Wordlist::find($id);

        return view('wordlist.learn', compact(['words', 'wordlist']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function learn3($id)
    {
        $words = Word::where('user_id', Auth::id())->where('wordlist_id', $id)->where('correct_answers', 0)->take(10)->inRandomOrder()->get();
        $wordlist= Wordlist::find($id);

        return view('wordlist.learn', compact(['words', 'wordlist']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function progress($id)
    {
        $words = Word::where('user_id', Auth::id())->where('wordlist_id', $id)->orderBy('correct_answers')->get();
        $wordlist= Wordlist::find($id);

        return view('wordlist.progress', compact(['words', 'wordlist']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Wordlist $wordlist
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Wordlist $wordlist)
    {
        request()->validate(Wordlist::$rules);

        $request['user_id'] = Auth::id();

        $wordlist->update($request->all());

        return redirect()->route('wordlists.index')
            ->with('success', 'Wordlist updated successfully');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Wordlist $wordlist
     * @return \Illuminate\Http\Response
     */
    public function learn_finish(Request $request, Wordlist $wordlist)
    {
        $words_output = $request->words_output;
        $words_id = $request->words_id;

        for ($i = 0; $i < count($words_id); $i++) {
            $word2 = Word::find($words_id[$i]);
            if($words_output[$i] != 0){
                $word2->last_correct_answer = date('Y-m-d');
                $word2->correct_answers += $words_output[$i];
                if($words_output[$i] <= 0){
                    $word2->correct_answers = $words_output[$i];
                }
                $word2->save();
            }

            if($word2->correct_answers < -10){
                $word2->correct_answers = -10;
            }
        }

        return response()->json([
            'status' => 'success',
            'test' => count($request->words_id),
        ]);
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $wordlist = Wordlist::find($id)->delete();

        return response()->json([
            'status' => 'success'
        ]);
    }
}
