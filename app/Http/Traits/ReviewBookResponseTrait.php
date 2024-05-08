<?php 

namespace App\Http\Traits;

trait ReviewBookResponseTrait 
{
    public function ReviewBookResponse($data,$message,$status){
        $array = [
            'data'=>$data,
            'message'=>$message,
        ];

        return response()->json($array,$status);
    }
    
}