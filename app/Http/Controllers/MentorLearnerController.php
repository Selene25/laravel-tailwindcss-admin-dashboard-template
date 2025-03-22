<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MentorLearnerController extends Controller
{

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'mentorlearner' => 'required',
            'major' => 'required|array',
        ]);

        // Save data to the database
        DB::table('tbl_mentorlearner')->insert([
            'user_id' => Auth::id(),
            'mentorlearner' => $request->mentorlearner,
            'major' => json_encode($request->major), // Save as JSON
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Redirect or return a response
        return redirect()->back()->with('success', 'Your preferences have been saved.');
    }
}
