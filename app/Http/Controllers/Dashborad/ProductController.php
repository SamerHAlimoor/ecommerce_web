<?php

namespace App\Http\Controllers\Dashborad;

use App\Http\Controllers\Controller;
use App\Http\Requests\GeneralProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    //

    //
    public function saveProductImages(Request $request)
    {
        $path = public_path('assets/images/products/');
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $file = $request->file('dzfile');

        $filename = uploadImage('products', $file);

        return response()->json([
            'name' => $filename,
            'original_name' => $file->getClientOriginalName(),
        ]);
    }

    public function index()
    {
        $products = Product::select('id', 'price', 'is_active', 'created_at')->orderBy('id', 'DESC')->paginate(PAGNIATION_COUNT);
        return view('admin.products.general.index', compact('products'));
    }

    public function create()
    {
        $data = [];
        // $categories = Category::parent()->orderBy('id', 'DESC')->get();
        $data['brands'] = Brand::active()->select('id')->get();
        $data['tags'] = Tag::active()->select('id')->get();
        $data['categories'] = Category::active()->select('id')->get();

        //return $data;

        return view('admin.products.general.gen1', compact('data'));
    }

    public function store(GeneralProductRequest $request)
    {

        try {
            DB::beginTransaction();

            if (!$request->has('is_active')) {
                $request->request->add(['is_active' => 0]);
            } else {
                $request->request->add(['is_active' => 1]);
            }

            //return $request;

            $product = Product::create([
                'slug' => $request->slug,
                'brand_id' => $request->brand_id,
                'is_active' => $request->is_active,
                'type' => $request->type,
                'price' => $request->price,
                'special_price' => $request->special_price,
                'special_price_type' => $request->special_price_type,
                'special_price_start' => $request->special_price_start,
                'special_price_end' => $request->special_price_end,
                'sku' => $request->sku,
                'manage_stock' => $request->manage_stock,
                'in_stock' => $request->in_stock,
                'qty' => $request->qty,

            ]);
            //save translations
            $product->name = $request->name;

            $product->description = $request->description;
            $product->short_description = $request->short_description;
            $product->save();
            $productCount = $product->id;

            if ($request->has('document') && count($request->document) > 0) {
                foreach ($request->document as $image) {
                    Image::create([
                        'product_id' => $productCount,
                        'imageable_id' => $productCount,
                        'imageable_type' => 'App\Models\Image',
                        'photo' => $image,
                    ]);
                }
            }
            //save product categories

            //save product tags
            $product->categories()->attach($request->categories);
            $product->tags()->attach($request->tags);
            //return $product;

            DB::commit();
            return redirect()->route('admin.products.general.index')->with(['success' => 'تم ألاضافة بنجاح']);
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->route('admin.products')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }

    }

    public function edit($id)
    {

        $data = [];
        // $categories = Category::parent()->orderBy('id', 'DESC')->get();
        $data['product'] = Product::find($id);
        $data['brands'] = Brand::active()->select('id')->get();
        $data['tags'] = Tag::active()->select('id')->get();
        $data['categories'] = Category::active()->select('id')->get();
        return $data;
        //get specific categories and its translations
        return view('admin.products.general.edit', compact('data'));

    }

    public function update($id, GeneralProductRequest $request)
    {

        try {
            //validation

            //update DB

            $product = Product::find($id);

            if (!$product) {
                return redirect()->route('admin.products')->with(['error' => 'هذا القسم غير موجود']);
            }

            if (!$request->has('is_active')) {
                $request->request->add(['is_active' => 0]);
            } else {
                $request->request->add(['is_active' => 1]);
            }

            $product->update($request->all());

            //save translations
            //save translations
            $product->name = $request->name;

            $product->description = $request->description;
            $product->short_description = $request->short_description;
            $product->save();

            //save product categories
            ;
            $product->categories()->attach($request->category_id);
            $product->tags()->attach($request->tags);

            return redirect()->route('admin.products')->with(['success' => 'تم التعديل  بنجاح']);

        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->route('admin.products')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }

    }

    public function destroy($id)
    {

        try {
            //get specific categories and its translations
            //get specific categories and its translations
            $products = Product::orderBy('id', 'DESC')->find($id);

            if (!$products) {
                return redirect()->route('admin.products')->with(['error' => 'هذا القسم غير موجود ']);
            }

            $image = Str::after($products->photo, '/assets');
            $image = base_path('public/assets/' . $image);
            unlink($image);
            $products->delete();
            return redirect()->route('admin.products')->with(['success' => 'تم  الحذف بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.products')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

/************************************************************************************************************** */

}