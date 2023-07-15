<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Session;

class AuthController extends Controller
{
    public function login(){
        return view('admin.pages.auth.login');
    }

    public function userLogin(Request $req){
      
        $email = $req->email;
        $password = md5($req->password);
        $user = User::where('email', '=', $email)
            ->where('password', '=', $password)
            ->first();
            if($user){
                // check if user is approved (check value of status coloumn is 1)

                if($user->status == 1){
                    //save user in the session
                    Session::put('user_fname',$user->first_name);
                    Session::put('user_lname',$user->last_name);
                    Session::put('user_email',$user->email);
                    Session::put('user_role',$user->role);
                
                    return redirect('admin/dashboard');

                }
                else{
                    return redirect()->back()->with('error', 'User Not Approved Yet...');

                }

                
            }
            else{
                return redirect()->back()->with('error', 'User Not Found with these credentials...');
            }
    }

    public function teacherRegister(){
        return view('admin.pages.auth.teacher_register');
    }
    public function regristrationTeacher(Request $req){
        if($req->password == $req->conf_password){
            // Check if the submitted email is already in the User table or databse
              $user_exists =  User::where('email', '=', $req->email)->first();
              if($user_exists){
                return redirect()->back()->with('error', 'Email Already Exists!');
              }
              else{
                $user = new User();
                $user->first_name = $req->first_name;
                $user->last_name = $req->last_name;
                $user->email = $req->email;
                $user->password = md5($req->password);
                $user->role = 'Teacher';
                if($user->save()){
                    return redirect()->back()->with('success', 'User Registred. Waiting for Admin Approval');
            }
                  
              }
    
        }
       else {
        return redirect()->back()->with('error', 'Password Mismatch!');
       }
        
    }
    
    public function studentRegister(){
        return view('admin.pages.auth.student_register');
    }
    public function regristrationStudent(Request $req){
        if($req->password == $req->conf_password){
            // Check if the submitted email is already in the User table or databse
              $user_exists =  User::where('email', '=', $req->email)->first();
              if($user_exists){
                return redirect()->back()->with('error', 'Email Already Exists!');
              }
              else{
                $user = new User();
                $user->first_name = $req->first_name;
                $user->last_name = $req->last_name;
                $user->email = $req->email;

                $user->student_id = $req->roll;


                $user->password = md5($req->password);
                $user->role = 'Student';
                if($user->save()){
                    return redirect()->back()->with('success', 'User Registred. Waiting for Admin Approval');
            }
                  
              }
    
        }
       else {
        return redirect()->back()->with('error', 'Password Mismatch!');
       }
    }

    public function logout(Request $request){
        $request->session()->forget(['user_fname', 'user_lname', 'user_email', 'user_role']);
        return redirect('admin/login');
    }
}
