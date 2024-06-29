<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user()->load('country', 'galleries');
        $user->country = $user->country->id ?? null;
        $user->gallery = $user->galleries->pluck('image')->toArray();
        $countries = Country::all();
        return inertia('Home', ['user' => $user, 'countries' => $countries]);
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'full_name' => 'required | string',
            'preferred_name' => 'required | string',
            'mobile_number' => 'required | string',
            'date_of_birth' => 'required',
            'date_of_joining' => 'required',
            'date_of_leaving' => 'required',
            'function' => 'required | string',
            'anniversary' => 'nullable',
            'other_functions' => 'nullable',
            'facebook_profile' => 'nullable',
            'country' => 'nullable',
            'whatsapp_number' => 'nullable',
            'spouse_dob' => 'nullable',
            'first_child_name' => 'nullable',
            'second_child_name' => 'nullable',
            'third_child_name' => 'nullable',
            'fun_fact_about_you' => 'nullable',
            'profile_image' => 'nullable',
            'cover_image' => 'nullable'
        ], [
            'full_name.required' => 'Please enter your full name !',
            'full_name.string' => 'Only alphabets, numbers & special characters are allowed. Must be a string !',
            'preferred_name.required' => 'Please enter your preferred name !',
            'preferred_name.string' => 'Only alphabets, numbers & special characters are allowed. Must be a string !',
            'mobile_number.required' => 'Please enter your mobile number !',
            'date_of_birth.required' => 'Please enter your date of birth !',
            'date_of_joining.required' => 'Please enter your date of joining !',
            'function.required' => 'Please enter your function !'
        ]);

        $user = auth()->user();
        $user->full_name = $request->full_name;
        $user->preferred_name = $request->preferred_name;
        $user->mobile_number = $request->mobile_number;
        $user->date_of_birth = $request->date_of_birth;
        $user->date_of_joining = Carbon::parse($request->date_of_joining)->format('Y-m-d');
        $user->date_of_leaving = Carbon::parse($request->date_of_leaving)->format('Y-m-d');
        $user->function = $request->function;
        $user->anniversary = Carbon::parse($request->anniversary)->format('Y-m-d');
        $user->other_functions = $request->other_functions;
        $user->facebook_profile = $request->facebook_profile;
        $user->country_id = $request->country;
        $user->whatsapp_number = $request->whatsapp_number;
        $user->spouse_dob = Carbon::parse($request->spouse_dob)->format('Y-m-d');
        $user->first_child_name = $request->first_child_name;
        $user->second_child_name = $request->second_child_name;
        $user->third_child_name = $request->third_child_name;
        $user->fun_fact_about_you = $request->fun_fact_about_you;

        if($request->hasFile('profileImage'))
        {   
            $old_profile_image = $user->profile_image;
            if($old_profile_image)
            {
                unlink(public_path($old_profile_image));
            }

            $profile_image = $request->file('profileImage');
            $profile_image_name = time().'_'.$profile_image->getClientOriginalName();
            $profile_image->move(public_path('images/profile'), $profile_image_name);
            $relative_path = '/images/profile/'.$profile_image_name;
            $user->profile_image = $relative_path;
        }

        if($request->hasFile('coverImage'))
        {
            $old_cover_image = $user->cover_image;
            if($old_cover_image)
            {
                unlink(public_path($old_cover_image));
            }

            $cover_image = $request->file('coverImage');
            $cover_image_name = time().'_'.$cover_image->getClientOriginalName();
            $cover_image->move(public_path('images/cover'), $cover_image_name);
            $relative_path = '/images/cover/'.$cover_image_name;
            $user->cover_image = $relative_path;
        }
        
        $gallery = $request->gallery;
        if($gallery!=null)
        {
            foreach($gallery as $image)
            {
                $image_name = time().'_'.$image->getClientOriginalName();
                $image->move(public_path('images/gallery'), $image_name);
                $relative_path = '/images/gallery/'.$image_name;
                $user->galleries()->create(['image' => $relative_path]);
            }
        }

        $user->save();

        return redirect()->route('home')->with('message', ['type' => 'success', 'content' => 'Profile updated successfully !']);
    }
}
