<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\JobApplication;
use Illuminate\Http\Request;

class JobapplicationController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'job' => 'required|string',
            'full_name' => 'required|string',
            'email' => 'required|email',
            'contact' => 'required|string',
            'resume' => 'required|mimes:pdf'
        ]);

        $resumePath = $request->file('resume')->storeAs('resumes',time().'_'.$request->file('resume')->getClientOriginalName());

        JobApplication::create([
            'role' => $request->job,
            'name' => $request->full_name,
            'email' => $request->email,
            'contact_number' => $request->contact,
            'resume' => $resumePath
        ]);

        return response()->json(['message'=>'Posted Successfully!']);
    }
}
