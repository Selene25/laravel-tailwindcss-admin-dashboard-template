<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'idnum' => ['required', 'integer', 'unique:users'],
            'fname' => ['required', 'string', 'max:255'],
            'lname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        $defaultProfilePicture = file_get_contents(public_path('images/defaultDP.jpg'));

        return User::create([
            'idnum' => $input['idnum'],
            'fname' => $input['fname'],
            'lname' => $input['lname'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'profile_photo_path' => $defaultProfilePicture,
        ]);
    }
}
