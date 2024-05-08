<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Review;
use Illuminate\Http\Request;
use App\Http\Requests\ReviewRequest;
use App\Http\Resources\ReviewBooksResource;
use App\Http\Traits\ReviewBookResponseTrait;

class ReviewController extends Controller
{
    use ReviewBookResponseTrait;
    public function index()
    {
        $name_user = auth()->user()->name;
        $reviewBooks = ReviewBooksResource::collection(Review::where('name_user','=',$name_user)->get());
        return $this->ReviewBookResponse($reviewBooks," index successfully",200);
    }
//===========================================================================================================================
    public function store(ReviewRequest $request,$id)
    {
        $request->validated();

        $findBook = Book::find($id);
        $name_user = auth()->user()->name;

        $reviewBook = Review::create([
            'name_user' => $name_user,
            'name_book' => $findBook->name,
            'review' => $request->review,
        ]);
        return $this->ReviewBookResponse( new ReviewBooksResource($reviewBook),'add review Book successfully', 201);
    }
//===========================================================================================================================
public function update(ReviewRequest $request,$id)
{
    
    $request->validated();

    $findBook = Review::find($id);
    $findBook->review = $request->review;
    $findBook->save();

    return $this->ReviewBookResponse( new ReviewBooksResource($findBook),'update review Book successfully', 200);
}
//===========================================================================================================================
    public function destroy($id)
    {
        $reviewBook = Review::find($id);
        $reviewBook->delete();

        return $this->ReviewBookResponse(null," delete successfully",201);
    }
}
