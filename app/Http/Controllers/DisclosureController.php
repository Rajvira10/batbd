<?php

namespace App\Http\Controllers;

use App\Models\Disclosure;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DisclosureController extends Controller
{
    public function index()
    {
        $disclosure = Disclosure::firstOrCreate(
            ['id' => 1],
            [
                'terms_and_conditions' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit',
                'privacy_policy' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit'
            ]
        );

        return inertia('Disclosure', [
            'disclosure' => $disclosure
        ]);
    }

    public function admin(Request $request)
    {
        $request->session()->now('view_name', 'admin.disclosures.disclosure.index');
        
        $disclosure = Disclosure::firstOrCreate(
            ['id' => 1],
            [
                'terms_and_conditions' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit',
                'privacy_policy' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit'
            ]
        );

        return view('admin.disclosures.disclosure.index', compact('disclosure'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'terms_and_conditions' => 'required',
            'privacy_policy' => 'required'
        ]);

        $disclosure = Disclosure::first();

        $disclosure->terms_and_conditions = $request->terms_and_conditions;
        $disclosure->privacy_policy = $request->privacy_policy;

        $disclosure->save();

        return redirect()->back()->with('message', 'Disclosure updated successfully');
    }
}
