<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\MessageReceived;

class MessageController extends Controller
{
    /* se puede obtener el request asi ...
    public function store(Request $request){

        return $request->get('name') == 'Jorge' ? "Correcto" : "Incorrecto";

    }
    
    o asi ... */

    public function store(){
        //return request("name") == 'Jorge' ? "Correcto" : "Incorrecto";

        $msg = request()->validate([
            'name' => 'required',
            'email' => 'required|email', // asi agregamos mas validaciones tambien puede ser como [..,..]
            'subject' => 'required',
            'content' => 'required|min:3'
        ]);

        Mail::to('gadesito@gmail.com')->send(new MessageReceived($msg));

        return back()->with('status', 'Recibimos tu mensaje');
    }
}
