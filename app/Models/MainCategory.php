<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainCategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'name_main_category',
    ];

    public function subcategories(){
        return $this->hasMany(SubCategory::class);
    }
}
