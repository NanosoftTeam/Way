<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $messages = Message::where('user_to', Auth::id())->where('archived', 0)->where('parent_message_id', '!=', -2)->orderBy('created_at', 'desc')->paginate(18);

        return view('messages.index', compact('messages'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function files()
    {
        $messages = Message::where('file_path', '!=', 'admin_usuna')->where('file_path', '!=', '')->where('parent_message_id', '<=', 0)->orderBy('created_at', 'desc')->paginate(18);

        return view('messages.files', compact('messages'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function del_file(Message $message)
    {
        Storage::delete($message->file_path);
        $message->file_path = "admin_usuna";

        $message->save();

        $messages2 = Message::where("parent_message_id", $message->id)->get();

        foreach($messages2 as $m){
            $m->file_path = "admin_usuna";
            $m->save();
        }

        return redirect(route('messages.files'));

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index2()
    {
        $messages = Message::where('user_from', Auth::id())
        ->where(function($query) {
            $query->where('parent_message_id', 0)
                ->orWhere('parent_message_id', -2);
        })
        ->orderBy('created_at', 'desc')->paginate(18);

        return view('messages.index2', compact('messages'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index3()
    {
        $messages = Message::where('user_to', Auth::id())->where('archived', 1)->orderBy('created_at', 'desc')->paginate(18);

        return view('messages.index3', compact('messages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        return view('messages.create', [
            'users' => $users,
            'message_title' => "",
            'message_to' => 0,
            'message_to_name' => ""
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create2(Message $message)
    {
        $users = User::all();

        if($message->to == Auth::user()){
            return view('messages.re', [
                'users' => $users,
                'message' => $message
            ]);
        }

        return redirect(route('messages.index'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $data)
    {
        if(!is_null($data['title'])){
            $title = $data['title'];
        }
        else{
            $title = "Brak tematu";
        }

        $path = "";
        $name = "";
        if($data->hasFile('file')){
           $path = $data->file('file')->store('files');
            $name = $data->file->getClientOriginalName();
        }


        $message_id = Message::create([
            'title' => $title,
            'user_to' => $data['user_to'],
            'user_from' => Auth::id(),
            'content' => $data['content'],
            'isread' => 0,
            'archived' => 0,
            'parent_message_id' => 0,
            'file_path' => $path,
            'file_name' => $name
        ])->id;


        if($data['user_to'] == -1){
            $message3 = Message::find($message_id);
            $message3->parent_message_id = -2;
            $message3->save();

            $users2 = User::all();
            foreach ($users2 as $user2) {
                Message::create([
                    'title' => $title,
                    'user_to' => $user2->id,
                    'user_from' => Auth::id(),
                    'content' => $data['content'],
                    'isread' => 0,
                    'archived' => 0,
                    'parent_message_id' => $message_id,
                    'file_path' => $path,
                    'file_name' => $name
                ]);

                $user2->unread_messages += 1;
                $user2->save();
            }
        }
        else{
            $user = User::find($data['user_to']);
            $user->unread_messages += 1;
            $user->save();
        }


        return redirect(route('messages.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function download(Message $message)
    {
        return Storage::download($message->file_path, $message->file_name);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message)
    {
        $sent_view = true;
        $if_file = false;
        if($message->file_path != ''){
            $if_file = true;
        }

        if($message->parent_message_id != -2){
            if(Auth::id() == $message->to->id){
                $user = Auth::user();
                if($user->unread_messages > 0 and $message->isread == 0){
                    $user->unread_messages -= 1;
                    $user->save();
                }
                $message->isread = 1;
                $message->save();
                $sent_view = false;


            }
        }
        else{
            $messages2 = Message::where('parent_message_id', $message->id)->get();
            return view('messages.show', [
                'message' => $message,
                'sent_view' => $sent_view,
                'messages2' => $messages2,
                'if_file' => $if_file
            ]);
        }






        return view('messages.show', [
            'message' => $message,
            'sent_view' => $sent_view,
            'if_file' => $if_file
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        if($message->user_from == Auth::id()){
            $message->title = "[Wiadomość anulowana]";
            $message->content = "Wiadomość wycofana przez nadawcę.";

            Storage::delete($message->file_path);
            $message->file_path = "";
            $message->file_name = "";

            $message->save();

            $messages2 = Message::where("parent_message_id", $message->id)->get();

            foreach($messages2 as $m){
                $m->title = "[Wiadomość anulowana]";
                $m->content = "Wiadomość wycofana przez nadawcę.";
                $m->file_path = "";
                $m->file_name = "";
                $m->save();
            }

            return response()->json([
                'status' => 'success'
            ]);
        }


        return response()->json([
            'status' => 'err'
        ]);

    }

    /**
     * Unread the specified resource.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function unread(Message $message)
    {
        $message->isread = 0;
        $message->to->unread_messages += 1;
        $message->to->save();
        $message->save();

        return redirect(route('messages.index'));
    }

    /**
     * Unread the specified resource.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function archive(Message $message)
    {
        if($message->archived == 0){
            $message->archived = 1;
            $message->save();
        }
        else{
            $message->archived = 0;
            $message->save();
            return redirect(route('messages.index3'));
        }



        return redirect(route('messages.index'));
    }
}
