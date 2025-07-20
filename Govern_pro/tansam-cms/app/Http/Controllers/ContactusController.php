<?php

namespace App\Http\Controllers;

use App\Models\contactus;
use Illuminate\Http\Request;

class ContactusController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
            'name' => 'required|string',
            'email' => 'required|email'
        ]);

        contactus::create([
            'message' => $request->message,
            'name' => $request->name,
            'email' => $request->email
        ]);

        return response()->json(['message'=>'Stored Successfully']);
    }
}
