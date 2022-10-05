<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\Settings;
use Illuminate\Http\Request;

/**
 * Class LessonController
 * @package App\Http\Controllers
 */
class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lessons = Lesson::orderBy('day')->orderBy('lesson_number')->paginate();
        $lessons_all = Lesson::orderBy('day')->orderBy('lesson_number')->get();

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


        $plan = array(array(), array(), array(), array(), array(), array(), array(), array(), array(), array(), array());

        foreach ($lessons_all as $lesson) {
            array_push($plan[$lesson->lesson_number], $lesson);
        }

        return view('lesson.index', compact(['lessons', 'plan', 'lessons_times']))
            ->with('i', (request()->input('page', 1) - 1) * $lessons->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lesson = new Lesson();
        return view('lesson.create', compact('lesson'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Lesson::$rules);

        $lesson = Lesson::create($request->all());

        return redirect()->route('lessons.index')
            ->with('success', 'Lesson created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $lesson = Lesson::find($id);

        return view('lesson.show', compact('lesson'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $lesson = Lesson::find($id);

        return view('lesson.edit', compact('lesson'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Lesson $lesson
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lesson $lesson)
    {
        request()->validate(Lesson::$rules);

        $lesson->update($request->all());

        return redirect()->route('lessons.index')
            ->with('success', 'Lesson updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $lesson = Lesson::find($id)->delete();

        return response()->json([
            'status' => 'success'
        ]);
    }
}
