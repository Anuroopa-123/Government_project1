<?php

namespace App\Http\Controllers;

use App\Models\CourseRegistration;
use Illuminate\Http\Request;

class CourseRegistrationController extends Controller
{
    public function show()
    {
        $courseRegs = CourseRegistration::all();
        return view('courseRegs.index',compact('courseRegs'));
    }
}
