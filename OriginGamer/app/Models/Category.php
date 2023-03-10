<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    // Define the fillable attributes for mass assignment
    protected $fillable = 'name';
    // Define the relationship with the Post model
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
