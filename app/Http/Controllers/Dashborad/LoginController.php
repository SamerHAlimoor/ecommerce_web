<?php

namespace App\Http\Controllers\Dashborad;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminLoginRequest;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    //
    public  function login(){
    return view('admin.auth.prelogin');
    }

    public  function loginDashboard(AdminLoginRequest $request){
     //  return $request;
        // return view('admin.auth.prelogin');

        $remember_me=$request->has('remember_me') ? true : false;
        if(auth()->guard('admin')->attempt(['email'=>$request->input('email'),'password'=>$request->input('password')])){
            return   redirect()->route('admin.dashboard');
        }else{
            return redirect()->back()->with(['error'=>'يوجد هناك خطأ'])->withInput($request->all());

        }
    }
}
