<?php

namespace App\Http\Controllers;

use App\Helpers\TimelineLog;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::all();
        return view('news.index',compact('news'));
    }

    public function create()
    {
        return view('news.create');
    }

    public function add(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'news_image' => 'required|image|mimes:jpg,png,jpeg,gif',
            'description' => 'required|string',
            'date' => 'required|date',
            'role' => 'required|in:Chairman,Member',
            'is_published' => 'nullable|boolean',
        ]);

        if ($request->hasFile('news_image')) {
            $image = $request->file('news_image');
            $originalName = time() . '_' . $image->getClientOriginalName();
            $destinationPath = public_path('uploads/news');
            $image->move($destinationPath, $originalName);
            $imagePath = 'uploads/news/' . $originalName;
        } else {
            $imagePath = null;
        }

        $news = News::create([
            'title' => $request->title,
            'news_image' => $imagePath,
            'description' => $request->description,
            'date' => $request->date,
            'role' => $request->role,   
            'is_published' => $request->has('is_published') ? 1 : 0
        ]);

        TimelineLog::log("News - {$news->id}",'Created');

        return redirect()->route('news.list')->with('success','Created!');
    }

    public function editForm($id)
    {
        $news = News::findOrFail($id);
        return view('news.edit', compact('news'));
    }

    public function edit(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string',
            'news_image' => 'nullable|mimes:jpg,png,jpeg,gif',
            'description' => 'required|string',
            'date' => 'required|date',
            'role' => 'required|in:Chairman,Member', 
            'is_published' => 'nullable|boolean',
        ]);

        $news = News::findOrFail($id);

        if ($request->hasFile('news_image')) {
            if ($news->image && file_exists(public_path($news->image))) {
                unlink(public_path($news->image));
            }
            $image = $request->file('news_image');
            $originalName = time() . '_' . $image->getClientOriginalName();
            $destinationPath = public_path('uploads/news');
            $image->move($destinationPath, $originalName);
            $imagePath = 'uploads/news/' . $originalName;
        } else {
            $imagePath = $news->news_image;
        }

        $news->update([
            'title' => $request->title,
            'news_image' => $imagePath,
            'description' => $request->description,
            'date' => $request->date,
            'role' => $request->role,
            'is_published' => $request->has('is_published') ? 1 : 0
        ]);

        TimelineLog::log("News - {$news->id}",'Updated');

        return redirect()->route('news.list')->with('success','Updated!');
    }

    public function delete($id)
    {
        $news = News::findOrFail($id);
        if ($news->image && file_exists(public_path($news->image))) {
            unlink(public_path($news->image));
        }

        $news->delete();

        TimelineLog::log("News - {$news->id}",'Deleted');

        return response()->json(['success' => true, 'message' => 'Deleted successfully.']);
    }
}
