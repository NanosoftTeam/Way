<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\Deadline;
use App\Models\Settings;
use App\Models\Task;
use App\Models\Change;
use App\Models\Important;
use App\Models\Lesson;

use \Datetime;
use Illuminate\Http\Request;
use Auth;
use Session;
use function PHPUnit\Framework\returnValue;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        $actual_user_team = Auth::user()->team_id;
        if(Session::get('team_id') == 0){
            $actual_user_team = 'x';
        }

        $date1 = date("Y-m-d");
        if(isset($_GET["date"])){
            $date1 = $_GET["date"];
            $tasks = Task::when($actual_user_team, function ($query, $actual_user_team) {
                if($actual_user_team == 'x'){
                    return $query->where('user_id', Auth::id())->where('team_id', NULL);
                }
                else{
                    return $query->where('team_id', $actual_user_team)->where('user_id', Auth::id());
                }
            })->where('status', "!=", 4)
                ->where('end', '!=', '')
                ->orderBy('duration', 'desc')
                ->where('end', $date1)
                ->get();
        }
        else{
            $tasks = Task::when($actual_user_team, function ($query, $actual_user_team) {
                if($actual_user_team == 'x'){
                    return $query->where('user_id', Auth::id())->where('team_id', NULL);
                }
                else{
                    return $query->where('team_id', $actual_user_team)->where('user_id', Auth::id());
                }
            })->where('status', "!=", 4)
                ->where('end', '!=', '')
                ->orderBy('duration', 'desc')
                ->where('end', '<=', $date1)
                ->get();

            $duration1 = Task::when($actual_user_team, function ($query, $actual_user_team) {
                if($actual_user_team == 'x'){
                    return $query->where('user_id', Auth::id())->where('team_id', NULL);
                }
                else{
                    return $query->where('team_id', $actual_user_team)->where('user_id', Auth::id());
                }
            })->where('status', 4)
                ->where('end', '!=', '')
                ->where('end', $date1)
                ->sum("duration");

            $duration2 = Task::when($actual_user_team, function ($query, $actual_user_team) {
                if($actual_user_team == 'x'){
                    return $query->where('user_id', Auth::id())->where('team_id', NULL);
                }
                else{
                    return $query->where('team_id', $actual_user_team)->where('user_id', Auth::id());
                }
            })->where('end', '!=', '')
                ->where('end', $date1)
                ->sum("duration");

        }

        $weekMap = [
            0 => 'Niedz',
            1 => 'Pon',
            2 => 'Wt',
            3 => 'Śr',
            4 => 'Cz',
            5 => 'Pt',
            6 => 'Sob',
        ];
        $dayOfTheWeek = \Carbon\Carbon::parse($date1)->dayOfWeek;
        $weekday = $weekMap[$dayOfTheWeek];

        //$films = Film::whereDate('updated_at', ">=", Auth::user()->news_from)->orderBy("updated_at", "desc")->get(['title', 'updated_at']);
        //$all_changes = Film::whereDate('updated_at', ">=", Auth::user()->news_from)->orderBy("updated_at", "desc")->unionAll($films)->get(['title', 'updated_at']);
        $changes = Change::where('created_at', ">=", Auth::user()->news_from)->where("user_id", "!=", Auth::id())->orderBy('created_at', 'desc')->get();
        $changes_count = count($changes);
        $post = Settings::find(2);
        $post_html = Settings::find(3);
        $post_js = Settings::find(4);
        $rutyna_rano = Settings::find(16);
        $rutyna_popoludnie = Settings::find(17);
        $rutyna_wieczor = Settings::find(18);
        $quote = Settings::find(19)->content;
        $date2 = new DateTime($date1);
        $date2->modify('+7 day');
        $date2 = $date2->format('Y-m-d');

        $jutro = new DateTime($date1);
        $jutro->modify('+1 day');
        $jutro = $jutro->format('Y-m-d');


        $deadlines = Deadline::when($actual_user_team, function ($query, $actual_user_team) {
            if($actual_user_team == 'x'){
                return $query->where('user_id', Auth::id());
            }
            else{
                return $query->where('team_id', $actual_user_team);
            }
        })->where('date', '<=', $date2)->orderBy('date', 'asc')->orderBy('priority', 'asc')->get();
        //$deadlines_tommorow = Deadline::where('user_id', Auth::id())->where('date', $date2)->orderBy('priority', 'asc')->get();
        $duration = $tasks->sum("duration");
        $lessons = Lesson::where('day', $dayOfTheWeek)->orderBy('lesson_number', 'asc')->get();

        $lesson0 = Settings::find(5);
        $lesson1 = Settings::find(6);
        $lesson2 = Settings::find(7);
        $lesson3 = Settings::find(8);
        $lesson4 = Settings::find(9);
        $lesson5 = Settings::find(10);
        $lesson6 = Settings::find(11);
        $lesson7 = Settings::find(12);
        $lesson8 = Settings::find(13);
        $lesson9 = Settings::find(14);
        $lesson10 = Settings::find(15);

        $lessons_times = array($lesson0, $lesson1, $lesson2, $lesson3, $lesson4, $lesson5, $lesson6, $lesson7, $lesson8, $lesson9, $lesson10);

        $procent = 0;
        if(!isset($_GET['date']) and $duration2 > 0) {
            $procent = $duration1 / $duration2;
        }


        $importants = Important::when($actual_user_team, function ($query, $actual_user_team) {
            if($actual_user_team == 'x'){
                return $query->where('user_id', Auth::id())->where('team_id', NULL);
            }
            else{
                return $query->where('team_id', $actual_user_team);
            }
        })->get();

        return view('home', [
            'changes' => $changes,
            'changes_count' => $changes_count,
            'post' => $post->content,
            'tasks' => $tasks,
            'post_html' => $post_html->content,
            'importants' => $importants,
            'date1' => $date1,
            'weekday' => $weekday,
            'deadlines' => $deadlines,
            'duration' => $duration,
            'procent' => $procent,
            'post_js' => $post_js->content,
            'lessons' => $lessons,
            'lessons_times' => $lessons_times,
            'rutyna_rano' => $rutyna_rano->content,
            'rutyna_popoludnie' => $rutyna_popoludnie->content,
            'rutyna_wieczor' => $rutyna_wieczor->content,
            'jutro' => $jutro,
            'quote' => $quote,
        ]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dashboard2()
    {
        $actual_user_team = Auth::user()->team_id;
        if(Session::get('team_id') == 0){
            $actual_user_team = 'x';
        }

        return view('dashboard2', [
            'actual_user_team' => $actual_user_team
        ]);
    }

    public function test(){
        return View('layouts.app3');
    }
}
