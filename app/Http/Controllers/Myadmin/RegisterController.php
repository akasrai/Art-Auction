<?php

namespace App\Http\Controllers\Myadmin;

use App\Admin;
use App\Role;
use App\Role_admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

   use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('superadmins'); //for role access

    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        // dump($data);
        // die();
        return Validator::make($data, [
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

   /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {

       // Session::flash('status','Registered Successfully! now verify your email to activate your account.');

        $admin = Admin::create([
            'fname' => $data['fname'],
            'lname' => $data['lname'],
            'email' => $data['email'],
            'password' => bcrypt($data['password'])
           
        ]);

        // sending email link to verify a/c
        $thisAdmin = Admin::findOrFail($admin->id);
       
        // updating the role table
        $role_admin = new Role_admin;
        $role_admin->role_id = $data['role'];
        $role_admin->admin_id = $thisAdmin['id'];
        $role_admin->save();

        
        return $admin;
    }

    public function register(Request $request)
    {

        $this->validator($request->all())->validate();
       // $user = $this->create($request->all());
        event(new Registered($user = $this->create($request->all())));
        
        return redirect('/admin/register')->with('success','Admin created successfully.');

        // optional way
        //$this->guard()->login($user); //changed for email verification
        //return redirect(route('login'));
        
        //return $this->registered($request, $user)
                   //     ?: redirect($this->redirectPath());
       

      //   $this->validate($request,[
      //       'fname' => 'required|string|max:255',
      //       'lname' => 'required|string|max:255',
      //       'email' => 'required|string|email|max:255|unique:users',
      //       'password' => 'required|string|min:6|confirmed',
      //   ]);

      //   $enc_pass = bcrypt($request['password']);
      //   //create admin
      //   $admin = new Admin;
      //   $admin->fname = $request->input('fname');
      //   $admin->lname = $request->input('lname');
      //   $admin->email = $request->input('email');
      //   $admin->password = $enc_pass;
      //   $admin->save();

      //   $adminId = Admin::where('email',$request->input('email'))->get();
      
      // // updating the role table
      //   foreach ($adminId as $aid) {
            
      //       $adminId = $aid->id;
      //   }
      //   $role_admin = new Role_admin;
      //   $role_admin->role_id = $request->input('role');
      //   $role_admin->admin_id = $adminId;
      //   $role_admin->save();

      //   return redirect('/admin')->with('success','Admin created.');
    }

    public function showRegistrationForm(){

        $roles = Role::all();
        return view('myadmin.register')->with('roles',$roles);    
    }
}
