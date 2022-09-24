<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Film;
use App\Models\Change;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Exception;
use Auth;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $courses = Course::orderBy('status', 'asc')->paginate(18);

        if ($request->ajax()) {
            return view('courses.load', ['courses' => $courses])->render();  
        }

        return view('courses.index', [
            'courses' => $courses,
        ]);
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
        $course = new Course($request->all());
        $course->save();
        Change::create([
            'name' => $request->name,
            'user_id' => Auth::id(),
            'action' => 0,
            'model' => 1,
        ]);
        return redirect(route('courses.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(course $course, Request $request)
    {
        if ($request->ajax()) {
            return view('courses.show-load', [
                'course' => $course,
                'films' => $course->films,
                'count_films' => count($course->films)
            ]); 
        }

        return view('courses.show', [
            'course' => $course,
            'films' => $course->films,
            'count_films' => count($course->films)
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  Course  $course
     * @return View
     */
    public function show2(Course $course): View
    {
        return view('courses.show2', [
            'course' => $course,
            'films' => $course->films,
            'count_films' => count($course->films)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $course = Course::find($id);
        return $course;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course)
    {
        $course->fill($request->all());
        $course->save();
        Change::create([
            'name' => $request->name,
            'user_id' => Auth::id(),
            'action' => 1,
            'model' => 1,
        ]);
        return redirect(route('courses.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(course $course)
    {
        $course->delete();

        Change::create([
            'name' => $course->name,
            'user_id' => Auth::id(),
            'action' => 2,
            'model' => 1,
        ]);

        return response()->json([
            'status' => 'success'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Course $film
     * @return View
     */
    public function tab_info(Course $course): View
    {
        return view('courses.tabs.info', [
            'course' => $course,
            'count_films' => count($course->films)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Course $film
     * @return View
     */
    public function tab_films(Course $course): View
    {   
        return view('courses.tabs.films', [
            'course' => $course,
            'films' => $course->films
        ]);
    }
}
