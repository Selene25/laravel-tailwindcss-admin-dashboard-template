<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Models\User;

class UserController extends Controller
{
    public function getUserImage($id)
    {
        $user = User::find($id);

        if (!$user || !$user->profile_photo_path) {
            abort(404);
        }

        // Assuming the BLOB data is stored in the 'profile_photo_path' column
        $imageData = $user->profile_photo_path;

        return Response::make($imageData, 200, [
            'Content-Type' => 'image/jpeg', // Adjust MIME type if necessary
            'Content-Disposition' => 'inline',
        ]);
    }


}
