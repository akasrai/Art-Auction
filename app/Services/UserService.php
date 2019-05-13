<?php

namespace App\Services;

use Auth;
use Mail;
use App\Models\User;
use App\Mail\verifyEmail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class UserService
{
    public function __construct()
    {
    }

    public function save(array $data)
    {
        $user = User::create([
            'fname' => $data['fname'],
            'lname' => $data['lname'],
            'email' => $data['email'],
            'phone_no' => $data['phone'],
            'verify_token' => Str::random(40),
            'password' => bcrypt($data['password'])
        ]);

        $thisUser = User::findOrFail($user->id);
        $this->sendEmail($thisUser);
        return $user;
    }

    public function sendEmail($thisUser)
    {
        Mail::to($thisUser['email'])->send(new verifyEmail($thisUser));
    }

    public function resendEmailVerificationLink($id)
    {
        $thisUser = User::findOrFail($id);
        return $this->sendEmail($thisUser);
    }

    public function verifyEmail($email, $verifyToken)
    {
        return User::where(['email'=>$email,'verify_token' => $verifyToken])->update(['status' => '1','verify_token' => null]);
    }

    public function uploadProfileImage(array $data)
    {
        $filename = $data['image']->store('images/profile');
        return User::where('id', Auth::user()->id)->update(['image' => $filename]);
    }

    protected function profileImageVlidator(array $data)
    {
        return Validator::make($data, [
            'images.*.image' => 'image|mimes:jpeg,bmp,png|max:2000'
        ]);
    }

    public function update(array $data)
    {
        return User::where('id', Auth::user()->id)->update([
            'fname' => $data['fname'],
            'mname' => $data['mname'],
            'lname' => $data['lname'],
            'phone_no' => $data['phone'],
            'address_line' => $data['address-line'],
            'city' => $data['city'],
            'state' => $data['state'],
            'country' => $data['country'],
            'postal_code' => $data['postal-code'],
            'language' => $data['language'],
            'currency' => $data['currency']
        ]);
    }

    public function updateAddress(array $data)
    {
        return User::where('id', Auth::user()->id)->update([
            'address_line' => $data['addressLine'],
            'city' => $data['city'],
            'state' => $data['state'],
            'country' => $data['country'],
            'postal_code' => $data['zipCode']
        ]);
    }
}
