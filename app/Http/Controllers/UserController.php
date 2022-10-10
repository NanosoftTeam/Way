<?php

namespace App\Http\Controllers;

use App\Models\Change;
use App\Models\User;
use App\Models\Team;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $users = User::paginate(18);

        return view('users.index', compact('users'));
    }

    public function apiPostLogin(): string
    {
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            $user = Auth::user();
            return response()->json(['user' => $user, 'success' => true], 200);
        } else {
            return response()->json(['error' => 'Unauthorised', 'success' => false], 401);
        }
    }

    public function apiGetUser(): string
    {
        //$user = Auth::user();
        //return response()->json(['user' => $user, 'success' => true], 200);

        //get all users
        $users = User::all();
        return response()->json(['users' => $users, 'success' => true], 200);
    }

    public function apiGetTasks(): string
    {
        $user = Auth::user();
        return response()->json(['tasks' => $user->tasks, 'success' => true], 200);
    }

    public function apiPostCreateUser(): string
    {
        $postUsername = $_POST['username'];
        $postEmail = $_POST['email'];
        $postPassword = $_POST['password'];
        User::create([
            'name' => $postUsername,
            'email' => $postEmail,
            'password' => Hash::make($postPassword),
        ]);
        return response()->json(['success' => true], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $data)
    {
        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        Change::create([
            'name' => $data['name'],
            'user_id' => Auth::id(),
            'action' => 0,
            'model' => 3,
        ]);

        return redirect(route('users.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $team = Team::where('id', Auth::user()->team_id)->first();
        return view('users.show', [
            'user' => $user,
            'team' => $team
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $teams = Team::all();
        return view('users.edit', [
            'user' => $user,
            'teams' => $teams,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user->fill($request->all());
        $user->save();
        Change::create([
            'name' => $request->name,
            'user_id' => Auth::id(),
            'action' => 1,
            'model' => 3,
        ]);
        return redirect(route('users.index'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_pass(Request $request, User $user)
    {
        $user->password = Hash::make($request['password']);
        $user->save();
        return redirect(route('users.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        Change::create([
            'name' => $user->name,
            'user_id' => Auth::id(),
            'action' => 2,
            'model' => 3,
        ]);

        return response()->json([
            'status' => 'success'
        ]);
    }
}
