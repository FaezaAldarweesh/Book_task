<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'name_sub_category',
        'main_category_id',
    ];

    public function maincategory(){
        return $this->belongsTo(MainCategory::class,'main_category_id','id');
    }
    
    public function books(){
        return $this->hasMany(Book::class);
    }
}
