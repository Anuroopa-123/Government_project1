<?php

namespace App\Http\Controllers;

use App\Helpers\TimelineLog;
use Illuminate\Http\Request;
use App\Models\Event;

class EventsController extends Controller
{
    public function index()
    {
        $events = Event::all();
        return view('events.index', compact('events'));
    }

    public function create()
    {
        return view('events.create');
    }

    public function add(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'date' => 'required|date',
            'image' => 'required|image|mimes:jpeg,jpg,png,gif',
            'category' => 'required|string',
            'is_published' => 'nullable|boolean'
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $originalName = time() . '_' . $image->getClientOriginalName();
            $destinationPath = public_path('uploads/events');
            $image->move($destinationPath, $originalName);
            $imagePath = 'uploads/events/' . $originalName;
        } else {
            $imagePath = null;
        }

        // Create Record
        $event = Event::create([
            'title' => $request->title,
            'description' => $request->description,
            'date' => $request->date,
            'image' => $imagePath,
            'category' => $request->category,
            'is_published' => $request->has('is_published') ? 1 : 0,
        ]);

        TimelineLog::log("Event - {$event->id}", 'Created');

        return redirect()->route('events.list')->with('success', 'Updated successfully!');
    }

    public function editForm($id)
    {
        $event = Event::findOrFail($id);
        return view('events.edit', compact('event'));
    }

    public function edit(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'date' => 'required|date',
            'image' => 'nullable|mimes:jpg,png,jpeg,gif',
            'category' => 'required|string',
            'is_published' => 'nullable|boolean'
        ]);

        // Edit Record
        $event = Event::findOrFail($id);

        if ($request->hasFile('image')) {
            if ($event->image && file_exists(public_path($event->image))) {
                unlink(public_path($event->image));
            }
            $image = $request->file('image');
            $originalName = time() . '_' . $image->getClientOriginalName();
            $destinationPath = public_path('uploads/events');
            $image->move($destinationPath, $originalName);
            $imagePath = 'uploads/events/' . $originalName;
        } else {
            $imagePath = $event->image;
        }

        $event->update([
            'title' => $request->title,
            'description' => $request->description,
            'date' => $request->date,
            'image' => $imagePath,
            'category' => $request->category,
            'is_published' => $request->has('is_published') ? 1 : 0,
        ]);

        return redirect()->route('events.list')->with('success', 'Updated successfully!');
    }

    public function delete($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();

        if($event->image && file_exists(public_path($event->image))) {
            unlink(public_path($event->image));
        }

        TimelineLog::log("Event - {$event->id}", 'Deleted');

        return response()->json(['success'=>true, 'message'=>'Deleted']);
    }
}
