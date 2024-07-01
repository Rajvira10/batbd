<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class ContactController extends Controller
{
    public function index()
    {
        return inertia('Contact');
    }

    public function store(Request $request)
    {
        $request->validate([
            'message' => 'required'
        ]);

        $contact = new Contact();
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->phone = $request->phone_number;
        $contact->subject = $request->subject;
        $contact->message = $request->message;

        $contact->save();

        return redirect()->route('home')->with('message', ['type' => 'success', 'content' => 'Your message has been sent.']);
    }

    public function admin(Request $request)
    {
        $request->session()->now('view_name', 'admin.contacts.contact.index');
        
        if($request->ajax()){

            $contacts = Contact::orderBy('created_at', 'desc')
            ->get();

            return DataTables::of($contacts)
                
                ->addColumn('action', function ($category) {

                    $edit_button = '<div class="dropdown d-inline-block">
                                        <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="ri-more-fill align-middle"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">';
                    $edit_button .= '<li><a href="'.route('admin.contact.show', $category->id).'" class="dropdown-item">
                    <i class="ri-eye-fill pt-2 me-2"></i>View</a></li>';
                    $edit_button .= '</ul></div>';
                    return $edit_button;
                })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.contacts.contact.index');
    }

    public function show(Request $request, $contact_id)
    {
        $contact = Contact::findOrFail($contact_id);

        return view('admin.contacts.contact.show', compact('contact'));
    }
}
