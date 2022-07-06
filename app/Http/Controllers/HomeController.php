<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function adminHome()
    {
        $posts = Contact::all();
//        dd($posts);
        return view('adminHome', compact("posts"));
    }

    public function changeStatus(Request $request)
    {
        $contact = Contact::find($request->id);
//        dd($contact);
        $contact->status = $request->status;
        $contact->save();

        return response()->json(['success'=>'Status change successfully.']);
    }

    public function send_mail(Request $request)
    {
        $this->validate($request, [
            'fullname' => ['required', 'string', 'max:255' ],
            'email' => ['required', 'string', 'email', 'max:255' ],
            'subject' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:255']
        ]);

        $contact = [
            'fullname' => $request['fullname'],
            'email' => $request['email'],
            'subject' => $request['subject'],
            'message' => $request['message'],
            'attachment' => $request->file('attachment')->store('contact', 'public')
        ];

        $contactDb = [
            'name' => $request['fullname'],
            'email' => $request['email'],
            'subject' => $request['subject'],
            'message' => $request['message'],
            'attachment' => $request->file('attachment')->store('contact', 'public'),
            'fileurl' => Storage::url($request->file('attachment')->store('contact', 'public')),
        ];

//        dd($contactDb);
        Contact::create($contactDb);

        Mail::to('ukr.opa@gmail.com')->send(new ContactFormMail($contact));

        return redirect()->back()->with('status', 'Ваше повідомлення відпавлено');
    }

}
