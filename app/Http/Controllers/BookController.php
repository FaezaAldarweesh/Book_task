<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\searchRequest;
use App\Http\Resources\BookResource;
use App\Http\Traits\allbookResponseTrait;

class BookController extends Controller
{
    use allbookResponseTrait;
    public function __construct()
    {
        $this->middleware('auth')->except('all_books','search');

        $this->middleware('permission:book-list|book-create|book-edit|book-delete|book-find_Book', ['only' => ['index']]);
        $this->middleware('permission:book-create', ['only' => ['create','store']]);
        $this->middleware('permission:book-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:book-delete', ['only' => ['destroy']]);
        $this->middleware('permission:book-find_Book', ['only' => ['find_Book']]);

        $this->middleware('permission:book-all_books', ['only' => ['all_books']]);
        $this->middleware('permission:book-search', ['only' => ['search']]);

    }
    public function index()
    {
        $Books = Book::with('subcategory')->get();
        return view('Book.index' , compact('Books'));
    }

//==============================================================================================================
    public function create()
    {
        $subcategories = SubCategory::all();
        return view('Book.create',compact('subcategories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=>['required','string'],
            'author'=>['required','string'],
            'subcategory_id'=>['required' , 'integer', 'exists:sub_categories,id'],
        ]);
        
        Book::create([
            'name' => $request->name,
            'author'=>$request->author,
            'sub_category_id'=>$request->subcategory_id
        ]);

        return redirect()->route('Book.index');
    }

//==============================================================================================================
    public function find_Book(Request $request)
    {
        $request->validate([
            'find_Book' => ['string'],
        ]);
        $Books = Book::where('name','like','%'.$request->find_Book.'%')->get();
        return view('Book.index' , compact('Books'));
    }

//==============================================================================================================

    public function edit($id)
    {
        $Books = Book::findOrFail($id);
        $subCategories = SubCategory::all();
        return view('Book.edit' , compact('Books','subCategories'));
    }


    public function update(Request $request , $id)
    {
        $request->validate([
            'name'=>['required' , 'string'],
            'author'=>['required' , 'string'],
            'subcategory_id'=>['required' , 'integer', 'exists:sub_categories,id'],
        ]);
        $Book = Book::findOrFail($id);
        $Book->name = $request->name;
        $Book->author = $request->author;
        $Book->sub_category_id  = $request->subcategory_id;
        $Book->save();
        return redirect()->route('Book.index');
    }

//==============================================================================================================

    public function destroy($id)
    {
        $Book = Book::findOrFail($id);
        $Book->delete();
        return redirect()->route('Book.index');
    }
//==============================================================================================================
public function all_books()
{
    $all_books = BookResource::collection(Book::with('subcategory')->get());
    return $this->allbookResponse($all_books," all book successfully",200);
}
//==============================================================================================================
public function search($id)
{
    $search = BookResource::collection(Book::where('sub_category_id', $id)->with('subcategory')->get());
    return $this->allbookResponse($search, "Showing all books in the specified category successfully", 200);
}
}
