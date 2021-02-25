<?php

namespace App\Http\Controllers\Support;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function send(Request $req)
    {
        $email = $req->email;
        $text = $req->text;
        $obj = $req->obj;
        $lastname= $req->lastname;
        $firstname= $req->firstname;
        
        file_get_contents("http://frugality.tech/contactMail.php?action=support&email=$email&text=$text&lastname=$lastname&firstname=$firstname&obj=$obj");

        file_get_contents("http://frugality.tech/contactMail.php?action=confirm&email=$email&lastname=$lastname&firstname=$firstname");


        return response()->json([
            'data' => "email send"
        ]);
    }
}
