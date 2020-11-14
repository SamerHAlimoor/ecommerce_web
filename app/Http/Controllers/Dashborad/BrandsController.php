<?php

namespace App\Http\Controllers\Dashborad;

use App\Http\Controllers\Controller;
use App\Http\Requests\BrandRequest;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BrandsController extends Controller
{
    //

    //
    public function index()
    {
        $brands = Brand::orderBy('id', 'DESC')->paginate(PAGNIATION_COUNT);
        return view('admin.brands.index', compact('brands'));
    }

    public function create()
    {
        // $categories = Category::parent()->orderBy('id', 'DESC')->get();
        return view('admin.brands.create');
    }

    public function store(BrandRequest $request)
    {

        //  return $request;

        # code...
        try {
            DB::beginTransaction();

            if (!$request->has('is_active')) {
                $request->request->add(['is_active' => 0]);
            } else {
                $request->request->add(['is_active' => 1]);
            }

            // save photo
            $fileName = "";
            if ($request->has('photo')) {
                $fileName = uploadImage('brands', $request->photo);
            }
            //   return $fileName;
            $brand = Brand::create($request->except('_token', 'photo'));
            //save translation
            $brand->name = $request->name;
            $brand->photo = $fileName;
            // return $request;
            $brand->save();
            // save image

            DB::commit();
            return redirect()->route('admin.brands')->with(['success' => 'تم إضافة القسم بنجاح']);
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->route('admin.brands')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }

    }

    public function edit($id)
    {

        //get specific categories and its translations
        $brand = Brand::orderBy('id', 'DESC')->find($id);

        if (!$brand) {
            return redirect()->route('admin.brands')->with(['error' => 'هذا القسم غير موجود ']);
        }

        return view('admin.brands.edit', compact('brand'));

    }

    public function update($id, BrandRequest $request)
    {

        try {
            //validation

            //update DB
            $brand = Brand::find($id);

            if (!$brand) {
                return redirect()->route('admin.brands')->with(['error' => 'هذا القسم غير موجود']);
            }
            DB::beginTransaction();

            if (!$request->has('is_active')) {
                $request->request->add(['is_active' => 1]);
            } else {
                $request->request->add(['is_active' => 0]);
            }

            // update  photo
            if ($request->has('photo')) {
                $fileName = uploadImage('brands', $request->photo);
                Brand::where('id', $id)->update([
                    'photo' => $fileName,
                ]);
            }
            $brand->update($request->except('_token', 'id', 'photo'));
            $brand->name = $request->name;
          //  return $request;
            $brand->save();
            DB::commit();

            return redirect()->route('admin.brands')->with(['success' => 'تم التعديل  بنجاح']);

        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->route('admin.brands')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }

    }

    public function destroy($id)
    {

        try {
            //get specific categories and its translations
            $brand = Brand::find($id);

            if (!$brand) {
                return redirect()->route('admin.brands')->with(['error' => 'هذا القسم غير موجود ']);
            }

            $brand->delete();

            return redirect()->route('admin.brands')->with(['success' => 'تم  الحذف بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.brands')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

}