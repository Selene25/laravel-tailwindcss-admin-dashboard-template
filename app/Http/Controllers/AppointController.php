<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

class AppointController extends Controller
{
    public function setScheduleAppointment($userId)
    {
        $user = User::findOrFail($userId);
        return view('pages.set-schedule-appointment', compact('user'));
    }

    public function saveAppointment(Request $request)
    {
        $request->validate([
            'tutor_id' => 'required|exists:users,id',
            'sched' => 'required|date', // Ensure the date is valid
            'major' => 'required|string',
            'emails' => 'nullable|string', // Validate the emails field
        ]);

        DB::table('tbl_appointment')->insert([
            'tutee_id' => Auth::id(),
            'tutor_id' => $request->tutor_id,
            'sched' => $request->sched, // Store the date as plain text
            'major' => Crypt::encryptString($request->major), // Encrypt the major
            'emails' => $request->emails ? Crypt::encryptString($request->emails) : null, // Encrypt emails if not empty
            'created_at' => now(),
        ]);

        return redirect()->route('set-schedule-appointment', ['user' => $request->tutor_id])
            ->with('success', 'Appointment saved successfully.');
    }
}