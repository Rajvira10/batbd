<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MemberController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('full_name', 'like', "%$search%");
        }

        if ($request->has('sort')) {
            $sort = $request->input('sort');
            $sortDirection = $request->input('direction', 'desc');
            $query->orderBy($sort, $sortDirection);
        }

        $users = $query->where('id', '!=', auth()->id())
            ->where('email_verified_at', '!=', null);

        $users = $query->paginate(24);
        return inertia('Members', ['users' => $users, 'search' => $request->input('search'), 'sort' => $request->input('sort'), 'direction' => $request->input('direction')]);
    }

    public function show(Request $request, $user_id)
    {
        $user = User::with('galleries')->findOrFail($user_id);
        $user->gallery = $user->galleries->pluck('image')->toArray();
        $user->country = $user->country->id ?? null;
        $countries = Country::all();
        return inertia('Member', ['user' => $user, 'countries' => $countries]);
    }
}

