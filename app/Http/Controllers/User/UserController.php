<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hash;
use Auth;
use App\Models\User;
use App\Mail\Websitemail;

class UserController extends Controller
{
    public function dashboard()
    {
        return view('user.dashboard');
    }

    public function registration()
    {
        return view('user.registration');
    }

    public function registration_submit(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|max:255|email|unique:users,email',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ]);

        $token = hash('sha256', time());

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->token = $token;
        $user->save();

        $link = url('registration-verify/'.$token.'/'.$request->email);
        $subject = 'Registration Verification';
        $message = 'Click on the following link to verify your email: <br><a href="' . $link . '">' . $link . '</a>';

        \Mail::to($request->email)->send(new Websitemail($subject, $message));
        return redirect()->back()->with('success', 'Registration successful. Please check your email to verify your account.');
    }

    public function registration_verify($token, $email)
    {
        $user = User::where('email', $email)->where('token', $token)->first();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Invalid token or email');
        }
        $user->token = '';
        $user->status = 1;
        $user->update();

        return redirect()->route('login')->with('success', 'Email verified successfully. You can now login.');
    }

    public function login()
    {
        return view('user.login');
    }

    public function login_submit(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $check = $request->all();
        $data = [
            'email' => $check['email'],
            'password' => $check['password'],
            'status' => 1,
        ];

        if(Auth::guard('web')->attempt($data)){
            return redirect()->route('dashboard');
        } else {
            return redirect()->back()->with('error', 'Invalid credentials');
        }
    }

    public function logout()
    {
        Auth::guard('web')->logout();
        return redirect()->route('login')->with('success', 'Logged out successfully');
    }

    public function forget_password()
    {
        return view('user.forget_password');
    }

    public function forget_password_submit(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::where('email', $request->email)->first();
        if(!$user){
            return redirect()->back()->with('error', 'Email not found');
        }

        $token = hash('sha256', time());
        $user->token = $token;
        $user->update();

        $link = route('reset_password', [$token,$request->email]);
        $subject = 'Reset Password';
        $message = 'Click on the following link to reset your password: <br>';
        $message .= '<a href="'.$link.'">'.$link.'</a>';

        \Mail::to($request->email)->send(new Websitemail($subject,$message));

        return redirect()->back()->with('success', 'Reset password link sent to your email');

    }

    public function reset_password($token, $email)
    {
        $user = User::where('email', $email)->where('token', $token)->first();
        if(!$user){
            return redirect()->route('login')->with('error', 'Invalid token or email');
        }
        return view('user.reset_password', compact('token', 'email'));
    }

    public function reset_password_submit(Request $request, $token, $email)
    {
        $request->validate([
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ]);

        $user = User::where('email', $email)->where('token', $token)->first();
        $user->password = Hash::make($request->password);
        $user->token = '';
        $user->update();

        return redirect()->route('login')->with('success', 'Password reset successfully');
    }

    public function profile()
    {
        return view('user.profile');
    }

    public function profile_submit(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.Auth::guard('web')->user()->id,
        ]);

        $user = User::where('id',Auth::guard('web')->user()->id)->first();

        if($request->photo){
            $request->validate([
                'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $final_name = 'user_'.time().'.'.$request->photo->extension();
            if($user->photo != '') {
                unlink(public_path('uploads/'.$user->photo));
            }
            $request->photo->move(public_path('uploads'), $final_name);
            $user->photo = $final_name;
        }

        if($request->password){
            $request->validate([
                'password' => 'required',
                'confirm_password' => 'required|same:password',
            ]);
            $user->password = Hash::make($request->password);
        }
        
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->city = $request->city;
        $user->state = $request->state;
        $user->country = $request->country;
        $user->zip = $request->zip;
        $user->update();

        return redirect()->back()->with('success', 'Profile updated successfully');
    }
}
