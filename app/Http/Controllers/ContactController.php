<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use App\Models\Contact;
// use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function create()
    {
      return view('contact');
    }

    public function store()
    {
      $data = array();
      $data['success'] = 0;
      $data['errors'] = [];
      $rules = [
        'first_name' => 'required',
        'last_name' => 'required',
        'email' => 'required',
        'subject' => 'nullable|min:5|max:50',
        'message' => 'required|min:5|max:500',
      ];

      $validated = Validator::make(request()->all(), $rules);

      if($validated->fail())
      {
        $data['errors']['first_name'] = $validated->errors()->first('first_name');
        $data['errors']['last_name'] = $validated->errors()->first('last_name');
        $data['errors']['email'] = $validated->errors()->first('email');
        $data['errors']['subject'] = $validated->errors()->first('subject');
        $data['errors']['message'] = $validated->errors()->first('message');
      }
      else
      {
        $attributes = $validated->validated();
        Contact::create($attributes);

        Mail::to( env('ADMIN_EMAIL') )->send(new ContactMail(
            $attributes['first_name'],
            $attributes['last_name'],
            $attributes['email'],
            $attributes['subject'],
            $attributes['message']
          ));
          $data['success'] = 1;
          $data['message'] = '문의해 주셔서 감사합니다.';
      }
        return response()->json($data);
    }
}
