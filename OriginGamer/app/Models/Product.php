<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'price',
        'content',
        'category_id',
    ];
    //relationships
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
