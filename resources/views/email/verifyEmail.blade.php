<div>
      <h3>Welcome to Bid N Buy <i>{{$user->fname}}</i> </h3>
      <p>To verify email <a
                  href="{{route('verifyEmail',['email' => $user->email, 'verifyToken' => $user->verify_token])}}">click
                  here</a>
      </p>
</div>