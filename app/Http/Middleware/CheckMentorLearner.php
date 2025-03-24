<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckMentorLearner
{
    public function handle(Request $request, Closure $next)
    {
        $currentUser = DB::table('tbl_mentorlearner')
            ->where('mentorlearner', Auth::id())
            ->first();

        if ($currentUser && $currentUser->mentorlearner == 1) {
            return redirect('pages/utility/404');
        }

        return $next($request);
    }
}
