<!--sends this view to email of user-->
To verify email <a href="{{route('sendEmailDone',["email" => $user->email, "verifyToken" => $user->verify_token])}}">click</a>