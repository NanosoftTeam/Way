<?php

namespace App\Http\Controllers;

use App\Models\Change;
use App\Models\Note;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $notes_all = Note::where('user_id', Auth::id())->orderBy('name')->get();

        /*$if_date = $request['date'];
        $if_film = $request['film'];
        $if_status = $request['status'];
        $if_user = $request['user'];*/
        $if_parent = $request['parent'];
        $if_only_projects = $request['projects'];
        $if_search = $request['search'];

        /*if($if_status == '0'){
            $if_status = 100;
        }*/

        if($if_parent == '0'){
            $if_parent = "x";
        }
        else{
            $if_only_projects = 0;
        }

        if(!isset($request['parent'])){
            $if_parent = "x";
        }

        /*if(!isset($request['status'])){
            $if_status = 200;
        }*/

        $notes = Note::where('user_id', Auth::id())->when($if_search, function ($query, $if_search) {
            return $query->where('name', 'like', '%'.$if_search.'%');
        })
        ->where('count_children', 0)
        //->groupBy('parent_id')
        ->get();
        //->paginate(18);
        //->appends(request()->query());


        $potrzebne_projekty = array();
        foreach ($notes as $n) {
            //if($t->count_children == 0 or $t->count_children == NULL){
                if($n->parent_id != NULL){

                    array_push($potrzebne_projekty, $n->parent_id);
                    $chwil = $notes_all->where("id", $n->parent_id);
                    $chwil = $chwil->first();

                    while($chwil->parent_id != NULL){
                        array_push($potrzebne_projekty, $chwil->parent_id);
                        $chwil = $notes_all->where("id", $chwil->parent_id);
                        $chwil = $chwil->first();


                    }
                }

            //}
        }

        $notes = Note::where('user_id', Auth::id())->when($if_search, function ($query, $if_search) {
            return $query->where('name', 'like', '%'.$if_search.'%');
        })
        ->when($if_only_projects, function ($query, $if_only_projects) {
            if($if_only_projects == 1){
                return $query->where('count_children', '!=', 0);
            }
        })
        //TO DO: CZY NA PEWNO OK->where('count_children', 0)
        ->when($if_parent, function ($query, $if_parent) use ($potrzebne_projekty) {
            if($if_parent == 'x'){
                return $query->where('parent_id', NULL)->orWhere(function($query2) use ($potrzebne_projekty){
                    $query2->whereIn('id', $potrzebne_projekty)
                        ->where('parent_id', NULL);
                });
            }
            else if($if_parent == 'i'){

            }
            else{
                return $query->where('parent_id', $if_parent)->orWhere(function($query2) use ($potrzebne_projekty, $if_parent){
                    $query2->whereIn('id', $potrzebne_projekty)
                        ->where('parent_id', $if_parent);
                });
            }
        })
        ->orderBy('name')
        //->groupBy('parent_id')
        //->get();
        ->paginate(18)
        ->appends(request()->query());

        //$notes2 = note::whereIn('id', $potrzebne_projekty)->get();

        //$notes = $notes2->merge($notes); toooooooooo

        /*foreach ($notes as $t) {
            if($t->count_children != 0 or $t->count_children != NULL){
                if(in_array($t->id, $potrzebne_projekty)){

                }
                else{
                    $t->name = "do us";
                }

            }
        }*/


        if($if_parent == 'x'){
            /*$notes = Arr::where($notes, function ($value, $key) {
                return $value['parent_id'] == NULL;
            });*/

            //$notes = $notes->where('parent_id', NULL);
            //$notes->all();
        }
        else{
            //$notes = $notes->where('parent_id', $if_parent);
           // $notes->all();
        }


        /*$notes = $notes->when($if_parent, function ($query, $if_parent) {
            if($if_parent == 'x'){
                return $query->where('parent_id', NULL);
            }
            else if($if_parent == 'i'){

            }
            else{
                return $query->where('parent_id', $if_parent);
            }
        });*/

        //$notes_g = $notes->groupBy('parent_id');
        if ($request->ajax()) {


            //return $notes_g;
            return view('notes.load', ['notes' => $notes, 'parent' => $if_parent])->render();
        }

        return view('notes.index', [
            'notes' => $notes,
            'notes_all' => $notes_all,
            'parent' => $if_parent,
            'potrzebne_projekty' => $potrzebne_projekty,
        ]);
    }

    public function auto_complete(Request $request) {
        $data = $request->all();

        $query = $data['query'];

        $filter_data = Note::select(['name', 'id'])
                        ->where('user_id', Auth::id())
                        ->where('name', 'LIKE', '%'.$query.'%')
                        ->take(8)
                        ->get();

        return response()->json($filter_data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(isset($request->addmany) and $request->addmany){
            $text = $request->content;
            $separator = "\r\n";

            $note2 = Note::find($request->parent_id);

            $line = strtok($text, $separator);

            /*$note1 = new Note();
            $note1->name = $line;
            $note1->parent_id = $request->parent_id;
            $note1->content = "";
            $note2->count_children += 1;
            $note1->save();*/
            //$do_usuniecia = $line;



            while ($line !== false) {

                $note1 = new Note();
                $note1->user_id = Auth::id();
                $note1->name = $line;
                $note1->parent_id = $request->parent_id;
                $note1->content = "";
                $note2->count_children += 1;
                $note1->save();

                $line = strtok( $separator );
            }

            $note2->save();

            Change::create([
                'name' => "[Wiele notatek]",
                'user_id' => Auth::id(),
                'action' => 0,
                'model' => 4,
            ]);
            return redirect(route('notes.index'));

        }
        else{
            $note = new Note($request->all());
            $note->user_id = Auth::id();
            if($request->content == NULL){
                $note->content = "";
            }

            if($request->name3 == "" or $request->name3 == NULL){
                $note->parent_id = NULL;
                $request->parent_id = NULL;
            }

            $note->save();

            if($request->parent_id != NULL){
            $note2 = Note::find($request->parent_id);
            $note2->count_children += 1;
            $note2->save();
            }



            Change::create([
                'name' => $request->name,
                'user_id' => Auth::id(),
                'action' => 0,
                'model' => 4,
            ]);
            return redirect(route('notes.index'));
        }

    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function show(Note $note, Request $request)
    {
        $notes_all = Note::where('user_id', Auth::id())->orderBy('name')->get();
        $note->content = Str::markdown($note->content);

        if ($request->ajax()) {
            return view('notes.show-load', [
                'note' => $note,
            ]);
        }

        return view('notes.show', [
            'note' => $note,
            'notes_all' => $notes_all
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function show2(Note $note)
    {
        $note->content = Str::markdown($note->content);
        return view('notes.show2', [
            'note' => $note,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $note = Note::find($id);
        $note->parent_name = "";
        if($note->parent_id != NULL){
            $note->parent_name = Note::find($note->parent_id)->name;
        }

        return $note;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Note $note)
    {
        $parent_id = $note->parent_id;

        if($request->name3 == "" or $request->name3 == NULL){
            $request->parent_id = NULL;
            $note->fill($request->all());
            $note->parent_id = NULL;
        }
        else{
            $note->fill($request->all());
        }


        if($request->content == NULL){
            $note->content = "";
        }

        $note->user_id = Auth::id();
        $note->save();



        if($request->parent_id != $parent_id){
            if($parent_id != NULL){
                $note2 = Note::find($parent_id);
                $note2->count_children -= 1;
                $note2->save();
            }

            if($note->parent_id != NULL){
                $note3 = $note->parent;
                $note3->count_children += 1;
                $note3->save();
            }

        }



        Change::create([
            'name' => $request->name,
            'user_id' => Auth::id(),
            'action' => 1,
            'model' => 4,
        ]);
        return redirect(route('notes.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function destroy(Note $note)
    {
        DB::table('notes')->where('parent_id', $note->id)->delete();


        if($note->parent_id != NULL){
            $note2 = Note::find($note->parent_id);
            $note2->count_children -= 1;
            $note2->save();
        }
        $note->delete();


        Change::create([
            'name' => $note->name,
            'user_id' => Auth::id(),
            'action' => 2,
            'model' => 4,
        ]);

        return response()->json([
            'status' => 'success'
        ]);
    }
}
