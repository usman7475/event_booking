<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Http\Requests\StoreEventRequest;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index(Request $request){
 $query = Event::latest();
 
 if($request->has('location') && $request->location){
  $query->where('location', 'like', '%'.$request->location.'%');
 }
 
 if($request->has('date') && $request->date){
  $query->whereDate('event_datetime', $request->date);
 }
 
 $events = $query->paginate(6);
 return view('events.index',compact('events'));
}

public function show(Event $event){
 return view('events.show',compact('event'));
}

public function create(){
 return view('events.create');
}

public function store(StoreEventRequest $request){
 Event::create([
  ...$request->validated(),
  'available_seats'=>$request->total_seats,
  'user_id'=>auth()->id()
 ]);
 return redirect()->route('events.index')->with('success','Event created successfully!');
}

public function edit(Event $event){
 $this->authorize('update', $event);
 return view('events.edit',compact('event'));
}

public function update(StoreEventRequest $request, Event $event){
 $this->authorize('update', $event);
 $old_seats = $event->total_seats;
 $new_seats = $request->total_seats;
 $difference = $new_seats - $old_seats;
 
 $event->update([
  ...$request->validated(),
  'available_seats' => $event->available_seats + $difference
 ]);
 return redirect()->route('events.index')->with('success','Event updated successfully!');
}

public function destroy(Event $event){
 $this->authorize('delete', $event);
 $event->delete();
 return back()->with('success','Event deleted successfully!');
}
}
