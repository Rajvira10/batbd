<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\EmailVerification;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AuthenticationController extends Controller
{
    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required | email',
            'password' => 'required | string'
        ], [
            'email.required' => 'Please enter your email !',
            'email.email' => 'Please enter a valid email !',
            'password.required' => 'Please enter your password !',
            'password.string' => 'Only alphabets, numbers & special characters are allowed. Must be a string !'
        ]);

        if(Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password]))
        {
            $request->session()->regenerate();

            return redirect()->route('home')->with('message', ['type' => 'success', 'content' => 'Login successful !']);
        }

        return redirect()->route('login')->with('message', ['type' => 'danger', 'content' => 'Invalid credentials !']);
    }

    public function register(Request $request)
    {
        $request->validate([
            'full_name' => 'required | string',
            'preferred_name' => 'required | string',
            'email' => 'required | email | unique:users,email',
            'mobile_number' => 'required | string',
            'date_of_birth' => 'required',
            'gender' => 'required | string',
            'date_of_joining' => 'required',
            'date_of_leaving' => 'nullable',
            'function' => 'required | string',
            'password' => 'required | string | min:8'
        ], [
            'full_name.required' => 'Please enter your full name !',
            'full_name.string' => 'Only alphabets, numbers & special characters are allowed. Must be a string !',
            'preferred_name.required' => 'Please enter your preferred name !',
            'preferred_name.string' => 'Only alphabets, numbers & special characters are allowed. Must be a string !',
            'mobile_number.required' => 'Please enter your mobile number !',
            
            'email.required' => 'Please enter your email !',
            'email.email' => 'Please enter a valid email !',
            'email.unique' => 'This email is already registered !',
            'mobile_number.string' => 'Only alphabets, numbers & special characters are allowed. Must be a string !',
            'date_of_birth.date' => 'Please enter a valid date !',
            'date_of_joining.date' => 'Please enter a valid date !',
            'date_of_leaving.date' => 'Please enter a valid date !',
            'function.string' => 'Only alphabets, numbers & special characters are allowed. Must be a string !',
            'password.required' => 'Please enter your password !',
            'password.string' => 'Only alphabets, numbers & special characters are allowed. Must be a string !',
            'password.min' => 'Password must be at least 8 characters long !',
        ]);

        $user = new User();
        $user->full_name = $request->full_name;
        $user->preferred_name = $request->preferred_name;
        $user->email = $request->email;
        $user->mobile_number = $request->mobile_number;
        $user->date_of_birth = Carbon::parse($request->date_of_birth)->format('Y-m-d');
        $user->gender = $request->gender;
        $user->date_of_joining = Carbon::parse($request->date_of_joining)->format('Y-m-d');
        $user->date_of_leaving = Carbon::parse($request->date_of_leaving)->format('Y-m-d');
        $user->function = $request->function;
        $user->password = bcrypt($request->password);
        $user->save();

        Auth::guard('web')->login($user);

        Mail::to($user->email)->send(new EmailVerification($user));
        
        return redirect()->route('email-confirmation', $user)->with('message', ['type' => 'success', 'content' => 'Registration successful !']);
    }

    public function emailConfirmation(Request $request, User $user)
    {
        $email = $user->email;
        $user_verified = $user->hasVerifiedEmail();
        return inertia('EmailConfirmation', ['email' => $email, 'user_verified' => $user_verified]);
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
