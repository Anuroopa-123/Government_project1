<?php

namespace App\Http\Controllers;
use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    //
     public function index()
    {
        return response()->json([
            'status' => 'success',
            'data' => Member::where('role', '!=', null)->get()
        ]);
    }
     // Store a new member
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif',
            'role' => 'required|in:Chairman,Member',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads/members'), $imageName);
            $imagePath = 'uploads/members/' . $imageName;
        } else {
            $imagePath = null;
        }

        $member = Member::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $imagePath,
            'role' => $request->role,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Member created successfully',
            'data' => $member
        ]);
    }

}
