<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\Test;

class ContactController extends Controller
{
    public function create()
    {
      return view('contact');
    }

    public function store()
    {
      Contact::create(
          request()->validate([
          'first_name' => 'required',
          'last_name' => 'required',
          'email' => 'required',
          'subject' => 'nullable|min:5|max:50',
          'message' => 'required|min:5|max:500',
        ])
      );

      Mail::to("jiyeonyee0312@gmail.com")->send(new Test("Youngrong"));

      return redirect()->route('contact.create')->with('success', '내용이 전달되었습니다.')
    }
}
