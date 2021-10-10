<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parentCategories = Category::where("parent_id", 0)->get();
        $attributes = Attribute::all();

        return view("admin.categories.create", compact("parentCategories", "attributes"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:categories,slug',
            'parent_id' => 'required',
            'attributes_ids' => 'required',
            'attributes_is_filter_ids' => 'required',
            'variation_id' => 'required',
        ]);

        try {
            DB::beginTransaction();

            $category =  Category::create([
                'name' => $request->name,
                'slug' => $request->slug,
                'parent_id' => $request->parent_id,
                'icon' => $request->icon,
                'description' => $request->description,
            ]);

            foreach ($request->attributes_ids as $attributeId) {
                $attribute = Attribute::findOrFail($attributeId);
                $attribute->categories()->attach($category->id, [
                    'is_filter' => in_array($attributeId, $request->attributes_is_filter_ids) ? 1 : 0,
                    'is_variation' => $request->variation_id == $attributeId ? 1 : 0,

                ]);
            }

            DB::commit();
        } catch (Exception $ex) {
            DB::rollBack();

            alert()->success('مشکل در ایجاد دسته بندی', 'هشدار ')->persistent('حله');
            return redirect()->back();
        }

        alert()->success('دسته بندی مورد نظر ایجاد شد', 'با تشکر');

        return redirect()->route("admin.categories.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
