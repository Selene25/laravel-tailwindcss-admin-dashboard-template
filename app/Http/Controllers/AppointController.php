<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

class AppointController extends Controller
{
    public function viewScheduleAppointment($userId)
    {
        $user = User::findOrFail($userId);

        // Fetch appointments for the logged-in user
        $appointments = DB::table('tbl_appointment')
            ->where('tutor_id', $userId)
            ->orWhere('tutee_id', Auth::id())
            ->select('id', 'sched', 'end_session')
            ->get();

        return view('pages.view-schedule-appointment', compact('user', 'appointments'));
    }
    public function viewScheduleSysadmin($userId)
    {
        $user = User::findOrFail($userId);

        // Fetch appointments for the logged-in user
        $appointments = DB::table('tbl_appointment')
            ->where('tutor_id', $userId)
            ->orWhere('tutee_id', Auth::id())
            ->select('id', 'sched', 'end_session')
            ->get();

        return view('systemadmin.systemadmin-card-02.blade.php', compact('user', 'appointments'));
    }
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

        return redirect()->route('view-schedule-appointment', ['user' => $request->tutor_id])
            ->with('success', 'Appointment saved successfully.');
    }
}