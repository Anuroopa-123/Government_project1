<?php

namespace App\Http\Controllers;

use App\Helpers\TimelineLog;
use App\Models\MediaItem;
use Illuminate\Http\Request;

class MediaItemController extends Controller
{
    public function index()
    {
        $mediaItems = MediaItem::all();
        return view('mediaItems.index',compact('mediaItems'));
    }

    public function create()
    {
        return view('mediaItems.create');
    }

    public function add(Request $request)
    {
        $request->validate([
            'category' => 'required|string',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif',
            'title' => 'required|string',
            'is_published' => 'nullable|boolean'
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $originalName = time() . '_' . $image->getClientOriginalName();
            $destinationPath = public_path('uploads/mediaItems');
            $image->move($destinationPath, $originalName);
            $imagePath = 'uploads/mediaItems/' . $originalName;
        } else {
            $imagePath = null;
        }

        $mediaItem = MediaItem::create([
            'category' => $request->category,
            'image' => $imagePath,
            'title' => $request->title,
            'is_published' => $request->has('is_published') ? 1 : 0
        ]);

        TimelineLog::log("Media Item - {$mediaItem->id}",'Created');

        return redirect()->route('mediaItems.list')->with('success','Created!');
    }

    public function editForm($id)
    {
        $mediaItem = MediaItem::findOrFail($id);
        return view('mediaItems.edit', compact('mediaItem'));
    }

    public function edit(Request $request, $id)
    {
        $request->validate([
            'category' => 'required|string',
            'image' => 'nullable|mimes:jpg,png,jpeg,gif',
            'title' => 'required|string',
            'is_published' => 'nullable|boolean'
        ]);

        $mediaItem = MediaItem::findOrFail($id);

        if ($request->hasFile('image')) {
            if ($mediaItem->image && file_exists(public_path($mediaItem->image))) {
                unlink(public_path($mediaItem->image));
            }
            $image = $request->file('image');
            $originalName = time() . '_' . $image->getClientOriginalName();
            $destinationPath = public_path('uploads/mediaItems');
            $image->move($destinationPath, $originalName);
            $imagePath = 'uploads/mediaItems/' . $originalName;
        } else {
            $imagePath = $mediaItem->image;
        }

        $mediaItem->update([
            'category' => $request->category,
            'image' => $imagePath,
            'title' => $request->title,
            'is_published' => $request->has('is_published') ? 1 : 0
        ]);

        TimelineLog::log("Media Item - {$mediaItem->id}",'Updated');

        return redirect()->route('mediaItems.list')->with('success','Updated!');
    }

    public function delete($id)
    {
        $mediaItem = MediaItem::findOrFail($id);
        if ($mediaItem->image && file_exists(public_path($mediaItem->image))) {
            unlink(public_path($mediaItem->image));
        }

        $mediaItem->delete();

        TimelineLog::log("Media Item - {$mediaItem->id}",'Deleted');

        return response()->json(['success' => true, 'message' => 'Deleted successfully.']);
    }
}
