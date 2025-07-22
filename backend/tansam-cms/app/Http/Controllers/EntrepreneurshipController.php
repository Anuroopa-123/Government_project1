<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Entrepreneurship;
use App\Helpers\TimelineLog;

class EntrepreneurshipController extends Controller
{
    public function index()
    {
        $entrepreneurships = Entrepreneurship::all();
        return view('entrepreneurship.index', compact('entrepreneurships'));
    }

    public function create()
    {
        return view('entrepreneurship.create');
    }

    public function add(Request $request)
    {
        $request->validate([
            'course_title' => 'required|string',
            'course_lab' => 'required|string',
            'course_image' => 'required|image|mimes:jpeg,png,jpg,gif',
            'start_date' => 'required|date',
            'from_time' => 'required',
            'to_time' => 'required',
            'mode' => 'required|string',
            'contact_person' => 'required|string',
            'contact_mail' => 'required|email',
            'is_published' => 'nullable|boolean'
        ]);

        if ($request->hasFile('course_image')) {
            $image = $request->file('course_image');
            $originalName = time() . '_' . $image->getClientOriginalName();
            $destinationPath = public_path('uploads/entrepreneurship');
            $image->move($destinationPath, $originalName);
            $imagePath = 'uploads/entrepreneurship/' . $originalName;
        } else {
            $imagePath = null;
        }

        $entrepreneurship = Entrepreneurship::create([
            'course_title' => $request->course_title,
            'course_lab' => $request->course_lab,
            'course_image' => $imagePath,
            'start_date' => $request->start_date,
            'from_time' => $request->from_time,
            'to_time' => $request->to_time,
            'mode' => $request->mode,
            'contact_person' => $request->contact_person,
            'contact_mail' => $request->contact_mail,
            'is_published' => $request->has('is_published') ? 1 : 0,
        ]);

        TimelineLog::log("Entrepreneurship - {$entrepreneurship->id}", 'Created');

        return redirect()->route('entrepreneurship.list')->with('success', 'Created successfully!');
    }

    public function editForm($id)
    {
        $entrepreneurship = Entrepreneurship::findOrFail($id);
        return view('entrepreneurship.edit', compact('entrepreneurship'));
    }

    public function edit(Request $request, $id)
    {
        $request->validate([
            'course_title' => 'required|string',
            'course_lab' => 'required|string',
            'course_image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'start_date' => 'required|date',
            'from_time' => 'required',
            'to_time' => 'required',
            'mode' => 'required|string',
            'contact_person' => 'required|string',
            'contact_mail' => 'required|email',
            'is_published' => 'nullable|boolean'
        ]);

        $entrepreneurship = Entrepreneurship::findOrFail($id);

        if ($request->hasFile('course_image')) {
            if ($entrepreneurship->course_image && file_exists(public_path($entrepreneurship->course_image))) {
                unlink(public_path($entrepreneurship->course_image));
            }
            $image = $request->file('course_image');
            $originalName = time() . '_' . $image->getClientOriginalName();
            $destinationPath = public_path('uploads/entrepreneurship');
            $image->move($destinationPath, $originalName);
            $imagePath = 'uploads/entrepreneurship/' . $originalName;
        } else {
            $imagePath = $entrepreneurship->course_image;
        }

        $entrepreneurship->update([
            'course_title' => $request->course_title,
            'course_lab' => $request->course_lab,
            'course_image' => $imagePath,
            'start_date' => $request->start_date,
            'from_time' => $request->from_time,
            'to_time' => $request->to_time,
            'mode' => $request->mode,
            'contact_person' => $request->contact_person,
            'contact_mail' => $request->contact_mail,
            'is_published' => $request->has('is_published') ? 1 : 0,
        ]);

        TimelineLog::log("Entrepreneurship - {$entrepreneurship->id}", 'Updated');

        return redirect()->route('entrepreneurship.list')->with('success', 'Updated successfully!');
    }

    public function delete($id)
    {
        $entrepreneurship = Entrepreneurship::findOrFail($id);
        if ($entrepreneurship->course_image && file_exists(public_path($entrepreneurship->course_image))) {
            unlink(public_path($entrepreneurship->course_image));
        }

        $entrepreneurship->delete();

        TimelineLog::log("Entrepreneurship - {$entrepreneurship->id}", 'Deleted');

        return response()->json(['success'=>true, 'message'=>'Deleted']);
    }
}
