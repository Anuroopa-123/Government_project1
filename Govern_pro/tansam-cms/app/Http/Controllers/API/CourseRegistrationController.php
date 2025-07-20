<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CourseRegistration;

class CourseRegistrationController extends Controller
{
    // Handle course data from form and show to admin
    public function index()
    {
        $registrations = CourseRegistration::orderByDesc('created_at');
        return view('course_registrations',compact('registrations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'dob' => 'required|date',
            'mobile_number' => 'required|string',
            'email' => 'required|string',
            'address_line_one' => 'required|string',
            'address_line_two' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'zip_code' => 'required|string',
            'college_organization' => 'required|string',
            'department_domain' => 'required|string',
            'year_experience' => 'required|string',
        ]);

        CourseRegistration::create([
            'course' => $request->course,
            'name' => $request->name,
            'dob' => $request->dob,
            'mobile_number' => $request->mobile_number,
            'email' => $request->email,
            'address_line_one' => $request->address_line_one,
            'address_line_two' => $request->address_line_two,
            'city' => $request->city,
            'state' => $request->state,
            'zip_code' => $request->zip_code,
            'college_organization' => $request->college_organization,
            'department_domain' => $request->department_domain,
            'year_experience' => $request->year_experience,
        ]);

        return response()->json(['message' => 'Stored Successfully'],200);
    }
}
