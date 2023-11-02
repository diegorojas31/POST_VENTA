<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\TestEmail;
use Illuminate\Support\Facades\Mail;



class MailController extends Controller
{
    //

    public function getMail(){
        $data=['name'=>'diego'];
        Mail::to('diegorojasrios31@gmail.com')->send(new TestEmail($data));
        return 'CORREO ENVIADO EXITOSMENTE';
    }
}
