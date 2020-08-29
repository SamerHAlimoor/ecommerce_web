<?php

namespace App\Http\Controllers\Dashborad;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShippingRequest;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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


    public  function updateShippingMethods(ShippingRequest $request,$id){

        try {
            $shippingMethod=Setting::find($id);
            DB::beginTransaction();
            $shippingMethod->update([
                'plain_value'=>$request->plain_value
            ]);
            $shippingMethod->value=$request->value;
            $shippingMethod->save();
            // return $request;
            DB::commit();
            return redirect()->back()->with(['success'=>'تم الحفظ بنجاح']);
        }catch (\Exception $exception){
            return redirect()->back()->with(['error'=>'فضل الحفظ']);

            DB::rollBack();

        }
    }
}
