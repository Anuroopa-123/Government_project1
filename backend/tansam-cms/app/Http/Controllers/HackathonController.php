<?php

namespace App\Http\Controllers;

use App\Helpers\TimelineLog;
use App\Models\Hackathon;
use Illuminate\Http\Request;

class HackathonController extends Controller
{
    public function index()
    {
        $hackathons = Hackathon::all();
        return view('hackathon.index',compact('hackathons'));
    }

    public function create()
    {
        return view('hackathon.create');
    }

    public function add(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'date' => 'required|date',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif',
            'gallery_images.*' => 'nullable|image|mimes:jpg,png,jpeg,gif',
            'is_published' => 'nullable|boolean',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $originalName = time() . '_' . $image->getClientOriginalName();
            $destinationPath = public_path('uploads/hackathons');
            $image->move($destinationPath, $originalName);
            $imagePath = 'uploads/hackathons/' . $originalName;
        } else {
            $imagePath = null;
        }

        $hackathon = Hackathon::create([
            'title' => $request->title,
            'description' => $request->description,
            'date' => $request->date,
            'image' => $imagePath,
            'is_published' => $request->has('is_published') ? 1 : 0,
        ]);

        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $galleryImage) {
                $galleryName = time() . '_' . $galleryImage->getClientOriginalName();
                $galleryDestination = public_path('uploads/hackathons/gallery');
                $galleryImage->move($galleryDestination, $galleryName);
                $galleryPath = 'uploads/hackathons/gallery/' . $galleryName;
                $hackathon->images()->create(['image_path' => $galleryPath]);
            }
        }

        TimelineLog::log("Hackathon - {$hackathon->id}",'Created');

        return redirect()->route('hackathons.list')->with('success',"Created successfully");
    }

    public function editForm($id)
    {
        $hackathon = Hackathon::findOrFail($id);
        return view('hackathon.edit', compact('hackathon'));
    }

    public function edit(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'date' => 'required|date',
            'image' => 'nullable|mimes:jpg,png,jpeg,gif',
            'gallery_images.*' => 'nullable|image|mimes:jpg,png,jpeg,gif',
            'is_published' => 'nullable|boolean',
        ]);

        // Edit Record
        $event = Hackathon::findOrFail($id);

        if ($request->hasFile('image')) {
            if ($event->image && file_exists(public_path($event->image))) {
                unlink(public_path($event->image));
            }
            $image = $request->file('image');
            $originalName = time() . '_' . $image->getClientOriginalName();
            $destinationPath = public_path('uploads/hackathons');
            $image->move($destinationPath, $originalName);
            $imagePath = 'uploads/hackathons/' . $originalName;
        } else {
            $imagePath = $event->image;
        }

        $event->update([
            'title' => $request->title,
            'description' => $request->description,
            'date' => $request->date,
            'image' => $imagePath,
            'is_published' => $request->has('is_published') ? 1 : 0,
        ]);

        if ($request->hasFile('gallery_images')) {
            foreach ($event->showcaseImages as $images) {
                if($images && file_exists(public_path($images->image_path))) {
                    unlink(public_path($images->image_path));
                }
                $images->delete();
            }
            foreach ($request->file('gallery_images') as $galleryImage) {
                $galleryName = time() . '_' . $galleryImage->getClientOriginalName();
                $galleryDestination = public_path('uploads/hackathons/gallery');
                $galleryImage->move($galleryDestination, $galleryName);
                $galleryPath = 'uploads/hackathons/gallery/' . $galleryName;
                $event->showcaseImages()->create(['image_path' => $galleryPath]);
            }
        }

        TimelineLog::log("Hackathon - {$event->id}",'Updated');

        return redirect()->route('hackathons.list')->with('success', 'Updated!');
    }

    public function delete($id)
    {
        $hackathon = Hackathon::findOrFail($id);
        if ($hackathon->image && file_exists(public_path($hackathon->image))) {
            unlink(public_path($hackathon->image));
        }

        $hackathon->delete();

        TimelineLog::log("Hackathon - {$hackathon->id}",'Deleted');

        return response()->json(['success' => true, 'message' => 'Deleted successfully.']);
    }
}
