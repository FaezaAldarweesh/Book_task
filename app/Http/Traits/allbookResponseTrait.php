<?php 

namespace App\Http\Traits;

trait allbookResponseTrait 
{
    public function allbookResponse($data,$message,$status){
        $array = [
            'data'=>$data,
            'message'=>$message,
        ];

        return response()->json($array,$status);
    }
    
}