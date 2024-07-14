<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

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

        $users = $query
            ->where('account_verified_at', '!=', null);

        $users = $query->paginate(24);

        $user = User::find(auth()->id());

        return inertia('Members', ['users' => $users, 'user'=> $user, 'search' => $request->input('search'), 'sort' => $request->input('sort'), 'direction' => $request->input('direction')]);
    }

    public function show(Request $request, $user_id)
    {
        $user = User::with('galleries')->findOrFail($user_id);
        $user->gallery = $user->galleries->pluck('image')->toArray();
        $user->country = $user->country->id ?? null;
        $countries = Country::all();
        return inertia('Member', ['user' => $user, 'countries' => $countries]);
    }

    public function admin(Request $request)
    {
        $request->session()->now('view_name', 'admin.member.members.index');
        
        if($request->ajax()){

            $users = User::orderBy('created_at', 'desc')
            ->get();

            return DataTables::of($users)
                ->addColumn('email_verified', function($user){
                    if($user->email_verified_at){
                        return '<span class="badge bg-success">Approved</span>';
                    }else{
                        return '<span class="badge bg-warning">Pending</span>';
                    }
                })                
                ->addColumn('account_verified', function($user){
                    if($user->account_verified_at){
                        return '<span class="badge bg-success">Approved</span>';
                    }else{
                        return '<span class="badge bg-warning">Pending</span>';
                    }
                })

                
                ->addColumn('action', function ($category) {
                    if($category->roles->contains('name', 'super_admin'))
                    {
                        return '';
                    }

                    $edit_button = '<div class="dropdown d-inline-block">
                                        <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="ri-more-fill align-middle"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">';
                    if($category->email_verified_at && !$category->account_verified_at){
                        $edit_button .= '<li>
                                        <button type="submit" class="dropdown-item delete-item-btn" onclick="approveMember(' . $category->id . ')">
                                            <i class="ri-check-fill align-bottom me-2 text-success"></i> Approve
                                        </button>
                                    </li>';
                    }

                    $edit_button .= '<li>
                                    <a href="' . route('users.user_roles', $category->id) . '" class="dropdown-item">
                                        <i class="ri-group-fill align-bottom me-2 text-success"></i> Assign Roles
                                    </a>
                                </li>';

                    $edit_button .= '<li>
                                        <button type="submit" class="dropdown-item delete-item-btn" onclick="deleteMember(' . $category->id . ')">
                                            <i class="ri-delete-bin-6-fill align-bottom me-2 text-danger"></i> Delete
                                        </button>
                                    </li>';
                    $edit_button .= '</ul></div>';
                    return $edit_button;
                })
                ->addIndexColumn()
                ->rawColumns(['action', 'email_verified', 'account_verified'])
                ->make(true);
        }

        return view('admin.members.member.index');
    }

    public function approve(Request $request)
    {
        if($request->ajax())
        {
            $user = User::find($request->member_id);
            $user->account_verified_at = now();
            $user->save();
            return response()->json(['success' => 'Member approved successfully !']);
        }
    }

    public function userRoles(Request $request, $user_id)
    {
        // if(!in_array('user.assign_role', session('user_permissions')))
        // {
        //     return redirect()->route('admin.home')->with('error', 'You are not authorized');
        // }
        
        $request->session()->now('view_name', 'admin.member.members.index');
        
        try{
            $member = User::find($user_id);

            $roles = Role::select(
                'id',
                'name',
                'description',
            )->get();
            
            $member_roles_array = $member->roles->pluck('id')->toArray();

            return view('admin.members.member.userRoles', compact('roles', 'member_roles_array', 'member'));
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    public function assignRoles(Request $request, $user_id)
    {
        $request->session()->now('view_name', 'admin.member.members.index');
        
        try{
            $user = User::find($user_id);

            if($user != null){

                $user->roles()->sync($request->roles);
    
                return redirect()->route('admin.members')->with('success', 'User roles assigned successfully.');
            }
            else{
                return redirect()->route('admin.members')->with('error', 'User not found.');
            }
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }
}

