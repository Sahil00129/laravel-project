<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function customers()
    {
        if(Auth::check()){
        return view ('customers');
        }
        return redirect("/")->withSuccess('Opps! You do not have access');
    } 

    public function getPdf()
     {
        if(Auth::check()){
        return view ('getPdf');
        }
    return redirect("/")->withSuccess('Opps! You do not have access');
     }

}
