<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FavoriteBook extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_name',
        'book_name',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
