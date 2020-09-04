<?php

namespace App\Http\Controllers\Dashborad;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubCategoriesRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubCategoriesController extends Controller
{
    //
    public function index()
    {
        $categories = Category::child()->orderBy('id','DESC') -> paginate(PAGNIATION_COUNT);
        return view('admin.sub_categories.index', compact('categories'));
    }

    public function create()
    {
        $categories = Category::parent()->orderBy('id','DESC') -> get();
        return view('admin.sub_categories.create',compact('categories'));
    }


    public function store(SubCategoriesRequest $request)
    {
       // return $request;
        try{

            # code...
            DB::beginTransaction();

            if (!$request->has('active'))
                $request->request->add(['active' => 0]);
            else
                $request->request->add(['active' => 1]);

            $sub_category = Category::create($request->except('_token'));
            $sub_category->name=$request->name;
            $sub_category->save();
            // save image




            DB::commit();
            return redirect()->route('admin.subcategories')->with(['success' => 'تم إضافة القسم بنجاح']);

        }catch(\Exception $ex){
            DB::rollback();
            return redirect()->route('admin.subcategories')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);

        }

    }


    public function edit($id)
    {


        //get specific categories and its translations
        $category = Category::orderBy('id', 'DESC')->find($id);

        if (!$category)
            return redirect()->route('admin.subcategories')->with(['error' => 'هذا القسم غير موجود ']);

        $categories = Category::parent()->orderBy('id','DESC') -> get();


        return view('admin.sub_categories.edit', compact('category','categories'));

    }


    public function update($id, SubCategoriesRequest $request)
    {

        try {
            //validation

            //update DB
            $category = Category::find($id);

            if (!$category)
                return redirect()->route('admin.subcategories')->with(['error' => 'هذا القسم غير موجود']);

            if (!$request->has('active'))
                $request->request->add(['active' => 0]);
            else
                $request->request->add(['active' => 1]);

            $category->update($request->all());
            $category->name=$request->name;
            $category->save();

            return redirect()->route('admin.subcategories')->with(['success' => 'تم ألتحديث بنجاح']);
        } catch (\Exception $ex) {

            return redirect()->route('admin.subcategories')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }

    }


    public function destroy($id)
    {

        try {
            //get specific categories and its translations
            $category = Category::orderBy('id', 'DESC')->find($id);

            if (!$category)
                return redirect()->route('admin.subcategories')->with(['error' => 'هذا القسم غير موجود ']);

            $category->delete();

            return redirect()->route('admin.subcategories')->with(['success' => 'تم  الحذف بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.subcategories')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

}
