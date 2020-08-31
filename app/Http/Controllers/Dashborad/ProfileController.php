<?php

namespace App\Http\Controllers\Dashborad;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Models\Admin;


class ProfileController extends Controller
{
    //
    public function editProfile(){
   $currentUser= auth('admin')->user() ->id;
   $admin=Admin::find($currentUser);
   return view('admin.profile.edit',compact('admin'));
    }


    public function updateProfile(ProfileRequest $request){
        try {
            $admins = Admin::find(auth('admin')->user()->id);
            if ($request->filled('password')){
                $request->merge(['password'=>bcrypt($request->password)]);
            }else{
                unset($request['password']);

            }
            unset($request['id']);
            unset($request['password_confirmation']);
          //  return $request;
            $admins->update($request->all());

            return redirect()->back()->with(['success'=>'تم الحفظ بنجاح']);
        }catch (\Exception $exception){
          //  return $exception;
         return redirect()->back()->with(['error'=>'قشل الحفظ']);

        }
    }

}
