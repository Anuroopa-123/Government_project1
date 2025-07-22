<?php

namespace App\Http\Controllers;

use App\Helpers\TimelineLog;
use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::all();
        return view('sliders.index',compact('sliders'));
    }

    public function create()
    {
        return view('sliders.create');
    }

    public function add(Request $request)
    {
        $request->validate([
            'slider_image' => 'required|image|mimes:jpg,png,jpeg,gif',
            'slider_title' => 'required|string',
            'is_published' => 'nullable|boolean'
        ]);

        if ($request->hasFile('slider_image')) {
            $image = $request->file('slider_image');
            $originalName = time() . '_' . $image->getClientOriginalName();
            $destinationPath = public_path('uploads/sliders');
             
            $image->move($destinationPath, $originalName);
            $imagePath = 'uploads/sliders/' . $originalName;
        } else {
            $imagePath = null;
        }

        $slider = Slider::create([
            'slider_image' => $imagePath,
            'slider_title' => $request->slider_title,
            'is_published' => $request->has('is_published') ? 1 : 0
        ]);

        TimelineLog::log("Slider - {$slider->id}",'Created');

        return redirect()->route('sliders.list')->with('success','Created!');
    }

    public function editForm($id)
    {
        $slider = Slider::findOrFail($id);
        return view('sliders.edit', compact('slider'));
    }

    public function edit(Request $request, $id)
    {
        $request->validate([
            'slider_image' => 'nullable|mimes:jpg,png,jpeg,gif',
            'slider_title' => 'required|string',
            'is_published' => 'nullable|boolean'
        ]);

        $slider = Slider::findOrFail($id);

        if ($request->hasFile('slider_image')) {
            if ($slider->slider_image && file_exists(public_path($slider->slider_image))) {
                unlink(public_path($slider->slider_image));
            }
            $image = $request->file('slider_image');
            $originalName = time() . '_' . $image->getClientOriginalName();
            $destinationPath = public_path('uploads/sliders');
            $image->move($destinationPath, $originalName);
            $imagePath = 'uploads/sliders/' . $originalName;
        } else {
            $imagePath = $slider->slider_image;
        }

        $slider->update([
            'slider_image' => $imagePath,
            'slider_title' => $request->slider_title,
            'is_published' => $request->has('is_published') ? 1 : 0
        ]);

        TimelineLog::log("Slider - {$slider->id}",'Updated');

        return redirect()->route('sliders.list')->with('success','Updated!');
    }

    public function delete($id)
    {
        $slider = Slider::findOrFail($id);
        if ($slider->slider_image && file_exists(public_path($slider->slider_image))) {
            unlink(public_path($slider->slider_image));
        }

        $slider->delete();

        TimelineLog::log("Slider - {$slider->id}",'Deleted');

        return response()->json(['success' => true, 'message' => 'Deleted successfully.']);
    }
}
