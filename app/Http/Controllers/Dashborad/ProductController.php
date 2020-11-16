<?php

namespace App\Http\Controllers\Dashborad;

use App\Http\Controllers\Controller;
use App\Http\Requests\BrandRequest;
use App\Http\Requests\GeneralProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    //

    //
    public function index()
    {
        // $brands = Brand::orderBy('id', 'DESC')->paginate(PAGNIATION_COUNT);
        //   return view('admin.brands.index', compact('brands'));
    }

    public function create()
    {
        $data = [];
        // $categories = Category::parent()->orderBy('id', 'DESC')->get();
        $data['brands'] = Brand::active()->select('id')->get();
        $data['tags'] = Tag::active()->select('id')->get();
        $data['categories'] = Category::active()->select('id')->get();

        //return $data;

        return view('admin.products.general.create', $data);
    }

    public function store(GeneralProductRequest $request)
    {
        try {

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

        return view('admin.brands.edit', compact('brand'));

    }

    public function update($id, BrandRequest $request)
    {

        try {
            //validation

            //update DB

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

            return redirect()->route('admin.brands')->with(['success' => 'تم  الحذف بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.brands')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

}