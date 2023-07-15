<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class UserController extends Controller
{
    public function pendingUsers(){
        $pending_users = User::where('status', '=', 0)->get();
        return view('admin.pages.pending_user', compact('pending_users'));
    }

    public function approveUser($id){
        User::where('id', $id)
        
            ->update(['status' => true]);
        return redirect()->back();
    }
}
