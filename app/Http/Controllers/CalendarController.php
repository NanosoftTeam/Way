<?php

namespace App\Http\Controllers;

use App\Models\Deadline;
use App\Models\Task;
use App\Models\User;
use Auth;
use Datetime;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class CalendarController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax())
    	{
    		$data = Deadline::where('date', '!=', NULL)->get(['id', 'name', 'priority', 'date', 'type', 'is_planned']);



            foreach ($data as $element) {
                if($element->is_planned == 0) {
                    $element->title = "❌ ".$element->name;
                }
                else{
                    $element->title = $element->name;
                }

                $element->start = $element->date;
                $element->end = $element->date;
                $element->id2 = $element->id;
                $element->id *= -1;
                $element->type2 = $element->type;
                $element->type = 1;
                if($element->end != NULL and $element->end != ''){
                    $date1 = new DateTime($element->end);
                    $date1->modify('+1 day');

                    $element->end = $date1->format('Y-m-d');
                }

                $colors = array("#e3342f", "#ff6600", "#ccb800", "#38c172",  "#868e96");
                $element->color = $colors[$element->priority];

                if($element->type2 == "Wyjazd"){
                    $element->rendering = 'background';
                    $element->color = "#ccb800";
                }



                unset($element->type2);
            }


            $data2 = Task::where('end', '!=', NULL)->where('status', '!=', 4)->get(['id', 'name', 'start', 'end', 'duration']);

            foreach ($data2 as $element) {
                $element->title = $element->name;
                $element->id2 = $element->id;
                $element->type = 2;
                //if($element->start == NULL or $element->start == ''){
                    $element->start = $element->end;
                //}
                if($element->end != NULL and $element->end != ''){
                    $date1 = new DateTime($element->end);
                    $date1->modify('+1 day');

                    $element->end = $date1->format('Y-m-d');
                }

                if($element->duration == NULL or $element->duration == 0){
                    $element->color = "#cccccc";
                    $element->textColor = "#000000";
                }
                else{
                    $element->color = "#ababab";
                }



            }

            //$data = array_merge($data2, $data);
            //$data = $data->merge($data2);
            //$data = $questions->toBase()->merge($answers);
            $data = $data->toBase()->merge($data2);



            return response()->json($data);
    	}
    	return view('calendar.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return JsonResponse
     */
    public function action(Request $request): JsonResponse
    {
    	if($request->ajax())
    	{
            $request->end = new DateTime($request->end);
            $request->end->modify('-1 day');
    		if($request->type == 'add')
    		{
    			$event = Task::create([
    				'name'		=>	$request->name,
                    'start' => $request->start,
                    'status' => 1,
    				'end'		=>	$request->end,
                    'priority'    =>  4
    			]);

    			return response()->json($event);
    		}

    		if($request->type == 'update')
    		{
                if($request->event_type == 1){
                    $event = Deadline::find($request->id)->update([
                        'name'		=>	$request->title,
                        'date'		=>	$request->start,
                    ]);

                }
                else{
                    $event = Task::find($request->id)->update([
                        'name'		=>	$request->title,
                        'start'		=>	$request->start,
                        'end'		=>	$request->end
                    ]);

                }


    			return response()->json($event);
    		}

    		if($request->type == 'show')
    		{
                return redirect(route('deadlines.show', $request->id));
    		}
    	}
    }

}
