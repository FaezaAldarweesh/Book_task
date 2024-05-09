<?php

namespace App\Http\Controllers;

use App\Models\MainCategory;
use Illuminate\Http\Request;

class MainCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware('permission:mainCategory-list|mainCategory-create|mainCategory-edit|mainCategory-delete|find_MainCategory', ['only' => ['index']]);
        $this->middleware('permission:mainCategory-create', ['only' => ['create','store']]);
        $this->middleware('permission:mainCategory-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:mainCategory-delete', ['only' => ['destroy']]);
        $this->middleware('permission:find_MainCategory', ['only' => ['find_MainCategory']]);
    }
    
    public function index()
    {
        $MainCategories = MainCategory::all();
        return view('MainCategory.index' , compact('MainCategories'));
    }

//==============================================================================================================
    public function create()
    {
        return view('MainCategory.create');
    }


    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required |string',
        ]);
        
        MainCategory::create([
            'name_main_category' => $request->name,
        ]);

        return redirect()->route('MainCategory.index');
    }

//==============================================================================================================
    public function find_MainCategory(Request $request)
    {
        $request->validate([
            'find_MainCategory' => ['string'],
        ]);
        $MainCategories = MainCategory::where('name_main_category','like','%'.$request->find_MainCategory.'%')->get();
        return view('MainCategory.index' , compact('MainCategories'));
    }

//==============================================================================================================

    public function edit($id)
    {
        $mainCategory = MainCategory::findOrFail($id);
        return view('MainCategory.edit' , compact('mainCategory'));
    }


    public function update(Request $request , $id)
    {
        $request->validate([
            'name'=>['required' , 'string'],
        ]);
        $mainCategory = MainCategory::findOrFail($id);
        $mainCategory->name_main_category = $request->name;
        $mainCategory->save();
        return redirect()->route('MainCategory.index');
    }

//==============================================================================================================

    public function destroy($id)
    {
        $mainCategory = MainCategory::findOrFail($id);
        $mainCategory->delete();
        return redirect()->route('MainCategory.index');
    }


}
