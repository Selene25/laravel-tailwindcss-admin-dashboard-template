<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class MajorController extends Controller
{
    public function index()
    {
        $majors = DB::table('tbl_major')
            ->join('users', 'tbl_major.user_id', '=', 'users.id')
            ->select('tbl_major.*', 'users.name as user_name')
            ->get();

        return view('components.systemadmin.systemadmin-card-01', compact('majors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'major' => 'required|string|max:255'
        ]);

        DB::table('tbl_major')->insert([
            'user_id' => Auth::id(),
            'major' => $request->major,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return response()->json(['message' => 'Major saved successfully!'], 200);
    }
}
