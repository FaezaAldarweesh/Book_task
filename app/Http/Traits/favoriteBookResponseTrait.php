<?php 

namespace App\Http\Traits;

trait favoriteBookResponseTrait 
{
    public function favoriteBookResponse($data,$message,$status){
        $array = [
            'data'=>$data,
            'message'=>$message,
        ];

        return response()->json($array,$status);
    }
    
}