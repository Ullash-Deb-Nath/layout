<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminLayoutController extends Controller
{
    public function dashboard(){
        return view('admin.pages.dashboard');
    }
    public function tables(){
        return view('admin.pages.tables');
    }
    
}
