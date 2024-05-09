<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\FavoriteBook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\favoriteBooksResource;
use App\Http\Traits\favoriteBookResponseTrait;

class FavoriteBookController extends Controller
{
    use favoriteBookResponseTrait;

    public function __construct()
    {
        $this->middleware('permission:favoriteBook-index|favoriteBook-store|favoriteBook-delete', ['only' => ['index']]);
        $this->middleware('permission:favoriteBook-store', ['only' => ['store']]);
        $this->middleware('permission:favoriteBook-delete', ['only' => ['destroy']]);

    }
    public function index()
    {
        $name_user = auth()->user()->name;
        $favoriteBooks = favoriteBooksResource::collection(FavoriteBook::where('user_name','=',$name_user)->get());
        return $this->favoriteBookResponse($favoriteBooks," index successfully",200);
    }
//===========================================================================================================================
    public function store($id)
    {
        $findBook = Book::find($id);
        $name_user = auth()->user()->name;

        $favoriteBook = FavoriteBook::create([
            'user_name' => $name_user,
            'book_name' => $findBook->name,
        ]);
        return $this->favoriteBookResponse( new favoriteBooksResource($favoriteBook),'add favorite Book successfully', 201);
    }
//===========================================================================================================================
    public function destroy($id)
    {
        $favoriteBook = FavoriteBook::find($id);
        $favoriteBook->delete();

        return $this->favoriteBookResponse(null," delete successfully",201);
    }
}
