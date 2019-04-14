<?php

namespace App\Services;

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
        return User::where('id', $data['userId'])->update(['image' => $filename]);
    }

    protected function profileImageVlidator(array $data)
    {
        return Validator::make($data, [
            'images.*.image' => 'image|mimes:jpeg,bmp,png|max:2000'
        ]);
    }
}
