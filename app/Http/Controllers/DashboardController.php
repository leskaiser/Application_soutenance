<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class DashboardController extends Controller
{
    public function home()
    {
        return view('dashboard.home');
    }

    public function sendEmail(){
        
    }
}
