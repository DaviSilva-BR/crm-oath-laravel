<?php

namespace App\Http\Controllers;

use App\Http\Requests\SendEmailRequest;
use App\Mail\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
class ContactController extends Controller
{
    public function index(){
        return view("welcome");
    }

    public function store(SendEmailRequest $request){ 
        $send = Mail::to('davigabriel.sp@outlook.com', 'Davi')->send(new Contact([
            'fromName' => $request->input('name'),
            'fromEmail' => $request->input('email'),
            'subject' => $request->input('subject'),
            'message' => $request->input('message'),
            'attachments' => $request->file('files'),
        ]));

        return redirect()->route('site.index')->with('success', '');
    }
}
