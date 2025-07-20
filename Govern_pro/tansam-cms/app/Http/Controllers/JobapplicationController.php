<?php

namespace App\Http\Controllers;

use App\Models\JobApplication;
use Illuminate\Http\Request;

class JobapplicationController extends Controller
{
    public function show()
    {
        $jobApplications = JobApplication::all();
        return view('jobApps.index', compact('jobApplications'));
    }
    public function updateStatus(Request $request, $id)
    {
        $request->validate(['status' => 'required|string']);
        $app = JobApplication::findOrFail($id);
        $app->status = $request->status;
        $app->save();
        return response()->json(['success' => true]);
    }
    public function downloadResume($id)
    {
        $app = JobApplication::findOrFail($id);

        $path = storage_path('app/private/' . $app->resume);
        if (!file_exists($path)) {
            abort(404);
        }

        return response()->file($path, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . basename($path) . '"'
        ]);
    }
}
