<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\EmailRequestValidation;
use Illuminate\Support\Facades\Mail;
use App\Mail\sendContactForm;

class ContactFormController extends Controller
{
    
    public function getEmail() {

        return view('pages.contact');

    }

    public function sendEmail(EmailRequestValidation $request) {

        $data = [
            'subject' => $request->subject,
            'email' => $request->email,
            'content' => $request->content
        ];


        Mail::to('test@test.cz')->send(new sendContactForm($data));
        // Mail::send('pages.sendFormContact', $data, function($message) use ($data) {
        //     $message->from($data['email']);
        //     $message->to('VladimirHavrda@seznam.cz');
        //     $message->subject($data['subject']);
        // });


    }
 
}
