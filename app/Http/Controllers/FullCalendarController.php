<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;


class FullCalendarController extends Controller
{
    //
    public function index(Request $request)
    {
        return view('full-calendar');
    }
    public function events(Request $request)
    {
        $data = Event::whereDate('start','>=',$request->start)
            ->whereDate('end','<=',$request->end)
            ->where('approved','=','1')
            ->get(['id','title','start','end']);
        return response()->json($data);
    }
    public function action(Request $request)
    {
        if($request->ajax())
        {
            if($request->type == 'add')
            {
                $event = Event::create([
                    'title' => $request->title,
                    'start' => $request->start,
                    'end' => $request->end,
                    'name' => $request->name,
                    'num_people' => $request->num_people,
                    'contact' => $request->contact,
                    'note' => $request->note,
                    'approved' => 0,
                ]);

                return response()->json($event);
            }
            if($request->type == 'update')
            {
                $event = Event::find($request->id)
                    ->update([
                        'title' => $request->title,
                        'start' => $request->start,
                        'end' => $request->end
                    ]);

                return response()->json($event);
            }
            if($request->type == 'delete')
            {
                $event = Event::find($request->id)->delete();

                return response()->json($event);
            }
        }
    }
}
