<?php

namespace App\Http\Controllers\Dashborad;

use App\Http\Controllers\Controller;
use App\Http\Requests\MainCategoriesRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MainCategoriesController extends Controller
{
    //
    public function index()
    {
        # code...
        $categories = Category::with('mainParent')->orderBy('id', 'DESC')->paginate(PAGNIATION_COUNT);
        return view('admin.main_categories.index', compact('categories'));
    }

    public function create()
    {
        # code...categories
        $categories = Category::select('id', 'parent_id')->get();
        return view('admin.main_categories.create', compact('categories'));
    }

    public function store(MainCategoriesRequest $request)
    {

        try {

            # code...
            DB::beginTransaction();

            if (!$request->has('active')) {
                $request->request->add(['active' => 0]);
            } else {
                $request->request->add(['active' => 1]);
            }

            $fileName = "";
            if ($request->has('photo')) {
                $fileName = uploadImage('categories', $request->photo);
            }
            // update date

//            if ($request->has('photo')) {
            //                $filePath = uploadImage('maincategories', $request->photo);
            //                MainCategorie::where('id', $id)
            //                    ->create([
            //                        'photo' => $filePath,
            //                    ]);
            //    CategorieyType::mainCategory        }
            if ($request->type == 1) {
                $request->request->add(['parent_id' => null]);
            }

            $main_category = Category::create($request->except('_token', 'photo'));
            $main_category->name = $request->name;
            $main_category->photo = $fileName;
            $main_category->save();
            // save image

            DB::commit();
            return redirect()->route('admin.main.categories')->with(['success' => 'تم إضافة القسم بنجاح']);

        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->route('admin.main.categories')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);

        }
    }

    public function edit($id)
    {
        # code...
        $catogrie = Category::find($id);
        if (!$catogrie) {
            return redirect()->route('admin.main.categories')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);

        }
        return view('admin.main_categories.edit', compact('catogrie'));

    }

    public function update($id, MainCategoriesRequest $request)
    {
//
        try {
            $main_category = Category::orderBy('id', 'DESC')->find($id);

            if (!$main_category) {
                return redirect()->route('admin.main.categories')->with(['error' => 'هذا القسم غير موجود ']);
            }

            if (!$request->has('active')) {
                $request->request->add(['active' => 0]);
            } else {
                $request->request->add(['active' => 1]);
            }

            // update date

//            if ($request->has('photo')) {
            //                $filePath = uploadImage('maincategories', $request->photo);
            //                MainCategorie::where('id', $id)
            //                    ->update([
            //                        'photo' => $filePath,
            //                    ]);
            //            }

            $main_category->update($request->all());
            $main_category->name = $request->name;
            $main_category->save();
            // save image

            return redirect()->route('admin.main.categories')->with(['success' => 'تم ألتحديث بنجاح']);
        } catch (\Exception $ex) {

            return redirect()->route('admin.main.categories')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

    public function destroy($id)
    {
        # code...

        try {

            $maincategory = Category::orderBy('id', 'DESC')->find($id);

            if (!$maincategory) {
                return redirect()->route('admin.main.categories')->with(['error' => 'هذا القسم غير موجود ']);
            }

//            $vendors = $maincategory->vendors();
            //            if (isset($vendors) && $vendors->count() > 0) {
            //                return redirect()->route('admin.main.categories')->with(['error' => ' لأ يمكن حذف هذا القسم  لانه يوجد تجار']);
            //            }
            //            $image = Str::after($maincategory->photo, 'assets/');
            //            $image = base_path('assets/' . $image);
            //            unlink($image); //delete from folder

//            $maincategory->categories()->delete();
            $maincategory->delete();
            return redirect()->route('admin.main.categories')->with(['success' => 'تم ألتحديث بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.main.categories')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

    public function changeStatus($id)
    {
        try {
            $maincategory = MainCategorie::find($id);
            if (!$maincategory) {
                return redirect()->route('admin.main.categories')->with(['error' => 'هذا القسم غير موجود ']);
            }

            $status = $maincategory->active == 0 ? 1 : 0;

            $maincategory->update(['active' => $status]);

            return redirect()->route('admin.main.categories')->with(['success' => ' تم تغيير الحالة بنجاح ']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.main.categories')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }
}