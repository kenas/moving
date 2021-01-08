<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\newEmailNotofication;
use App\Mail\NotoficationForSender;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\EmailRequestValidation;

class ContactFormController extends Controller
{
    
    public function getEmail() {

        return view('pages.contact');

    }

    public function sendEmail(EmailRequestValidation $request) {

        // dd($request);
        $data = [
            'subject' => $request->subject,
            'email' => $request->email,
            'content' => $request->content
        ];


       Mail::to('libor.gess11@gmail.com')->send(new newEmailNotofication($data));
       Mail::to($data['email'])->send(new NotoficationForSender($data));

       return redirect()->back()->with('status', 'Na Váš dotaz bude odpovězeno, jakmile to bude možné. Přeji Vám hezký den.');
    }
 
}