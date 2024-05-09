<?php

namespace App\Http\Controllers;

use App\Models\MainCategory;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware('permission:subCategory-list|subCategory-create|subCategory-edit|subCategory-delete|find_SubCategory', ['only' => ['index']]);
        $this->middleware('permission:subCategory-create', ['only' => ['create','store']]);
        $this->middleware('permission:subCategory-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:subCategory-delete', ['only' => ['destroy']]);
        $this->middleware('permission:find_SubCategory', ['only' => ['find_SubCategory']]);
    }
    public function index()
    {
        $SubCategories = SubCategory::with('maincategory')->get();
        return view('SubCategory.index' , compact('SubCategories'));
    }

//==============================================================================================================
    public function create()
    {
        $maincategories = MainCategory::all();
        return view('SubCategory.create',compact('maincategories'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name'=>['required','string'],
            'maincategory_id'=>['required' , 'integer', 'exists:main_categories,id'],
        ]);
        
        SubCategory::create([
            'name_sub_category' => $request->name,
            'main_category_id'=>$request->maincategory_id
        ]);

        return redirect()->route('SubCategory.index');
    }

//==============================================================================================================
    public function find_SubCategory(Request $request)
    {
        $request->validate([
            'find_SubCategory' => ['string'],
        ]);
        $SubCategories = SubCategory::where('name_sub_category','like','%'.$request->find_SubCategory.'%')->get();
        return view('SubCategory.index' , compact('SubCategories'));
    }

//==============================================================================================================

    public function edit($id)
    {
        $subCategory = SubCategory::findOrFail($id);
        $maincategories = MainCategory::all();
        return view('SubCategory.edit' , compact('subCategory','maincategories'));
    }


    public function update(Request $request , $id)
    {
        $request->validate([
            'name'=>['required' , 'string'],
            'maincategory_id'=>['required' , 'integer', 'exists:main_categories,id'],
        ]);
        $subCategory = SubCategory::findOrFail($id);
        $subCategory->name_sub_category = $request->name;
        $subCategory->main_category_id  = $request->maincategory_id;
        $subCategory->save();
        return redirect()->route('SubCategory.index');
    }

//==============================================================================================================

    public function destroy($id)
    {
        $subCategory = SubCategory::findOrFail($id);
        $subCategory->delete();
        return redirect()->route('SubCategory.index');
    }


}
