<?php

namespace App\Http\Controllers\Dashborad;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    //
    public function editShippingMethods($type)
    {
        // free , inside , outline
     //  return Setting::all();
        if ($type=='free'){
         $methodShipping=   Setting::where('key','free_shipping_lable')->first();
        }
        else if ($type=='inside'){
            $methodShipping=   Setting::where('key','local_lable')->first();
        }
        else {
            $methodShipping=   Setting::where('key','outer_lable')->first();
        }
        return view('admin.settings.shippings.edit',compact('methodShipping'));
    }


    public  function updateShippingMethods(Request $request,$id){

    }
}
