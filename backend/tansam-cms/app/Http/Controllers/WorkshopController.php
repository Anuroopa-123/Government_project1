<?php

namespace App\Http\Controllers;

use App\Helpers\TimelineLog;
use App\Models\Workshop;
use Illuminate\Http\Request;

class WorkshopController extends Controller
{
    public function index()
    {
        $workshops = Workshop::all();
        return view('workshops.index', compact('workshops'));
    }

    public function create()
    {
        return view('workshops.create');
    }

 public function add(Request $request)
{
    // Validation - relaxed and more mime types allowed
    $request->validate([
        'video' => 'nullable|file|mimes:mp4,avi,mpeg,mov,quicktime|max:512000', // max ~500MB adjust as needed
        'is_published' => 'nullable|boolean'
    ]);

    // Check if video file is uploaded
    if (!$request->hasFile('video')) {
        return back()->withErrors(['video' => 'No video file detected in the request']);
    }

    $video = $request->file('video');

    // Debug info - comment out after testing
    // dd([
    //     'mime' => $video->getMimeType(),
    //     'size' => $video->getSize(),
    //     'originalName' => $video->getClientOriginalName(),
    // ]);

    // Upload directory
    $videoDestinationPath = public_path('uploads/workshops/videos');

    if (!file_exists($videoDestinationPath)) {
        mkdir($videoDestinationPath, 0755, true);
    }

    $videoOriginalName = time() . '_' . $video->getClientOriginalName();

    // Move uploaded video
    $video->move($videoDestinationPath, $videoOriginalName);

    $videoPath = 'uploads/workshops/videos/' . $videoOriginalName;

    // Create workshop record
    $workshop = Workshop::create([
        'image' => null,
        'video' => $videoPath,
        'is_published' => $request->has('is_published') ? 1 : 0
    ]);

    TimelineLog::log("Workshop - {$workshop->id}", 'Created');

    return redirect()->route('workshops.list')->with('success', 'Workshop created successfully!');
}


    public function editForm($id)
    {
        $workshop = Workshop::findOrFail($id);
        return view('workshops.edit', compact('workshop'));
    }

    public function edit(Request $request, $id)
    {
        $request->validate([
            // 'image' => 'nullable|image|mimes:jpg,png,jpeg,gif',
            'video' => 'required|mimetypes:video/mp4,video/avi,video/mpeg,video/quicktime',
            'is_published' => 'nullable|boolean'
        ]);

        $workshop = Workshop::findOrFail($id);

        // Handle Image Update
        // if ($request->hasFile('image')) {
        //     if ($workshop->image && file_exists(public_path($workshop->image))) {
        //         unlink(public_path($workshop->image));
        //     }
        //     $image = $request->file('image');
        //     $originalName = time() . '_' . $image->getClientOriginalName();
        //     $destinationPath = public_path('uploads/workshops');
        //     $image->move($destinationPath, $originalName);
        //     $imagePath = 'uploads/workshops/' . $originalName;
        // } else {
        //     $imagePath = $workshop->image;
        // }

        // Handle Video Update
        if ($request->hasFile('video')) {
            if ($workshop->video && file_exists(public_path($workshop->video))) {
                unlink(public_path($workshop->video));
            }
            $video = $request->file('video');
            $videoOriginalName = time() . '_' . $video->getClientOriginalName();
            $videoDestinationPath = public_path('uploads/workshops/videos');
            if (!file_exists($videoDestinationPath)) {
                mkdir($videoDestinationPath, 0755, true);
            }
            $video->move($videoDestinationPath, $videoOriginalName);
            $videoPath = 'uploads/workshops/videos/' . $videoOriginalName;
        } else {
            $videoPath = $workshop->video;
        }

        $workshop->update([
            // 'image' => $imagePath,
            'video' => $videoPath,
            'is_published' => $request->has('is_published') ? 1 : 0,
        ]);

        TimelineLog::log("Workshop - {$workshop->id}", 'Updated');

        return redirect()->route('workshops.list')->with('success', 'Updated!');
    }

    public function delete($id)
    {
        $workshop = Workshop::findOrFail($id);

        // if ($workshop->image && file_exists(public_path($workshop->image))) {
        //     unlink(public_path($workshop->image));
        // }

        if ($workshop->video && file_exists(public_path($workshop->video))) {
            unlink(public_path($workshop->video));
        }

        $workshop->delete();

        TimelineLog::log("Workshop - {$workshop->id}", 'Deleted');

        return response()->json(['success' => true, 'message' => 'Deleted successfully.']);
    }
}
