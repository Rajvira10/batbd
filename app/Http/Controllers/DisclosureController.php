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
}
