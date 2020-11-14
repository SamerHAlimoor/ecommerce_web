<?php

namespace App\Http\Controllers\Dashborad;

use App\Http\Controllers\Controller;
use App\Http\Requests\TagsRequest;
use App\Models\Tag;
use Illuminate\Support\Facades\DB;

class TagsController extends Controller
{
    //

    //
    public function index()
    {
        $tags = Tag::orderBy('id', 'DESC')->paginate(PAGNIATION_COUNT);
        return view('admin.tags.index', compact('tags'));
    }

    public function create()
    {
        // $categories = Category::parent()->orderBy('id', 'DESC')->get();
        return view('admin.tags.create');
    }

    public function store(TagsRequest $request)
    {

        //  return $request;

        # code...
        DB::beginTransaction();

        $tag = Tag::create($request->only('slug'));
        //save translation
        $tag->name = $request->name;
        $tag->save();
        // save image

        DB::commit();
        return redirect()->route('admin.tags')->with(['success' => 'تم إضافة القسم بنجاح']);

    }

    public function edit($id)
    {

        //get specific categories and its translations
        $tag = Tag::orderBy('id', 'DESC')->find($id);

        if (!$tag) {
            return redirect()->route('admin.tags')->with(['error' => 'هذا القسم غير موجود ']);
        }

        return view('admin.tags.edit', compact('tag'));

    }

    public function update($id, TagsRequest $request)
    {

        try {
            //validation

            //update DB
            $tag = Tag::find($id);

            if (!$tag) {
                return redirect()->route('admin.tags')->with(['error' => 'هذا القسم غير موجود']);
            }
            DB::beginTransaction();
            // return $request;
            $tag->update($request->except('_token', 'id'));
            //save translation
            $tag->name = $request->name;
            $tag->save();
            DB::commit();

            return redirect()->route('admin.tags')->with(['success' => 'تم ألتحديث بنجاح']);

        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->route('admin.tags')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }

    }

    public function destroy($id)
    {

        try {
            //get specific categories and its translations
            $tag = Tag::find($id);

            if (!$tag) {
                return redirect()->route('admin.tags')->with(['error' => 'هذا القسم غير موجود ']);
            }

            $tag->delete();

            return redirect()->route('admin.tags')->with(['success' => 'تم  الحذف بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.tags')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

}