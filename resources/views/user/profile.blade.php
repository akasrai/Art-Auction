@extends('layouts.app')
@section('content')
<div class="container" style="min-height:75vh">
   <div class="col-md-12 dashboard-wrapper clearfix">
      <div class="col-md-3 menu-items-wrapper">
         @include('inc.dashboardSidebar')
      </div>

      <div class="col-md-9 no-mobile-padding">
         <div class="col-md-12 dashboard-content clearfix">
            <h3>
               My Profile
               @if($user->status == 1)
               <i class="glyphicon glyphicon-ok-sign verified-account-icon" title="Verified Account"></i>
               @else
               <small>
                  <a href="javascript:void(0)" onclick="resendVerificationLink()">Resend email verification link</a>
                  <i class="fa fa-spinner fa-spin hide" id="sending-verification-email-icon"></i>
               </small>
               @endif
               <button id="edit-profile" class="btn btn-edit-profile pull-right">Edit</button>
            </h3>

            <div class="col-md-12 no-padding">
               <div class="alert alert-success hide" id="email-sent-success">
                  <i class="glyphicon glyphicon-ok-sign"></i>
               </div>

               <div class="custom-alert-wrapper">
               </div>

               @if (session('status'))
               <div class="alert alert-success">
                  <i class="glyphicon glyphicon-ok-sign"></i>
                  {{ session('status') }}
               </div>
               @endif

               @if (session('error'))
               <div class="alert alert-danger">
                  <i class="glyphicon glyphicon-remove-sign"></i>
                  {{ session('error') }}
               </div>
               @endif
            </div>

            <div class="col-md-3 no-padding">
               <div class="user-profile-image">

                  @if($user->image)
                  <img
                     src="<?php echo url('storage/'.$user->image)?>"
                     id="profile-picture" alt="profile image" />
                  @else
                  <img src="{{ asset('images/profiles/dp.png') }}" alt="profile image" id="profile-picture" />
                  @endif

                  <i class="fa fa-spinner fa-spin hide" id="uploading-profile-image"></i>

                  <div class="change-profile-image">
                     <i class="glyphicon glyphicon-camera"></i> change
                     <input type="file" name="profile-image" id="profile-image-input" size="60" />
                  </div>
               </div>
            </div>

            <div class="col-md-9">

               <div class="col-md-12" style="margin-bottom:20px;">
                  <h2>
                     {{$user->fname}} {{$user->mname}} {{$user->lname}}
                  </h2>
                  <p>E-mail: <b>{{$user->email}}</b>
                     @if($user->status == 1)
                     <i class="glyphicon glyphicon-ok-sign verified-account-icon" style="font-size:13px;"
                        title="Verified Account"></i>
                     @endif
                     <br />
                     Phone: <b>{{$user->phone_no}}</b></p>
                  <div id="address-info">
                     <p><b>Address</b><br />
                        Address Line: <b>{{$user->address_line}}</b><br />
                        City: <b>{{$user->city}}</b><br />
                        State: <b>{{$user->state}}</b><br />
                        Country: <b>{{$user->country}}</b><br />
                        Zip Code: <b>{{$user->postal_code}}</b><br />
                     </p>
                  </div>
               </div>

               <form method="POST" action="{{ route('profile.update') }}" id="edit-profile-form" class="hide">

                  <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}" />
                  <input type="hidden" name="user-id" id="user-id" value="{{ $user->id }}" />
                  <div class="col-md-12 no-padding">
                     <div class="col-md-4">
                        <div class="form-group row">
                           <label for="fname" class="col-sm-12 col-form-label no-padding">First Name</label>
                           <input id="fname" type="text" class="form-control" name="fname" value="{{$user->fname}}"
                              autofocus autocomplete="off" />

                        </div>
                     </div>

                     <div class="col-md-4">
                        <div class="form-group row">
                           <label for="mname" class="col-sm-12 col-form-label no-padding">Middle Name</label>
                           <input id="mname" type="text" class="form-control" name="mname" value="{{$user->mname}}"
                              autofocus autocomplete="off" />

                        </div>
                     </div>

                     <div class="col-md-4">
                        <div class="form-group row">
                           <label for="lname" class="col-sm-12 col-form-label no-padding">Last Name</label>
                           <input id="lname" type="text" class="form-control" name="lname" value="{{$user->lname}}"
                              autofocus autocomplete="off" />

                        </div>
                     </div>

                     <div class="col-md-6">
                        <div class="form-group row">
                           <label for="email" class="col-sm-12 col-form-label no-padding">E-Mail Address</label>
                           <input id="email" type="email"
                              class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"
                              value="{{$user->email}}" autofocus autocomplete="off" title="You cannot change email."
                              disabled />

                           @if ($errors->has('email'))
                           <span class="invalid-feedback">
                              <strong>{{ $errors->first('email') }}</strong>
                           </span>
                           @endif
                        </div>
                     </div>

                     <div class="col-md-6">
                        <div class="form-group row">
                           <label for="phone" class="col-sm-12 col-form-label no-padding">Phone Number</label>
                           <input id="phone" type="number" class="form-control" name="phone" value="{{$user->phone_no}}"
                              autofocus autocomplete="off" />
                        </div>
                     </div>
                  </div>

                  <div class="col-md-12">
                     <div class="form-group row">
                        <label for="address-line" class="col-sm-12 col-form-label no-padding">Address Line</label>
                        <input id="address-line" type="text" class="form-control" name="address-line"
                           value="{{$user->address_line}}" autofocus autocomplete="off" />
                     </div>
                  </div>

                  <div class="col-md-12 no-padding">
                     <div class="col-md-6">
                        <div class="form-group row">
                           <label for="city" class="col-sm-12 col-form-label no-padding">City</label>
                           <input id="city" type="text" class="form-control" name="city" value="{{$user->city}}"
                              autofocus autocomplete="off" />
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group row">
                           <label for="state" class="col-sm-12 col-form-label no-padding">State</label>
                           <input id="state" type="text" class="form-control" name="state" value="{{$user->state}}"
                              autofocus autocomplete="off" />
                        </div>
                     </div>
                  </div>

                  <div class="col-md-12 no-padding">
                     <div class="col-md-6">
                        <div class="form-group row">
                           <label for="country" class="col-sm-12 col-form-label no-padding">Country</label>
                           <input id="country" type="text" class="form-control" name="country"
                              value="{{$user->country}}" autofocus autocomplete="off" />
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group row">
                           <label for="postal-code" class="col-sm-12 col-form-label no-padding">Postal Code</label>
                           <input id="postal-code" type="text" class="form-control" name="postal-code"
                              value="{{$user->postal_code}}" autofocus autocomplete="off" />
                        </div>
                     </div>
                  </div>

                  <div class="col-md-12 no-padding">
                     <div class="col-md-6">
                        <div class="form-group row">
                           <label for="language" class="col-sm-12 col-form-label no-padding">Language</label>
                           <select id="language" class="form-control" name="language">
                              <option value="{{$user->language}}"> {{$user->language}} </option>
                              <option value="np">np</option>
                           </select>
                        </div>
                     </div>

                     <div class="col-md-6">
                        <div class="form-group row">
                           <label for="currency" class="col-sm-12 col-form-label no-padding">Currency</label>
                           <select id="currency" class="form-control" name="currency">
                              <option value="{{$user->currency}}"> {{$user->currency}} </option>
                           </select>
                        </div>
                     </div>
                  </div>

                  <div class="col-md-12 no-padding">
                     <div class="col-md-12">
                        <div class="form-group row">
                           <button class="btn btn-primary col-md-12">UPDATE</button>
                        </div>
                     </div>
                  </div>
            </div>
            </form>
         </div>
      </div>
   </div>

</div>
</div>
</div>
@endsection
@section('scripts')
<script>
   function resendVerificationLink() {
      $("#sending-verification-email-icon").removeClass("hide");

      $.ajax({
         type: "GET",
         url: "{{url('resend-email-verification-link')}}",
         success: function(response) {
            if (response.status == 200) {
               $("#email-sent-success").removeClass('hide');
               $("#email-sent-success").delay(5000).fadeOut();
               $("#email-sent-success").append(response.message);
            }
            $("#sending-verification-email-icon").addClass("hide");
         },
         error: function(response) {}

      });
   }

   $("#profile-image-input").change(function(e) {
      if (this.disabled) {
         return alert('File upload not supported!');
      }
      if (this.files && this.files[0]) {
         readImage(this.files[0]);
      }
   });

   function readImage(file) {
      var reader = new FileReader();
      var image = new Image();

      reader.readAsDataURL(file);
      reader.onload = function(_file) {
         image.src = _file.target.result;
         image.onload = function() {
            var w = this.width,
               h = this.height,
               t = file.type,
               n = file.name,
               s = ~~(file.size / 1024) + 'KB';
            $("#profile-picture").attr("src", this.src);
            uploadProfileImage();
         };

         image.onerror = function() {
            let invalidImageMessage =
               '<div class="alert alert-danger custom-alert-box"><i class="glyphicon glyphicon-remove-sign"></i> Invalid file type: ' +
               file.type +
               '</div>';
            $(".custom-alert-wrapper").html(invalidImageMessage);
            $(".alert").delay(5000).fadeOut();
         };
      };
   }

   function uploadProfileImage() {
      let form = new FormData();
      form.append('userId', getValueOf("user-id"));
      form.append('_token', getValueOf("_token"))
      form.append('image', $("#profile-image-input")[0].files[0]);

      $("#uploading-profile-image").removeClass("hide");

      $.ajax({
         type: "POST",
         url: "{{url('upload-profile-image')}}",
         data: form,
         cache: false,
         contentType: false,
         processData: false,
         success: function(response) {
            let message = "";
            if (response.status == 200) {
               message =
                  '<div class="alert alert-success custom-alert-box"><i class="glyphicon glyphicon-ok-sign"></i> ' +
                  response.message +
                  '</div>';
            } else {
               message =
                  '<div class="alert alert-danger custom-alert-box"><i class="glyphicon glyphicon-remove-sign"></i> ' +
                  response.message +
                  '</div>';
            }
            $(".custom-alert-wrapper").html(message);
            $(".alert").delay(5000).fadeOut();
            $("#uploading-profile-image").addClass("hide");
         },
         error: function(response) {}
      });
   }

   function getValueOf(id) {
      return $("#" + id).val();
   }


   $("#edit-profile").click(function() {
      $("#address-info").toggleClass("hide");
      $("#edit-profile-form").toggleClass("hide");
      let buttonText = $("#edit-profile").text() == "Edit" ? "Cancel" : "Edit"
      $("#edit-profile").text(buttonText);
   });
</script>
@endsection