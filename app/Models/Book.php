<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'author',
        //'main_category_id',
        'sub_category_id',
    ];

    public function subcategory(){
        return $this->belongsTo(SubCategory::class,'sub_category_id','id');
    }

    public function reviews(){
        return $this->hasMany(Review::class);
    }
}
